<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionsFormRequest;
use Exception;
use App\Traits\Authorisable;

class PermissionsController extends Controller
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
	}

    /**
     * Display a listing of the permissions.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $permissions = Permission::all();//paginate(25);

        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $this->generate_permissions();
        return redirect()->route('admin.permission.index')
        ->with('success_message', trans('permissions.model_was_added'));

    }

    /**
     * Store a new permission in the storage.
     *
     * @param App\Http\Requests\PermissionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(PermissionsFormRequest $request)
    {
        try {

            $data = $request->getData();

            Permission::create($data);

            return redirect()->route('admin.permission.index')
                             ->with('success_message', trans('permissions.model_was_added'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('permissions.unexpected_error')]);
        }
    }

    /**
     * Display the specified permission.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($permission)
    {
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($permission)
    {

        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission in the storage.
     *
     * @param  int $id
     * @param App\Http\Requests\PermissionsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($permission, PermissionsFormRequest $request)
    {
        try {

            $data = $request->getData();
            $permission->update($data);

            return redirect()->route('admin.permission.index')
                             ->with('success_message', trans('permissions.model_was_updated'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('permissions.unexpected_error')]);
        }
    }

    /**
     * Remove the specified permission from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($permission)
    {
        try {
            $permission->delete();

            return redirect()->route('admin.permission.index')
                             ->with('success_message', trans('permissions.model_was_deleted'));

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('permissions.unexpected_error')]);
        }
    }

    /**
     * This function generates permissions automatically from the models folder
     */
    private function generate_permissions(){
        //TODO: Improve this function to be able to assign Admin all permission automatically
        $path = app_path().'/Models';
        $files = scandir($path);

        /*$models = array();
        $namespace = 'Your\Model\Namespace\\';*/
        foreach($files as $file) {
          //skip current and parent folder entries and non-php files
          if ($file == '.' || $file == '..') continue;
          $models[] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);//$file; //$namespace . preg_replace('\.php$', '', $file);
        }
      //$users = User::whereHas('roles',function($q){$q->where('name', 'admin');})->get(); //get users with admin roles


        $ps = ['view','add','edit','delete'];
        //$role = Role::firstOrFail(['Admin'=>'name']);
        foreach($models as $mod){
            foreach($ps as $p){
                $perm = Permission::firstOrNew(
                    ['name' => $p.'_'.strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $mod))], ['guard_name' => 'web']);
                $perm->save();
                //$perm->assignRole('Admin');
                //strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $mod))  -> this is for changing modDule to mod_dule
            }
        }

        //give all permissions to admin
        //$role->syncPermissions(Permission::all());


    }




}
