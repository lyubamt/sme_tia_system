@extends('layouts.master_clidata')

@section('title')
Regions
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

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ trans('regions.model_plural') }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.regions.region.create') }}" class="btn btn-success" title="{{ trans('regions.create') }}">
                    <span class="fas fa-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($regions) == 0)
            <div class="card-body text-center">
                <h4>{{ trans('regions.none_available') }}</h4>
            </div>
        @else
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>{{ trans('regions.name') }}</th>
                            <th>Description</th>
                            <th>{{ trans('regions.country_id') }}</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @php

                        $index = 0;

                      @endphp
                    @foreach($regions as $region)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $region->name }}</td>
                            <td>{{ $region->description }}</td>
                            <td>{{ optional($region->country)->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('admin.regions.region.destroy', $region->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('admin.regions.region.show', $region->id ) }}" class="btn btn-info" title="{{ trans('regions.show') }}">
                                            <span class="fas fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('admin.regions.region.edit', $region->id ) }}" class="btn btn-primary" title="{{ trans('regions.edit') }}">
                                            <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('regions.delete') }}" onclick="return confirm(&quot;{{ trans('regions.confirm_delete') }}&quot;)">
                                            <span class="fas fa-trash" aria-hidden="true"></span>
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

        <div class="card-footer">
            {!! $regions->render() !!}
        </div>

        @endif

    </div>
@endsection
