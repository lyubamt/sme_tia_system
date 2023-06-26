<?php
// app/Models/Auth/User.php
namespace App\Models\Auth;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\Services\Contracts\NosqlServiceInterface;

class User implements AuthenticatableContract
{
  private $conn;

  private $username;
  private $password;
  protected $rememberTokenName = 'remember_token';

  public function __construct()
  {
    // $this->conn = $conn;
  }

  /**
   * Fetch user by Credentials
   *
   * @param array $credentials
   * @return Illuminate\Contracts\Auth\Authenticatable
   */
  public function fetchUserByCredentials(Array $credentials)
  {

    $post_data = $credentials;
    $response = json_decode($this->api_call_json($url = "login",$post_data,$headers = []));

    $user = [];
    if ($response){
      if (isset($response->data)){

        $data = $response->data;
        $user_info = $data[0];
        $this->username = $user_info->username;
        $this->password = '$2y$10$o4A1G6cgSMlmWLcHWZlqBu21P6iREhrsgTsDDYbnD4B1dYjG3z/ZC';
        $this->username = $user_info->username;
        $this->password = '$2y$10$o4A1G6cgSMlmWLcHWZlqBu21P6iREhrsgTsDDYbnD4B1dYjG3z/ZC';
        $this->isFirstTime = $user_info->isFirstTime;
        $this->api_token = $user_info->auth_id;
        $this->first_name = $user_info->first_name;
        $this->last_name = $user_info->last_name;
        $this->status = $user_info->status;
        $this->user_id = $user_info->user_id;
        $this->station = $user_info->pores;

      }
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthIdentifierName()
   */
  public function getAuthIdentifierName()
  {
    return "username";
  }

  /**
   * {@inheritDoc}
   * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthIdentifier()
   */
  public function getAuthIdentifier()
  {
    return $this->{$this->getAuthIdentifierName()};
  }

  /**
   * {@inheritDoc}
   * @see \Illuminate\Contracts\Auth\Authenticatable::getAuthPassword()
   */
  public function getAuthPassword()
  {
    return $this->password;
  }

  /**
   * {@inheritDoc}
   * @see \Illuminate\Contracts\Auth\Authenticatable::getRememberToken()
   */
  public function getRememberToken()
  {
    if (! empty($this->getRememberTokenName())) {
      return $this->{$this->getRememberTokenName()};
    }
  }

  /**
   * {@inheritDoc}
   * @see \Illuminate\Contracts\Auth\Authenticatable::setRememberToken()
   */
  public function setRememberToken($value)
  {
    if (! empty($this->getRememberTokenName())) {
      $this->{$this->getRememberTokenName()} = $value;
    }
  }

  /**
   * {@inheritDoc}
   * @see \Illuminate\Contracts\Auth\Authenticatable::getRememberTokenName()
   */
  public function getRememberTokenName()
  {
    return $this->rememberTokenName;
  }

  public function api_call_json($url,$post_data,$headers){

    $active_base_url_info = "http://";
    $server_output = "";
    if ($active_base_url_info){

        $url = $active_base_url_info.$url;

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
