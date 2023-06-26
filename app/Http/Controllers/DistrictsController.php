<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DistrictsFormRequest;
use App\Models\District;
use App\Models\Region;
use Exception;

class DistrictsController extends Controller
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
     * Display a listing of the districts.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $districts = District::with('region')->where("status",1)->where("is_deleted",0)->paginate(25);

        return view('admin.districts.districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new district.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $regions = Region::where("status",1)->where("is_deleted",0)->pluck('name','id')->all();

        return view('admin.districts.districts.create', compact('regions'));
    }

    /**
     * Store a new district in the storage.
     *
     * @param App\Http\Requests\DistrictsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(DistrictsFormRequest $request)
    {
        try {

            $data = $request->getData();

            District::create($data);

            return redirect()->route('admin.districts.district.index')
                ->with('success_message', trans('districts.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('districts.unexpected_error')]);
        }
    }

    /**
     * Display the specified district.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $district = District::with('region')->where("status",1)->where("is_deleted",0)->findOrFail($id);

        return view('admin.districts.districts.show', compact('district'));
    }

    /**
     * Show the form for editing the specified district.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $district = District::where("status",1)->where("is_deleted",0)->findOrFail($id);
        $regions = Region::where("status",1)->where("is_deleted",0)->pluck('name','id')->all();

        return view('admin.districts.districts.edit', compact('district','regions'));
    }

    /**
     * Update the specified district in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\DistrictsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, DistrictsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $district = District::where("status",1)->where("is_deleted",0)->findOrFail($id);
            $district->update($data);

            return redirect()->route('admin.districts.district.index')
                ->with('success_message', trans('districts.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('districts.unexpected_error')]);
        }
    }

    /**
     * Remove the specified district from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $district = District::where("status",1)->where("is_deleted",0)->findOrFail($id);
						$district->update([
							'is_deleted' => 1
						]);

            return redirect()->route('admin.districts.district.index')
                ->with('success_message', trans('districts.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('districts.unexpected_error')]);
        }
    }



}
