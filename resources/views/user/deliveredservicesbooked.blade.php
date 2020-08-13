@extends('layouts.app')



@section('content')
<strong>DELIVERED BOOKINGS</strong>
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
<th>Date Of</br>Booking</th>
<th>Booked</br>Services</th>
<th>Confirm</br>Delivery</th>
</thead>
<tbody>
@foreach ($shipments as $row )
@if($row->order_shipment == "Shipment" && $row->deliverystatus == "Delivered")
<tr>
<td>{{$row->created_at}}</td>
<td>
<div class="panel panel-default">
<div class="panel-body">
<ul class="list-group">
@foreach($row->booking->items as $item)
<li class="list-group-item">
 <span class="badge"> {{$item['price']}} </span> 
 {{ $item['item']['serviceName']}}  <br>  {{$item['qty']}} Units
 </li>
@endforeach
</ul>
</div>
<div class="panel-footer">
<strong>Total Price: {{$row->booking->totalPrice}}</strong>
</div>
</div>
</td>

 <td>
 @if($row->receivestatus == "Pending")
 <a href="{{route('is_confirmdelivered', ['id'=>$row->id])}}" class="btn btn-success" > Confirm </a>
 @elseif($row->receivestatus == "Received") Confirmed
 @endif
 </td>
</tr>
@endif
@endforeach
</tbody>
</table>

@endsection
