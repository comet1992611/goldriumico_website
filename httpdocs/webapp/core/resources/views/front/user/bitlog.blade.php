@extends('front.layouts.admaster')
@section('content')

        <div class="row">
          <div class="panel panel-inverse">
            <div class="panel-heading">
              <h4 class="panel-title">BitCoin Transaction Log</h4>
            </div>
            <div class="panel-body">
     <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-body">
              <table class="table table-responsive table-striped">
              <thead>
              <tr>
              <th>
                Operation
              </th>
              <th>
                From / To
              </th>
              <th>
                Processed at
              </th>
              <th>
                Amount
              </th>
       </tr>
              </thead>
              <tbody>
   @foreach($trans as $tran)
<tr>
<td>
{{ $tran->status == "1" ? 'Recived' : 'Sent' }}
</td>
<td>
{{$tran->toacc }}
</td>
<td>
{{$tran->created_at}}
</td>
<td>
  <b class="btn {{ $tran->status == "1" ? 'btn-success' : 'btn-danger' }}  btn-md">{{round(floatval($tran->amount), 8)}}</b> 
</td>
</tr>
@endforeach    
              </tbody>
          </table>
          <?php echo $trans->render(); ?>
             
            </div>
          </div>
        </div>

      </div>

</div>

</div>

@endsection


      