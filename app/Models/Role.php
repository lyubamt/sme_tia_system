<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Spatie\Permission\Traits\HasPermissions;


class Role extends \Spatie\Permission\Models\Role
{
    //use HasPermissions;

    /**
     * The database table used by the model.
     *
     * @var string
     */
  
    protected $table = 'roles';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'name',
                  'guard_name'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Get the modelHasRole for this model.
     */
    public function modelHasRole()
    {
        return $this->hasOne('App\Models\ModelHasRole','role_id','id');
    }

    /**
     * Get the roleHasPermission for this model.
     */
    public function roleHasPermission()
    {
        return $this->hasOne('App\Models\RoleHasPermission','role_id','id');
    }

}
