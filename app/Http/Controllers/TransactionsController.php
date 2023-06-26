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
        $transactions = Transaction::with("transactionType","transactionCategory")->where("status",1)->where("is_deleted",0)->get();
    
        return view('admin.transactions.transactions.index', compact('transactions'));
    }

    public function getSubCategories($transaction_category_id){

        $transactions = Transaction::where("parent_id",$transaction_category_id)->where("status",1)->where("is_deleted",0)->get();

        return $transactions;

    }

    public function getTreeView($transactions){

        $treeView = '';
        foreach ($transactions as $subCategory) {

            $childSubCategories = $this->getSubCategories($subCategory->id);
            if (count($childSubCategories) > 0) {

                $treeView .= '<li><span class="caret">' .$subCategory->name. '</span>';

                $treeView .= '<ul class="nested">';
                $treeView .= $this->getTreeView($childSubCategories);
                $treeView .= '</ul>';
                $treeView .= '</li>';


            }else{

                $treeView .= '<li>' .$subCategory->name. '&nbsp;&nbsp;<form method="POST" action="'. route('admin.transactions.transaction.destroy', $subCategory->id) .'" accept-charset="UTF-8" class="form-inline" style="display: inline;"><input name="_method" value="DELETE" type="hidden">' . csrf_field() .'<div class="btn-group-xs" style="display: inline;"><button type="submit" class="btn btn-warning" title="Delete category" onclick="return confirm(&quot;Do you want to delete this category?&quot;)"><span class="fas fa-times" aria-hidden="true"></span></button></div></form></li>';

            }

        }

        return $treeView;

    }

    /**
     * Show the form for creating a new transaction_category.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        $transaction_types = TransactionType::all();
        $businesses = Business::all();
        $items = Item::all();
        $units = Unit::all();

        return view('admin.transactions.transactions.create',compact("transaction_types","businesses","items","units"));
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
                'description' => $request->get("description")
            ]);
      

            return redirect()->route('admin.transactions.transaction.index')
                ->with('success_message', 'Transaction has been added successfully');
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
            return redirect()->route('admin.transactions.transaction.index')
                ->with('success_message', 'Transaction has been updated successfully');
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

            return redirect()->route('admin.transactions.transaction.index')
                ->with('success_message', 'Transaction has been deleted successfully');
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
