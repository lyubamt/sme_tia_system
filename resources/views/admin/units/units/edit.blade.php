@extends('layouts.master_clidata')

@section('title')
{{ !empty($unit->name) ? $unit->name : 'Unit' }}
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ !empty($unit->name) ? $unit->name : 'Unit' }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('admin.units.unit.index') }}" class="btn btn-primary" title="{{ trans('units.show_all') }}">
                    <span class="fas fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('admin.units.unit.create') }}" class="btn btn-success" title="{{ trans('units.create') }}">
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

            <form method="POST" action="{{ route('admin.units.unit.update', $unit->id) }}" id="edit_unit_form" name="edit_unit_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.units.units.form', [
                                        'unit' => $unit,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('units.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
