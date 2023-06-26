<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\UserDatabase;
use App\Models\UserLoginLog;
use App\Models\Recaptcha;
use App\Models\Log;
use App\Models\SystemSetting;
use Session;
use Auth;

class Authorize{


  static function checkApplication(){

    if ((isset($_SERVER['HTTP_REFERER'])) && (isset($_SERVER['REQUEST_URI']))) {
      // CHECK FOR LAST PAGE
      $split_uri = explode("/",$_SERVER['REQUEST_URI']);
      $app_ref = NULL;
      if (count($split_uri) >= 2) {
        $app_ref = $split_uri[count($split_uri) - 2];
      }
      if ((strpos($_SERVER['HTTP_REFERER'],'/applications') !== false) || (strpos($_SERVER['HTTP_REFERER'],'/'. $app_ref .'/') !== false)) {
        // CONTINUE TO DESIRED PAGE
        Session::put("app",$app_ref);
      }else {

        return redirect()->route('landing');

      }

    }elseif ((!isset($_SERVER['HTTP_REFERER'])) && (isset($_SERVER['REQUEST_URI']))) {
      // CHECK FOR LAST PAGE
      $split_uri = explode("/",$_SERVER['REQUEST_URI']);
      $app_ref = NULL;
      if (count($split_uri) >= 2) {
        $app_ref = $split_uri[count($split_uri) - 2];
      }

      Session::put("app",$app_ref);

    }else {

      return redirect()->route('landing');

    }

  }

  static function getApplication(){

    $app = session("app");
    return $app;

  }

  static function checkIfAccountDeleted($auth__user){

    if ($auth__user->is_deleted == 1) {

      return 1;

    }

  }

  static function checkIfAccountInActive($auth__user){

    if ($auth__user->status == 0) {

      return 1;

    }

  }

  static function checkIfAccountIsLoggedOut($auth__user){

    if ($auth__user->is_logged_in == 0) {

      return 1;

    }

  }

  static function getSystemSetting($setting_name){

    $setting = SystemSetting::where("name",$setting_name)->first();
    return $setting;

  }

  static function getSystemSettingValue($setting_name){

    $setting_value = NULL;
    $setting = SystemSetting::where("name",$setting_name)->first();
    if ($setting) {
      $setting_value = $setting->value;
    }
    return $setting_value;

  }

  static function logLogin($email,$direction,$comment = NULL,$status){
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

  static function logGeneral($description,$user_id){
    Log::create([
     'description' => $description,
     'user_id' => $user_id
    ]);
  }

}



?>
