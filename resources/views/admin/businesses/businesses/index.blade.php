@extends('layouts.master_clidata')

@section('title')
Businesses
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

            <h4 class="my-1 float-left">Businesses</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.businesses.business.create') }}" class="btn btn-success" title="Add new business">
                    <span class="fas fa-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($businesses) == 0)
            <div class="card-body text-center">
                <h4>No Businesses Available</h4>
            </div>
        @else
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>

                            <th>SN</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Website</th>
                            <th>Category</th>
                            <th>Currency</th>
                            <th>Certificate</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @php

                        $index = 0;

                      @endphp
                    @foreach($businesses as $business)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $business->name }}</td>
                            <td>{{ $business->physical_address }}</td>
                            <td>{{ $business->email }}</td>
                            <td>{{ $business->phone }}</td>
                            <td>{{ ($business->website)?$business->website:'NONE' }}</td>
                            <td>{{ optional($business->businessCategory)->name }}</td>
                            <td>{{ optional($business->currency)->name }}</td>
                            <td>

                                @if ($business->certificate)
                                
                                    <a href="{{ route('admin.businesses.business.download_certificate', $business->id ) }}">Download</a>

                                @else

                                    NONE

                                @endif

                            </td>

                            <td>

                                <form method="POST" action="{!! route('admin.businesses.business.destroy', $business->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('admin.businesses.business.show', $business->id ) }}" class="btn btn-info" title="Show business">
                                            <span class="fas fa-eye" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('admin.businesses.business.edit', $business->id ) }}" class="btn btn-primary" title="Edit business">
                                            <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete business" onclick="return confirm(&quot;Do you want to delete this business?&quot;)">
                                            <span class="fas fa-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        @endif

    </div>
@endsection
