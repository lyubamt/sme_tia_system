@extends('layouts.master')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($country->name) ? $country->name : 'Country' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('admin.countries.country.destroy', $country->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.countries.country.index') }}" class="btn btn-primary" title="{{ trans('countries.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.countries.country.create') }}" class="btn btn-success" title="{{ trans('countries.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('admin.countries.country.edit', $country->id ) }}" class="btn btn-primary" title="{{ trans('countries.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('countries.delete') }}" onclick="return confirm(&quot;{{ trans('countries.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('countries.name') }}</dt>
            <dd>{{ $country->name }}</dd>
            <dt>{{ trans('countries.description') }}</dt>
            <dd>{{ $country->description }}</dd>
            <dt>{{ trans('countries.status') }}</dt>
            <dd>{{ ($country->status) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('countries.is_deleted') }}</dt>
            <dd>{{ ($country->is_deleted) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('countries.created_at') }}</dt>
            <dd>{{ $country->created_at }}</dd>
            <dt>{{ trans('countries.updated_at') }}</dt>
            <dd>{{ $country->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection