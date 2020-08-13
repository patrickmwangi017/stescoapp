@extends('layouts.appdriver')

@section('content')
<u>My Pending Shipments</u>


<!-- <div class="table-responsive"> -->
<table class="table">
<thead class="text-primary">

<th>Cust <br> Name</th>
<th>Address</th>
<th>Ordered <br> goods</th>
<th>Action</th>

</thead>
<tbody>
@foreach ($shipments as $row )

@if($row->driver_id == $driver->id && $row->deliverystatus == "Pending") 
<tr>

<td>{{$row->name}}</td>

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
<td><a href="{{route('is_delivered', ['id'=>$row->id])}}" class="btn btn-success" >Acknowledge <br> Delivery </a></td>
</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
