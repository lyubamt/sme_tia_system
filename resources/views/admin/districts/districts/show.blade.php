@extends('layouts.master_clidata')

@section('title')
{{ isset($district->name) ? $district->name : 'District' }}
@endsection

@section('content')

<div class="card">
    <div class="card-header">

        <h4 class="my-1 float-left">{{ isset($district->name) ? $district->name : 'District' }}</h4>

        <div class="float-right">

            <form method="POST" action="{!! route('admin.districts.district.destroy', $district->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.districts.district.index') }}" class="btn btn-primary" title="{{ trans('districts.show_all') }}">
                        <span class="fas fa-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.districts.district.create') }}" class="btn btn-success" title="{{ trans('districts.create') }}">
                        <span class="fas fa-plus" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.districts.district.edit', $district->id ) }}" class="btn btn-primary" title="{{ trans('districts.edit') }}">
                        <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('districts.delete') }}" onclick="return confirm(&quot;{{ trans('districts.confirm_delete') }}?&quot;)">
                        <span class="fas fa-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('districts.region_id') }}</dt>
            <dd>{{ optional($district->region)->name }}</dd>
            <dt>{{ trans('districts.name') }}</dt>
            <dd>{{ $district->name }}</dd>
            <dt>{{ trans('districts.description') }}</dt>
            <dd>{{ $district->description }}</dd>
            <!-- <dt>{{ trans('districts.status') }}</dt>
            <dd>{{ ($district->status) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('districts.is_deleted') }}</dt>
            <dd>{{ ($district->is_deleted) ? 'Yes' : 'No' }}</dd> -->
            <dt>{{ trans('districts.created_at') }}</dt>
            <dd>{{ $district->created_at }}</dd>
            <dt>{{ trans('districts.updated_at') }}</dt>
            <dd>{{ $district->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection
