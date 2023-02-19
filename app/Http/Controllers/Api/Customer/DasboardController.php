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
use App\Models\Order;
use App\Http\Resources\DasboardResource;

class DasboardController extends BaseController
{

  /**
   * Dashboard
   * @return \Illuminate\Http\Response
   */
	public function index(Request $request){
      
		$page   = $request->page ?? 1;
		$count  = $request->count ?? '100';

		if ($page <= 0){ $page = 1; }
		$start = $count * ($page - 1);

		$user = Auth::user();
		if(empty($user)){
		  return $this->sendError('',trans('customer_api.invalid_user'));
		}

		try{
			$query = Order::where(['outlet_id'=>$user->outlet_id, 'status'=>'New'])->orderBy('id', 'DESC')->offset($start)->limit($count)->get();
			
			if($query->count() > 0){
				return $this->sendArrayResponse(DasboardResource::collection($query), trans('customer_api.data_found_success'));
			}
			return $this->sendArrayResponse('', trans('customer_api.data_found_empty'));
		}catch (\Exception $e) { 
		  DB::rollback();
		  return $this->sendError('', $e->getMessage()); 
		}
	}
}