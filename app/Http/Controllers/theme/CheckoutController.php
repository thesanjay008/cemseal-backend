<?php

namespace App\Http\Controllers\theme;

use Auth;
use App;
use App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Address;

class CheckoutController extends CommonController
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
	* Show the application first page.
	*/
	public function index(){
		
		$user = Auth()->user();
		if(empty($user)){
			return redirect()->route('menuPage');
		}
		
		try {
			$page       = 'checkoutPage';
			$page_title = trans('title.checkout');
			
			// GET CART DATA
			$cartData = Cart::with(['product'])->where('user_id', $user->id)->get();
			$addresses = Address::where('user_id', $user->id)->get();
			
			if($cartData->count() > 0){
				return view('theme.order.checkout', compact('page','page_title','cartData','addresses'));
			}
			
			return redirect()->route('menuPage');

		} catch (Exception $e) {
		  return redirect()->route('menuPage')->withError($e->getMessage());
		}
	}
}
