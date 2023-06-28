<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionCategory;
use App\Models\TransactionType;
use App\Models\Item;

use App\Models\Currency;

use Exception;

class TransactionCategoriesController extends Controller
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
        $transaction_categories = TransactionCategory::with("transactionType","category","subCategories")->orderBy("transaction_type_id","ASC")->where('parent_id',0)->where("status",1)->where("is_deleted",0)->get();

        $treeView = '';
        if (count($transaction_categories) > 0) {
            $treeView .= '<ul id="categories-tree">';
            $treeView .= $this->getTreeView($transaction_categories);
            $treeView .= '</ul>';

        }

        return view('admin.transaction_categories.transaction_categories.index', compact('transaction_categories','treeView'));
    }

    public function getSubCategories($transaction_category_id){

        $transaction_categories = TransactionCategory::where("parent_id",$transaction_category_id)->where("status",1)->where("is_deleted",0)->get();

        return $transaction_categories;

    }

    public function getTreeView($transaction_categories){

        $treeView = '';
        foreach ($transaction_categories as $subCategory) {

            $childSubCategories = $this->getSubCategories($subCategory->id);
            if (count($childSubCategories) > 0) {

                $treeView .= '<li><span class="caret">' .$subCategory->name. '</span>';

                $treeView .= '<ul class="nested">';
                $treeView .= $this->getTreeView($childSubCategories);
                $treeView .= '</ul>';
                $treeView .= '</li>';


            }else{

                $treeView .= '<li>' .$subCategory->name. '&nbsp;&nbsp;<form method="POST" action="'. route('admin.transaction_categories.transaction_category.destroy', $subCategory->id) .'" accept-charset="UTF-8" class="form-inline" style="display: inline;"><input name="_method" value="DELETE" type="hidden">' . csrf_field() .'<div class="btn-group-xs" style="display: inline;"><button type="submit" class="btn btn-warning" title="Delete category" onclick="return confirm(&quot;Do you want to delete this category?&quot;)"><span class="fas fa-times" aria-hidden="true"></span></button></div></form></li>';

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
        $currencies = Currency::all();

        return view('admin.transaction_categories.transaction_categories.create',compact("transaction_types","currencies"));
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

            TransactionCategory::create([
                'transaction_type_id' => $request->get("transaction_type_id"),
                'name' => $request->get("name"),
                'description' => $request->get("description"),
                'parent_id' => $parent_id
            ]);
      

            return redirect()->route('admin.transaction_categories.transaction_category.index')
                ->with('success_message', 'Transaction category has been added successfully');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
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

            $transaction_category = TransactionCategory::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $transaction_category->update([
                'Transaction category_id' => $request->get("transaction_category_category"),
                'Transaction category_type' => $request->get("transaction_category_type"),
                'name' => $request->get("name"),
                'physical_address' => $request->get("physical_address"),
                'email' => $request->get("email"),
                'phone' => $request->get("phone"),
                'website' => $request->get("website"),
                'currency_id' => $request->get("currency"),
                // 'certificate' => $certificate,
                'geo_tag' => $request->get("geo_tag")
            ]);

            return redirect()->route('admin.transaction_categories.transaction_category.index')
                ->with('success_message', 'Transaction category has been updated successfully');
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
            $transaction_category = TransactionCategory::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $transaction_category->update([
                'is_deleted' => 1
            ]);

            return redirect()->route('admin.transaction_categories.transaction_category.index')
                ->with('success_message', 'Transaction category has been deleted successfully');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    public function download_certificate($id){

        try {

            $transaction_category = TransactionCategory::where("status",1)->where("is_deleted",0)->findOrFail($id);
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

            $transaction_categories = TransactionCategory::where("transaction_type_id",$transaction_type_id)->where("parent_id",0)->where("status",1)->where("is_deleted",0)->get();
            $categories_options = '';
            if (count($transaction_categories) > 0) {

                foreach ($transaction_categories as $transaction_category) {
                    $categories_options .= '<option value="'.$transaction_category->id.'">'.$transaction_category->name.'</option>';
                }

            }

            $items = [];
            if ($transaction_type_id == 1) {
                // ASSET

                $items = Item::where("is_asset",1)->where('user_id',auth()->user()->id)->where("status",1)->where("is_asset",1)->where("is_deleted",0)->paginate(25);

            } else if ($transaction_type_id == 2) {
                // LIABILITY

                $items = Item::where("is_liability",1)->where('user_id',auth()->user()->id)->where("status",1)->where("is_liability",1)->where("is_deleted",0)->paginate(25);

            } else if ($transaction_type_id == 3) {
                // CAPITAL

                $items = Item::where("is_capital",1)->where('user_id',auth()->user()->id)->where("status",1)->where("is_liability",1)->where("is_deleted",0)->paginate(25);

            } else if ($transaction_type_id == 4) {
                // PURCHASE

                $items = Item::where("is_purchase",1)->where('user_id',auth()->user()->id)->where("status",1)->where("is_liability",1)->where("is_deleted",0)->paginate(25);

            } else if ($transaction_type_id == 5) {
                // SALE

                $items = Item::where("is_sale",1)->where('user_id',auth()->user()->id)->where("status",1)->where("is_liability",1)->where("is_deleted",0)->paginate(25);

            } else if ($transaction_type_id == 6) {
                // EXPENSE

                $items = Item::where("is_expense",1)->where('user_id',auth()->user()->id)->where("status",1)->where("is_liability",1)->where("is_deleted",0)->paginate(25);

            }

            $items_options = '';
            if (count($items) > 0) {

                foreach ($items as $item) {
                    $items_options .= '<option value="'.$item->id.'">'.$item->name.'</option>';
                }

            }
            

            return response()->json([
                'success' => 1,
                'message' => 'Operation successfully',
                'data' => [
                    'categories_options' => $categories_options,
                    'items_options' => $items_options
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

            $transaction_categories = TransactionCategory::where("parent_id",$transaction_category_id)->where("status",1)->where("is_deleted",0)->get();
            $categories_options = '';
            if (count($transaction_categories) > 0) {

                foreach ($transaction_categories as $transaction_category) {
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
