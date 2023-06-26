@extends('layouts.master_clidata')

@section('title')
(Show Activity Log) {{ $log->description }}
@endsection

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="my-1 float-left"><i class="fas fa-history" style="color: black;"></i>&nbsp;{{ $log->description }}</h4>

        <div class="float-right">

            <form method="POST" action="{!! route('admin.logs.log.destroy', $log->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.logs.log.index') }}" class="btn btn-primary" title="Show All Actvity Logs">
                        <span class="fas fa-th-list" aria-hidden="true"></span>
                    </a>

                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('logs.description') }}</dt>
            <dd>{{ $log->description }}</dd>
            <dt>{{ trans('logs.user_id') }}</dt>
            <dd>{{ optional($log->user)->name }}</dd>
            <dt>{{ trans('logs.created_at') }}</dt>
            <dd>{{ $log->created_at }}</dd>
            <dt>{{ trans('logs.updated_at') }}</dt>
            <dd>{{ $log->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection
