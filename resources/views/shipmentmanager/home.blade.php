@extends('layouts.appshipmentmanager')



@section('content')
<a href="{{URL::to('shipmentmanager/shipmentreport')}}" class="btn btn-danger pull-right" role="button">Export PDF</a>

<h5>All Orders</h5> 
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
@if($row->payment_status == "Approved")
<tr>
<td>{{$row->order_id}}</td>
<!-- <td>{{$row->name}}</td> -->
<!-- <td>

<div class="panel panel-default">
<div class="panel-body">
<ul class="list-group">
@foreach($row->cart->items as $item)
<li class="list-group-item">
 <span class="badge"> {{$item['price']}} </span> 
 {{ $item['item']['productName']}}  | {{$item['qty']}} Units
 </li>
@endforeach
</ul>
</div>
<div class="panel-footer">
<strong>Total Price: {{$row->cart->totalPrice}}</strong>
</div>
</div>

</td> -->

<td>{{$row->town}} <br> {{$row->address}}</td>

 
<td>
@if($row->allocation_status == "Pending")

<form action="{{route('is_allocated', ['$id'=>$row->id])}}" method="POST">
<select name="cat" required>

                                <option value="-1">Select...</option>
                                        @foreach ($drivers as $driver )
                                        
                                        <option value="{{ $driver['id'] }}">{{$driver->name}}</option>
                                        
                                         @endforeach
                                    </select>
                                    <td><button type="submit" class="btn btn-info">Allocate</button></td>
                                      {{ csrf_field() }} 
                                      </form>             
@elseif($row->allocation_status == "Allocated")
 @foreach ($drivers as $driver ) 
 @if($driver->id==$row->driver_id)Name:{{$driver->name}}
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
