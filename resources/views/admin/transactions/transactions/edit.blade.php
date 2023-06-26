@extends('layouts.master_clidata')

@section('title')
{{ !empty($transaction->name) ? $transaction->name : 'Edit Transaction' }}
@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ !empty($transaction->name) ? $transaction->name : 'Edit Transaction' }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('admin.transactions.transaction.index') }}" class="btn btn-primary" title="Show all transactions">
                    <span class="fas fa-th-list" aria-hidden="true"></span>
                </a>

                <a href="{{ route('admin.transactions.transaction.create') }}" class="btn btn-success" title="Add transaction">
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

            <form method="POST" action="{{ route('admin.transactions.transaction.update', $transaction->id) }}" id="edit_transaction_form" name="edit_transaction_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('admin.transactions.transactions.form', [
                                        'transaction' => $transaction,
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
