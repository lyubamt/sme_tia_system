@extends('layouts.master_clidata')

@section('title')
{{ isset($basin->name) ? $basin->name : 'Basin' }}
@endsection

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="my-1 float-left">{{ isset($basin->name) ? $basin->name : 'Basin' }}</h4>

        <div class="float-right">

            <form method="POST" action="{!! route('admin.basins.basin.destroy', $basin->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.basins.basin.index') }}" class="btn btn-primary" title="{{ trans('basins.show_all') }}">
                        <span class="fas fa-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.basins.basin.create') }}" class="btn btn-success" title="{{ trans('basins.create') }}">
                        <span class="fas fa-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.basins.basin.edit', $basin->id ) }}" class="btn btn-primary" title="{{ trans('basins.edit') }}">
                        <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('basins.delete') }}" onclick="return confirm(&quot;{{ trans('basins.confirm_delete') }}?&quot;)">
                        <span class="fas fa-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('basins.name') }}</dt>
            <dd>{{ $basin->name }}</dd>
            <dt>{{ trans('basins.description') }}</dt>
            <dd>{{ $basin->description }}</dd>
            <dt>{{ trans('basins.hydro_DTB') }}</dt>
            <dd>{{ $basin->hydro_DTB }}</dd>
            <dt>CHP ID</dt>
            <dd>{{ optional($basin)->CHP_ID }}</dd>
            <dt>{{ trans('basins.basin_area') }}</dt>
            <dd>{{ $basin->basin_area }}KM<sup>2</sup> &nbsp;({{ $basin->basin_area_percentage }}%)</dd>
            <dt>{{ trans('basins.river_id') }}</dt>
            <dd>{{ optional($basin->river)->name }}</dd>
            <!-- <dt>{{ trans('basins.status') }}</dt>
            <dd>{{ ($basin->status) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('basins.is_deleted') }}</dt>
            <dd>{{ ($basin->is_deleted) ? 'Yes' : 'No' }}</dd> -->
            <dt>{{ trans('basins.created_at') }}</dt>
            <dd>{{ $basin->created_at }}</dd>
            <dt>{{ trans('basins.updated_at') }}</dt>
            <dd>{{ $basin->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection
