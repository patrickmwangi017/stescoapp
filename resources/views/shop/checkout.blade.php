@extends('layouts.app')
@section('title')
laravel shopping cart
@endsection

@section('content')
@if(session('message'))
<div class="alert alert-success">
{{session('message')}}
</div>
@endif
<div class="col-md-12">
    <form action="" method="" role="search">
   
    <div class="input-group">
        <input type="search" name="searchservices" class="form-control" placeholder="search items by name">
        <span class="input-group-btn">
            <button type="" class="btn btn-default">
            <span class="glyphicon-search"></span></button>
        </span>
    </div>

</form>
</div>
<!-- <p  align="center"><img src="images/favicon.png" class="img-circle" alt=""></p> -->
<div class="row">  
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
    <h3  align="center">Lipa na M-Pesa</h3>
    <h3  align="center">Till Number:<strong class="text-primary"> (0718359977)</strong></h3>
    <h4  align="center">Your Total is: <strong class="text-primary">  Ksh. {{$total}}</strong></h4>
    <h5  align="center"><u><strong>N.B: Delivery at Kanini Haraka Enterprises is </strong><strong class="text-success">Totally Free</strong></u></h5> 
    @if(count($errors)>0)
<div class="alert alert-danger">
@foreach($errors->all() as $error)
<p>{{$error}}</p>
@endforeach
</div>
@endif
    <form id="formElem" name="formElem"  action="{{route('checkout')}}" method="POST" class="myForm">
    <div class="row"> 
   
    <div class="col-xs-12">
    <div class="form-group">
   <p align="center"><label for="mpesa_code">Enter M-Pesa Code</label></p>
    <input type="text" id="mpesa_code" class="form-control" name="mpesa_code"  required  align="center">
@if ($errors->has('mpesa_code'))
<span class="help-block">
 <strong>{{ $errors->first('mpesa_code') }}</strong>
 </span>
@endif
    </div>
    </div>
    <div class="col-xs-12">
    <div class="form-group">
   <p align="center"><label for="town">Enter Shipment Town</label></p>
    <input type="text" id="town" class="form-control" name="town"  required  align="center">
@if ($errors->has('town'))
<span class="help-block">
 <strong>{{ $errors->first('town') }}</strong>
 </span>
@endif
    </div>
    </div>
    <div class="col-xs-12">
    <div class="form-group">
   <p align="center"><label for="address">Enter Shipment Address</label></p>
    <input type="text" id="address" class="form-control" name="address"  required  align="center">
@if ($errors->has('address'))
<span class="help-block">
 <strong>{{ $errors->first('address') }}</strong>
 </span>
@endif
    </div>
    </div>

{{ csrf_field() }}
<p align="center"><button type="submit" class="btn btn-success"  align="center">Complete Order</button></p>

    </form>
    </div>
    </div>
   

@endsection