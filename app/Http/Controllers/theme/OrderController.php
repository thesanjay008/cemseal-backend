<?php

namespace App\Http\Controllers\theme;

use App\Http\Controllers\CommonController;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator,Auth,DB,Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Helpers\CommonHelper;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;

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
		$this->middleware(['auth']);
	}
	
	/**
	* 
	* Create a new Order
	* @return void
	*
	*/
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'payment_method' => 'required',
			'delivery_address' => 'required',
		]);
		if($validator->fails()){
			$this->ajaxError([], $validator->errors()->first());
		}

		$user = Auth()->user();
		if(empty($user)){
			$this->ajaxError([], trans('common.login_to_continue'));
		}
		
		DB::beginTransaction();
		try{
			$shipping_address 	= 'Undefined address';
			$payment_url 		= '';
			
			// GET Address
			$address = Address::where(['id'=> $request->delivery_address])->first();
			if(!empty($address)){
				$shipping_address = '('. $address->address_type .') '. $address->address .' '. $address->city->name .' '. $address->address;
			}

			// GET CART DATA
			$cartData = Cart::where('user_id', $user->id)->get();
			if($cartData->count() > 0){
				
				if($request->payment_method_id == 1){
					$data['status'] = 'New';
				}else {
					// Ctreate Payment URL
					
				}
				
				// CREATE ORDER
				$data['custom_order_id'] 	= time();
				$data['order_date']    		= date('Y-m-d');
				$data['user_id']       		= $user->id;
				$data['payment_method_id']	= $request->payment_method_id;
				$data['address_id']			= $request->delivery_address;
				$data['shipping_address']	= $shipping_address;
				$data['item_count']    		= $cartData->count();
				$data['quantity']      		= $cartData->sum('quantity');
				$data['total']         		= $cartData->sum('total');
				$data['grand_total']   		= $cartData->sum('total');
				
				$insert		 = Order::create($data);
				if($insert){
					// INSERT ORDER ITEMS
					foreach($cartData as $key=> $list){
						$orderItems = array(
						  'order_id'			=> $insert->id,
						  'custom_order_id'		=> $insert->custom_order_id,
						  'product_id'			=> $list->product_id,
						  'quantity'			=> $list->quantity,
						  'price'				=> $list->price,
						  'total'				=> $list->total,
						);
						OrderItem::create($orderItems);
					}
					DB::commit();
					
					if($request->payment_method == 1){
						CommonHelper::order_finalization($insert->id, $user);
					}
					
					$response['payment_url'] = $payment_url;
					$this->sendResponse($response, trans('order.confirm_success'));
				}
			}
			
			$this->sendResponse([], trans('order.failed_to_create'));
		} catch (Exception $e) {
			DB::rollback();
			$this->ajaxError([], $e->getMessage());
		}
	}
	
	/**
	* 
	* Confirm the Order
	* @return void
	*
	*/
	public function confirm(Request $request){
		
		
		return redirect()->route('order_successPage');
    }
	
	public function orderSuccess(){
		$page		= 'orderSuccess';
        $page_title = trans('title.order_success');
		
		return view('theme.order.success-message',compact('page', 'page_title'));
    }
}