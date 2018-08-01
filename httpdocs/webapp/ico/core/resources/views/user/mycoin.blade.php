@extends('layouts.user')

@section('content')
<div class="row">
<div class="col-md-12">
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <h4 class="panel-title">{{$gnl->cur}} Purchase Log</h4>
    </div>
    <div class="panel-body table-responsive">
     <table class="table table-striped">
     	<tr>
            <th>Amount</th>
            <th>{{$gnl->cur}} Buying Price</th>
            <th>ICO Start Date</th>
            <th>ICO End Date</th>
     		<th>Buying Date</th>
            <th>Payment Gateway</th>
     	</tr>
     	@foreach($coins as $cn)
     	<tr>
            <td>{{$cn->amount}} {{$gnl->cur}}</td>
            <td>{{$cn->ico->price}} USD</td>
            <td>{{$cn->ico->start}}</td>
            <td>{{$cn->ico->end}}</td>
     		<td>{{$cn->created_at}}</td>
            <td>{{$cn->gateway->name}}</td>
     	</tr>
     	@endforeach
     </table>
   </div>
 </div>
</div> 
</div>
@endsection
