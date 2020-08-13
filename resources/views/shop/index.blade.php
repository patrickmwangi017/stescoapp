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
    <form action="{{URL::to('/search')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="search" class="form-control" placeholder="search product">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
            <span class="glyphicon-search"></span></button>
        </span>
    </div>

</form>
</div>

@foreach($products->chunk(3) as $productChunk)
<div class="row">
@foreach($productChunk as $product)
@if($product->status == "Published")
<div class="col-sm-6 col-md-4">
<div class="thumbnail">
<!-- {{$product->Picture}} -->
<img src="images/{{$product->Picture}}" style="max-height=150px" alt="Generic placeholder thumbnail"  class="img-responsive">
<!-- asset('images/1.png') -->
<div class="caption">
<h3>{{$product->productName}}</h3>
<p id="me" class="description">{{ $product->Description}}</p>
<div class="clearfix">
<div class="pull-left price">Ksh. {{$product->Price}} per {{$product->unit}}</div>
@if($product->quantity_available>0)
<a href="{{route('product.addToCart', ['id'=> $product->id])}}" class="btn btn-success pull-right" role="button">Add to Cart</a>
@else
<br>
<a href="#" class="btn btn-danger pull-right" role="button">Out of Stock</a>
@endif

</div>
</div>
</div>
</div>
@endif
@endforeach

</div>
@endforeach
@endsection
