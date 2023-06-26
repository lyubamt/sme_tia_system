@extends('layouts.master')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($anthropogenicInfluenceType->name) ? $anthropogenicInfluenceType->name : 'Anthropogenic Influence Type' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('admin.anthropogenic_influence_types.anthropogenic_influence_type.destroy', $anthropogenicInfluenceType->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('admin.anthropogenic_influence_types.anthropogenic_influence_type.index') }}" class="btn btn-primary" title="{{ trans('anthropogenic_influence_types.show_all') }}">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.anthropogenic_influence_types.anthropogenic_influence_type.create') }}" class="btn btn-success" title="{{ trans('anthropogenic_influence_types.create') }}">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('admin.anthropogenic_influence_types.anthropogenic_influence_type.edit', $anthropogenicInfluenceType->id ) }}" class="btn btn-primary" title="{{ trans('anthropogenic_influence_types.edit') }}">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{ trans('anthropogenic_influence_types.delete') }}" onclick="return confirm(&quot;{{ trans('anthropogenic_influence_types.confirm_delete') }}?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>{{ trans('anthropogenic_influence_types.name') }}</dt>
            <dd>{{ $anthropogenicInfluenceType->name }}</dd>
            <dt>{{ trans('anthropogenic_influence_types.description') }}</dt>
            <dd>{{ $anthropogenicInfluenceType->description }}</dd>
            <dt>{{ trans('anthropogenic_influence_types.status') }}</dt>
            <dd>{{ ($anthropogenicInfluenceType->status) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('anthropogenic_influence_types.is_deleted') }}</dt>
            <dd>{{ ($anthropogenicInfluenceType->is_deleted) ? 'Yes' : 'No' }}</dd>
            <dt>{{ trans('anthropogenic_influence_types.created_at') }}</dt>
            <dd>{{ $anthropogenicInfluenceType->created_at }}</dd>
            <dt>{{ trans('anthropogenic_influence_types.updated_at') }}</dt>
            <dd>{{ $anthropogenicInfluenceType->updated_at }}</dd>

        </dl>

    </div>
</div>

@endsection