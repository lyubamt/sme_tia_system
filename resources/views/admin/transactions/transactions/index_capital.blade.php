@extends('layouts.master_clidata')

@section('title')
Capital
@endsection

@section("css")

<style>
    ul, #categories-tree {
  list-style-type: none;
}

#categories-tree {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  margin-left: 30px;
  display: none;
}

.active {
  display: block;
}
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

            <h4 class="my-1 float-left">Capital</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.capitals.capital.create') }}" class="btn btn-success" title="Add capital">
                    <span class="fas fa-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($transactions) == 0)
            <div class="card-body text-center">
                <h4>No Capitals Available</h4>
            </div>
        @else
        <div class="card-body">

          <table class="table table-bordered table-responsive" id="data-table" width="100%">
            <thead>
                <tr>

                    <th>SN</th>
                    <th>Business</th>
                    <th class="mid-sized-column">Name</th>
                    <th>Unit</th>
                    <th>Value</th>
                    <th>Quantity</th>
                    <th>Total Value</th>
                    <th class="mid-sized-column">Description</th>
                    <th>Type</th>
                    <th>Category</th>
                    <th>Business Owner</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
              @php

                $index = 0;

              @endphp
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ optional($transaction->business)->name }}</td>
                    <td>{{ optional($transaction->item)->name }}</td>
                    <td>{{ optional($transaction->unit)->name }}</td>
                    <td>{{ number_format($transaction->value,) }}</td>
                    <td>{{ $transaction->quantity }}</td>
                    <td>{{ number_format($transaction->value * $transaction->quantity,2) }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ optional($transaction->transactionType)->name }}</td>
                    <td>{{ optional($transaction->transactionCategory)->name }}</td>
                    <td>{{ optional($transaction->user)->name }}</td>

                    <td>

                        <form method="POST" action="{!! route('admin.transactions.transaction.destroy', $transaction->id) !!}" accept-charset="UTF-8">
                        <input name="_method" value="DELETE" type="hidden">
                        {{ csrf_field() }}

                            <div class="btn-group btn-group-xs float-right" role="group">
                        
                                <a href="{{ route('admin.transactions.transaction.edit', $transaction->id ) }}" class="btn btn-primary" title="Edit Capital">
                                    <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                                </a>

                                <button type="submit" class="btn btn-danger" title="Delete Capital" onclick="return confirm(&quot;Do you want to delete this Capital?&quot;)">
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

@section("js")

<script>

    $(document).ready(function () {

        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
            this.parentElement.querySelector(".nested").classList.toggle("active");
            this.classList.toggle("caret-down");
        });
        }

    });

</script>

@endsection