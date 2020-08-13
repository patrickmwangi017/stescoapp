@extends('layouts.appdriver')

@section('content')
<u>All My Allocated Shipments</u>


<!-- <div class="table-responsive"> -->
<table class="table">
<thead class="text-primary">

<th>Customer <br> Name</th>
<th>Address</th>
<th>Ordered <br> goods</th>
<th>Action</th>

</thead>
<tbody>
@foreach ($shipments as $row )

@if($row->driver_id == $driver->id) 
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
<td>@if($row->deliverystatus == "Pending")<a href="{{route('is_delivered', ['id'=>$row->id])}}" class="btn btn-success" >Acknowledge <br> Delivery </a>
@endif
</td>
</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
