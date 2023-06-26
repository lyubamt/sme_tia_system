<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolesFormRequest;
use Exception;
use App\Traits\Authorisable;

use Session;

use App\Helpers\Authorize;
use App\Helpers\AuthenticateTokenActivationKey;



class RolesController extends Controller
{
    use Authorisable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
	public function __construct()
	{
        $this->middleware(['auth']);
        Authorize::checkApplication();
	}

    /**
     * Display a listing of the roles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.roles.index', compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        return back();
        $permissions = Permission::all();
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a new role in the storage.
     *
     * @param App\Http\Requests\RolesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(RolesFormRequest $request)
    {
        try {

            $data = $request->getData();
            //permissions array ids
            $permissions = $data['permissions'];


            if($role = Role::create($data)){

                $role->syncPermissions($permissions);
                return redirect()->route('admin.role.index')
                ->with('success_message', trans('roles.model_was_updated'));
            }
            else{

                return back()->withInput()
                ->withErrors(['unexpected_error' => trans('roles.unexpected_error')]);
            }

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('roles.unexpected_error')]);
        }
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($role)
    {

        $permissions = Permission::all();

        return view('admin.roles.show', compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($role)
    {
        return back();
    }

    /**
     * Update the specified role in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\RolesFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($role, RolesFormRequest $request)
    {
        try {

            return back();

            $data = $request->getData();
            $permissions = $data['permissions'];

            if($role){
                //update role
                $role->update($data);
                // admin role has everything
                if($role->name === 'Admin') {
                    //$role->syncPermissions(Permission::all());
                    $role->syncPermissions($permissions);
                    return redirect()->route('admin.role.index')
                        ->with('success_message', trans('roles.model_was_updated'));

                }

                $role->syncPermissions($permissions);
                return redirect()->route('admin.role.index')
                ->with('success_message', trans('roles.model_was_updated'));
            }


        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('roles.unexpected_error')]);
        }
    }

    /**
     * Remove the specified role from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($role)
    {

        try {

            return redirect()->route('admin.role.index');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('roles.unexpected_error')]);
        }
    }



}
