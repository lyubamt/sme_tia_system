@extends('layouts.master_clidata')

@section('title')
Users
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

<div class="card page-content-card">

  <h4>Users&nbsp;({{count($users)}})</h4>

  <div class="header-container">

    <div class="float-left"></div>

    <div class="btn-group btn-group-sm float-right" role="group">

      <div class="" style="margin-right: 10px;">
        <input class="form-control" type="text" id="search" placeholder="Search...">
      </div>

      @hasanyrole('Admin')
          <a href="{{ route('admin.user.create') }}" class="btn btn-success float-right" title="Add New User">
            <i class="fa fa-plus" aria-hidden="true"></i>
          </a>
      @endhasanyrole

    </div>

  </div>

  <div class="table-responsive">

    <table class="table table-striped table-sm" style="width:100%" id="search-table">

      <thead>
        <tr>
          <th>SN</th>
          <th>Name</th>
          <th>Gender</th>
          <th><i class="far fa-envelope"></i>&nbsp;Email</th>
          <th><i class="fas fa-phone"></i>&nbsp;Phone</th>
          <th><i class="far fa-calendar"></i>&nbsp;Start Date</th>
          <th>
            <!-- <i class="fas fa-user-tag"></i>&nbsp; -->
            Role(s)
          </th>
          <th>

            <!-- <i class="fas fa-database"></i>&nbsp; -->
            Database(s)

          </th>
          <th>

            <!-- <i class="far fa-flag"></i>&nbsp; -->
            Status

          </th>
          <th>

            <!-- <i class="fas fa-history"></i>&nbsp; -->
            Last Seen

          </th>
          <th>Logged</th>
          <th></th>
        </tr>
      </thead>
      <tbody>

        @if(count($users) > 0)

          @php
            $index = 0;
          @endphp
          @foreach($users as $user)

            @php

              $bg_color = ($user->status == 0)?'pink':'';
              $bg_color = ($user->is_deleted == 1)?'orange':$bg_color;

            @endphp

            <tr style="background: {{ $bg_color }};">
              <td>{{++$index}}</td>
              <td>{{ optional($user)->name }}</td>
              <td>{{ optional($user)->gender }}</td>
              <td>{{ optional($user)->email }}</td>
              <td>{{ optional($user)->mobile_phone }}</td>
              <td>

                @php

                  $format_date = strtotime(optional($user)->created_at);
                  echo date("D, dS F,Y h:i:s a",$format_date);

                @endphp

              </td>
              <td>

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

              </td>
              <td>

                @if (count(optional($user)->userDatabases)>0)

                  @foreach(optional($user)->userDatabases as $database)
                    {{ ucwords(str_replace("_"," ",$database->name)) }}
                  @endforeach

                @else
                  NONE
                @endif

              </td>
              <td>

                @if (optional($user)->status == 0)
                  <b style="color: red;">Locked</b>
                @elseif (optional($user)->status == 1)
                  <b style="color: green;">Active</b>
                @endif

              </td>
              <td>

                @php

                  $format_date = strtotime(optional($user)->last_login_time);
                  echo date("D, dS F,Y h:i:s a",$format_date);

                @endphp

              </td>

              <td>

                @if (optional($user)->is_logged_in == 0)
                  <b style="color: red;">No</b>
                @elseif (optional($user)->is_logged_in == 1)
                  <b style="color: green;">Yes</b>
                @endif

              </td>

              <td>

                <form method="POST" action="{!! route('admin.user.destroy', $user->id) !!}" accept-charset="UTF-8">
                  <input name="_method" value="DELETE" type="hidden">
                  {{ csrf_field() }}

                      <div class="btn-group btn-group-xs pull-right" role="group">
                          <a href="{{ route('admin.user.show', $user->id ) }}" class="btn btn-info btn-sm" title="{{ trans('users.show') }}">
                              <span class="fa fa-eye" aria-hidden="true"></span>
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

              </td>
            </tr>
          @endforeach

        @endif

      </tbody>

    </table>

  </div>
  <!--/.table-responsive --->

  @if(count($users) > 0)

    {!! $users->render() !!}

  @endif

</div>
<!-- card -->

@endsection

@section('js')
<script>

$(document).ready(function (){

  // search from table
  $(document).on("keyup", "#search", function() {
    var value = $(this).val().toLowerCase();
    $("#search-table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

});

</script>
@endsection
