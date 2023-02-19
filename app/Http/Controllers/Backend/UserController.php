<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\Helpers\CommonHelper;
use Validator,Auth,DB,Storage;
use App\Models\User;
use App\Models\Table;
use App\Models\Outlet;

class UserController extends CommonController
{   
	use CommonHelper;
	
	/**
	* Create a new controller instance.
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth');
	}

	// List of Users
	public function index(){
		$page_title	= '';
		return view('backend.user.list', compact('page_title'));
	}
  
	// CREATE
	public function create(){
		$page_title	= '';
		$outlet		= Outlet::where('status','active')->get();
		return view('backend.user.add', compact('page_title','outlet'));
	}

	/**
	* List User.
	* @return void
	*/
	public function ajax($id = null)
	{
		try{
			// GET LIST
			$query = User::where('user_type','!=','superAdmin')->where('user_type','!=','developer')->orderBy('id','DESC')->get();
			if($query){
			foreach($query as $key=> $list){
				$query[$key]->action = '<div class="widget-content-right widget-content-actions">
										<a class="border-0 btn-transition btn btn-outline-success" href="'. route("users.edit",$list->id) .'"><i class="fa fa-eye"></i></a>
										<button class="border-0 btn-transition btn btn-outline-danger" onclick="deleteThis('. $list->id .')"><i class="fa fa-trash-alt"></i></button>
										</div>';
				$outlet = Outlet::where('id', $list->outlet_id)->first();
				if($outlet){ $query[$key]->outlet = $outlet->title;}
				else{ $query[$key]->outlet = 'Unknown'; }
				
				$status_array = ['Active'=>'', 'Inactive'=>''];
				if($list->status == 'Active') { $status_array['Active'] = 'selected'; }
				if($list->status == 'Inactive') { $status_array['Inactive'] = 'selected'; }
				$status = "<select class='form-control change_status' id='$list->id'>
									<option value='Active' 	". $status_array['Active'] .">Active</option>
									<option value='Inactive'". $status_array['Inactive'] .">Inactive</option>
								</select>";
				
				$query[$key]->status = $status;
			}
			$this->sendResponse($query, trans('common.data_found_success'));
			}
			$this->sendResponse([], trans('common.data_found_empty'));

		} catch (Exception $e) {
			$this->ajaxError([], $e->getMessage());
		}
	}
	
	/**
	* List Users.
	* @return void
	*/
	public function edit($id = null)
	{
		try{
			$page_title = trans('user.update');
			$data    	= User::where('id',$id)->first();
			$outlet		= Outlet::where('status','active')->get();
			if(!empty($data)){
				return view('backend.user.edit',compact(['page_title','data','outlet']));
			}
			return redirect()->route('homePage')->with('error', trans('common.invalid_table'));
      
		} catch (Exception $e) {
			return redirect()->route('homePage')->with('error', $e->getMessage());
		}
	}

