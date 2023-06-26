@extends('layouts.master_clidata')

@section('title')
Create New Role
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-default">

                <!-- card-header -->
                <div class="card-header">
                <div class="d-flex align-items-center">
                        <h3><i class="fa fa-user"></i>Add New {{ !empty($role->name) ? $role->name : 'Role' }}</h3>
                        <div class="ml-auto">
                        <a href="{{ route('admin.role.index') }}" class="btn btn-primary" title="{{ trans('roles.show_all') }}">
                                <span class="fa fa-th-list" aria-hidden="true"></span>
                            </a>

                        </div>
                    </div>
                    </div>
                    <!-- end card-header -->


                <div class="card-body">

                    @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ route('admin.role.store') }}" accept-charset="UTF-8" id="create_role_form" name="create_role_form" class="form-horizontal">
                        {{ csrf_field() }}
                        @include ('admin.roles.form', [
                                                    'role' => null,
                                                    ])

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <input class="btn btn-primary" type="submit" value="{{ trans('roles.add') }}">
                                </div>
                            </div>

                        </form>
                        </div>
            <!-- end card body-->
            </div>
                <!-- card -->
            </div>
            <!-- col -->
        </div>
        <!-- row -->

     @endsection
