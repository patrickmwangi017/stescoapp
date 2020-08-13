@extends('layouts.app')



@section('content')
<strong>DELIVERED ORDERS</strong>
<div class="col-md-16">
    <form action="{{URL::to('/searchaccountantspayments')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchaccountantspayments" class="form-control" placeholder="search payment by name, address or status">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
            <span class="glyphicon-search"></span></button>
        </span>
    </div>

</form>
</div>


<!-- <div class="table-responsive"> -->
<table id="sTBL" class="table" class="table table-bordered table-hover">
<thead class="text-primary">
<th>Date of</br>Order</th>
<th>Cart</th>
<th>Receive</br>Status</th>
<th>Confirm</br>Delivery</th>
</thead>
<tbody>
@foreach ($shipments as $row )
@if($row->order_shipment == "Order" && $row->deliverystatus == "Delivered")
<tr>
<td>{{$row->created_at}}</td>
<td>

<div class="panel panel-default">
<div class="panel-body">
<ul class="list-group">
@foreach($row->cart->items as $item)
<li class="list-group-item">
 <span class="badge"> {{$item['price']}} </span> 
 {{ $item['item']['productName']}}  <br>  {{$item['qty']}} Units
 </li>
@endforeach
</ul>
</div>
<div class="panel-footer">
<strong>Total Price: {{$row->cart->totalPrice}}</strong>
</div>
</div>

</td>
<td>@if($row->receivestatus == "Pending") Pending 
@elseif($row->receivestatus == "Received") Received
 @endif</td>

<td><a href="{{route('is_confirmdelivered', ['id'=>$row->id])}}" class="btn btn-success" > Confirm </a>

</td>

</tr>
@endif
@endforeach
</tbody>
</table>

@endsection
