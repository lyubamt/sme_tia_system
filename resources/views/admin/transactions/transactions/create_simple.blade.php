@extends('layouts.master_clidata')

@section('title')
{{ $transactionAction }}
@endsection

@section("css")

<style>
    .sub-parent-id{
        display: inline;
        width: 95%;
    }
    .sub-parent-btn-group{
        display: inline;
        width: 5%;
        padding-left: 10px;
    }

</style>

@endsection

@section('content')

    <div class="card">

        <div class="card-header">

            <h4 class="my-1 float-left">{{ $transactionAction }}</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('admin.transactions.transaction.index') }}" class="btn btn-primary" title="Show all transactions">
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

            <form method="POST" action="{{ route('admin.transactions.transaction.store') }}" accept-charset="UTF-8" enctype="multipart/form-data" id="create_transaction_form" name="create_transaction_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('admin.transactions.transactions.form_simple', [
                                        'transaction' => null,
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

@section("js")

<script>

    $(document).ready(function () {

        $(document).on("change","#transaction_type_id", function () {

            $("#parent_category_1").nextAll('.another-category-div').remove();

            $.ajax({
                'url':'{{ route("admin.transaction_categories.transaction_category.get_transaction_categories_from_type") }}',
                'method':'POST',
                'data':{
                    _token:$('meta[name="csrf-token"]').attr('content'),
                    'transaction_type_id':$("#transaction_type_id").val()
                },
                success:function (response) {

                    if (response.success == 1) {

                        let data = response.data;
                        if (data.categories_options == "") {

                            $("#parent_id").html('<option value="0">None</option>');

                        }else{


                            $("#parent_id").html('<option value="" style="display: none;" disabled selected>Select parent category</option>' + data.categories_options);

                            $("#item_id").html('<option value="" style="display: none;" disabled selected>Select entry item</option>' + data.items_options);

                        }
                        
                    } else {

                        $("#parent_id").html('<option value="0">None</option>');
                        
                    }
                   
                },
                error:function (response) {
                    // console.log(response);
                }
            });
            
        });

        $(document).on("change",".parent_id", function () {

            let __this = $(this);

            $.ajax({
                'url':'{{ route("admin.transaction_categories.transaction_category.get_transaction_categories_from_category") }}',
                'method':'POST',
                'data':{
                    _token:$('meta[name="csrf-token"]').attr('content'),
                    'transaction_category_id':__this.val()
                },
                success:function (response) {

                    if (response.success == 1) {

                        let data = response.data;
                        if (data.categories_options == "") {

                            __this.parent().nextAll('.another-category-div').remove();

                        }else{

                            __this.parent().nextAll('.another-category-div').remove();

                            let parentCategoryId = __this.parent().attr("id");
                            let parentCategoryIdParts = parentCategoryId.split("parent_category_");
                            var parentCategoryIdIndex = parentCategoryIdParts[1];
                            let categorySelection = '<div id="parent_category_' + ++parentCategoryIdIndex + '" class="form-group col-md-12 text-left another-category-div"><h5>Choose another category</h5><select class="form-control sub-parent-id parent_id" name="sub_parent_id[]" required="true" ><option value="" style="display: none;" disabled selected>Select parent category</option>' + data.categories_options + '</select><div class="btn-group-xs float-right sub-parent-btn-group"><a class="btn btn-warning remove-sub-parent-category-button"><i class="fas fa-times"></i></div></div></div>';
                      
                            $(categorySelection).insertAfter("#" + parentCategoryId);

                        }
                        
                    } else {

                        __this.parent().nextAll('.another-category-div').remove();
                        
                    }
                
                },
                error:function (response) {
                    __this.parent().nextAll('.another-category-div').remove();
                }
            });

        });

        $(document).on("click",".remove-sub-parent-category-button", function () {

            let parentCategoryId = $(this).parent().parent().attr("id");
            $("#" + parentCategoryId).nextAll('.another-category-div').remove();
            $(this).parent().parent().remove();

        });

    });

</script>

@endsection