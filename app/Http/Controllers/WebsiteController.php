<?php

// namespace App\MyHelpers;

// require_once(__DIR__.'/../PHPMailer/src/PHPMailer.php');
// require __DIR__.'/../PHPMailer/src/SMTP.php';
// require __DIR__.'/../PHPMailer/src/Exception.php';

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recaptcha;
use App\Models\User;
use App\Models\Business;

use App\Models\BusinessCategory;
use App\Models\Currency;
use App\Models\BusinessOwner;

use File;
use Session;
use PDF;
use Hash;
use Exception;
use Auth;
use App;

use App\Helpers\Authorize;
use App\Helpers\AuthenticateTokenActivationKey;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function terms_and_conditions(){
      return view('auth.terms_and_conditions');
    }

    public function license(){
      return view('auth.license');
    }

    public function change_lang(Request $request){

      App::setLocale($request->lang);
      session()->put('locale', $request->lang);

      return redirect()->back();

    }

    public function get_current_date()
    {
      try {

        return response()->json([
          'success' => 1,
          'message' => 'Operation successful',
          'data' => date("d.m.Y H:s")
        ]);

      } catch (\Exception $e) {

        return response()->json([
          'success' => 0,
          'message' => $e->getMessage(),
          'data' => []
        ]);

      }

    }

    public function get_recaptcha(){

      try {

        $session_ID = Session::getId();

        $recaptcha_ID = bin2hex(random_bytes(50));
        $recaptcha_code = bin2hex(random_bytes(3));

        $client_ip = (isset($_SERVER['HTTP_CLIENT_IP']))?$_SERVER['HTTP_CLIENT_IP']:'NONE';
        $forward_ip = (isset($_SERVER['HTTP_X_FORWARDED_FOR']))?$_SERVER['HTTP_X_FORWARDED_FOR']:'NONE';
        $remote_address = (isset($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR']:'NONE';

        $host = $_SERVER['HTTP_HOST'];
        $host_address = gethostbyname($host);
        $uri = $_SERVER['REQUEST_URI'];

        $session_recaptcha = Recaptcha::where("session_ID",$session_ID)->where("status",0)->first();
        if ($session_recaptcha){
            $session_recaptcha->update([
                'status' => '3'//Expired By Session
            ]);
        }

        Recaptcha::create([
            'recaptcha_ID' => $recaptcha_ID,
            'recaptcha_code' => $recaptcha_code,
            'session_ID' => $session_ID,
            'remote_address' => $remote_address,
            'forwarded_ip' => $forward_ip,
            'client_ip' => $client_ip,
            'host_name' => $host,
            'host_address' => $host_address,
            'request_uri' => $uri,
            'status' => 0
        ]);

        return response()->json([
          'success' => 1,
          'message' => 'Operation successful',
          'recaptcha_code' => $recaptcha_code
        ]);

      } catch (\Exception $e) {

        return response()->json([
          'success' => 0,
          'message' => $e->getMessage(),
          'recaptcha_code' => ''
        ]);

      }

    }

    public function check_user_session(){

      try {

        if (Auth::check()) {

          $has_session_failed = 0;

          // CHECK IF THE AUTH USER IS NOT DELETED
          $is_account_deleted = Authorize::checkIfAccountDeleted(auth()->user());
          if ($is_account_deleted == 1) {
            $user = User::find(auth()->user()->id);
            if ($user) {
              $user->update([
                'is_logged_in' => 0
              ]);
            }
            Session::flush();
            $has_session_failed = 1;
          }

          // // CHECK IF THE AUTH USER IS ACTIVE
          $is_account_in_active = Authorize::checkIfAccountInActive(auth()->user());
          if ($is_account_in_active == 1) {
            $user = User::find(auth()->user()->id);
            if ($user) {
              $user->update([
                'is_logged_in' => 0
              ]);
            }
            Session::flush();
            $has_session_failed = 1;
          }

          // CHECK IF THE AUTH USER HAS BEEN LOGGED OUT
          $is_account_logged_out = Authorize::checkIfAccountIsLoggedOut(auth()->user());
          if ($is_account_logged_out == 1) {
            $user = User::find(auth()->user()->id);
            if ($user) {
              $user->update([
                'is_logged_in' => 0
              ]);
            }
            Session::flush();
            $has_session_failed = 1;
          }

          return response()->json([
            'success' => 1,
            'message' => 'Operation successful',
            'data' => $has_session_failed
          ]);

        }else{

          return response()->json([
            'success' => 1,
            'message' => 'Operation successful',
            'data' => 1
          ]);

        }

      } catch (\Exception $e) {

        return response()->json([
          'success' => 0,
          'message' => $e->getMessage(),
          'data' => 1
        ]);

      }

    }

    public function get_session_idle_time(){

      try {

          $session_idle_time = Authorize::getSystemSettingValue("session_idle_time");

          return response()->json([
            'success' => 1,
            'message' => 'Operation successful',
            'data' => $session_idle_time
          ]);

      } catch (\Exception $e) {

        return response()->json([
          'success' => 0,
          'message' => $e->getMessage(),
          'data' => NULL
        ]);

      }

    }

    public function clear_user_session(){

      try {

        if (Auth::check()) {

          $user = User::find(auth()->user()->id);
          if ($user) {
            $user->update([
              'is_logged_in' => 0
            ]);
          }
          Session::flush();

          return response()->json([
            'success' => 1,
            'message' => 'Operation successful',
            'data' => 1
          ]);

        }else {

          return response()->json([
            'success' => 1,
            'message' => 'Operation successful',
            'data' => 1
          ]);

        }

      } catch (\Exception $e) {

        return response()->json([
          'success' => 0,
          'message' => $e->getMessage(),
          'data' => 0
        ]);

      }

    }

    public function landing(){

      return redirect()->route('login');

    }

    public function choose_business(){

      if (Auth::user()) {

        $owns = BusinessOwner::where("user_id",auth()->user()->id)->where("is_deleted",0)->where("status",1)->get();
        $businesses = [];
        if (count($owns) > 0) {

          foreach ($owns as $own) {
            $business = Business::with("businessOwners","currency","businessCategory")->where("status",1)->where("is_deleted",0)->find($own->business_id);
            if ($business) {
              array_push($businesses,$business);
            }
          }

        }

        $business_categories = BusinessCategory::all();
        $currencies = Currency::all();

        return view("admin.landing",compact("businesses","business_categories","currencies"));

      } else {

        return redirect()->route('login');

      }
      

    }

    public function select_business(Request $request){

      if (Auth::user()) {

        $businessName = $request->get("businessName");
        $businessId = $request->get("businessId");

        Session::put('businessName',$businessName);
        Session::put('businessId',$businessId);

        return redirect()->route('dashboard');

      } else {

        return redirect()->route('login');

      }
      

    }

    public function register(){

      $business_categories = BusinessCategory::all();
      $currencies = Currency::all();

      return view('auth.register', compact("business_categories","currencies"));

    }

    public function register_external_user(Request $request){

      try {

        $first_name = $request->get("first_name");
        $middle_name = $request->get("middle_name");
        $last_name = $request->get("last_name");
        $gender = $request->get("gender");
        $phone = $request->get("phone");
        $email = $request->get("email");
        $password = $request->get("password");
        $confirm_password = $request->get("confirm_password");

        User::create([
          "name" => $first_name . " " .$middle_name . " " . $last_name,
          "first_name" => $first_name,
          "middle_name" => $middle_name,
          "last_name" => $last_name,
          "gender" => $gender,
          "mobile_phone" => $phone,
          "email" => $email,
          "password" => Hash::make($password)
        ]);

        return response()->json([
          'success' => 1,
          'message' => 'Operation successful',
          'data' => 1
        ]);

      } catch (\Exception $e) {

        return response()->json([
          'success' => 0,
          'message' => $e->getMessage(),
          'data' => 0
        ]);

      }

    }

    protected function login_json(Request $request)
     {

        try{


          $uname = htmlspecialchars($request->get('email'));
          $pwd = htmlspecialchars($request->get('password'));

          if (($uname) && ($pwd)) {

            //CUSTOM VALIDATION
            $illegal = "#$%^&*()+=-[]';,/{}|:<>?~";

            if (false === strpbrk($uname, $illegal)) {

              $credentials = [
                'email' => $uname,
                'password' => $pwd
              ];

              if(Auth::attempt($credentials)){

                if (isset(auth()->user()->id)) {

                  return response()->json([
                    'success' => 1,
                    'message' => 'Login successfully',
                    'redirect_route' => route('dashboard'),
                    'auth_id' => auth()->user()->id,
                    'auth_name' => auth()->user()->name
                  ]);

                }else{

                  return response()->json([
                    'success' => 0,
                    'message' => 'Failed, session not created!',
                    'redirect_route' => '',
                    'auth_id' => '',
                    'auth_name' => ''
                  ]);

                }

              }else {
                //Illegal characters

                return response()->json([
                  'success' => 0,
                  'message' => 'Failed, invalid credentials!',
                  'redirect_route' => '',
                  'auth_id' => '',
                  'auth_name' => ''
                ]);

              }

            } else {
              
              return response()->json([
                'success' => 0,
                'message' => 'Failed, illegal characters!',
                'redirect_route' => '',
                'auth_id' => '',
                'auth_name' => ''
              ]);

            }

          } else {
              
            return response()->json([
              'success' => 0,
              'message' => 'Failed, no username or password!',
              'redirect_route' => '',
              'auth_id' => '',
              'auth_name' => ''
            ]);

          }
         

        } catch (Exception $exception) {

            return response()->json([
              'success' => 0,
              'message' => $exception->getMessage(),
              'redirect_route' => '',
              'auth_id' => '',
              'auth_name' => ''
            ]);

        }

     }

     public function create_external_business(Request $request){

      try {

        $certificate = NULL;
        if($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $certificate = time(). '-' .$file->getClientOriginalName();
            $certificateArray = explode(".",$certificate);

            if (($certificateArray[count($certificateArray) - 1] == "png") || ($certificateArray[count($certificateArray) - 1] == "jpg") | ($certificateArray[count($certificateArray) - 1] == "jpeg") || ($certificateArray[count($certificateArray) - 1] == "pdf") || ($certificateArray[count($certificateArray) - 1] == "docx")) {

                $destinationPath = 'storage/business/certificates';
                $file->move($destinationPath,$certificate);

            } else {

                return back()->withInput()
                    ->withErrors(['unexpected_error' => 'Unsupported file format!']);

            }
        
        }

        $businessId = Business::create([
          'business_category_id' => $request->get("business_category"),
          'business_type' => $request->get("business_type"),
          'name' => $request->get("business_name"),
          'physical_address' => $request->get("physical_address"),
          'email' => $request->get("b_email"),
          'phone' => $request->get("b_phone"),
          'website' => $request->get("website"),
          'currency_id' => $request->get("currency"),
          'certificate' => $certificate,
          'geo_tag' => $request->get("geo_tag")
        ])->id;

        BusinessOwner::create([
          'business_id' => $businessId,
          'user_id' => $request->get("auth_id")
        ]);


        return redirect()->route('choose_business')
              ->with('success_message','Welcome ' . auth()->user()->name . ', your business registration is complete');


      } catch (\Exception $e) {

        return redirect()->route('choose_business')
          ->withErrors(['unexpected_error' => 'Failed to register your business, please try again from the side menu on the left']);

      }

     }

    function send_verification_code($email_phone,$is_email){

      try {

          $vCode = rand(100000,999999);

          if ($is_email == 1) {
              # SEND EMAIL

              $subject = "SME App: Verification Code";
              $body = "Please use the following code for verification:" . $vCode;

              $sendEmailResponse = $this->send_email($email_phone,$subject,$body);

              if ($sendEmailResponse == "Email sent successfully") {

                return 1;

              } else {

                return 0;

              }
              
          }else{
              // SEND SMS

              return 1;

          }

      } catch (\Exception $e) {

          return 0;

      }
  }

  public function send_email($receiver,$subject,$body){

    try {

      $email = new PHPMailer(true);
      $email->SMTPDebug = 0;
      $email->IsSMTP();
      $email->Host = "smtp.gmail.com";
      $email->SMTPAuth = true;
      $email->Username = $this->get_email_username();
      $email->Password = $this->get_email_password();
      $email->SMTPSecure = "tls";
      $email->Port = "587";
      
      $email->SMTPOptions = [
          'ssl' => [
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
              ]
      ];

      $email->SetFrom($this->get_email_username());
      $email->Subject   = $subject;
      $email->Body      = $body;
      $email->addAddress($receiver);

      $email->send();

      return "Email sent successfully";

    } catch (\Exception $e) {

      return $e->getMessage();

    }

  }

  public function get_email_username(){

    return "tats.tacaids@gmail.com";

  }

  public function get_email_password(){

    return "wgijliddgaldnibr";

  }

}
