<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemsFormRequest;
use App\Models\Item;
use Auth;
use Exception;

class ItemsController extends Controller
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
     * Display a listing of the Items.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $items = [];
        if (Auth::user()->hasRole("Admin")) {
            $items = Item::with("user")->where("status",1)->where("is_deleted",0)->paginate(25);
        } else {
            $items = Item::with("user")->where("user_id",auth()->user()->id)->where("status",1)->where("is_deleted",0)->paginate(25);
        }
        

        return view('admin.items.items.index', compact('items'));
    }

    /**
     * Show the form for creating a new Item.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        return view('admin.items.items.create');
    }

    /**
     * Store a new Item in the storage.
     *
     * @param App\Http\Requests\ItemsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ItemsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Item::create($data);

            return redirect()->route('admin.items.item.index')
                ->with('success_message', 'Item has been added successfully.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified Item.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $item = Item::where("status",1)->where("is_deleted",0)->findOrFail($id);

        return view('admin.items.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified Item.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $item = Item::where("status",1)->where("is_deleted",0)->findOrFail($id);


        return view('admin.items.items.edit', compact('item'));
    }

    /**
     * Update the specified Item in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\ItemsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ItemsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $item = Item::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $item->update($data);

            return redirect()->route('admin.items.item.index')
                ->with('success_message', 'Item has been updated successfully.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified Item from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $item = Item::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $item->update([
                'is_deleted' => 1
            ]);

            return redirect()->route('admin.items.item.index')
                ->with('success_message', 'Item has been deleted successfully.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('Items.unexpected_error')]);
        }
    }



}
