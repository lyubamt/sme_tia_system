<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionCategory;
use App\Models\TransactionType;

use App\Models\Transaction;
use App\Models\Business;
use App\Models\BusinessOwner;
use App\Models\Item;
use App\Models\Unit;

use Auth;

use Exception;

class TransactionsController extends Controller
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
    public function index()
    {

        $transactions = [];
        if (Auth::user()->hasRole("Admin")) {
            $transactions = Transaction::with("transactionType","transactionCategory","user")->where("transaction_type_id","!=",5)->where("transaction_type_id","!=",3)->where("transaction_type_id","!=",4)->where("status",1)->where("is_deleted",0)->paginate(25);
        } else {
            $transactions = Transaction::with("transactionType","transactionCategory","user")->where("transaction_type_id","!=",5)->where("transaction_type_id","!=",3)->where("transaction_type_id","!=",4)->where("business_id",session("businessId"))->where("user_id",auth()->user()->id)->where("status",1)->where("is_deleted",0)->paginate(25);
        }
    
        return view('admin.transactions.transactions.index', compact('transactions'));
    }

    public function index_sale()
    {

        $transactions = [];
        if (Auth::user()->hasRole("Admin")) {
            $transactions = Transaction::with("transactionType","transactionCategory","user")->where("transaction_type_id",5)->where("status",1)->where("is_deleted",0)->paginate(25);
        } else {
            $transactions = Transaction::with("transactionType","transactionCategory","user")->where("transaction_type_id",5)->where("business_id",session("businessId"))->where("user_id",auth()->user()->id)->where("status",1)->where("is_deleted",0)->paginate(25);
        }
    
        return view('admin.transactions.transactions.index_sale', compact('transactions'));
    }

    public function index_purchase()
    {

        $transactions = [];
        if (Auth::user()->hasRole("Admin")) {
            $transactions = Transaction::with("transactionType","transactionCategory","user")->where("transaction_type_id",4)->where("status",1)->where("is_deleted",0)->paginate(25);
        } else {
            $transactions = Transaction::with("transactionType","transactionCategory","user")->where("transaction_type_id",4)->where("business_id",session("businessId"))->where("user_id",auth()->user()->id)->where("status",1)->where("is_deleted",0)->paginate(25);
        }
    
        return view('admin.transactions.transactions.index_purchase', compact('transactions'));
    }

    public function index_capital()
    {

        $transactions = [];
        if (Auth::user()->hasRole("Admin")) {
            $transactions = Transaction::with("transactionType","transactionCategory","user")->where("transaction_type_id",3)->where("status",1)->where("is_deleted",0)->paginate(25);
        } else {
            $transactions = Transaction::with("transactionType","transactionCategory","user")->where("transaction_type_id",3)->where("business_id",session("businessId"))->where("user_id",auth()->user()->id)->where("status",1)->where("is_deleted",0)->paginate(25);
        }
    
        return view('admin.transactions.transactions.index_capital', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction_category.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $transaction_types = TransactionType::where("id","!=",4)->where("id","!=",3)->where("id","!=",5)->get();

        $owns = BusinessOwner::where("user_id",auth()->user()->id)->where("is_deleted",0)->where("status",1)->get();
        $businesses = [];
        if (count($owns) > 0) {

          foreach ($owns as $own) {
            $business = Business::with("businessOwners","currency","businessCategory")->where("status",1)->where("is_deleted",0)->find($own->business_id);
            if ($business) {
              array_push($businesses,$business);
            }
          }

        }

        $items = [];
        $units = Unit::where('user_id',auth()->user()->id)->where("status",1)->where("is_deleted",0)->get();

        return view('admin.transactions.transactions.create',compact("transaction_types","businesses","items","units"));
    }

    public function create_sale($itemId)
    {

        $transactionAction = "Add New Sale";
        $transactionTypeid = 5;
        $units = Unit::where('user_id',auth()->user()->id)->where("status",1)->where("is_deleted",0)->get();
        $transaction_categories = TransactionCategory::where("transaction_type_id",5)->where("parent_id",0)->where("status",1)->where("is_deleted",0)->get();

        return view('admin.transactions.transactions.create_simple',compact("transactionAction", "units", "transaction_categories", "transactionTypeid","itemId"));
    }

    public function create_purchase($itemId)
    {

        $transactionAction = "Add New Purchase";
        $transactionTypeid = 4;
        $units = Unit::where('user_id',auth()->user()->id)->where("status",1)->where("is_deleted",0)->get();
        $transaction_categories = TransactionCategory::where("transaction_type_id",4)->where("parent_id",0)->where("status",1)->where("is_deleted",0)->get();

        return view('admin.transactions.transactions.create_simple',compact("transactionAction", "units", "transaction_categories", "transactionTypeid","itemId"));
    }

    public function create_capital()
    {

        $transactionAction = "Add Capital";
        $transactionTypeid = 3;
        $items = Item::where('user_id',auth()->user()->id)->where("status",1)->where("is_deleted",0)->get();
        $units = Unit::where('user_id',auth()->user()->id)->where("status",1)->where("is_deleted",0)->get();
        $transaction_categories = TransactionCategory::where("transaction_type_id",3)->where("parent_id",0)->where("status",1)->where("is_deleted",0)->get();

        return view('admin.transactions.transactions.create_capital',compact("transactionAction", "units", "transaction_categories", "transactionTypeid","items"));
    }

    /**
     * Store a new transaction_category in the storage.
     *
     * @param App\Http\Requests\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {

            $parent_id = $request->get("parent_id");
            $sub_parent_ids = $request->get("sub_parent_id");
            if ($sub_parent_ids) {
                $parent_id = $sub_parent_ids[count($sub_parent_ids) - 1];
            }

            Transaction::create([
                'business_id' => $request->get("business_id"),
                'transaction_type_id' => $request->get("transaction_type_id"),
                'transaction_category_id' => $parent_id,
                'item_id' => $request->get("item_id"),
                'unit_id' => $request->get("unit_id"),
                'value' => $request->get("value"),
                'quantity' => $request->get("quantity"),
                'date' => $request->get("date"),
                'user_id' => auth()->user()->id,
                'description' => $request->get("description")
            ]);

            if ($request->get("transaction_type_id") == 4) {

                return redirect()->route('admin.purchases.purchase.index')
                ->with('success_message', 'Purchase has been added successfully');

            } elseif ($request->get("transaction_type_id") == 5) {

                return redirect()->route('admin.sales.sale.index')
                ->with('success_message', 'Sale has been added successfully');

            } elseif ($request->get("transaction_type_id") == 3) {

                return redirect()->route('admin.capitals.capital.index')
                ->with('success_message', 'Capital has been added successfully');

            } else {

                return redirect()->route('admin.transactions.transaction.index')
                ->with('success_message', 'Transaction has been added successfully');

            }
            
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    public function edit($id)
    {

        $transaction = Transaction::where("status",1)->where("is_deleted",0)->findOrFail($id);
        $transaction_types = TransactionType::all();
        $businesses = Business::all();
        $items = Item::all();
        $units = Unit::all();

        return view('admin.transactions.transactions.edit',compact("transaction","transaction_types","businesses","items","units"));
    }

    /**
     * Update the specified transaction_category in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

            $transaction = Transaction::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $transaction->update([
                'name' => $request->get("name"),
                'value' => $request->get("value"),
                'description' => $request->get("description")
            ]);

            if ($transaction->transaction_type_id == 4) {

                return redirect()->route('admin.purchases.purchase.index')
                ->with('success_message', 'Purchase has been updated successfully');

            } elseif ($transaction->transaction_type_id == 5) {

                return redirect()->route('admin.sales.sale.index')
                ->with('success_message', 'Sale has been updated successfully');

            } elseif ($transaction->transaction_type_id == 3) {

                return redirect()->route('admin.capitals.capital.index')
                ->with('success_message', 'Capital has been updated successfully');

            } else {

                return redirect()->route('admin.transactions.transaction.index')
                ->with('success_message', 'Transaction has been updated successfully');

            }
            

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified transaction_category from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $transaction = Transaction::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $transaction->update([
                'is_deleted' => 1
            ]);

            if ($transaction->transaction_type_id == 4) {

                return redirect()->route('admin.purchases.purchase.index')
                ->with('success_message', 'Purchase has been deleted successfully');

            } elseif ($transaction->transaction_type_id == 5) {

                return redirect()->route('admin.sales.sale.index')
                ->with('success_message', 'Sale has been deleted successfully');

            } elseif ($transaction->transaction_type_id == 3) {

                return redirect()->route('admin.capitals.capital.index')
                ->with('success_message', 'Capital has been deleted successfully');

            } else {

                return redirect()->route('admin.transactions.transaction.index')
                ->with('success_message', 'Transaction has been deleted successfully');

            }

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    public function download_certificate($id){

        try {

            $transaction_category = Transaction::where("status",1)->where("is_deleted",0)->findOrFail($id);
            if ($transaction_category) {

                if (file_exists("storage/transaction_category/certificates/" . $transaction_category->certificate)) {

                    return response()->download("storage/transaction_category/certificates/" . $transaction_category->certificate);

                } else {

                    return back()
                        ->withErrors(['unexpected_error' => 'File not found.']);

                }
                

            } else {

                return back()
                    ->withErrors(['unexpected_error' => 'Data not found.']);

            }
            

        } catch (\Exception $e) {

            return back()
                ->withErrors(['unexpected_error' => $e->getMessage()]);

        }

    }

    protected function get_transaction_categories_from_type(Request $request)
     {

        try{

            $transaction_type_id = $request->get("transaction_type_id");

            $transactions = Transaction::where("transaction_type_id",$transaction_type_id)->where("parent_id",0)->where("status",1)->where("is_deleted",0)->get();
            $categories_options = '';
            if (count($transactions) > 0) {

                foreach ($transactions as $transaction_category) {
                    $categories_options .= '<option value="'.$transaction_category->id.'">'.$transaction_category->name.'</option>';
                }

            }

            return response()->json([
                'success' => 1,
                'message' => 'Operation successfully',
                'data' => [
                    'categories_options' => $categories_options
                ]
            ]);

        } catch (Exception $exception) {

            return response()->json([
              'success' => 0,
              'message' => $exception->getMessage(),
              'data' => []
            ]);

        }

    }

    protected function get_transaction_categories_from_category(Request $request)
     {

        try{

            $transaction_category_id = $request->get("transaction_category_id");

            $transactions = Transaction::where("parent_id",$transaction_category_id)->where("status",1)->where("is_deleted",0)->get();
            $categories_options = '';
            if (count($transactions) > 0) {

                foreach ($transactions as $transaction_category) {
                    $categories_options .= '<option value="'.$transaction_category->id.'">'.$transaction_category->name.'</option>';
                }

            }

            return response()->json([
                'success' => 1,
                'message' => 'Operation successfully',
                'data' => [
                    'categories_options' => $categories_options
                ]
            ]);

        } catch (Exception $exception) {

            return response()->json([
              'success' => 0,
              'message' => $exception->getMessage(),
              'data' => []
            ]);

        }

    }

}
