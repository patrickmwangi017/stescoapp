@extends('layouts.appacc')



@section('content')
<strong>Pending Payments</strong>
<div class="col-md-16">
    <form action="{{URL::to('/searchpendingpayments')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchpendingpayments" class="form-control" placeholder="search payment by mpesa-code or amount">
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
<th>Mpesa<br>Code</th>
<th>user<br>id</th>
<th>Total</th>
<!-- <th>Date</th> -->
<th>STATUS</th>
<!-- <th>ACTION</th> -->

</thead>
<tbody>
@foreach ($shipments as $row )
@if($row->payment_status == "Pending")
<tr>
<td>{{$row->mpesa_code}}</td>
<td>{{$row->user_id}}</td>
@if($row->order_shipment == "Order") 
<td>
{{$row->cart->totalPrice}}
</td>
@else
<td>
{{$row->totalexpected}}
</td>
@endif
<!-- <td>{{$row->created_at}}</td> -->


<td>@if($row->payment_status == "Pending")
<a href="{{route('is_payment', ['id'=>$row->id])}}" class="btn btn-success" > APPROVE </a>
</br>
<a href="{{route('payment_reject', ['id'=>$row->id])}}" class="btn btn-danger"> REJECT </a>
@elseif($row->payment_status == "Approved") Approved
@elseif($row->payment_status == "Rejected") Rejected

 @endif</td>
 
 
<!-- <td><a href="{{route('is_payment', ['id'=>$row->id])}}" class="btn btn-success" > APPROVE </a>
</br>
<a href="{{route('payment_reject', ['id'=>$row->id])}}" class="btn btn-danger"> REJECT </a>
</br>
</td> -->

</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
