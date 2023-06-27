<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  Transaction extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

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
        'business_id',
        'transaction_type_id',
        'transaction_category_id',
        'item_id',
        'unit_id',
        'value',
        'quantity',
        'date',
        'description',
        'parent_id',
        'status',
        'is_deleted',
        'user_id'
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

    public function transactionCategory(){
        return $this->belongsTo("App\Models\TransactionCategory", "transaction_category_id");
    }

    public function subTransactions(){
        return $this->hasMany("App\Models\Transaction", "parent_id","id");
    }

    public function transaction(){
        return $this->belongsTo("App\Models\Transaction", "parent_id","id");
    }

    public function business(){
        return $this->belongsTo("App\Models\Business", "business_id");
    }

    public function item(){
        return $this->belongsTo("App\Models\Item", "item_id");
    }

    public function unit(){
        return $this->belongsTo("App\Models\Unit", "unit_id");
    }

    public function user(){
        return $this->belongsTo("App\Models\User", "user_id");
    }



}
