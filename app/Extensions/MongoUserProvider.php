<?php
// app/Extensions/MongoUserProvider.php
namespace App\Extensions;

use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Auth\User;
use Hash;

class MongoUserProvider implements UserProvider
{
  /**
   * The Mongo User Model
   */
  private $model;

  /**
   * Create a new mongo user provider.
   *
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   * @return void
   */
  public function __construct()
  {
    $this->model = new User();
  }

  /**
   * Retrieve a user by the given credentials.
   *
   * @param  array  $credentials
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public function retrieveByCredentials(array $credentials)
  {
      if (empty($credentials)) {
          return;
      }

      $user = $this->model->fetchUserByCredentials(['username' => $credentials['username'],'password' => $credentials['password']]);

      return $user;
  }

  /**
   * Validate a user against the given credentials.
   *
   * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
   * @param  array  $credentials  Request credentials
   * @return bool
   */
  public function validateCredentials(Authenticatable $user, Array $credentials)
  {

      if ($credentials['username'] == $user->getAuthIdentifier()) {

        if (Hash::check($credentials['password'],$user->getAuthPassword())) {
          return true;
        }

        return false;

      }

      return true;

    //   return ($credentials['username'] == $user->getAuthIdentifier() &&
  // md5($credentials['password']) == $user->getAuthPassword());
  }

  public function retrieveById($identifier) {}

  public function retrieveByToken($identifier, $token) {}

  public function updateRememberToken(Authenticatable $user, $token) {}
}
