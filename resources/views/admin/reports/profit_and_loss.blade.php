@extends('layouts.master_clidata')

@section('title')
Profit & Loss
@endsection

@section("css")

<style>
.report-wrapper{
  margin: 2%;
  padding: 2%;
  border: 3px solid black;
}
.inner-item{
  padding-left: 2%;
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

            <h4 class="my-1 float-left">Profit & Loss</h4>

            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="#" class="btn btn-warning" title="Download PDFs">
                    <span class="fas fa-file-pdf" aria-hidden="true"></span>
                </a>
            </div>

        </div>

        <div class="card-body">

          <div class="report-wrapper text-center">

            <h4>Statement of profit or loss</h4>

            <table class="text-left" width="100%" border="0">

              <tr>
                <td>
                  <h5>Sales</h5>
                </td>
                <td></td>
                <td>
                  <h5>XX</h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5>COGS</h5>
                </td>
                <td></td>
                <td>
                  <h5>XX</h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Opening Stock</h5>
                </td>
                <td>XX</td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Opening Stock</h5>
                </td>
                <td>XX</td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Opening Stock</h5>
                </td>
                <td>(XX)</td>
                <td>
                  <h5></h5>
                </td>
              </tr>

            </table>

          </div>

        </div>

    </div>
@endsection