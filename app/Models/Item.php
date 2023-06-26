<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transaction_items';

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
                  'description',
                  'is_asset',
                  'is_liability',
                  'is_capital',
                  'is_purchase',
                  'is_sale',
                  'is_expense',
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

}
