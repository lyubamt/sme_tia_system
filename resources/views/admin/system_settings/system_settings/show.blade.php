@extends('layouts.master_clidata')

@section('title')
{{ isset($systemSetting->name) ? $systemSetting->name : 'System Setting' }} (System Setting)
@endsection


@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="my-1 float-left">{{ isset($systemSetting->name) ? $systemSetting->name : 'System Setting' }}</h4>

        <div class="float-right">

            <form method="POST" action="{!! route('admin.system_settings.system_setting.destroy', $systemSetting->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.system_settings.system_setting.index') }}" class="btn btn-primary" title="{{ trans('system_settings.show_all') }}">
                        <span class="fas fa-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.system_settings.system_setting.edit', $systemSetting->id ) }}" class="btn btn-primary" title="{{ trans('system_settings.edit') }}">
                        <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                    </a>

                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('system_settings.name') }}</dt>
            <dd>{{ $systemSetting->name }}</dd>
            <dt>{{ trans('system_settings.value') }}</dt>
            <dd>{{ $systemSetting->value }}</dd>
            <dt>Description</dt>
            <dd>{{ $systemSetting->descrption }}</dd>
            <dt>{{ trans('system_settings.created_at') }}</dt>
            <dd>{{ $systemSetting->created_at }}</dd>
            <dt>{{ trans('system_settings.updated_at') }}</dt>
            <dd>{{ $systemSetting->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection
