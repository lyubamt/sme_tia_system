<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'districts';

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
                  'region_id',
                  'name',
                  'description',
                  'status',
                  'is_deleted'
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
     * Get the region for this model.
     *
     * @return App\Models\Region
     */
    public function region()
    {
        return $this->belongsTo('App\Models\Region','region_id');
    }

}
