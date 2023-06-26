@extends('layouts.master_clidata')

@section('title')
Units
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

            <h4 class="my-1 float-left">{{ trans('units.model_plural') }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.units.unit.create') }}" class="btn btn-success" title="{{ trans('units.create') }}">
                    <span class="fas fa-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($units) == 0)
            <div class="card-body text-center">
                <h4>{{ trans('units.none_available') }}</h4>
            </div>
        @else
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>

                            <th>SN</th>
                            <th>{{ trans('units.name') }}</th>
                            <th>Description</th>
                            <th>Symbol</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @php

                        $index = 0;

                      @endphp
                    @foreach($units as $unit)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->description }}</td>
                            <td>{{ $unit->symbol }}</td>

                            <td>

                                <form method="POST" action="{!! route('admin.units.unit.destroy', $unit->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('admin.units.unit.show', $unit->id ) }}" class="btn btn-info" title="{{ trans('units.show') }}">
                                            <span class="fas fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('admin.units.unit.edit', $unit->id ) }}" class="btn btn-primary" title="{{ trans('units.edit') }}">
                                            <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="{{ trans('units.delete') }}" onclick="return confirm(&quot;{{ trans('units.confirm_delete') }}&quot;)">
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
            {!! $units->render() !!}
        </div>

        @endif

    </div>
@endsection
