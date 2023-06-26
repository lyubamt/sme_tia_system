<?php

namespace App\Auth;
use App\Models\UserPoa;
use Carbon\Carbon;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

/**
 * CustomUserProvider
 */
class CustomUserProvider implements UserProvider
{

  public function retrieveById($identifier){

    $post_data = [
      "auth_id"=>2,
      "user_id"=>$identifier
    ]
    $response = json_decode($this->api_call_json($url = "agyw_get_one_user",$post_data,$headers = []));

    if($response)
    {

        if(isset($response->data)){

            $data = $response->data;
            $user = $data[0];

            $attributes = array(
                'id' => $user->id,
                'username' => $user->email,
                'password' => '$2y$10$JEawqkLG2BWfPm/QI7seK.kB4skeOgfG1g..E36pgVGPSk.Oc65nO',
                'name' => $user->first_name,
            );

            return $user;

        }

        return null;
    }
    return null;

  }

  public function retrieveByToken($identifier, $token)
  {
      // TODO: Implement retrieveByToken() method.
      $qry = UserPoa::where('id','=',$identifier)->where('remember_token','=',$token);

      if($qry->count() >0)
      {
          $user = $qry->select('id', 'name','email', 'password')->first();

          $attributes = array(
              'id' => $user->id,
              'username' => $user->email,
              'password' => $user->password,
              'name' => $user->name,
          );

          return $user;
      }
      return null;



  }

  public function updateRememberToken(Authenticatable $user, $token)
  {
      // TODO: Implement updateRememberToken() method.
      $user->setRememberToken($token);

      $user->save();

  }

  public function retrieveByCredentials(array $credentials)
  {
      // TODO: Implement retrieveByCredentials() method.

      $post_data = [
        "username"=>$credentials['username'],
        "password"=>$$credentials['password']
      ]
      $response = json_decode($this->api_call_json($url = "agyw_login",$post_data,$headers = []));

      if($response)
      {

          if(isset($response->data)){

              $data = $response->data;
              $user = $data[0];

              return $user;

          }

          return null;
      }
      return null;


  }

  public function validateCredentials(Authenticatable $user, array $credentials)
  {
      // TODO: Implement validateCredentials() method.
      // we'll assume if a user was retrieved, it's good

      if($user->email == $credentials['username'] && $user->password == md5($credentials['password'].\Config::get('constants.SALT')))
      {

          // $user->last_login_time = Carbon::now();
          // $user->save();

          return true;
      }
      return false;


  }

  public function api_call_json($url,$post_data,$headers){

      $active_base_url_info = "http://154.118.230.203/tomsha/test/";
      $server_output = "";
      if ($active_base_url_info){

          $url = $active_base_url_info->name.$url;

          $encoded_data = json_encode($post_data);

          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL,$url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS,$encoded_data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);

          if (!empty($headers)) {

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

          }

          $respons = curl_exec($ch);

          $err = curl_error($ch);
          curl_close($ch);

          if ($err) {
             $server_output = "cURL Error #:" . $err;
          } else {
             $server_output = $respons;
          }

      }

      return $server_output;

    }


}
