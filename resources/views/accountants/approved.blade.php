@extends('layouts.appacc')



@section('content')
<strong>Approved Payments</strong>
<div class="col-md-16">
    <form action="{{URL::to('/searchapprovedpayments')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchapprovedpayments" class="form-control" placeholder="search payment by name or Amount">
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
<th>Payment<br>ID</th>
<th>Amount</th>
<th>user<br>id</th>
<!-- <th>Cust name</th> -->
<th>order<br>id</th>
<th>Booking<br>id</th>
<!-- <th>Date</th> -->


</thead>
<tbody>

@foreach ($shipments as $row )
@if($row->payment_status == "Approved")
<tr>
<td>{{$row->payment_id}}</td>
<td>{{$row->totalexpected}}</td>
<td>{{$row->user_id}}</td>
<!-- <td>{{$row->name}}</td> -->
<td>{{$row->order_id}}</td>
<td>{{$row->bookedservice_id}}</td>
<!-- <td>{{$row->updated_at}}</td> -->
</td>

</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
