@extends('layouts.master_clidata')

@section('title')
Roles
@endsection

@section('content')

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
  <!-- end of message-->

  <div class="card">
    <!-- card-header -->
    <div class="card-header">

        <div class="d-flex align-items-center">
            <h4><i class="fas fa-key" style="color: black;"></i> {{ trans('roles.model_plural') }} ({{count($roles)}})</h4>
            <div class="ml-auto">
              <a href="{{ route('admin.role.create') }}" class="btn btn-success" title="{{ trans('roles.create') }}">
                <i class="fas fa-plus" aria-hidden="true"></i>
              </a>
            </div>
        </div>
  </div>
  <!-- end card-header -->

  @if(count($roles) == 0)
    <div class="card-body text-center">
        <h4>{{ trans('roles.none_available') }}</h4>
    </div>
  @else

    <!-- card body-->
    <div class="card-body">

      <div class="table-responsive">

        <table class="table table-striped">
          <thead>
              <tr>
                  <th>{{ trans('roles.name') }}</th>
                  <th>{{ trans('roles.guard_name') }}</th>
                  <th class="text-right">Action</th>
              </tr>
          </thead>
          <tbody>
          @foreach($roles as $role)

            <tr>

              <td>{{ $role->name }}</td>
              <td>{{ $role->guard_name }}</td>

              <td>

                <form method="POST" action="{!! route('admin.role.destroy', $role->id) !!}" accept-charset="UTF-8">

                  <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}

                    <div class="btn-group btn-group-xs float-right" role="group">
                      <a href="{{ route('admin.role.show', $role->id ) }}" class="btn btn-info btn-sm" title="{{ trans('roles.show') }}">
                          <span class="fa fa-eye" aria-hidden="true"></span>
                      </a>

                    </div>

                  </form>

                </td>

              </tr>
          @endforeach
          </tbody>
        </table>

      </div>
      <!-- /.table-responsive -->

  </div>
  <!-- card body-->

  @endif

</div>
<!-- card -->

@endsection
