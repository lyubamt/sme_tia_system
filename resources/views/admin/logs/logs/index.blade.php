@extends('layouts.master_clidata')

@section('title')
Activity Logs
@endsection

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fas fa-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left"><i class="fas fa-history" style="color: black;"></i>&nbsp;Activity Logs</h4>

            <div class="btn-group btn-group-sm float-right" role="group"></div>

        </div>

        @if(count($logs) == 0)
            <div class="card-body text-center">
                <h4>{{ trans('logs.none_available') }}</h4>
            </div>
        @else
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Content</th>
                            <th>User</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                      $index = 0;
                    @endphp
                    @foreach($logs as $log)
                        <tr>
                            <td>{{++$index}}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ optional($log->user)->name }}</td>
                            <td>

                                <form method="POST" action="{!! route('admin.logs.log.destroy', $log->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('admin.logs.log.show', $log->id ) }}" class="btn btn-info" title="Show Actvity Log">
                                            <span class="fas fa-eye" aria-hidden="true"></span>
                                        </a>

                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="card-footer">
            {!! $logs->render() !!}
        </div>

        @endif

    </div>
@endsection
