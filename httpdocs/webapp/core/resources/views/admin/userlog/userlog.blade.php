@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> User Transaction Log</span>
                </div>

            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover order-column">
                    <thead>
                        <tr>
                         <th>
                            User
                        </th>
                        <th>
                            Transaction ID
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                          Currency
                      </th>
                      <th>
                          Current Balance
                      </th>
                      <th>
                        Details
                    </th>                           
                    <th>
                        Processed on
                    </th>
                </tr>
            </thead>
            <tbody>
             @foreach($userlogs as $log)
             <tr class="odd gradeX {{ $log->flag == "1" ? 'success' : 'warning' }}">
                <td>
                    <a href="{{route('user.single', $log->user->id)}}">
                      {{$log->user->firstname}} {{$log->user->lastname}}   
                  </a>
              </td>
              <td>
                {{$log->trxid}}      
            </td> 
            <td>
                {{ number_format(floatval($log->amount), $gset->decimalPoint, '.', '')}} {{$gset->curSymbol}}
            </td>
            <td>
             {{ $log->flag == "1" ? $gset->curCode : 'BitCoin' }}
         </td>
         <td>
            {{ number_format(floatval($log->balance), $gset->decimalPoint, '.', '') }}      
        </td> 
        <td>
            {{$log->desc}}
        </td>
        <td>
            {{$log->created_at}}
        </td>
    </tr>
    @endforeach 
</tbody>
</table>
<?php echo $userlogs->render(); ?>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>




@endsection

