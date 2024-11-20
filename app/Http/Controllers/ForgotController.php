<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Profile,User};

class ForgotController extends Controller
{
    public function index()
        {
            return view('auth/forgot-password-mobile');
        }

    public function store(Request $request)
        {
            $request->validate([
                                    'mobile' => 'required|numeric|digits:10|',
                              ]);

            $userObj = Profile::select('user_id')->where('mobile', '=', $request->mobile)->first();
            if ($userObj == null) {
                //return redirect()->route('forgot.index')->withInput($request->input())->with('error', 'Mobile number is not registered');
            }

            try {
                $password = mt_rand(111111, 999999);
                $enc_password = bcrypt($password);
                $pmsg = urlencode("Hi,\n\nYour new password for BHARAT5G LABS is: " . $password . "\n\nSupport Team");
		
		$arrContextOptions = array(
      						"ssl" => array(
            							"verify_peer" => false,
            							"verify_peer_name" => false,
        						      ),
    					  );  

                //User::where('id', $userObj->user_id)->update(['password' => $enc_password]);

		$curl = curl_init();

		curl_setopt_array($curl, array(
      						CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=ToUEZMc3nGgh54I2Y8S6fauiWRmrJpDb7dAtjzXly1HNvQkCLV8GudVrAn5oeLUhZsO9mbtkwaClR2DX&message=$pmsg&language=english&route=q&numbers=".urlencode('9717181856'),
      						CURLOPT_RETURNTRANSFER => true,
      						CURLOPT_ENCODING => "",
      						CURLOPT_MAXREDIRS => 10,
      						CURLOPT_TIMEOUT => 30,
      						CURLOPT_SSL_VERIFYHOST => 0,
      						CURLOPT_SSL_VERIFYPEER => 0,
      						CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      						CURLOPT_CUSTOMREQUEST => "GET",
      						CURLOPT_HTTPHEADER => array(
        									"cache-control: no-cache"
      									   ),
					     )
				);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) 
			{
  			    \Log::info("Forgot SMS API ERROR: - "  . $err);
  			    $msg = 'Something went wrong!';
			    $key = "error";
				print_r($err); die;
			} 

            } catch (\Exception $e) {
                $key = 'error';
                $msg = $e->getMessage();
            }
            return redirect()->route('forgot.index')->with($key ?? 'status', $msg ?? 'Password has been sent to your mobile number.');
        }
    
}
