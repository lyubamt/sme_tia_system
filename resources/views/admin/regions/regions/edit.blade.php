@extends('layouts.master_clidata')

@section('title')
{{ isset($region->name) ? $region->name : 'Region' }}
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ !empty($region->name) ? $region->name : 'Region' }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('admin.regions.region.index') }}" class="btn btn-primary" title="{{ trans('regions.show_all') }}">
                    <span class="fas fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('admin.regions.region.create') }}" class="btn btn-success" title="{{ trans('regions.create') }}">
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

            <form method="POST" action="{{ route('admin.regions.region.update', $region->id) }}" id="edit_region_form" name="edit_region_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.regions.regions.form', [
                                        'region' => $region,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('regions.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
