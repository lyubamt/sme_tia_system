<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegionsFormRequest;
use App\Models\Country;
use App\Models\Region;
use Exception;

class RegionsController extends Controller
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
     * Display a listing of the regions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $regions = Region::with('country')->where("status",1)->where("is_deleted",0)->paginate(25);

        return view('admin.regions.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new region.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::where("status",1)->where("is_deleted",0)->pluck('name','id')->all();

        return view('admin.regions.regions.create', compact('countries'));
    }

    /**
     * Store a new region in the storage.
     *
     * @param App\Http\Requests\RegionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RegionsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Region::create($data);

            return redirect()->route('admin.regions.region.index')
                ->with('success_message', trans('regions.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('regions.unexpected_error')]);
        }
    }

    /**
     * Display the specified region.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $region = Region::with('country')->where("status",1)->where("is_deleted",0)->findOrFail($id);

        return view('admin.regions.regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified region.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $region = Region::where("status",1)->where("is_deleted",0)->findOrFail($id);
        $countries = Country::where("status",1)->where("is_deleted",0)->pluck('name','id')->all();

        return view('admin.regions.regions.edit', compact('region','countries'));
    }

    /**
     * Update the specified region in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\RegionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, RegionsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $region = Region::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $region->update($data);

            return redirect()->route('admin.regions.region.index')
                ->with('success_message', trans('regions.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('regions.unexpected_error')]);
        }
    }

    /**
     * Remove the specified region from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $region = Region::where("status",1)->where("is_deleted",0)->findOrFail($id);
						$region->update([
							'is_deleted' => 1
						]);

            return redirect()->route('admin.regions.region.index')
                ->with('success_message', trans('regions.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('regions.unexpected_error')]);
        }
    }



}
