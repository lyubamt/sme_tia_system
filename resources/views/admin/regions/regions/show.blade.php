@extends('layouts.master_clidata')

@section('title')
{{ isset($region->name) ? $region->name : 'Region' }}
@endsection

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="my-1 float-left">{{ isset($region->name) ? $region->name : 'Region' }}</h4>

        <div class="float-right">

            <form method="POST" action="{!! route('admin.regions.region.destroy', $region->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.regions.region.index') }}" class="btn btn-primary" title="{{ trans('regions.show_all') }}">
                        <span class="fas fa-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.regions.region.create') }}" class="btn btn-success" title="{{ trans('regions.create') }}">
                        <span class="fas fa-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.regions.region.edit', $region->id ) }}" class="btn btn-primary" title="{{ trans('regions.edit') }}">
                        <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('regions.delete') }}" onclick="return confirm(&quot;{{ trans('regions.confirm_delete') }}?&quot;)">
                        <span class="fas fa-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('regions.country_id') }}</dt>
            <dd>{{ optional($region->country)->name }}</dd>
            <dt>{{ trans('regions.name') }}</dt>
            <dd>{{ $region->name }}</dd>
            <dt>{{ trans('regions.description') }}</dt>
            <dd>{{ $region->description }}</dd>
            <!-- <dt>{{ trans('regions.status') }}</dt>
            <dd>{{ ($region->status) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('regions.is_deleted') }}</dt>
            <dd>{{ ($region->is_deleted) ? 'Yes' : 'No' }}</dd> -->
            <dt>{{ trans('regions.created_at') }}</dt>
            <dd>{{ $region->created_at }}</dd>
            <dt>{{ trans('regions.updated_at') }}</dt>
            <dd>{{ $region->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection
