<?php

namespace App\Http\Controllers\Api\Customer;

use Validator;
use DB,Settings;
use Authy\AuthyApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Helpers\CommonHelper;
use App\Models\Banner;
use App\Models\User;
use App\Http\Resources\BannerListResource;

class BannersController extends BaseController
{

	/**
	* Banners
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request){
      
		$page   = $request->page ?? 1;
		$count  = $request->count ?? '20';

		if ($page <= 0){ $page = 1; }
		$start = $count * ($page - 1);

		$user = Auth::user();
		if(empty($user)){
			return $this->sendUnauthorizedError([], trans('customer_api.invalid_user'));
			$user = User::where('id', 4)->first();
		}
		
		try{
			//$query = Banner::where(['outlet_id'=>$user->outlet_id, 'status'=>'Active', 'type'=>'Slider'])->orderBy('id', 'ASC')->offset($start)->limit($count)->get();
			$query = Banner::where(function ($query) use ($user) {
				$query->where('outlet_id', '=', $user->outlet_id)->orWhere('outlet_id', '=', NULL);
				})->where(function ($query) {
				$query->where('status', '=', 'Active')->where('type', '=', 'Slider');
			})->orderBy('sorting', 'ASC')->offset($start)->limit($count)->get();
			
			if($query->count() > 0){
				return $this->sendArrayResponse(BannerListResource::collection($query), trans('customer_api.data_found_success'));
			}
			return $this->sendArrayResponse('', trans('customer_api.data_found_empty'));
		}catch (\Exception $e) { 
			DB::rollback();
			return $this->sendError('', $e->getMessage()); 
		}
	}

	/**
	* Dashboard Baners
	* @return \Illuminate\Http\Response
	*/
	public function order_banners(Request $request){
      
		$page   = $request->page ?? 1;
		$count  = $request->count ?? '50';

		if ($page <= 0){ $page = 1; }
		$start = $count * ($page - 1);

		$user = Auth::user();
		if(empty($user)){
		  return $this->sendError('',trans('customer_api.invalid_user'));
		}
		
		try{
			//$query = Banner::where(['outlet_id'=>$user->outlet_id, 'status'=>'Active', 'type'=>'Order'])->orderBy('id', 'ASC')->offset($start)->limit($count)->get();
			
			$query = Banner::where(function ($query) use ($user) {
				$query->where('outlet_id', '=', $user->outlet_id)->orWhere('outlet_id', '=', NULL);
				})->where(function ($query) {
				$query->where('status', '=', 'Active')->where('type', '=', 'Order');
			})->orderBy('sorting', 'ASC')->offset($start)->limit($count)->get();
			
			if($query->count() > 0){
				return $this->sendArrayResponse(BannerListResource::collection($query), trans('customer_api.data_found_success'));
			}
			return $this->sendArrayResponse('', trans('customer_api.data_found_empty'));
		}catch (\Exception $e) { 
			DB::rollback();
			return $this->sendError('', $e->getMessage()); 
		}
	}
}