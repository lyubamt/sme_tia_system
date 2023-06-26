@extends('layouts.master_clidata')

@section('title')
Regions
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ trans('regions.create') }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.regions.region.index') }}" class="btn btn-primary" title="{{ trans('regions.show_all') }}">
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

            <form method="POST" action="{{ route('admin.regions.region.store') }}" accept-charset="UTF-8" id="create_region_form" name="create_region_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.regions.regions.form', [
                                        'region' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('regions.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
