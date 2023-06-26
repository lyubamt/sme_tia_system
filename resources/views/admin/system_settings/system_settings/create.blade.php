@extends('layouts.master_clidata')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading clearfix">
            
            <span class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('system_settings.create') }}</h4>
            </span>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('admin.system_settings.system_setting.index') }}" class="btn btn-primary" title="{{ trans('system_settings.show_all') }}">
                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
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

            <form method="POST" action="{{ route('admin.system_settings.system_setting.store') }}" accept-charset="UTF-8" id="create_system_setting_form" name="create_system_setting_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.system_settings.system_settings.form', [
                                        'systemSetting' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('system_settings.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection


