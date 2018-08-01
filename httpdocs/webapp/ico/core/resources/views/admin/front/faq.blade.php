@extends('admin.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Faq Section Content </span>
                </div>
            </div>
            <div class="portlet-body">
                <form role="form" method="POST" action="{{route('fqsec.update')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                   <div class="form-group">
                            <label for="faq_title">Faq Section Title</label>
                                <input type="text" value="{{$frontend->faq_title}}" name="faq_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="faq_details">Faq Section Details</label>
                               <textarea name="faq_details" class="form-control">
                                   {!!$frontend->faq_details!!}
                               </textarea>
                            </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-success btn-block" >Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Faq</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-lg btn-success" data-toggle="modal" data-target="#addRoad">
                        <i class="icon-plus"></i> New Faq
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column">
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                    </tr>
                    @foreach($faqs as $faq)
                    <tr>
                        <td>{{$faq->title}}</td>
                        <td>{{$faq->details}}</td>
                        <td>
                            <a class="btn btn-circle btn-icon-only btn-warning" data-toggle="modal" data-target="#edit{{$faq->id}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('faq.destroy', $faq)}}" method="POST" style="display: inline-block;">
                                {{csrf_field()}}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-circle btn-icon-only btn-danger"  type="submit" data-toggle="confirmation"  data-title="Are You Sure?" data-content="Delete This Faq?">
                                    <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <div id="edit{{$faq->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Faq</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" method="POST" action="{{route('faq.update', $faq)}}">
                                            {{ csrf_field() }}
                                            {{method_field('put')}}
                                            <div class="form-group">
                                                <label for="title">Question</label>
                                                <input type="text" value="{{$faq->title}}" name="title" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="details">Answer</label>
                                                <input type="text" value="{{$faq->details}}" name="details" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-lg btn-success btn-block" >Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Test -->
    <div id="addRoad" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Faq</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('faq.store')}}">
                        {{ csrf_field() }}
                         <div class="form-group">
                            <label for="title">Question</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="details">Answer</label>
                            <input type="text"  name="details" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-success btn-block" >Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @endsection