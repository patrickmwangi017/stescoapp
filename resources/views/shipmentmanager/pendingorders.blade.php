@extends('layouts.appshipmentmanager')



@section('content')
<h5>Orders Pending Allocation</h5>
<div class="col-md-16">
    <form action="{{URL::to('/searchallshipmentorders')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchallshipmentorders" class="form-control" placeholder="search Order by name, address or status">
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
<!-- <th>Ordered</br>goods</th> -->
<th>Address</th>
<th>Allocated</br>Driver</th>
<th>ACTION</th>

</thead>
<tbody>
@foreach ($shipments as $row )
@if($row->payment_status == "Approved" && $row->allocation_status=="Pending")
<tr>
<td>{{$row->order_id}}</td>

<td>{{$row->town}} <br> {{$row->address}}</td>

 
<td>
@if($row->allocation_status == "Pending")

<form action="{{route('is_allocated', ['$id'=>$row->id])}}" method="POST">
<select name="cat" required>

                                <option value="-1">Select...</option>
                                        @foreach ($drivers as $driver )
                                        <option value="{{ $driver['id'] }}"> {{$driver->id}}:{{$driver->name}}-{{$driver->status}}</option>
                                         @endforeach
                                    </select>
                                    
                                    
@elseif($row->allocation_status == "Allocated")
 @foreach ($drivers as $driver ) 
 @if($driver->id==$row->driver_id)Driver Id:{{$driver->id}}<br>Name:{{$driver->name}}
 @endif
@endforeach
 @endif</td>
 <td><button type="submit" class="btn btn-info">Allocate</button></td>
 {{ csrf_field() }}
 
</tr>

@endif
@endforeach
</tbody>
</table>
</form>
</div>

@endsection
