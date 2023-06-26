@extends('layouts.master_clidata')

@section('content')

    <div class="panel panel-default">
  
        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ !empty($title) ? $title : 'User Login Log' }}</h4>
            </div>
            <div class="btn-group btn-group-sm pull-right" role="group">

                <a href="{{ route('admin.user_login_logs.user_login_log.index') }}" class="btn btn-primary" title="{{ trans('user_login_logs.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('admin.user_login_logs.user_login_log.create') }}" class="btn btn-success" title="{{ trans('user_login_logs.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>

            </div>
        </div>

        <div class="panel-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('admin.user_login_logs.user_login_log.update', $userLoginLog->id) }}" id="edit_user_login_log_form" name="edit_user_login_log_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.user_login_logs.user_login_logs.form', [
                                        'userLoginLog' => $userLoginLog,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('user_login_logs.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection