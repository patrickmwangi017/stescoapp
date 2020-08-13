@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <form action="" method="" role="search">
   
    <div class="input-group">
        <input type="search" name="searchservices" class="form-control" placeholder="">
        <span class="input-group-btn">
            <button type="" class="btn btn-default">
            <span class="glyphicon-search"></span></button>
        </span>
    </div>

</form>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{URL::to('replymessage', ['id'=>$feedback->id])}}">
                        {{ csrf_field() }}

<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8">
        <div class="card">
            <div class="card-header">
            <div class="form-group">
            <div class="col-md-8">
            <span class="pull-right">{{$feedback->feedbackMessage}}</span>
            </div>
            </div>


            <div class="form-group">
            <div class="col-md-8">
            <p>{{$feedback->reply}}</p>
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

@endsection
