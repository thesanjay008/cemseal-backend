<?php

namespace App\Http\Controllers\Api\Customer\Auth;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator,DB;
use App\Models\DeviceDetail;
use Spatie\Permission\Models\Role;
use Twilio\Rest\Client;
use Authy\AuthyApi;
use App\Models\SmsVerification;

class AuthController extends BaseController
{
    
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //'username' 		=> 'required|min:8|max:15',
            'password' 			=> 'required|min:6|max:55'
        ]);
        if($validator->fails()){
            return $this->sendValidationError('', $validator->errors()->first());       
        }
		
		$username = $request->username;
		if(empty($username)){
			$username = $request->mobile_number;
		}
		
		$auth_check = Auth::attempt(['mobile_number' => $username, 'password' => $request->password]);
        if(empty($auth_check)){
			$auth_check = Auth::attempt(['email' => $username, 'password' => $request->password]);
        }
		if($auth_check){
            $user = Auth::user();
            if($user){
                DB::table('oauth_access_tokens')->where('user_id', $user->id)->update(['revoked' => true]);
            }
            
            //Add response details into variable
            $success['token']            =  $user->createToken(config('app.name'))->accessToken;
            $success['id']               =  (string)$user->id;
            $success['gender']           =  $user->gender ? $user->gender : '';
            $success['age']              =  $user->dob ? (string) date_diff(date_create($user->dob), date_create('today'))->y : '';
            $success['dob']              =  $user->dob ? date('d-m-Y', strtotime($user->dob)) : '';
            $success['name']             =  $user->name;
            $success['email']            =  $user->email;
            $success['country_code']     =  $user->country_code;
            $success['mobile_number']     =  $user->mobile_number;
            $success['status']           =  $user->status;
            $success['user_type']        =  $user->user_type;
            
            $data = $request->except('mobile_number','password','user_type');
            $createArray = array();

            foreach ($data as $key => $value) {
                $createArray[$key] = $value;
            }

            $device_detail = DeviceDetail::where('user_id',Auth::user()->id)->first();
            if($device_detail){
                $device_detail->update($createArray);
            } else {
                $createArray['user_id'] = Auth::user()->id;
                DeviceDetail::create($createArray);
            }

            if(strtolower($user->status) != 'active') {
                return $this->sendError('',trans('customer_api.login_status'), 200, 202);
            } else { 
                return $this->sendResponse($success, trans('customer_api.login_success'));
            }  
        }  else {
            return $this->sendError('',trans('customer_api.login_error'));
        }
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(){
        $user = Auth::user();
        /*$device_detail = $user->device_detail;
        if($device_detail){
            $device_detail->delete();
        }*/
        $user->token()->revoke();
        return $this->sendResponse('', trans('customer_api.logout'));
    }
}
