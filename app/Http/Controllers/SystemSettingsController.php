<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SystemSettingsFormRequest;
use App\Models\SystemSetting;
use Exception;

use Session;

use App\Helpers\Authorize;
use App\Helpers\AuthenticateTokenActivationKey;

class SystemSettingsController extends Controller
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
     * Display a listing of the system settings.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $systemSettings = SystemSetting::orderBy("position","ASC")->get();

        return view('admin.system_settings.system_settings.index', compact('systemSettings'));
    }

    /**
     * Show the form for creating a new system setting.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        return back();

    }

    /**
     * Store a new system setting in the storage.
     *
     * @param App\Http\Requests\SystemSettingsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(SystemSettingsFormRequest $request)
    {
        try {

						return back();

            $data = $request->getData();

            SystemSetting::create($data);

            return redirect()->route('admin.system_settings.system_setting.index')
                ->with('success_message', trans('system_settings.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('system_settings.unexpected_error')]);
        }
    }

    /**
     * Display the specified system setting.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $systemSetting = SystemSetting::findOrFail($id);

        return view('admin.system_settings.system_settings.show', compact('systemSetting'));
    }

    /**
     * Show the form for editing the specified system setting.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $systemSetting = SystemSetting::findOrFail($id);


        return view('admin.system_settings.system_settings.edit', compact('systemSetting'));
    }

    /**
     * Update the specified system setting in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\SystemSettingsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, SystemSettingsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $systemSetting = SystemSetting::findOrFail($id);
						$last_value = $systemSetting->value;
            $systemSetting->update($data);

						// LOG
						Authorize::logGeneral("System Setting '" . $systemSetting->name . "' has been updated from value: ". $last_value . " to ". $data["value"],auth()->user()->id);

            return redirect()->route('admin.system_settings.system_setting.index')
                ->with('success_message', trans('system_settings.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('system_settings.unexpected_error')]);
        }
    }

    /**
     * Remove the specified system setting from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {

						return back();
            $systemSetting = SystemSetting::findOrFail($id);
            $systemSetting->delete();

            return redirect()->route('admin.system_settings.system_setting.index')
                ->with('success_message', trans('system_settings.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('system_settings.unexpected_error')]);
        }
    }



}
