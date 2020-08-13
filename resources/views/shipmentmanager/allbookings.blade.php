@extends('layouts.appshipmentmanager')



@section('content')
<a href="{{URL::to('shipmentmanager/servicedeliveryreport')}}" class="btn btn-danger pull-right" role="button">Export PDF</a>
<h5>All Bookings</h5>
<div class="col-md-16">
    <form action="{{URL::to('/searchshipmentallbookings')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchshipmentallbookings" class="form-control" placeholder="search Booking by name or address">
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
<!-- <th>Ordered</br>goods</th> -->
<th>Address</th>
<th>Allocated</br>Mason</th>
<th>ACTION</th>

</thead>
<tbody>
@foreach ($shipments as $row )
@if($row->booking_status == "Approved")
<tr>
<td>{{$row->bookedservice_id}}</td>
<!-- <td>{{$row->name}}</td> -->

<td>{{$row->town}} <br> {{$row->postaladdress}}</td>

 
<td>
@if($row->allocation_status == "Pending")

<form action="{{route('is_masonallocated', ['$id'=>$row->id])}}" method="POST">
<select name="cat" required>

                                <option value="-1">Select...</option>
                                        @foreach ($suppliers as $mason )
                                        @if($mason->status=="Free")
                                        <option value="{{ $mason['id'] }}"> {{$mason->id}}:{{$mason->name}}-{{$mason->status}}</option>
                                        @endif
                                         @endforeach
                                    </select>
                                    <td><button type="submit" class="btn btn-info">Allocate</button></td>
                                      {{ csrf_field() }} 
                                      </form>             
@elseif($row->allocation_status == "Allocated")
 @foreach ($suppliers as $mason ) 
 @if($mason->id==$row->mason_id)Mason Id:{{$mason->id}}<br>Name:{{$mason->name}}
 @endif
@endforeach
 @endif</td>
 
 
</tr>

@endif
@endforeach
</tbody>
</table>

</div>

@endsection
