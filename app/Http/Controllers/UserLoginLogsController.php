<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginLogsFormRequest;
use App\Models\UserLoginLog;
use Exception;

use App\Helpers\Authorize;
use App\Helpers\AuthenticateTokenActivationKey;

class UserLoginLogsController extends Controller
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
     * Display a listing of the user login logs.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $userLoginLogs = UserLoginLog::orderBy("id","DESC")->paginate(25);

        return view('admin.user_login_logs.user_login_logs.index', compact('userLoginLogs'));
    }

    /**
     * Show the form for creating a new user login log.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

			return back();

    }

    /**
     * Store a new user login log in the storage.
     *
     * @param App\Http\Requests\UserLoginLogsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(UserLoginLogsFormRequest $request)
    {
        try {

            return back();

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('user_login_logs.unexpected_error')]);
        }
    }

    /**
     * Display the specified user login log.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $userLoginLog = UserLoginLog::findOrFail($id);

        return view('admin.user_login_logs.user_login_logs.show', compact('userLoginLog'));
    }

    /**
     * Show the form for editing the specified user login log.
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
     * Update the specified user login log in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\UserLoginLogsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, UserLoginLogsFormRequest $request)
    {
        try {

            return back();

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('user_login_logs.unexpected_error')]);
        }
    }

    /**
     * Remove the specified user login log from the storage.
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
                ->withErrors(['unexpected_error' => trans('user_login_logs.unexpected_error')]);
        }
    }



}
