<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Spatie\Permission\Traits\HasRoles;

class UserPoa extends Model implements AuthenticatableContract
{
  use Authenticatable,HasRoles;
  protected $guard = 'custom';
  protected $table = 'users';
  protected $primaryKey  = 'id';
  public $timestamps = false;
}
