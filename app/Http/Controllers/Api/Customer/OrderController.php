<?php

namespace App\Http\Controllers\Api\Customer;

use Validator;
use DB,Settings;
use Authy\AuthyApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController;
use App\Models\Helpers\CommonHelper;
use App\Models\Order;

class OrderController extends BaseController
{

	/**
	* Create Order
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
		  'order_id'  => 'required',
		]);
		if($validator->fails()){
		  return $this->sendValidationError('', $validator->errors()->first());       
		}
		
		$user = Auth::user();
		if(empty($user)){
			return $this->sendError('',trans('customer_api.invalid_user'));
		}
		
		DB::beginTransaction();
		try {
			$insertData = [
			  'custom_order_id'	=> $request->order_id,
			  'user_id'       	=> $user->id,
			  'outlet_id'      	=> $user->outlet_id,
			  'table_id' 		=> $request->table_id,
			  'status' 			=> 'New',
			  'date'          	=> date('Y-m-d'),
			];

			$return = Order::create($insertData);
			if($return){
				DB::commit();
				return $this->sendResponse('', trans('customer_api.data_added_success'));
			}
			DB::rollback();
			return $this->sendError('',trans('customer_api.data_added_error'));
			
		}catch (Exception $e) {
			DB::rollback();
			return $this->sendError($this->object,$e->getMessage());
		}
	}
	
	/**
	* Create Order
	*
	* @return \Illuminate\Http\Response
	*/
	public function complete(Request $request)
	{
		$validator = Validator::make($request->all(), [
		  'id'  => 'required',
		]);
		if($validator->fails()){
		  return $this->sendValidationError('', $validator->errors()->first());       
		}
		
		$user = Auth::user();
		if(empty($user)){
			return $this->sendError('',trans('customer_api.invalid_user'));
		}
		
		DB::beginTransaction();
		try {
			$query = Order::where(['id'=>$request->id, 'status'=>'New'])->first();
			if($query){
				$query->status = 'Delivered';
				$return = $query->save();
				if($return){
					DB::commit();
					return $this->sendResponse('', trans('customer_api.data_updated_success'));
				}
			}
			DB::rollback();
			return $this->sendError('',trans('customer_api.data_added_error'));
			
		}catch (Exception $e) {
			DB::rollback();
			return $this->sendError($this->object,$e->getMessage());
		}
	}
}