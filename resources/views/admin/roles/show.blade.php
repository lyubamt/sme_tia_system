@extends('layouts.master_clidata')

@section('title')
{{$role->name}}
@endsection

@section('content')

<div class="card">

  <!-- card-header -->
  <div class="card-header">

    <div class="d-flex align-items-center">

      <h4><i class="fas fa-key"></i>&nbsp;{{$role->name}}</h4>

      <div class="ml-auto">

          <form method="POST" action="{!! route('admin.role.destroy', $role->id) !!}" accept-charset="UTF-8">
              <input name="_method" value="DELETE" type="hidden">
              {{ csrf_field() }}

                <div class="btn-group btn-group-sm" role="group">

                   <a href="{{ route('admin.role.index') }}" class="btn btn-primary" title="{{ trans('roles.show_all') }}">
                      <span class="fa fa-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('admin.role.create') }}" class="btn btn-success" title="{{ trans('roles.create') }}">
                        <span class="fa fa-plus" aria-hidden="true"></span>
                    </a>

                </div>

            </form>

          </div>
          <!-- /.ml-auto -->

      </div>

  </div>
  <!-- card-header -->

  <!-- card-body-->
  <div class="card-body">

        <dl class="dl-holizontal">

            <dt>{{ trans('roles.name') }}</dt>
            <dd>{{ $role->name }}</dd>
            <dt>{{ trans('roles.guard_name') }}</dt>
            <dd>{{ $role->guard_name }}</dd>
            <dt>{{ trans('roles.created_at') }}</dt>
            <dd>{{ $role->created_at }}</dd>
            <dt>{{ trans('roles.updated_at') }}</dt>
            <dd>{{ $role->updated_at }}</dd>

        </dl>

    </diV>
    <!-- card-body-->

</div>
<!-- card -->

@endsection
