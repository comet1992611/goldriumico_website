@extends('front.layouts.admaster')
@section('content')

        <div class="row">
          <div class="panel panel-success">
            <div class="panel-heading">
              <h1>Transaction Log</h1>
            </div>
            <div class="panel-body">
     <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-body">
              <table class="table table-responsive">
              <thead>
                  <tr>
                    
              <th>
                Transaction ID
              </th>
              <th>
                Amount
              </th>
              <th>
                Operation
              </th>
              <th>
                Balance
              </th>
              <th>
                Description
              </th>
              <th>
                Processed at
              </th>
           

                  </tr>
              </thead>
              <tbody>
   @foreach($trans as $tran)
<tr class="{{ $tran->flag == "1" ? 'success' : 'info' }}">
<td>
{{$tran->trxid }}
</td>
<td>
{{number_format(floatval($tran->amount), $gset->decimalPoint, '.', '')}} {{$gset->curSymbol}}
</td>
<td>
{{ $tran->flag == "1" ? $gset->curCode : 'BitCoin' }}
</td>
<td>
{{number_format(floatval($tran->balance), $gset->decimalPoint, '.', '')}}      
</td> 
<td>
{{$tran->desc}}
</td>
<td>
{{$tran->created_at}}
</td>
</tr>
@endforeach    
              </tbody>
              <tfoot>
                  <tr>
                      <th>
                Transaction ID
              </th>
              <th>
                Amount
              </th>
              <th>
                Operation
              </th>
              <th>
                Balance
              </th>
              <th>
                Description
              </th>
              <th>
                Processed at
              </th>
           
                  </tr>
              </tfoot>
          </table>
          <?php echo $trans->render(); ?>
             
            </div>
          </div>
        </div>

      </div>

</div>

</div>

@endsection


      