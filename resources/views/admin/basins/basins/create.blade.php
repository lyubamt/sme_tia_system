@extends('layouts.master_clidata')

@section('title')
Basins
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ trans('basins.create') }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.basins.basin.index') }}" class="btn btn-primary" title="{{ trans('basins.show_all') }}">
                    <span class="fas fa-th-list" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        <div class="card-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('admin.basins.basin.store') }}" accept-charset="UTF-8" id="create_basin_form" name="create_basin_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.basins.basins.form', [
                                        'basin' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('basins.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
