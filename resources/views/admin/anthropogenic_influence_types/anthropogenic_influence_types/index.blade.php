@extends('layouts.master')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">{{ trans('anthropogenic_influence_types.model_plural') }}</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('admin.anthropogenic_influence_types.anthropogenic_influence_type.create') }}" class="btn btn-success" title="{{ trans('anthropogenic_influence_types.create') }}">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($anthropogenicInfluenceTypes) == 0)
            <div class="panel-body text-center">
                <h4>{{ trans('anthropogenic_influence_types.none_available') }}</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>{{ trans('anthropogenic_influence_types.name') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($anthropogenicInfluenceTypes as $anthropogenicInfluenceType)
                        <tr>
                            <td>{{ $anthropogenicInfluenceType->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('admin.anthropogenic_influence_types.anthropogenic_influence_type.destroy', $anthropogenicInfluenceType->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('admin.anthropogenic_influence_types.anthropogenic_influence_type.show', $anthropogenicInfluenceType->id ) }}" class="btn btn-info" title="{{ trans('anthropogenic_influence_types.show') }}">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('admin.anthropogenic_influence_types.anthropogenic_influence_type.edit', $anthropogenicInfluenceType->id ) }}" class="btn btn-primary" title="{{ trans('anthropogenic_influence_types.edit') }}">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('anthropogenic_influence_types.delete') }}" onclick="return confirm(&quot;{{ trans('anthropogenic_influence_types.confirm_delete') }}&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $anthropogenicInfluenceTypes->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection