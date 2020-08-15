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

@if(Session::has('cart'))

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
   <div class="row">  
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
       <ul class="list-group">
    
       
       @foreach($products as $product)
       @if($product['qty']>0)
          <li class="list-group-item">
          <span class="badge">{{ $product['qty'] }} {{$product ['item']['unit'] }}s</span>
          <strong>{{$product ['item']['productName'] }}</strong>
          <span class="label label-success">Ksh. {{$product['price'] }}</span>
          
          <div class="btn-group">
          <a href="{{route('update-cart', ['id'=>($product['item']['id'])])}}" class="btn btn-primary fa fa-minus"> </a>
          </div>
          
         <div class="btn-group">
        <a href="{{route('product.addoneToCart', ['id'=>($product['item']['id'])])}}" class="btn btn-info fa fa-plus-circle"></a>
        </div>
     
          </li>
         @endif

          @endforeach

    
       
       </ul>
     </div>
     </div>
     @if($totalQty>0)
     <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
   <!-- Click here if you want the goods to be delivered to your location
   <a href="" class="btn btn-success pull-right" role="button">Add to Cart</a> -->
    <strong>Total{{ $totalPrice }}</strong>
    </div>
     </div>
     <hr>
     <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
    <a href="{{route('checkout')}}" type="button" class="btn btn-success">Checkout</a>
    </div>
     </div>
     @else
     <div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
    <h2 align="center">Your Cart Is Empty</h2>
    </div>
     </div>
     @endif
@else

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
<div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
    <h2>Your Cart Is Empty</h2>
    </div>
     </div>
@endif

@endsection


