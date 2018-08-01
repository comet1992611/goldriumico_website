@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-list font-green"></i>
                        <span class="caption-subject font-green bold uppercase">Base Currency Prices</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle  btn-primary"  data-toggle="modal" data-target="#addprice">
                           <i class="icon-plus"></i> New Price
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th> Price </th>
                                <th>Date of Announce</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($prices as $price)
                            <tr>
                                <td> {{$price->price}} USD</td>
                                <td> {{$price->created_at}} </td>
                            </tr>
                
                            @endforeach
                            </tbody>
                        </table>
                         <?php echo $prices->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
                <div id="addprice" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add New Price</h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" method="POST" action="{{route('price.store')}}" enctype="multipart/form-data">
                                     {{ csrf_field() }}
                                         <div class="form-group">
                                            <label for="price">Price</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="price" name="price" >
                                                <span class="input-group-addon">USD</span>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-success btn-block" >Save</button>
                                    </div>
                                </form>                                   
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
@endsection