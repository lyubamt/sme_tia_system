@extends('layouts.master_clidata')

@section('title')
Add New User
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
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
        <h4>Add New {{ !empty($user->name) ? $user->name : 'User' }}</h4>
                <div class="ml-auto">
                <a href="{{ route('admin.user.index') }}" class="btn btn-primary pull-right" title="{{ trans('users.show_all') }}">
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

        <form method="POST" action="{{ route('admin.user.store') }}" accept-charset="UTF-8" id="create_user_form" name="create_user_form" class="form-horizontal">
        {{ csrf_field() }}
        @include ('admin.users.form', [
                                    'user' => null,
                                    'roles'=>$roles,
                                    'password_required'=>'true',
                                    ])

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <input class="btn btn-primary" type="submit" value="{{ trans('users.add') }}">
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

     @section('js')

 <script>

     setTimeout(function() {
          $(".phone_no").text(function(i, text) {
        text = text.replace(/(\d{1})(\d{3})(\d{3})(\d{3})/, "+$1 ($2)-$3-$4");
        return text;
    });
    }, 5000);

 </script>

     @endsection
