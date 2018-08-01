@extends('admin.layout.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> Sell Log</span>
                </div>
            </div>
            <div class="portlet-body">

                <table class="table table-striped table-bordered table-hover order-column">
                <thead>
                    <tr>
                        <th>
                            Username 
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Payment Gateway
                        </th>                       
                     </tr>
                </thead>
                <tbody>
      @foreach($sells as $sel)
                     <tr>
                      <td>
                          <a href="{{route('user.single', $sel->user->id)}}">
                            {{$sel->user->username}}
                          </a>
                        </td>
                        <td>
                            {{$sel->amount}} {{$gnl->cur}}   
                        </td> 
                        <td>
                            {{$sel->ico->price}} USD  
                        </td>
                        <td>
                            {{$sel->gateway->name}}
                        </td>
                     </tr>
      @endforeach 
      <tbody>
           </table>
           <?php echo $sells->render(); ?>
        </div>
      
      </div><!-- row -->
      </div>
    </div>
  </div>    
</div>
@endsection