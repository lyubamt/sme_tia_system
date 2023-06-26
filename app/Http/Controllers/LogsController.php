<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogsFormRequest;
use App\Models\Log;
use App\Models\User;
use Exception;

use App\Helpers\Authorize;
use App\Helpers\AuthenticateTokenActivationKey;

class LogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
	    $this->middleware('auth');
			Authorize::checkApplication();
	}

    /**
     * Display a listing of the logs.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $logs = Log::orderBy("id","DESC")->paginate(25);

        return view('admin.logs.logs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new log.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
				return back();
    }

    /**
     * Store a new log in the storage.
     *
     * @param App\Http\Requests\LogsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(LogsFormRequest $request)
    {
        try {

            return back();

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('logs.unexpected_error')]);
        }
    }

    /**
     * Display the specified log.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $log = Log::with('user')->findOrFail($id);

        return view('admin.logs.logs.show', compact('log'));

		}

    /**
     * Show the form for editing the specified log.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {

        return back();

    }

    /**
     * Update the specified log in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\LogsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, LogsFormRequest $request)
    {
        try {

            return back();

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('logs.unexpected_error')]);
        }
    }

    /**
     * Remove the specified log from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {

            return back();

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('logs.unexpected_error')]);
        }
    }



}
