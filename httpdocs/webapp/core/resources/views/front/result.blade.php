@extends('front.layouts.master')
@section('content')
<section class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumb-content">
          <h5>Search Result</h5>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="clearfix"></div>
<div class="clearfix"></div>

<div class="panel panel-info">
  <div class="panel-body">
    <div class="panel panel-primary">
      <div class="panel-body">
        <table class="table table-responsive">
          <thead>
            <tr>

              <th>
                Transaction ID
              </th>
              <th>
                Wallet ID
              </th>
              <th>
                Amount
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($logs as $log)
            <tr>
              <td>
                {{$log->trxid }}
              </td>
              <td>
                {{$log->toacc }}
              </td>
              <td>
                <button class="btn {{$log->status == '1' ? 'btn-success' : 'btn-danger'}}">
                  {{number_format(floatval($log->amount), $gset->decimalPoint, '.', '')}}
                </button>   
              </td>

            </tr>
            @endforeach    
          </tbody>
        </table>

      </div>
    </div>

  </div>

</div>


@endsection


