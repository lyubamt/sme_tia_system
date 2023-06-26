@extends('layouts.master_clidata')

@extends('layouts.master_clidata')

@section('title')
Edit {{$user->name}} (User)
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
               <!-- message-->
                @if(Session::has('success_message'))
                    <div class="alert alert-success">
                        <span class="fa fa-ok"></span>
                        {!! session('success_message') !!}

                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                @endif


        <div class="card card-default">

                <!-- card-header -->
                <div class="card-header">

                    <div class="d-flex align-items-center">
                        <h4><i class="far fa-user" style="color: black;"></i>&nbsp;{{$user->name}}</h4>
                        <div class="ml-auto">
                           <a href="{{ route('admin.user.index') }}" class="btn btn-primary" title="{{ trans('users.show_all') }}">
                                <span class="fa fa-th-list" aria-hidden="true"></span>
                            </a>

                            <a href="{{ route('admin.user.create') }}" class="btn btn-success" title="{{ trans('users.create') }}">
                                <span class="fa fa-plus" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                    </div>
                    <!-- end card-header -->

                        <!-- card body-->
                        <div class="card-body">

                                         @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }} <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button></li>

                    @endforeach
                </ul>
            @endif
                                    <form method="POST" action="{{ route('admin.user.update', $user->id) }}" id="edit_user_form" name="edit_user_form" accept-charset="UTF-8" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="PUT">
                                    @include ('admin.users.form', [
                                                                'user' => $user,
                                                                'roles'=>$roles,
                                                                'password_required'=>'false',
                                                            ])

                                        <div class="form-group">
                                            <div class="col-md-offset-2 col-md-10">
                                                <input class="btn btn-primary" type="submit" value="{{ trans('users.update') }}">
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
