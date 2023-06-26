@extends('layouts.master_clidata')

@section('title')
System Settings
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

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>

                  {{ $error }}

                  <button type="button" class="close" data-dismiss="alert" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                  </button>

                </li>
            @endforeach
        </ul>
    @endif

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ trans('system_settings.model_plural') }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group"></div>

        </div>

        @if(count($systemSettings) == 0)
            <div class="card-body text-center">
                <h4>{{ trans('system_settings.none_available') }}</h4>
            </div>
        @else
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>{{ trans('system_settings.name') }}</th>
                            <th>{{ trans('system_settings.value') }}</th>
                            <th>Description</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                      $index = 0;
                    @endphp
                    @foreach($systemSettings as $systemSetting)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{ $systemSetting->name }}</td>
                            <td>{{ $systemSetting->value }}</td>
                            <td>{{ $systemSetting->descrption }}</td>

                            <td>

                                <form method="POST" action="{!! route('admin.system_settings.system_setting.destroy', $systemSetting->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('admin.system_settings.system_setting.show', $systemSetting->id ) }}" class="btn btn-info" title="{{ trans('system_settings.show') }}">
                                            <span class="fas fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('admin.system_settings.system_setting.edit', $systemSetting->id ) }}" class="btn btn-primary" title="{{ trans('system_settings.edit') }}">
                                            <span class="fas fa-pencil-alt" aria-hidden="true"></span>
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

        @endif

    </div>
@endsection
