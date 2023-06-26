@extends('layouts.master_clidata')

@section('title')
Sign In Logs
@endsection

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fas fa-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left"><i class="fas fa-user-clock" style="color: black;"></i>&nbsp;Sign In Logs</h4>

            <div class="btn-group btn-group-sm float-right" role="group"></div>

        </div>

        @if(count($userLoginLogs) == 0)
            <div class="card-body text-center">
                <h4>{{ trans('user_login_logs.none_available') }}</h4>
            </div>
        @else
        <div class="card-body card-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>{{ trans('user_login_logs.email') }}</th>
                            <th>{{ trans('user_login_logs.http_client_ip') }}</th>
                            <th>{{ trans('user_login_logs.http_x_forwarded_for') }}</th>
                            <th>Remote Address</th>
                            <th>{{ trans('user_login_logs.server_name') }}</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Comment(s)</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                      $index = 0;
                    @endphp
                    @foreach($userLoginLogs as $userLoginLog)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{ $userLoginLog->email }}</td>
                            <td>{{ $userLoginLog->http_client_ip }}</td>
                            <td>{{ $userLoginLog->http_x_forwarded_for }}</td>
                            <td>{{ $userLoginLog->remote_addr }}</td>
                            <td>{{ $userLoginLog->server_name }}</td>
                            <td>

                              @if (optional($userLoginLog)->direction == 0)
                                Sign Out
                              @elseif (optional($userLoginLog)->direction == 1)
                                Sign In
                              @endif

                            </td>

                            <td>

                              @if (optional($userLoginLog)->status == 0)
                                <b style="color: red;">Failed</b>
                              @elseif (optional($userLoginLog)->status == 1)
                                <b style="color: green;">Success</b>
                              @endif

                            </td>

                            <td>

                              @php

                                $format_date = strtotime(optional($userLoginLog)->created_at);
                                echo date("D, dS F,Y h:i:s a",$format_date);

                              @endphp

                            </td>

                            <td>{{ ($userLoginLog->comment)?$userLoginLog->comment:'NONE' }}</td>

                            <td>

                                <form method="POST" action="{!! route('admin.user_login_logs.user_login_log.destroy', $userLoginLog->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('admin.user_login_logs.user_login_log.show', $userLoginLog->id ) }}" class="btn btn-info" title="Show Sign In Log">
                                            <span class="fas fa-eye" aria-hidden="true"></span>
                                        </a>

                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="card-footer">
            {!! $userLoginLogs->render() !!}
        </div>

        @endif

    </div>
@endsection
