@extends('layouts.master_clidata')

@section('title')
{{ isset($district->name) ? $district->name : 'District' }}
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ !empty($district->name) ? $district->name : 'District' }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('admin.districts.district.index') }}" class="btn btn-primary" title="{{ trans('districts.show_all') }}">
                    <span class="fas fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('admin.districts.district.create') }}" class="btn btn-success" title="{{ trans('districts.create') }}">
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

            <form method="POST" action="{{ route('admin.districts.district.update', $district->id) }}" id="edit_district_form" name="edit_district_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.districts.districts.form', [
                                        'district' => $district,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="{{ trans('districts.update') }}">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
