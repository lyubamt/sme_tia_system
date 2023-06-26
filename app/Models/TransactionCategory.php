<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  TransactionCategory extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transaction_categories';

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
        'transaction_type_id',
        'name',
        'description',
        'parent_id',
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

    public function transactionType(){
        return $this->belongsTo("App\Models\TransactionType", "transaction_type_id");
    }

    public function subCategories(){
        return $this->hasMany("App\Models\TransactionCategory", "parent_id","id");
    }

    public function category(){
        return $this->belongsTo("App\Models\TransactionCategory", "parent_id","id");
    }


}
