@extends('layouts.master_clidata')

@section('title')
{{ isset($basin->name) ? $basin->name : 'Basin' }}
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ !empty($basin->name) ? $basin->name : 'Basin' }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('admin.basins.basin.index') }}" class="btn btn-primary" title="{{ trans('basins.show_all') }}">
                    <span class="fas fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('admin.basins.basin.create') }}" class="btn btn-success" title="{{ trans('basins.create') }}">
                    <span class="fas fa-plus" aria-hidden="true"></span>
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

            <form method="POST" action="{{ route('admin.basins.basin.update', $basin->id) }}" id="edit_basin_form" name="edit_basin_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.basins.basins.form', [
                                        'basin' => $basin,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('basins.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
