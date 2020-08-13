@extends('layouts.app')

@section('content')
<strong>PENDING ORDERS</strong>
<div class="col-md-12">
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
<th>Order</br>Status</th>
<th>Order<br>Report</th>

</thead>
<tbody>
@foreach ($shipments as $row )
@if($row->order_shipment == "Order" && $row->shipment_status == "Pending")
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
<td>@if($row->delivery_status == "Pending" && $row->payment_status == "Pending") Pending<br>Payment<br>Approval
@elseif($row->delivery_status == "Pending" && $row->payment_status == "Rejected" && $row->refund_status == "Pending" )Rejected-<br>Pending Refund
@elseif($row->delivery_status == "Pending" && $row->refund_status == "Refunded" )Rejected<br>and Amount<br>Refunded
@elseif($row->payment_status == "Approved")Pending <br> Delivery
 @endif</td>

 <td><a href="{{URL::to('/makepdfpurchase/'.$row->id)}}" target="_blank"  class="btn btn-danger btn-sm"><i class="fa fa-print"></i></a></td>

</tr>
@endif
@endforeach
</tbody>
</table>

@endsection
