@extends('layouts.master_clidata')

@section('title')
Districts
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ trans('districts.create') }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.districts.district.index') }}" class="btn btn-primary" title="{{ trans('districts.show_all') }}">
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

            <form method="POST" action="{{ route('admin.districts.district.store') }}" accept-charset="UTF-8" id="create_district_form" name="create_district_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.districts.districts.form', [
                                        'district' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('districts.add') }}">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
