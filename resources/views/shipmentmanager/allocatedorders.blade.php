@extends('layouts.appshipmentmanager')



@section('content')
<h5>Allocated Orders</h5>
<div class="col-md-16">
    <form action="{{URL::to('/searchallocatedorders')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchallocatedorders" class="form-control" placeholder="search Order by name or address">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
            <span class="glyphicon-search"></span></button>
        </span>
    </div>

</form>
</div>


<!-- <div class="table-responsive"> -->
<table class="table">
<thead class="text-primary">
<th>Order<br>Id</th>
<!-- <th>Cust Name</th> -->
<th>Address</th>
<th>Driver</br>Allocated</th>
<th>Delivery</br>Status</th>
<th>Confirmation</br>Status</th>

</thead>
<tbody>
@foreach ($shipments as $row )
@if($row->payment_status == "Approved" && $row->allocation_status == "Allocated" )
<tr>
<td>{{$row->order_id}}</td>
<!-- <td>{{$row->name}}</td> -->
<td>{{$row->town}} <br> {{$row->address}}</td>
<td>
@foreach ($drivers as $driver ) 
 @if($driver->id==$row->driver_id)Driver Id:{{$driver->id}}<br>Name:{{$driver->name}}
 @endif
@endforeach
</td>
<!-- <td>{{$row->driver_id}} :<br>{{$row->driver_name}}</td> -->
<td>@if($row->deliverystatus == "Pending") Pending 
@elseif($row->deliverystatus == "Delivered") Delivered
 @endif</td>
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
