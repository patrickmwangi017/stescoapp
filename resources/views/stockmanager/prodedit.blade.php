@extends('layouts.appstockmanager')
@section('content')
@if(session('message'))
<div class="alert alert-success">
{{session('message')}}
</div>
@endif
<div class="row">
<div class="col-md-4 col-md-offset-4">
<h3>Update Product</h3>
@if(count($errors)>0)
<div class="alert alert-danger">
@foreach($errors->all() as $error)
<p>{{$error}}</p>
@endforeach
</div>
@endif
<table class="table">
<form action="{{URL::to('update-product-info', ['id'=>$products->id])}}" method="POST">
<tr>
<td><label for="name">Product Name</label></td>
<td><input type="text" id="productName" name="productName" class="form-control" value="{{$products->productName}}" required>
@if ($errors->has('productName'))
<span class="help-block">
 <strong>{{ $errors->first('productName') }}</strong>
 </span>
@endif
</td>
</tr>
<tr>
<td><label for="address">Description</label></td>
<td><input type="text" id="Description" name="Description" class="form-control" value="{{$products->Description}}" required>
@if ($errors->has('Description'))
<span class="help-block">
 <strong>{{ $errors->first('Description') }}</strong>
 </span>
@endif
</td>
</tr>
<tr>
<td><label for="phone">Price</label></td>
<td><input type="integer" id="Price" name="Price" class="form-control" value="{{$products->Price}}" required>
@if ($errors->has('Price'))
<span class="help-block">
 <strong>{{ $errors->first('Price') }}</strong>
 </span>
@endif
</td>
</tr>
<tr>
<td><label for="Email">Quantity Available</label></td>
<td><input type="integer" id="quantity_available" name="quantity_available" class="form-control" value="{{$products->quantity_available}}" required>
@if ($errors->has('quantity_available'))
<span class="help-block">
 <strong>{{ $errors->first('quantity_available') }}</strong>
 </span>
@endif
</td>
</tr>

<tr>
<td><label for="password">Unit</label></td>
<td>
<select name="unit" required>

                                <option value="{{ $products['unit'] }}">{{$products->unit}}</option>
                                        <option value="Tonne"> Tonne</option>
                                        <option value="Piece"> Piece</option>
                                    </select>
                                              

@if ($errors->has('unit'))
<span class="help-block">
 <strong>{{ $errors->first('unit') }}</strong>
 </span>
@endif
</td>
</tr>
<tr>
<td><label for="password">Status</label></td>
<td>
<select name="status" required>

                                <option value="{{ $products['status'] }}">{{$products->status}}</option>
                                        <option value="Published">Published</option>
                                        <option value="Archived">Archived</option>
                                    </select>
                                              

@if ($errors->has('status'))
<span class="help-block">
 <strong>{{ $errors->first('status') }}</strong>
 </span>
@endif
</td>
</tr>

<tr>
<td>
<button type="submit" class="btn btn-primary">Update</button>
{{ csrf_field() }}
</td>
</tr>
</form>
</table>
</div>
</div>
</div>
</div>
@endsection