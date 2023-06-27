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
                  <h5>1,230</h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5>COGS</h5>
                </td>
                <td></td>
                <td>
                  <h5>1,230</h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Opening Stock</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Purchases</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Closing Stock</h5>
                </td>
                <td>(1,230)</td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td colspan="3">&nbsp;</td>
              </tr>

            </table>
            <br>
            <table class="text-left" width="100%" border="0">

              <tr>
                <td>
                  <h5>Gross Profit</h5>
                </td>
                <td></td>
                <td>
                  <h5>1,230</h5>
                </td>
              </tr>

            </table>
            <br>
            <table class="text-left" width="100%" border="0">

              <tr>
                <td>
                  <h5>Expenses</h5>
                </td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Expense 1</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Expense 2</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Expense 3</h5>
                </td>
                <td><h5>(1,230)</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>(1,230)</h5>
                </td>
              </tr>

              <tr>
                <td><h5>Net Profit</h5></td>
                <td></td>
                <td>
                  <h5>1,230</h5>
                </td>
              </tr>

              <tr>
                <td><h5>ASSETS</h5></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td><h5>Non-Current Asset</h5></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Property Plant and Equipment (PPE)</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Machinery</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td><h5>Current Asset</h5></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Inventory</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Account Receivables</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Cash</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Bank</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5>Total Asset</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td><h5>LIABILITIES</h5></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td><h5>Current Liabilities</h5></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Account Payable (Creditors)</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Bank Overdraft</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td><h5>Non-Current Liabilities</h5></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Long term loan</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5>1,230</h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5>Total Liability</h5>
                </td>
                <td></td>
                <td>
                  <h5>1,230</h5>
                </td>
              </tr>

              <tr>
                <td><h5>CAPITAL</h5></td>
                <td></td>
                <td></td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Equity</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5></h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5 class="inner-item">Retained Earnings</h5>
                </td>
                <td><h5>1,230</h5></td>
                <td>
                  <h5>1,230</h5>
                </td>
              </tr>

              <tr>
                <td>
                  <h5>Total Equity and Retained Earnings</h5>
                </td>
                <td></td>
                <td>
                  <h5>1,230</h5>
                </td>
              </tr>

            </table>

          </div>

        </div>

    </div>
@endsection