	/**
	* Save User.
	* @return void
	*/
	public function store(Request $request){
		
		$validator = Validator::make($request->all(), [
			  'name'				=> 'required|min:3|max:99',
			  'mobile_number'		=> 'required|max:11',
			  'email'				=> 'required|max:51',
			  'outlet_id'			=> 'required|max:21',
			  'status'				=> 'required|min:3|max:51',
			  'user_type'			=> 'required',
		]);
		if($validator->fails()){
			$this->ajaxValidationError($validator->errors(), trans('common.error'));
		}

		$user = Auth()->user();
		if(empty($user)){
			$this->ajaxError([], trans('common.unauthorized_access'));
		}
			
		DB::beginTransaction();
		try{
			
			$data = [
				'name'				=> $request->name,
				'outlet_id'			=> $request->outlet_id,
				'user_type'			=> $request->user_type,
				'status'			=> $request->status,
			];
			
			// MEDIA UPLOAD
			if(!empty($request->image) && $request->image != 'undefined'){
				$validator = Validator::make($request->all(), [
					'image'	=> 'sometimes|image|mimes:jpeg,png,jpg|max:1024',
				]);
				if($validator->fails()){
					$this->ajaxValidationError($validator->errors(), trans('common.error'));
				}
				$data['profile_image'] =  $this->saveMedia($request->file('image'));
			}
			
			if(!empty($request->password)){
				$data['password'] = bcrypt($request->password);
			}
			
			if(empty($request->item_id)){
				$validator = Validator::make($request->all(), [
					  'mobile_number' 	=> 'required|min:8|unique:users',
					  'email' 			=> ['required', 'string', 'email', 'max:255', 'unique:users'],
					  'password'		=> 'required|max:21',
				]);
				if($validator->fails()){
					$this->ajaxValidationError($validator->errors(), trans('common.error'));
				}
				$data['mobile_number'] 	= $request->mobile_number;
				$data['email'] 			= $request->email;
				
				
				$insert = User::create($data);
				if($insert){
					DB::commit();
					$this->sendResponse([], trans('common.added_success'));
				}
			}else{
				
				$validator = Validator::make($request->all(), [
					'mobile_number'	=>  ['required','numeric',Rule::unique('users')->ignore($request->item_id)],
					'email'			=>  ['required','max:99',Rule::unique('users')->ignore($request->item_id)],
				]);
				if($validator->fails()){
					$this->ajaxValidationError($validator->errors(), trans('common.error'));
				}
				
				
				
				$query 	= User::find($request->item_id);
				if($query){
					$return	=  $query->update($data);
					if($return){
						DB::commit();
						$this->sendResponse([], trans('common.updated_success'));
					}
				}
			}
			DB::rollback();
			$this->ajaxError([], trans('common.try_again'));
			
		} catch (Exception $e) {
			DB::rollback();
			$this->ajaxError([], $e->getMessage());
		}
	}


	/**
	* Store QR.
	* @return void
	*/
	public function store_qr(Request $request){
		$validator = Validator::make($request->all(), [
			'user_id'	=> 'required|min:1|max:11',
			'file'	=> 'required|min:2|max:199',
		]);
		if($validator->fails()){
			$this->ajaxError('', $validator->errors()->first());
		}
		
		$user = Auth()->user();
		if(empty($user)){
			$this->ajaxError([], trans('common.invalid_user'));
		}
		
		DB::beginTransaction();
		try{
			$query = User::where(['id'=> $request->user_id])->orderBy('id','DESC')->first();
			if($query){
				// Update
				$data = ['qr' => $request->file];
				$return	=  $query->update($data);
				if($return){
					DB::commit();
					$this->sendResponse(['status'=>'success'], trans('common.generate_success'));
				}
			}
			$this->ajaxError([], trans('common.try_again'));
		} catch (Exception $e) {
			DB::rollback();
			$this->ajaxError([], $e->getMessage());
		}
	}
	
	/**
	* Change User Status.
	* @return void
	*/
	public function change_status(Request $request){
		DB::beginTransaction();
		try {
			$query = User::where('id',$request->id)->update(['status'=>$request->status]);
			if($query){
			  DB::commit();
			  $this->sendResponse(['status'=>'success'], trans('common.updated_success'));
			}else{
			  DB::rollback();
			  $this->sendResponse(['status'=>'error'], trans('common.updated_error'));
			}
			
		} catch (Exception $e) {
			DB::rollback();
			$this->ajaxError([], $e->getMessage());
		}
	}
	
	/**
	* DESTROY
	* @return void
	*/
	public function destroy(Request $request){
		$validator = Validator::make($request->all(), [
			'item_id' => 'required',
		]);
		if($validator->fails()){
			$this->ajaxError($validator->errors(), trans('common.error'));
		}
		
		try{
			// DELETE
			$query = User::where(['id'=>$request->item_id])->delete();
			if($query){
				$this->sendResponse([], trans('common.delete_success'));
			}
			$this->sendResponse([], trans('common.delete_error'));
		} catch (Exception $e) {
			$this->ajaxError([], $e->getMessage());
		}
	}
}