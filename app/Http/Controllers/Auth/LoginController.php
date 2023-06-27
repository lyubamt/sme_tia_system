<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Http\Request;
use Hash;

use App\Models\User;
use App\Models\Recaptcha;
use App\Models\Log;
use App\Models\UserDatabase;
use App\Models\UserLoginLog;
use App\Models\SystemSetting;
use App\Models\UserLockLog;
use App\Models\BusinessCategory;
use App\Models\Currency;

use Mail;
use DB;
use Config;
use DateTime;

use App\Helpers\Authorize;
use App\Helpers\AuthenticateTokenActivationKey;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     protected function login_api(Request $request){

      try {

        $request->validate([
          'email' => 'required|string|email',
          'password' => 'required|string'
        ]);
  
        $email = $request->get('email');
  
        //CUSTOM VALIDATION
        $illegal = "#$%^&*()+=-[]';,/{}|:<>?~";
        if (false === strpbrk($email, $illegal)) {
  
          $user = User::where("email",$email)->first();
  
          if (!$user){
            // LOG
            $this->logLogin($email,1,$comment = 'Unexisting User',0);
  
            return back()->withInput()
                  ->withErrors(['unexpected_error' => "Sorry, the user does not exist!"]);
          }
  
          // CHECK IF THE USER HAS BEEN DELETED
          if ($user->is_deleted == 1) {
  
            $this->logLogin($email,1,$comment = 'Deleted Account',0);
            return back()->withInput()
                   ->withErrors(['unexpected_error' => "The user account has been deleted, please contact System Administrator!"]);
         
          }
  
          // CHECK IF THE USER HAS BEEN LOCKED
  
          if ($user->status == 0) {
  
            $this->logLogin($email,1,$comment = 'Locked Account',0);
            return back()->withInput()
                   ->withErrors(['unexpected_error' => "The user account has been locked, please contact System Administrator!"]);
         
          }
  
          // CHECK IF THE USER IS ALREADY LOGGED IN
          $was_user_logged_in = 0;
          if ($user->is_logged_in == 1) {
  
            $was_user_logged_in = 1;
  
          }
  
          $credentials = $request->only('email', 'password');
          if (Auth::attempt($credentials)) {
  
            if ($was_user_logged_in == 1) {
  
              $this->logLogin($email,1,$comment = 'Already Logged In Account',0);
  
            }
  
            // LOG
            $this->logLogin($email,1,$comment = 'Logged in successfully',1);
            $session_id = Session::getId();
            $user->update([
              'last_login_time' => date("Y-m-d H:i:s"),
              'is_logged_in' => 1,
              'last_active_time' => date("Y-m-d H:i:s"),
              'last_session_id' => $session_id
            ]);

            if (Auth::user()->hasRole('Admin')) {

              return redirect()->intended('dashboard');

            } else {

              return redirect()->intended('choose_business');

            }
  
          }else{
  
            // LOG
            $this->logLogin($email,1,$comment = 'Invalid credentials',0);
  
            // CHECK THE NUMBER OF FAILED LOGIN ATTEMPTS
            $last_unlock_log = UserLockLog::orderBy("id","DESC")->where("email",$email)->where("direction",1)->first();
  
            $last_failed_login_attempts = [];
            if ($last_unlock_log) {
  
              $last_success_login_attempt = UserLoginLog::orderBy("id","DESC")->where("email",$email)->where("direction",1)->where("status",1)->first();
              if ($last_success_login_attempt) {
        
                $last_failed_login_attempts = UserLoginLog::orderBy("id","DESC")->where("id",">",$last_success_login_attempt->id)->where("email",$email)->where("direction",1)->where("status",0)->where("created_at",">",$last_unlock_log->created_at)->get();
        
              }else {
  
                $last_failed_login_attempts = UserLoginLog::orderBy("id","DESC")->where("email",$email)->where("direction",1)->where("status",0)->where("created_at",">",$last_unlock_log->created_at)->get();
  
              }
  
            } else {
  
              $last_success_login_attempt = UserLoginLog::orderBy("id","DESC")->where("email",$email)->where("direction",1)->where("status",1)->first();
              if ($last_success_login_attempt) {
        
                $last_failed_login_attempts = UserLoginLog::orderBy("id","DESC")->where("id",">",$last_success_login_attempt->id)->where("email",$email)->where("direction",1)->where("status",0)->get();
        
              }else {
  
                $last_failed_login_attempts = UserLoginLog::orderBy("id","DESC")->where("email",$email)->where("direction",1)->where("status",0)->get();
  
              }
  
            }
            
            $max_login_attempts = SystemSetting::where("name","max_login_attempts")->first()->value;
            
            if ($max_login_attempts) {
              if ($max_login_attempts !== 0) {
         
              if (count($last_failed_login_attempts) >= $max_login_attempts) {
         
                $user = User::where("email",$email)->first();
                if ($user) {
  
                $user->update([
                  'status' => 0
                ]);
  
                UserLockLog::create([
                  'email' => $email,
                  'direction' => 0,
                  'comment' => 'Your account has been locked because you have exceeded ' .$max_login_attempts. ' failed login attempts',
                  'user_id' => $user->id
                ]);
         
                return back()
                    ->withErrors(['unexpected_error'=>'Your account has been locked because you have exceeded ' .$max_login_attempts. ' failed login attempts, please contact the System Administrator!']);
         
                }
         
              }else{
  
                $remaining_login_attempts = $max_login_attempts - count($last_failed_login_attempts);
                return back()
                    ->withErrors(['unexpected_error'=>'Invalid credentials, you have only ' .$remaining_login_attempts. ' login attempts remaining before your account is locked!']);
  
              }
         
              }
         
            }
  
            return back()->withInput()
                  ->withErrors(['unexpected_error' => "Sorry, invalid credentials!"]);
  
          }
  
        }else{
  
          // LOG
          $this->logLogin($email,1,$comment = 'Illegal characters',0);
          return back()->withInput()
                ->withErrors(['unexpected_error' => "Sorry, special characters are not allowed on emails!"]);
  
        }
  
      } catch (Exception $e) {
  
        return back()
            ->withErrors(['unexpected_error' => $e->getMessage()]);
  
      }

    }

    public function logLogin($email,$direction,$comment = NULL,$status){
       UserLoginLog::create([
         'email' => $email,
         'http_client_ip' => (isset($_SERVER['HTTP_CLIENT_IP']))?$_SERVER['HTTP_CLIENT_IP']:"NONE",
         'http_x_forwarded_for' => (isset($_SERVER['HTTP_X_FORWARDED_FOR']))?$_SERVER['HTTP_X_FORWARDED_FOR']:"NONE",
         'remote_addr' => (isset($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR']:"NONE",
         'server_name' => (isset($_SERVER['SERVER_NAME']))?$_SERVER['SERVER_NAME']:"NONE",
         'direction' => $direction,
         'comment' => $comment,
         'status' => $status
       ]);
     }

     public function logGeneral($description,$user_id){
       Log::create([
        'description' => $description,
        'user_id' => $user_id
       ]);
     }

     public function login_page(){

      return view("auth.login");

     }

    public function redirect_login(){

        return redirect()->route('login');
    }

    public function logout(){

      $user = User::find(auth()->user()->id);
      if ($user) {
        $user->update([
          'is_logged_in' => 0
        ]);

      }

      $this->logLogin(auth()->user()->email,0,$comment = 'Logged out successfully',1);
      $this->logGeneral("User ".auth()->user()->name." has logged out",auth()->user()->id);

      Session::flush();
      return redirect('login');
    }
}
