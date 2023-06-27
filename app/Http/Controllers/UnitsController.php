<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitsFormRequest;
use App\Models\Unit;
use Auth;
use Exception;

class UnitsController extends Controller
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
     * Display a listing of the units.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $units = [];
        if (Auth::user()->hasRole("Admin")) {
            $units = Unit::where("status",1)->where("is_deleted",0)->paginate(25);
        } else {
            $units = Unit::where("user_id",auth()->user()->id)->where("status",1)->where("is_deleted",0)->paginate(25);
        }

        return view('admin.units.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new unit.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        return view('admin.units.units.create');
    }

    /**
     * Store a new unit in the storage.
     *
     * @param App\Http\Requests\UnitsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(UnitsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Unit::create($data);

            return redirect()->route('admin.units.unit.index')
                ->with('success_message', trans('units.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified unit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $unit = Unit::where("status",1)->where("is_deleted",0)->findOrFail($id);

        return view('admin.units.units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified unit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $unit = Unit::where("status",1)->where("is_deleted",0)->findOrFail($id);


        return view('admin.units.units.edit', compact('unit'));
    }

    /**
     * Update the specified unit in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\UnitsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UnitsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $unit = Unit::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $unit->update($data);

            return redirect()->route('admin.units.unit.index')
                ->with('success_message', trans('units.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified unit from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $unit = Unit::where("status",1)->where("is_deleted",0)->findOrFail($id);
						$unit->update([
							'is_deleted' => 1
						]);

            return redirect()->route('admin.units.unit.index')
                ->with('success_message', trans('units.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('units.unexpected_error')]);
        }
    }



}
