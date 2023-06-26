@extends('layouts.master_clidata')

@section('title')
{{ isset($unit->name) ? $unit->name : 'Unit' }}
@endsection

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="my-1 float-left">{{ isset($unit->name) ? $unit->name : 'Unit' }}</h4>

        <div class="float-right">

            <form method="POST" action="{!! route('admin.units.unit.destroy', $unit->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.units.unit.index') }}" class="btn btn-primary" title="{{ trans('units.show_all') }}">
                        <span class="fas fa-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.units.unit.create') }}" class="btn btn-success" title="{{ trans('units.create') }}">
                        <span class="fas fa-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.units.unit.edit', $unit->id ) }}" class="btn btn-primary" title="{{ trans('units.edit') }}">
                        <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('units.delete') }}" onclick="return confirm(&quot;{{ trans('units.confirm_delete') }}?&quot;)">
                        <span class="fas fa-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('units.name') }}</dt>
            <dd>{{ $unit->name }}</dd>
            <dt>{{ trans('units.description') }}</dt>
            <dd>{{ $unit->description }}</dd>
            <dt>Symbol</dt>
            <dd>{{ $unit->symbol }}</dd>
            <!-- <dt>{{ trans('units.status') }}</dt>
            <dd>{{ ($unit->status) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('units.is_deleted') }}</dt>
            <dd>{{ ($unit->is_deleted) ? 'Yes' : 'No' }}</dd> -->
            <dt>{{ trans('units.created_at') }}</dt>
            <dd>{{ $unit->created_at }}</dd>
            <dt>{{ trans('units.updated_at') }}</dt>
            <dd>{{ $unit->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection
