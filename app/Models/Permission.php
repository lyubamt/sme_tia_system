<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

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
     * Get the modelHasPermission for this model.
     */
    public function modelHasPermission()
    {
        return $this->hasOne('App\Models\ModelHasPermission','permission_id','id');
    }

    /**
     * Get the roleHasPermission for this model.
     */
    public function roleHasPermission()
    {
        return $this->hasOne('App\Models\RoleHasPermission','permission_id','id');
    }
    /**
     * Create default permissions
     */
    public static function defaultPermissions()
    {
        return [
            'view_user',
            'add_user',
            'edit_user',
            'delete_user',
    
            'view_role',
            'add_role',
            'edit_role',
            'delete_role',
    
            'view_permission',
            'add_permission',
            'edit_permission',
            'delete_permission',
        ];
    }

}
