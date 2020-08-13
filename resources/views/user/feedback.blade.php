@extends('layouts.app')
@section('content')


<strong>All MyFeedback Messages</strong>
<a href="#" class="btn btn-info pull-right">See Archive</a>
<br>
<br>
<div class="col-md-12">
    <form action="" method="" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchallpayments" class="form-control" placeholder="">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
            <span class="glyphicon-search"></span></button>
        </span>
    </div>

</form>
</div>
<div class="col-md-5">
<div class="box box-default box-solid">
<div class="box-header with-border">

                    <h3 class="box-title">Give Feedback</h3>
                    <a href="#addSupplyer" role="button" class="btn btn-warning btn-sm  pull-right" title="Give Feedback" data-toggle="modal"><i class="fa fa-user-plus" ></i></a>



                    <!-- /.box-tools -->
                </div>
                </div>
                </div>


<!-- <div class="table-responsive"> -->
<table class="table">
<thead class="text-primary">
<th>Feedback_id</th>
<th>Message</th>
<th>Reply</th>
<th>Action</th>

</thead>
<tbody>
@foreach ($feedback as $row )
@if($row->userstatus=="Pending")
<tr>
<td>{{$row->id}}</td>
<td>{{$row->feedbackMessage}}</td>
<td>{{$row->reply}}</td>
<td>@if($row->reply !="")
<a href="{{route('inbox', ['id'=>$row->id])}}" class="btn btn-success"> View Reply </a>
<a href="{{route('farchive', ['id'=>$row->id])}}" class="btn btn-danger"> Archive </a>
@else 
Waiting Reply 
 @endif</td>
 
</tr>
@endif
@endforeach
</tbody>
</table>
</div>

<div class="modal fade" id="addSupplyer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">New Feedback</h4>
                    </div>
                    <div class="modal-body">
                    <div class="container">
    <div class="row">
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <div class="panel-heading">To: Admin</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('feedback')}}">
                        {{ csrf_field() }}

<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8">
        <div class="card">
            <div class="card-header">
            
            <div class="form-group">
            <div class="col-md-8">
            <span class="pull-right"></span>
            </div>
            </div>

                <div class="form-group">
                <div class="col-md-8">
                <input type="text" id="feedbackMessage" class="form-control" name="feedbackMessage" placeholder="Type message here" required>
                <br>
                <button type="submit" class="btn btn-success pull-right">Send</button>
                </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>
        </div>
    </div>
</div>

</div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
@endsection
