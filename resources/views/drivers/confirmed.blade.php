@extends('layouts.appdriver')

@section('content')
<u>My Confirmed Shipments</u>


<!-- <div class="table-responsive"> -->
<table class="table">
<thead class="text-primary">

<th>Cust ID</th>
<th>Address</th>
<th>Ordered <br> goods</th>
<th>Delivery <br> Status</th>
<th>Customer <br> Confirmation</th>

</thead>
<tbody>
@foreach ($shipments as $row )

@if($row->driver_id == $driver->id && $row->receivestatus == "Received") 
<tr>

<td>{{$row->user_id}}</td>

<td>{{$row->town}}<br>{{$row->address}}</td>
<td>

<div class="panel panel-default">
<div class="panel-body">
<ul class="list-group">
@foreach($row->cart->items as $item)
<li class="list-group-item">
 <span class="badge"> {{$item['price']}} </span> 
 {{ $item['item']['productName']}} <br> {{$item['qty']}} Units
 </li>
@endforeach
</ul>
</div>
<div class="panel-footer">
<strong>Total Price: {{$row->cart->totalPrice}}</strong>
</div>
</div>

</td>
<td>
@if($row->deliverystatus == "Pending") Acknowledge Delivery 
@elseif($row->deliverystatus == "Delivered") Delivered
@endif</a></td>
<td>@if($row->receivestatus == "Pending") Pending 
@elseif($row->receivestatus == "Received") Confirmed 
@endif</td>
</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
