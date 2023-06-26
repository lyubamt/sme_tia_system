@extends('layouts.master_clidata')

@section('title')
Add Item
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">Add Item</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.items.item.index') }}" class="btn btn-primary" title="Show all items">
                    <span class="fas fa-th-list" aria-hidden="true"></span>
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

            <form method="POST" action="{{ route('admin.items.item.store') }}" accept-charset="UTF-8" id="create_item_form" name="create_item_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.items.items.form', [
                                        'item' => null,
                                      ])

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <input class="btn btn-primary" type="submit" value="Add">
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
