@extends('layouts.master_clidata')

@section('title')
Items
@endsection

@section("css")

<style>
    .mid-sized-column{
        width: 30%;
    }
</style>

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

            <h4 class="my-1 float-left">Items</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.items.item.create') }}" class="btn btn-success" title="Add Item">
                    <span class="fas fa-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($items) == 0)
            <div class="card-body text-center">
                <h4>No Items Available</h4>
            </div>
        @else
        <div class="card-body">

            <table class="table table-bordered table-responsive" id="data-table">
                <thead>
                    <tr>

                        <th>SN</th>
                        <th>Name</th>
                        <th class="mid-sized-column">Description</th>
                        <th>Is Asset</th>
                        <th>Is Liability</th>
                        <th>Is Capital</th>
                        <th>Is Purchase</th>
                        <th>Is Sale</th>
                        <th>Is Expense</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php

                    $index = 0;

                    @endphp
                @foreach($items as $item)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ ($item->is_asset == 1)?'Yes':'No' }}</td>
                        <td>{{ ($item->is_liability == 1)?'Yes':'No' }}</td>
                        <td>{{ ($item->is_capital == 1)?'Yes':'No' }}</td>
                        <td>{{ ($item->is_purchase == 1)?'Yes':'No' }}</td>
                        <td>{{ ($item->is_sale == 1)?'Yes':'No' }}</td>
                        <td>{{ ($item->is_expense == 1)?'Yes':'No' }}</td>

                        <td>

                            <form method="POST" action="{!! route('admin.items.item.destroy', $item->id) !!}" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            {{ csrf_field() }}

                                <div class="btn-group btn-group-xs float-right" role="group">
                                    <!-- <a href="{{ route('admin.items.item.show', $item->id ) }}" class="btn btn-info" title="Show all items">
                                        <span class="fas fa-eye" aria-hidden="true"></span>
                                    </a> -->
                                    <a href="{{ route('admin.items.item.edit', $item->id ) }}" class="btn btn-primary" title="Edit item">
                                        <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                                    </a>

                                    <button type="submit" class="btn btn-danger" title="Delete item" onclick="return confirm(&quot;Do you want to delete this item?&quot;)">
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

        @endif

    </div>
@endsection
