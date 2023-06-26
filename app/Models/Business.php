<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'businesses';

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
        'business_category_id',
        'business_type',
        'name',
        'physical_address',
        'email',
        'phone',
        'website',
        'currency_id',
        'certificate',
        'geo_tag',
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

    public function businessOwners(){
        return $this->hasMany("App\Models\BusinessOwner", "business_id", "id");
    }

    public function currency(){
        return $this->belongsTo("App\Models\Currency", "currency_id");
    }

    public function businessCategory(){
        return $this->belongsTo("App\Models\BusinessCategory", "business_category_id");
    }


}
