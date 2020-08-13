@extends('layouts.appshipmentmanager')



@section('content')
<h5>Allocated Bookings</h5>
<div class="col-md-16">
    <form action="{{URL::to('/searchshipmentallocatedbookings')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchshipmentallocatedbookings" class="form-control" placeholder="search payment by name or address">
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
<th>Booking<br>Id</th>
<!-- <th>Cust Name</th> -->
<!-- <th>Address</th> -->
<th>Mason</br>Allocated</th>
<th>Delivery</br>Status</th>
<th>Confirmation</br>Status</th>

</thead>
<tbody>
@foreach ($shipments as $row )
@if($row->booking_status == "Approved" && $row->allocation_status == "Allocated" )
<tr>
<td>{{$row->bookedservice_id}}</td>
<!-- <td>{{$row->name}}</td> -->
<!-- <td>{{$row->town}} <br> {{$row->postaladdress}}</td> -->
<td>
@foreach ($suppliers as $mason ) 
 @if($mason->id==$row->mason_id)Mason Id:{{$mason->id}}<br>Name:{{$mason->name}}
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
