@extends('layouts.master_clidata')

@section('title')
Units
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ trans('units.create') }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.units.unit.index') }}" class="btn btn-primary" title="{{ trans('units.show_all') }}">
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

            <form method="POST" action="{{ route('admin.units.unit.store') }}" accept-charset="UTF-8" id="create_unit_form" name="create_unit_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.units.units.form', [
                                        'unit' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('units.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
