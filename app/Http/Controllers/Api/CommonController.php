<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

use DB,Validator,Settings;

use App\Models\Helpers\CommonHelper;
use App\Models\Setting;

class CommonController extends BaseController
{
	/**
	* ---------------------------------
	* General Information
	* @return \Illuminate\Http\Response
	* ---------------------------------
	*/
    public function generalInformation(Request $request){
        try {
			$data = [
				'title' 				=> Setting::get('site_name'),
				'contact_no'			=> Setting::get('contact_no'),
				'contact_email'			=> Setting::get('site_email'),
				'app_version'			=> Setting::get('app_version'),
				'force_update_version'	=> Setting::get('app_version'),
				'fcm_server_key'		=> Setting::get('fcm_server_key'),
				'google_map_api_key'	=> Setting::get('google_map_api_key'),
				'copy_rights_year'		=> Setting::get('copy_rights_year'),
				'xd_web'				=> '',
				'xd_customer'			=> '',
				'playstore_url'			=> 'https://play.google.com/store/apps/details?id=com.teapost.tvapp',
				'appstore_url'			=> '',
			];
			return $this->sendResponse($data, trans('customer_api.data_found_success'));
			
		} catch (Exception $e) {
			$this->ajaxError([], $e->getMessage());
		}
    }
	
	/**
	* ---------------------------------
	* CMS Pages
	* @return \Illuminate\Http\Response
	* ---------------------------------
	*/
    public function cmsPages(Request $request){
        
        $return['about']            = url('about-us');
        $return['contact']          = url('contact-us');
        $return['terms']            = url('terms');
        $return['privacy_policy']   = url('privacy-policy');
        return $this->sendResponse($return, trans('customer_api.data_found_success'));
    }
}