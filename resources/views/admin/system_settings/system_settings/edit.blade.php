@extends('layouts.master_clidata')

@section('title')
Edit {{ isset($systemSetting->name) ? $systemSetting->name : 'System Setting' }} (System Setting)
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ !empty($systemSetting->name) ? $systemSetting->name : 'System Setting' }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('admin.system_settings.system_setting.index') }}" class="btn btn-primary" title="{{ trans('system_settings.show_all') }}">
                    <span class="fas fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('admin.system_settings.system_setting.create') }}" class="btn btn-success" title="{{ trans('system_settings.create') }}">
                    <span class="fas fa-plus" aria-hidden="true"></span>
                </a>

            </div>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('admin.system_settings.system_setting.update', $systemSetting->id) }}" id="edit_system_setting_form" name="edit_system_setting_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.system_settings.system_settings.form', [
                                        'systemSetting' => $systemSetting,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('system_settings.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
