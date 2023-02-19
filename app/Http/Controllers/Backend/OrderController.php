<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\CommonController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Helpers\CommonHelper;
use Validator,Auth,DB,Storage;
use Illuminate\Validation\Rule;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\Outlet;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class OrderController extends CommonController
{   
	use CommonHelper;
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:res_order-list', ['only' => ['index','show']]);
        $this->middleware('permission:res_order-create', ['only' => ['create','store']]);
        $this->middleware('permission:res_order-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:res_order-delete', ['only' => ['destroy']]);
    }
  
	// List Page
	public function index(){
		return view('backend.orders.list');
	}
  
	// List 
	public function ajax($id = null){
		try{
			// GET LIST
			$query = Order::where('status','!=','Unconfirmed')->orderBy('id', 'DESC')->get();
			if(count($query) > 0){
				foreach($query as $key=> $list){
					$query[$key]->action = '<div class="widget-content-right widget-content-actions"></div>';

					$query[$key]->customer_name = $list->user ? $list->user->name : 'Unknown';
					
					$outlet = Outlet::where('id', $list->outlet_id)->first();
					if($outlet){ $query[$key]->outlet = $outlet->title;}
					else{ $query[$key]->outlet = 'Unknown'; }
				
					if ($list->status == 'New') {
						$query[$key]->status = '<select class="form-control status" name="status" id="'.$list->id.'">
								<option value="New">New</option>
								<option value="Delivered">Completed</option>
						</select>';
					} elseif ($list->status == 'Delivered') {
						$query[$key]->status = '<select class="form-control status" name="status" id="'.$list->id.'">
								<option value="Delivered">Completed</option>
						</select>';
					} else {
						$query[$key]->status = '<select class="form-control status" name="status" id="'.$list->id.'">
								<option value="Unconfirmed">Unconfirmed</option>
								<option value="Delivered">Completed</option>
						</select>';
					}
				}
				$this->sendResponse($query, trans('order.data_found_success'));
			}
			$this->sendResponse([], trans('order.data_found_empty'));
		} catch (Exception $e) {
			$this->ajaxError([], $e->getMessage());
		}
	}

	public function status(Request $request){
	    DB::beginTransaction();
	    try {
	        $res = Order::where('id',$request->id)->update(['status'=>$request->status]);

	        if($res)
	        {
	          DB::commit();
	          $this->sendResponse(['status'=>'success'], trans('order.status_updated_successfully'));

	        }
	        else
	        {
	          DB::rollback();
	          $this->sendResponse(['status'=>'error'], trans('order.status_not_updated'));
	        }
	        
	    } catch (Exception $e) {
	        DB::rollback();
	        $this->ajaxError([], $e->getMessage());
	    }


	}

	// SHOW
	public function show($id = null){
		$order = Order::find($id);
		return view('backend.orders.show',compact('order'));
	}

	/**
	* 	CHECK NEW ORDERS
	*/
	public function ajax_checkNewOrders(){
      try {
		  $query = order::where('status','=','New')->get();
		  if(count($query) > 0){
			$return['count']	= $query->count();
			$return['html']		= "<audio controls autoplay hidden='true'><source src='". asset('default/ringtone.mpeg') ."' type='audio/mpeg'></audio>";
			 $this->sendResponse($return, trans('common.data_found_success'));
		  }
		  $this->sendResponse([], trans('common.data_found_empty'));
      } catch (Exception $e) {
          $this->ajaxError([], $e->getMessage());
      }
    }
	
	// OPEN ORDER COUNT
	public function ajax_count(Request $request){
		try{
			$cartData = order::where('status','=','New')->get();
			if($cartData){
				$return['count'] = $cartData->count();
				$this->sendResponse($return, trans('cart.data_found_success'));
			}
		} catch (Exception $e) {
			$this->ajaxError([], $e->getMessage());
		}
	}
}