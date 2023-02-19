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
use App\Models\Banner;
use App\Models\Outlet;

class BannerController extends CommonController
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

	// List of Tables
	public function index(){
		$page_title    	= '';
		return view('backend.banner.list', compact('page_title'));
	}
  
	// CREATE
	public function create(){
		$page_title    	= '';
		$outlet			= Outlet::where('status','active')->get();
		return view('backend.banner.add', compact('page_title','outlet'));
	}

	/**
	* List Tables.
	* @return void
	*/
	public function ajax($id = null){
		$page		= $request->page ?? '1';
		$count		= $request->count ?? '1000';
		$search		= $request->search ?? '';
		$status		= $request->status ?? 'all';
		
		if ($page <= 0){ $page = 1; }
		$start  = $count * ($page - 1);
		
		try{
			// GET LIST
			$query = Banner::where('delete_at',NULL);
			
			/* SEARCH */
			if($search){
				$query->where('title','like','%'.$search.'%');
			}
			
			// STATUS
			if($status != 'all' && !empty($status)){
				$query->where('status', $status);
			}
			
			$data  = $query->orderBy('id', 'DESC')->offset($start)->limit($count)->get();
			if($data){
				foreach($data as $key=> $list){
					$data[$key]->action = '<div class="widget-content-right widget-content-actions">
											<a class="border-0 btn-transition btn btn-outline-success" href="'. route("banners.edit",$list->id) .'"><i class="fa fa-eye"></i></a>
											<button class="border-0 btn-transition btn btn-outline-danger" onclick="deleteThis('. $list->id .')"><i class="fa fa-trash-alt"></i></button>
											</div>';
											
					$status_array = ['Active'=>'', 'Inactive'=>''];
					if($list->status == 'Active') { $status_array['Active'] = 'selected'; }
					if($list->status == 'Inactive') { $status_array['Inactive'] = 'selected'; }
					$status = "<select class='form-control change_status' id='$list->id'>
										<option value='Active' 	". $status_array['Active'] .">Active</option>
										<option value='Inactive'". $status_array['Inactive'] .">Inactive</option>
									</select>";
					
					$data[$key]->status = $status;
					
					if($list->image){
						if(strpos($list->image, '.mp4') !== false){
							$data[$key]->image = '<video width="140" controls><source src="'. asset($list->image) .'" type="video/mp4"></video>';
						}else{
							$data[$key]->image = '<img src="'. asset($list->image) .'" width="140px"></td>';
						}
					}else{
						$data[$key]->image = asset(config('constants.DEFAULT_IMAGE'));
					}
					
					$outlet = Outlet::find($list->outlet_id);
					if($outlet){
						$data[$key]->outlet = $outlet->title;
					}else{
						$data[$key]->outlet = 'Uknown';
					}
				}
				$this->sendResponse($data, trans('common.data_found_success'));
			}
			$this->sendResponse([], trans('common.data_found_empty'));

		} catch (Exception $e) {
			$this->ajaxError([], $e->getMessage());
		}
	}
	
	/**
	* List Table.
	* @return void
	*/
	public function edit($id = null)
	{
		try{
			$page_title = trans('banner.update');
			$data    	= Banner::where('id',$id)->first();
			$outlet		= Outlet::where('status','active')->get();
			if(!empty($data)){
				return view('backend.banner.edit',compact(['page_title','data','outlet']));
			}
			return redirect()->route('homePage')->with('error', trans('common.invalid_table'));
      
		} catch (Exception $e) {
			return redirect()->route('homePage')->with('error', $e->getMessage());
		}
	}

	/**
	* Save Table.
	* @return void
	*/
	public function store(Request $request){
		
		$validator = Validator::make($request->all(), [
			  'title'				=> 'required|min:3|max:99',
			  //'outlet_id'			=> 'required|max:11',
			  'status'				=> 'required|min:3|max:51',
			  'timimg'				=> 'required',
			  'type'				=> 'required',
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
				'title'              	=> $request->title,
				'outlet_id'				=> $request->outlet_id,
				'type'					=> $request->type,
				'timimg'				=> $request->timimg,
				'sorting'				=> $request->sorting,
				'status'                => $request->status,
			];
			
			// MEDIA UPLOAD
			if(!empty($request->image)){
				$validator = Validator::make($request->all(), [
					'image'	=> 'sometimes|image|mimes:jpeg,png,jpg,gif,mp4|max:35000',
				]);
				if($validator->fails()){
					//$this->ajaxValidationError($validator->errors(), trans('common.error'));
				}
				$data['image'] =  $this->saveMedia($request->file('image'));
			}
			
			if(empty($request->item_id)){
				
				$insert = Banner::create($data);
				if($insert){
					DB::commit();
					$this->sendResponse([], trans('common.added_success'));
				}
			}else{
				$query 	= Banner::find($request->item_id);
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
	* Change Table Status.
	* @return void
	*/
	public function change_status(Request $request){
		DB::beginTransaction();
		try {
			$query = Banner::where('id',$request->id)->update(['status'=>$request->status]);
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
	
	// DESTROY
	public function destroy(Request $request){
		$validator = Validator::make($request->all(), [
			'item_id' => 'required',
		]);
		if($validator->fails()){
			$this->ajaxError([], $validator->errors()->first());
		}
		
		try{
			// DELETE
			$query = Banner::where(['id'=>$request->item_id])->delete();
			if($query){
				$this->sendResponse([], trans('common.delete_success'));
			}
			$this->sendResponse([], trans('common.delete_error'));
		} catch (Exception $e) {
			$this->ajaxError([], $e->getMessage());
		}
	}
}