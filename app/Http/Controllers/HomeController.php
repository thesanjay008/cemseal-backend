<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Product;
use App\Models\MenuCategory;

class HomeController extends Controller
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
		$page				= 'home';
		$page_title			= '';
		
		return redirect('/login');
		
        $top_categories		= MenuCategory::where(['status'=> 'active'])->skip(0)->take(9)->orderBy('id', 'DESC')->get();
        $top_list			= Product::where(['status'=> 'active'])->skip(0)->take(6)->orderBy('id', 'DESC')->get();
		
		return view('theme/firstPage', compact('page','page_title','top_list','top_categories'));
    }
	
	/**
	* 	CHECK NEW ORDER STATUS
	*/
	public function ajax_checkNewOrder(){
      try {
		  $html = "<audio controls autoplay hidden='true'><source src='http://www.w3schools.com/html/horse.ogg' type='audio/ogg'></audio>";
          return response()->json(['success' => '1', 'status' => '200', 'data' => [], 'html' => $html, 'message' => trans('order.check_status')]);
      } catch (Exception $e) {
          return response()->json(['success' => '0', 'status' => '201', 'data' => [], 'message' => $e->getMessage()]);
      }
    }
	
    //Localization function
    public function lang($locale){
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }
    /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
    public function get_country(){
      try {
          $countries = Country::where('status',Country::ACTIVE_STATUS)->pluck('name','id');
          return response()->json(['success' => '1', 'data' => $countries, 'message' => 'country_list']);
      } catch (Exception $e) {
          return response()->json(['success' => '0', 'data' => [], 'message' => $e->getMessage()]);
      }
    }
    /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
    public function get_state($country_id){
      try {
          $states = State::where('country_id',$country_id)->pluck('name','id');
          return response()->json(['success' => '1', 'data' => $states, 'message' => 'state_list']);
      } catch (Exception $e) {
          return response()->json(['success' => '0', 'data' => [], 'message' => $e->getMessage()]);
      }
    }
}
