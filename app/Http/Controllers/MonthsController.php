<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MonthsFormRequest;
use App\Models\Month;
use Exception;

class MonthsController extends Controller
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
     * Display a listing of the months.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $months = Month::paginate(25);

        return view('admin.months.months.index', compact('months'));
    }

    /**
     * Show the form for creating a new month.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('admin.months.months.create');
    }

    /**
     * Store a new month in the storage.
     *
     * @param App\Http\Requests\MonthsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(MonthsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            Month::create($data);

            return redirect()->route('admin.months.month.index')
                ->with('success_message', trans('months.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('months.unexpected_error')]);
        }
    }

    /**
     * Display the specified month.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $month = Month::findOrFail($id);

        return view('admin.months.months.show', compact('month'));
    }

    /**
     * Show the form for editing the specified month.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $month = Month::findOrFail($id);
        

        return view('admin.months.months.edit', compact('month'));
    }

    /**
     * Update the specified month in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\MonthsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, MonthsFormRequest $request)
    {
        try {
            
            $data = $request->getData();
            
            $month = Month::findOrFail($id);
            $month->update($data);

            return redirect()->route('admin.months.month.index')
                ->with('success_message', trans('months.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('months.unexpected_error')]);
        }        
    }

    /**
     * Remove the specified month from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $month = Month::findOrFail($id);
            $month->delete();

            return redirect()->route('admin.months.month.index')
                ->with('success_message', trans('months.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('months.unexpected_error')]);
        }
    }



}
