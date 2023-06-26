@extends('layouts.master_clidata')

@section('title')
{{ !empty($business->name) ? $business->name : 'Business' }}
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ !empty($business->name) ? $business->name : 'Business' }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('admin.businesses.business.index') }}" class="btn btn-primary" title="Show all businesses">
                    <span class="fas fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('admin.businesses.business.create') }}" class="btn btn-success" title="Add business">
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

            <form method="POST" action="{{ route('admin.businesses.business.update', $business->id) }}" id="edit_business_form" name="edit_business_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.businesses.businesses.form', [
                                        'business' => $business,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Update">
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
