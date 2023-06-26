<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Member;
use App\Models\MemberRelative;
use App\Models\Subscription;
use App\Models\Contribution;
use App\Models\Condolence;
use App\Models\Transaction;

use App\Helpers\Authorize;
use App\Helpers\AuthenticateTokenActivationKey;

use Session;
use PDF;
use Auth;

class LandingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // Authorize::checkApplication();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('admin.landing');

    }

    public function application_dashboard()
    {
        $app = Authorize::getApplication();

        return view('admin.landing_application',compact('app'));

    }

}
