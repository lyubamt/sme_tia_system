@extends('layouts.master_clidata')

@section('title')
Basins
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

            <h4 class="my-1 float-left">{{ trans('basins.model_plural') }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.basins.basin.create') }}" class="btn btn-success" title="{{ trans('basins.create') }}">
                    <span class="fas fa-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($basins) == 0)
            <div class="card-body text-center">
                <h4>{{ trans('basins.none_available') }}</h4>
            </div>
        @else
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>{{ trans('basins.name') }}</th>
                            <th>Description</th>
                            <th>Hydro DTB</th>
                            <th>CHP ID</th>
                            <th>Basin Area</th>
                            <th>River</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @php

                        $index = 0;

                      @endphp
                    @foreach($basins as $basin)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $basin->name }}</td>
                            <td>{{ $basin->description }}</td>
                            <td>{{ $basin->hydro_DTB }}</td>
                            <td>{{ $basin->CHP_ID }}</td>
                            <td>{{ $basin->basin_area }}KM<sup>2</sup> &nbsp;({{ $basin->basin_area_percentage }}%)</td>
                            <td>{{ optional($basin->river)->name }}</td>

                            <td>

                                <form method="POST" action="{!! route('admin.basins.basin.destroy', $basin->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('admin.basins.basin.show', $basin->id ) }}" class="btn btn-info" title="{{ trans('basins.show') }}">
                                            <span class="fas fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('admin.basins.basin.edit', $basin->id ) }}" class="btn btn-primary" title="{{ trans('basins.edit') }}">
                                            <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('basins.delete') }}" onclick="return confirm(&quot;{{ trans('basins.confirm_delete') }}&quot;)">
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
            {!! $basins->render() !!}
        </div>

        @endif

    </div>
@endsection
