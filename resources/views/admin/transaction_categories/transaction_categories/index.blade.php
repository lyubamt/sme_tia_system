@extends('layouts.master_clidata')

@section('title')
Transaction Categories
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

            <h4 class="my-1 float-left">Transaction Categories</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.transaction_categories.transaction_category.create') }}" class="btn btn-success" title="Add transaction category">
                    <span class="fas fa-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        @if(count($transaction_categories) == 0)
            <div class="card-body text-center">
                <h4>No Transaction Categories Available</h4>
            </div>
        @else
        <div class="card-body table-responsive">

            {!! $treeView !!}

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