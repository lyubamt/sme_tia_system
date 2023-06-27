<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserDatabase;
use App\Models\UserLoginLog;
use App\Models\Role;
use App\Models\Permission;
use App\Models\District;#
use App\Models\Region;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Traits\Authorisable;
use Illuminate\Support\Facades\Hash;
use Exception;
use Mail;
use Config;
use Session;

use App\Helpers\Authorize;
use App\Helpers\AuthenticateTokenActivationKey;

use Illuminate\Http\Request;


class UsersController extends Controller
{
  use Authorisable; //This is for checking permission of all actions

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
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        if(Auth::user()->hasRole('Admin')){

            $users = User::with('userLoginLogs','userDatabases')->paginate(25);

            return view('admin.users.index', compact('users'));

         }else{
             return "You do not have  access!";
         }

    }

    public function filter(Request $request){
    	$filter_region_id = $request->get("region") + 0;
      	$filter_district_id = $request->get("district") + 0;

      	$all_regions_id = Region::where("name","All")->first()->id;


        $all_districts_id = District::where("name","All")->first()->id;

      	if(Auth::user()->hasRole('Admin')){

      	    //CHECK IF ALL REGIONS OR A SINGLE REGION
      	    if($filter_region_id == $all_regions_id){
      	        //ALL REGIONS

      	        $users = User::with('district','region')->get();//paginate(25);

      	    }else{
      	        //SELECTED REGION

      	        //CHECK IF ALL DISTRICTS OR A SINGLE DISTRICT

      	        if($filter_district_id == $all_districts_id){
      	            //SELECTED REGION + ALL DISTRICTS

      	             $users = User::with('district','region')->where("region_id",$filter_region_id)->get();//paginate(25);
      	        }else{
      	            //SELECTED REGION + SELECTED DISTRICT

      	            $users = User::with('district','region')->where("region_id",$filter_region_id)->where("district_id",$filter_district_id)->get();//paginate(25);

      	        }

      	    }

      	     $filter_districts = $filter_districts2 = District::where("region_id",$filter_region_id)->orderBy("name","ASC")->pluck("name","id")->all();
            $filter_regions = $filter_regions2 = Region::orderBy("name","ASC")->pluck("name","id")->all();



         }else{
           return "Sorry, you do not have access!";
         }




        // dd($users);
        return view('admin.users.index', compact('users','filter_districts','filter_districts2','filter_regions','filter_regions2','filter_region_id','filter_district_id'));

    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {

        if(Auth::user()->hasRole('Admin')){

          $roles = Role::all();
          $password_required = true;
          $db_connections = array_keys(config('database.connections'));

          return view('admin.users.create',compact('roles','password_required','db_connections'));

         }else{
             return "You do not have  access!";
         }

    }

    /**
     * Store a new user in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

      try {

        $this->validate($request, [
            'first_name' => 'required|min:2',
            'middle_name' => 'required|min:1',
            'last_name' => 'required|min:2',
            'gender' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'mobile_phone' => 'required|min:1',
            'roles' => 'required|min:1'
        ]);

        $email = $request->input('email');
        $db_connections = $request->input('db_connections');
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ?,.;:+=_-)(*&^%$#@!{}[]\|/<>';

        // $password = $this->generate_string($permitted_chars, 20);
        $root_password = Hash::make($email);

        $user = User::create($request->except('roles', 'permissions'));

        $added_user = User::where('email',$email)->first();
        $added_user->update([
          'name'=> $request->get("first_name") ." ".$request->get("middle_name"). " ".$request->get("last_name"),
          'password'=> $root_password
        ]);

        // if (count($db_connections) > 0) {

        //   foreach ($db_connections as $db_connection) {

        //     UserDatabase::create([
        //       'user_id' => $added_user->id,
        //       'email' => $email,
        //       'name' => $db_connection,
        //     ]);

        //   }

        // }

        if ($user) {

            $this->syncPermissions($request, $user);

        }

        // LOG
        Authorize::logGeneral("New user with email '" . $email . "' has been created",auth()->user()->id);

        return redirect()->route('admin.user.index')
                     ->with('success_message', 'User has been created successfully!');

      } catch (\Exception $e) {

        return back()
              ->withErrors(['unexpected_error' => $e->getMessage()]);

      }

    }

    public function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
      $user = User::find($id);
        if ($user->is_deleted == 1) {
          return back()
                  ->withErrors(['unexpected_error' => "Sorry, You can not edit information of a deleted user"]);
        }

        $db_connections = array_keys(config('database.connections'));
        $roles = Role::all();
        $permissions = Permission::all('name', 'id');
        $password_required = false;
        $edit = true;
        return view('admin.users.edit', compact('user','roles','permissions','password_required','db_connections','edit'));
    }

   /**
    * This function is used to edit user roles
    */

    public function edit_role($id)
    {

      $user = User::find($id);

      if ($user->is_deleted == 1) {
        return back()
                ->withErrors(['unexpected_error' => "Sorry, You can not edit role(s) of a deleted user"]);
      }

      $login_user=User::findOrFail(Auth::Id());

      if($login_user->hasRole('Admin')){

        $roles = Role::all();
        $permissions = Permission::all('name', 'id');
        return view('admin.users.edit_role', compact('user','roles','permissions'));
      }
      else{
        $message = "You do not have permission  to access  this page!";
        return response(view('errors.403',compact('message')), 403);
      }

    }

    /**
     * Update the specified user in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {

          $user = User::find($id);

            if ($user->is_deleted == 1) {
              return back()
                      ->withErrors(['unexpected_error' => "Sorry, You can not update information of a deleted user"]);
            }

            $this->validate($request, [
                'first_name' => 'required|min:2',
                'middle_name' => 'required|min:1',
                'last_name' => 'required|min:2',
                'gender' => 'required|min:4',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'mobile_phone' => 'required|min:1',
                'roles' => 'required|min:1'
            ]);

            $this->syncPermissions($request, $user);
            $email = $request->get("email");
            $db_connections = $request->input('db_connections');
            $user->update([
              "name"=>$request->get("first_name") ." ".$request->get("middle_name"). " ".$request->get("last_name"),
              "first_name"=>$request->get("first_name"),
              "middle_name"=>$request->get("middle_name"),
              "last_name"=>$request->get("last_name"),
              "gender"=>$request->get("gender"),
              "email"=>$request->get("email"),
              "mobile_phone"=>$request->get("mobile_phone"),
            ]);

            // $previous_assigned_dbs = UserDatabase::where("email",$email)->get();
            // if (count($previous_assigned_dbs) > 0) {

            //   foreach ($previous_assigned_dbs as $previous_assigned_db) {

            //     $previous_assigned_db->delete();

            //   }

            // }

            // if (count($db_connections) > 0) {

            //   foreach ($db_connections as $db_connection) {

            //     UserDatabase::create([
            //       'user_id' => $user->id,
            //       'email' => $email,
            //       'name' => $db_connection,
            //     ]);

            //   }

            // }

            // LOG
            Authorize::logGeneral("User with email '" . $email . "' has been updated successfully",auth()->user()->id);
            Session::put("success_message",trans('users.model_was_updated'));

            return redirect()->route('admin.user.index')
                             ->with('success_message', trans('users.model_was_updated'));

        } catch (Exception $exception) {

            Session::put("unexpected_error",$exception->getMessage());
            return back()->withInput()
                         ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Update the specified user in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update_role($id, Request $request)
    {

      $user = User::find($id);
        if ($user->is_deleted == 1) {
          return back()
                  ->withErrors(['unexpected_error' => "Sorry, You can not update role(s) of a deleted user"]);
        }

        $login_user=User::findOrFail(Auth::Id());

        if($login_user->hasRole('Admin'))
        {
           try {

                  $this->validate($request, [
                      'name' => 'bail|required|min:2',
                      'email' => 'required|email|unique:users,email,' . $user->id,
                      'roles' => 'required|min:1'
                  ]);


                  // Update user
                  //$user->fill($request->except('roles', 'permissions', 'password')); //TODO: Fix update user without changing passoword
                  $user->fill($request->except('roles', 'permissions'));

                  // Handle the user roles
                  $this->syncPermissions($request, $user);

                  $user->save();
                  //$user->update($data);

                  return redirect()->route('admin.user.index')
                                   ->with('success_message', trans('users.model_was_updated'));

              } catch (Exception $exception) {

                  return back()->withInput()
                               ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
              }
        } //TODO: Add else clause... to hand ubnormal  access tot he is resouces
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {

          $user = User::find($id);
            if ( Auth::user()->id == $user->id ) {

                // LOG
                Authorize::logGeneral("User '" . $user->email . "' has tried to delete his/her account",auth()->user()->id);

                return back()->withInput()
                        ->withErrors(['unexpected_error' => "Sorry, you can not delete your own account!"]);

            }else{

              if ($user->is_deleted == 0) {

                $user->update([
                  "status" => 0,
                  "is_deleted" => 1
                ]);

                // LOG
                Authorize::logGeneral("User '" . $user->email . "' has been deleted successfully",auth()->user()->id);

                return redirect()->route('admin.user.index')
                                ->with('success_message', trans('users.model_was_deleted'));

              }else{

                return back()->withInput()
                             ->withErrors(['unexpected_error' => 'You can not delete a user who is already deleted!']);

              }

            }
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('users.unexpected_error')]);
        }
    }

    public function recover($id)
    {
        try {

          $user = User::find($id);
            if ( Auth::user()->id == $user->id) {

                // LOG
                Authorize::logGeneral("User '" . $user->email . "' has tried to recover his/her account",auth()->user()->id);
                return back()->withInput()
                  ->withErrors(['unexpected_error' => "Sorry, you can not recover your own account!"]);//user cant delete himself
            }else{

              if ($user->is_deleted == 1) {

                $user->update([
                  "status" => 1,
                  "is_deleted" => 0
                ]);

                // LOG
                Authorize::logGeneral("User '" . $user->email . "' has been recovered successfully",auth()->user()->id);

                return redirect()->route('admin.user.index')
                                ->with('success_message', 'User has been recovered successfully');

              }else{

                return back()->withInput()
                             ->withErrors(['unexpected_error' => 'You can not recover a user who is not deleted yet!']);

              }

            }
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    public function lock($id)
    {
        try {

          $user = User::find($id);
            if ( Auth::user()->id == $user->id) {

                // LOG
                Authorize::logGeneral("User '" . $user->email . "' has tried to lock his/her account",auth()->user()->id);
                return back()->withInput()
                  ->withErrors(['unexpected_error' => "Sorry, you can not lock your own account!"]);//user cant delete himself
            }else{

              if ($user->status == 1) {

                $user->update([
                  "status" => 0
                ]);

                // LOG
                Authorize::logGeneral("User '" . $user->email . "' has been locked successfully",auth()->user()->id);

                return redirect()->route('admin.user.index')
                                ->with('success_message', 'User has been locked successfully');

              }else{

                return back()->withInput()
                             ->withErrors(['unexpected_error' => 'You can not lock a user who is already locked!']);

              }

            }
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    public function unlock($id)
    {
        try {

          $user = User::find($id);
            if ( Auth::user()->id == $user->id) {

                // LOG
                Authorize::logGeneral("User '" . $user->email . "' has tried to unlock his/her account",auth()->user()->id);
                return back()->withInput()
                  ->withErrors(['unexpected_error' => "Sorry, you can not unlock your own account!"]);//user cant delete himself
            }else{

                if ($user->status == 0) {

                  $user->update([
                    "status" => 1
                  ]);

                  // LOG
                  Authorize::logGeneral("User '" . $user->email . "' has been unlocked successfully",auth()->user()->id);

                  return redirect()->route('admin.user.index')
                                  ->with('success_message', 'User has been unlocked successfully');

                }else{

                  return back()
                          ->withErrors(['unexpected_error' => 'You can not unlock a user who has not been locked yet!']);

                }

            }
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    public function log_out($id)
    {
        try {

          $user = User::find($id);
            if ( Auth::user()->id == $user->id) {

                // LOG
                Authorize::logGeneral("User '" . $user->email . "' has tried to force log out his/her account",auth()->user()->id);
                return back()->withInput()
                  ->withErrors(['unexpected_error' => "Sorry, you can not force log out your own account!"]);//user cant delete himself
            }else{

                if ($user->is_logged_in == 1) {

                  $user->update([
                    "is_logged_in" => 0
                  ]);

                  // LOG
                  Authorize::logGeneral("User '" . $user->email . "' has been force logged out by Admin successfully",auth()->user()->id);

                  return redirect()->route('admin.user.index')
                                  ->with('success_message', 'User has been force logged out by Admin successfully');

                }else{

                  return back()->withInput()
                               ->withErrors(['unexpected_error' => 'You can not sign out a user who has not signed in yet!']);

                }

            }
        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => $exception->getMessage()]);
        }
    }

    /**
     * Function for syncing the permissions
     */
    private function syncPermissions(Request $request, $id)
    {

      $user = User::find($id);
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }

		public function change_password(Request $request){

		    $user_id =  $request->get("change_password_id");
		    $old_password = $request->get("password");
		    $password1 = $request->get("new_password");

		    $new_password = bcrypt($password1);
		  //  dd($user_id ." ".$old_password." ".$new_password);

            $user_hashed_password = User::find($user_id)->password;

            if (Hash::check($old_password, $user_hashed_password)) {
                $user = User::find($user_id);
                $user->update([
                    'password'=>$new_password
                    ]);
                return back()
                            ->with('success_message', trans('Password changed successfully!'));
            }else{
                return back()->withInput()
                         ->withErrors(['unexpected_error' => trans('The old password is not correct!')]);
            }
		}

}
