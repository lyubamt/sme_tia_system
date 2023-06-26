@extends('layouts.master_clidata')

@extends('layouts.master_clidata')

@section('title')
{{$user->name}} (User)
@endsection

@section('content')


@if(Session::has('success_message'))
    <div class="alert alert-success">
        <span class="fa fa-ok"></span>
        {!! session('success_message') !!}

        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
@endif

@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </li>

        @endforeach
    </ul>
@endif

<div class="card">
    <div class="card-header">

        <h4  class="my-1 float-left"><i class="far fa-user" style="color: black;"></i>&nbsp;{{$user->name}}</h4>

        <div class="float-right">

          <form method="POST" action="{!! route('admin.user.destroy', $user->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}

                <div class="btn-group btn-group-xs pull-right" role="group">
                  <a href="{{ route('admin.user.index') }}" class="btn btn-info" title="{{ trans('users.show_all') }}">
                       <span class="fa fa-th-list" aria-hidden="true"></span>
                   </a>
                    @hasanyrole("Admin")
                    <a href="{{ route('admin.user.edit', $user->id ) }}" class="btn btn-primary btn-sm" title="{{ trans('users.edit') }}">
                        <span class="fa fa-edit" aria-hidden="true"></span>
                    </a>
                    <a href="{{ route('admin.user.edit_role', $user->id ) }}" class="btn btn-success btn-sm" title="Edit Role">
                        <span class="fas fa-key" aria-hidden="true"></span>
                    </a>

                    @if($user->is_deleted == 0)

                      @if($user->status == 1)
                        <a href="{{ route('admin.user.lock', $user->id ) }}" class="btn btn-warning btn-sm" title="Lock User"  onclick="return confirm(&quot;Do you want to lock this user?&quot;)">
                            <span class="fas fa-lock" aria-hidden="true"></span>
                        </a>
                      @else
                        <a href="{{ route('admin.user.unlock', $user->id ) }}" class="btn btn-warning btn-sm" title="Unlock User"  onclick="return confirm(&quot;Do you want to unlock this user?&quot;)">
                            <span class="fas fa-lock-open" aria-hidden="true"></span>
                        </a>
                      @endif

                      <a href="{{ route('admin.user.log_out', $user->id ) }}" class="btn btn-success btn-sm" title="Log Out User"  onclick="return confirm(&quot;Do you want to sign out this user?&quot;)">
                          <span class="fas fa-sign-out-alt" aria-hidden="true"></span>
                      </a>

                      <button type="submit" class="btn btn-danger btn-sm" title="{{ trans('users.delete') }}" onclick="return confirm(&quot;{{ trans('users.confirm_delete') }}&quot;)">
                          <span class="fa fa-trash" aria-hidden="true"></span>
                      </button>

                    @else

                      <a href="{{ route('admin.user.recover', $user->id ) }}" class="btn btn-success btn-sm" title="Recover User"  onclick="return confirm(&quot;Do you want to recover this user?&quot;)">
                          <span class="fas fa-undo" aria-hidden="true"></span>
                      </a>

                    @endif

                    @endhasanyrole
                </div>

          </form>

        </div>

    </div>

    <div class="card-body">

      <dl class="dl-holizontal">
    		<dt>Name</dt>
    		<dd>{{ $user->name }}</dd>
    		<dt><i class="fas fa-venus-mars"></i>&nbsp;Gender</dt>
    		<dd>{{ $user->gender }}</dd>
    		<dt><i class="far fa-envelope"></i>&nbsp;Email</dt>
    		<dd>{{ $user->email }}</dd>
    		<dt><i class="fas fa-phone"></i>&nbsp;Phone</dt>
    		<dd>{{ $user->mobile_phone }}</dd>
    		<dt><i class="far fa-calendar"></i>&nbsp;Start Date</dt>
    		<dd>

          @php

            $format_date = strtotime(optional($user)->created_at);
            echo date("D, dS F,Y h:i:s a",$format_date);

          @endphp

        </dd>
        <dt><i class="fas fa-user-tag"></i>&nbsp;Role(s)</dt>
        <dd>

          @if (count(optional($user)->getRoleNames())>0)
            @php
              $counter = 0;
            @endphp

            @foreach(optional($user)->getRoleNames() as $role)

              @if ($counter == 0)

                {{ $role }}

              @else

                ,{{ $role }}

              @endif

              @php
                $counter++;
              @endphp
            @endforeach

          @else
            NONE
          @endif

        </dd>

        <dt><i class="fas fa-database"></i>&nbsp;Database(s)</dt>
        <dd>

          @if (count(optional($user)->userDatabases)>0)

            @foreach(optional($user)->userDatabases as $database)
              {{ ucwords(str_replace("_"," ",$database->name)) }}
            @endforeach

          @else
            NONE
          @endif

        </dd>

        <dt><i class="far fa-flag"></i>&nbsp;Status</dt>
        <dd>

          @if (optional($user)->status == 0)
            <b style="color: red;">Locked</b>
          @elseif (optional($user)->status == 1)
            <b style="color: green;">Active</b>
          @endif

        </dd>

        <dt><i class="fas fa-history"></i>&nbsp;Last Seen</dt>
        <dd>

          @php

            $format_date = strtotime(optional($user)->last_login_time);
            echo date("D, dS F,Y h:i:s a",$format_date);

          @endphp

        </dd>

        <dt>Is Logged In</dt>
        <dd>

          @if (optional($user)->is_logged_in == 0)
            <b style="color: red;">No</b>
          @elseif (optional($user)->is_logged_in == 1)
            <b style="color: green;">Yes</b>
          @endif

        </dd>

    	</dl>

    </div>
</div>

@endsection
