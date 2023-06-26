@extends('layouts.master_clidata')

@section('title')

(Sign In Log) {{ $userLoginLog->email }} on

@php

  $format_date = strtotime(optional($userLoginLog)->created_at);
  echo date("D, dS F,Y h:i:s a",$format_date);

@endphp

@endsection

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="my-1 float-left">

          <i class="fas fa-user-clock" style="color: black;"></i>&nbsp;

          {{ $userLoginLog->email }} on

          @php

            $format_date = strtotime(optional($userLoginLog)->created_at);
            echo date("D, dS F,Y h:i:s a",$format_date);

          @endphp

        </h4>

        <div class="float-right">

            <form method="POST" action="{!! route('admin.user_login_logs.user_login_log.destroy', $userLoginLog->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.user_login_logs.user_login_log.index') }}" class="btn btn-primary" title="Show All Sign In Logs">
                        <span class="fas fa-th-list" aria-hidden="true"></span>
                    </a>

                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('user_login_logs.email') }}</dt>
            <dd>{{ $userLoginLog->email }}</dd>
            <dt>{{ trans('user_login_logs.http_client_ip') }}</dt>
            <dd>{{ $userLoginLog->http_client_ip }}</dd>
            <dt>{{ trans('user_login_logs.http_x_forwarded_for') }}</dt>
            <dd>{{ $userLoginLog->http_x_forwarded_for }}</dd>
            <dt>Remote Address</dt>
            <dd>{{ $userLoginLog->remote_addr }}</dd>
            <dt>{{ trans('user_login_logs.server_name') }}</dt>
            <dd>{{ $userLoginLog->server_name }}</dd>
            <dt>Action</dt>
            <dd>

              @if (optional($userLoginLog)->direction == 0)
                Sign Out
              @elseif (optional($userLoginLog)->direction == 1)
                Sign In
              @endif

            </dd>
            <dt>{{ trans('user_login_logs.status') }}</dt>
            <dd>

              @if (optional($userLoginLog)->status == 0)
                <b style="color: red;">Failed</b>
              @elseif (optional($userLoginLog)->status == 1)
                <b style="color: green;">Success</b>
              @endif

            </dd>
            <dt>Date</dt>
            <dd>

              @php

                $format_date = strtotime(optional($userLoginLog)->created_at);
                echo date("D, dS F,Y h:i:s a",$format_date);

              @endphp

            </dd>
            <dt>{{ trans('user_login_logs.comment') }}(s)</dt>
            <dd>{{ $userLoginLog->comment }}</dd>

        </dl>

    </div>
</div>

@endsection
