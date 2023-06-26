<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionCategory;
use App\Models\TransactionType;

use App\Models\Transaction;
use App\Models\Business;
use App\Models\Item;
use App\Models\Unit;

use Exception;

class ReportsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
	    $this->middleware('auth');
	}

    /**
     * Display a listing of the transaction_categorys.
     *
     * @return Illuminate\View\View
     */
    public function profit_and_loss()
    {
        $sales = Transaction::where("transaction_type_id",5)->where("status",1)->where("is_deleted",0)->get();
        $purchases = Transaction::where("transaction_type_id",4)->where("status",1)->where("is_deleted",0)->get();

        $total_sales = 0;
        if (count($sales) > 0) {

            foreach ($sales as $sale) {
                $total_sales += $sale->value * $sale->quantity;
            }

        }

        $total_purchases = 0;
        if (count($purchases) > 0) {

            foreach ($purchases as $purchase) {
                $total_purchases += $purchase->value * $purchase->quantity;
            }

        }

        $opening_stock = 1000;
    
        return view('admin.reports.profit_and_loss');
    }

}
