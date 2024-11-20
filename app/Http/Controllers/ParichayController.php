<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Role};
use Auth;

use Log;

class ParichayController extends Controller
    {
        private $_PARICHAY_DOMAIN_URL;
        private $_JAN_PARICHAY_DOMAIN_URL;
        private $_PARICHAY_SERVICE_NAME;
        private $_AESIV;
        private $_AUTHKEY;
        private $_RESTAUTHID;
        private $_CLIENT_URL;
        private $_PARICHAY;
        private $_TIME_TO_LIVE;
       
        public function __construct() {
                date_default_timezone_set('Asia/Kolkata');
                $this->_TIME_TO_LIVE = (time() + 7200) * 1000; // next 1 hours date time in milliseconds //

                $this->_PARICHAY_DOMAIN_URL = env('PARICHAY_DOMAIN_URL');
                $this->_JAN_PARICHAY_DOMAIN_URL = env('JAN_PARICHAY_DOMAIN_URL');
                $this->_PARICHAY_SERVICE_NAME = env('PARICHAY_SERVICE_NAME');
                $this->_AESIV = env('AESIV');
                $this->_AUTHKEY = env('AUTHKEY');
                $this->_RESTAUTHID = env('RESTAUTHID');
                $this->_CLIENT_URL = env('CLIENT_URL');
                $this->_PARICHAY = env("PARICHAY");
        }

        public function get_client_api_full_url($action = "") {
            return $this->_CLIENT_URL . $action;
        }

        public function curl_req($url = "", $method = "", $data = "")  {
            $ch = curl_init();      
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            if ("POST" == $method) {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            }
            $server_output = curl_exec($ch);
            curl_close($ch);
            return $server_output;
        }

        public function hmac() {
            $client_hmac_url = $this->get_client_api_full_url('/hmac');
            $post_value = $this->_PARICHAY . $this->_TIME_TO_LIVE . $this->_PARICHAY_DOMAIN_URL . 'pnv1/api/login' . $this->_PARICHAY_SERVICE_NAME;
            $postparams = '{"HmacString":"' . $post_value . '"}';
            $server_output = $this->curl_req($client_hmac_url, "POST", $postparams);
            $response = (array) json_decode($server_output);
            $client_signature = '';
            if (isset($response['data']->signature))
            $client_signature = $response['data']->signature;
            return $client_signature;
        }

        public function encryption() {
            $client_enc_url = $this->get_client_api_full_url('/encryption');
            $postparams = '{"AESString":"' . $this->_AESIV . '"}';
            $server_output = $this->curl_req($client_enc_url, "POST", $postparams);
            $response = (array) json_decode($server_output);
            $encrypted_client_sessionId = '';
            if (isset($response['data']->signature))
            $encrypted_client_sessionId = $response['data']->signature;
            return $encrypted_client_sessionId;
        }

        public function handshake(Request $request) {

            $server_handshaking_id = $request->string;

            if (empty($server_handshaking_id)) {
                return redirect()->route('login')->with('error', 'Something went wrong!');
            }

            $action = '/handshake/' . $server_handshaking_id . '/' . $this->_PARICHAY_SERVICE_NAME;
            $client_handshake_url = $this->get_client_api_full_url($action);
            $encrypted_string = $this->curl_req($client_handshake_url, "GET");
            if (trim($encrypted_string) == false) {
                //return response()->json(['error' => true, 'message' => 'something went wrong with Hand Shaking Id']);
                return redirect()->route('login')->with('error', 'Something went wrong with Hand Shaking Id');
            } else {
                        $client_decrypt_url = $this->get_client_api_full_url('/decryption');
                        $postparams = '{"EncryptedString":"' . $encrypted_string . '"}';   
                        $curl_result = $this->curl_req($client_decrypt_url, "POST", $postparams);
                        $response = (array) json_decode($curl_result);
                        if (isset($response['status'])) {
                                if (strtolower(trim($response['status'])) !== "success") {
                                    $this->checkUserAuth($request, $response['data']->signature);
                                    return redirect()->route('dashboard');
                                    //return response()->json(['error' => false, 'response' => $response['data']->signature]);
                                } else {
                                    //return response()->json(['error' => true, 'message' => 'something went wrong with decryption']);
                                    return redirect()->route('login')->with('error', 'Something went wrong with decryption!');
                                }
                        } else {
                                    //return response()->json(['error' => true, 'message' => 'something went wrong!']);
                                      return redirect()->route('login')->with('error', 'Something went wrong with decrypt api!');
                        }
                   }
        }

        public function checkUserAuth(Request $request, $data = '') {

	       \Log::info("Parichay_auth_info - " . serialize($data));

               $user = User::where('email', $data->email)->first();
               if ($user == null) {
                    //$password = bcrypt('password');
                    //$user = User::create(['email' => $data->email, 'name' => $data->firstName, 'password' => $password, 'created_at' => date("Y-m-d H:i:s")]);
                    //$user->role_user()->create(['user_id' => $user->id, 'role_id' => 8]);
		    return redirect()->route('login')->with('error', 'The email i.e ' . $data->email . ' is not associated with any account!');
               }
               $user->update(['parichay_auth_info' => serialize($data)]);
               Auth::loginUsingId($user->id);
	       $request->session()->put('login_mode', 'parichay');
               return redirect()->route('dashboard');
        }

        public function is_token_valid(Request $request) {

            $parichay_auth_info = Auth::user()->parichay_auth_info;
            if ($parichay_auth_info):
                $parichay = unserialize($parichay_auth_info);
                $user_name = $parichay->userName;
                $session_id = $parichay->sessionId;
                $browser_id_sess = $parichay->browserId;
                $local_token_id = $parichay->localTokenId;

                $params = "/isTokenValid?userName=$user_name&service=" . $this->_PARICHAY_SERVICE_NAME . "&sessionId=$session_id&browserId=$browser_id_sess&localTokenId=$local_token_id";

                $is_token_valid_curl = $this->get_client_api_full_url($params);
                $server_output = $this->curl_req($is_token_valid_curl, "GET");
                $response = (array) json_decode($server_output);

		if (isset($response['status'])) {
                    if ("success" == strtolower($response['status'])):
                        return "success";
                    else:
                        return "failure";
                    endif;
                } else {
                    return 'failure';
                }

            endif;
        }

        public function login() {
            $client_signature = $this->hmac();
            $encrypted_client_session_id = $this->encryption();
            $parichay_login_url = $this->_PARICHAY_DOMAIN_URL . "/pnv1/api/login?service=" . $this->_PARICHAY_SERVICE_NAME . "&tid=".$this->_TIME_TO_LIVE."&cs=".$client_signature."&string=".$encrypted_client_session_id."&subservice=SubServiceName";
            return '<div style="width:100%;text-align:center;background:#0088AF"><a href="'.$parichay_login_url.'"><img style="margin:0 auto;" src="'.asset('assets/images/parichay.png').'" width="150" /></a></div>';
        }

        public function janlogin() {
            $client_signature = $this->hmac();
            $encrypted_client_session_id = $this->encryption();
            $parichay_login_url = $this->_JAN_PARICHAY_DOMAIN_URL . "/pnv1/api/login?service=" . $this->_PARICHAY_SERVICE_NAME . "&tid=".$this->_TIME_TO_LIVE."&cs=".$client_signature."&string=".$encrypted_client_session_id."&subservice=SubServiceName";
            echo '<div style="width:200px;tex-align:center;background:#0088AF"><a href="'.$parichay_login_url.'"><img src=\'https://parichay.staging.nic.in/pnv1/assets/images/parichay-white-logo-without-emblem.png\' width="150" /></a></div>';
            return response()->json(compact('parichay_login_url'));
        }

        public function logout(Request $request) {

            $parichay_auth_info = Auth::user()->parichay_auth_info;
            if ($parichay_auth_info):
                $parichay = unserialize($parichay_auth_info);
                $user_name = $parichay->userName;    
                $session_id = $parichay->sessionId;
                $browser_id_sess = $parichay->browserId;
                $local_token_id = $parichay->localTokenId;
                $params = "/logoutAll?userName=$user_name&service=" . $this->_PARICHAY_SERVICE_NAME . "&sessionId=$session_id&browserId=$browser_id_sess&localTokenId=$local_token_id";
                $logout_url = $this->get_client_api_full_url($params);
                $server_output = $this->curl_req($logout_url, "GET");
                $response = (array) json_decode($server_output);
		Auth::user()->update(['parichay_auth_info' => null]);
                //if (isset($response['status'])) {
                    //if (strtolower($response['status']) == "success")
                    //return response()->json(['error' => false, 'message' => 'successfully logout']);
                        //else
                    //return response()->json(['error' => true, 'message' => 'something went wrong!']);
                //} else {
                    //return response()->json(['error' => true, 'message' => 'something went wrong!']);
                //}
            endif;

	    Auth::logout();

            return redirect()->route('login');

        }

}
