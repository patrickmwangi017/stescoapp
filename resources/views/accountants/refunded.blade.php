@extends('layouts.appacc')



@section('content')
<strong>Refunded Payments</strong>
<div class="col-md-16">
    <form action="{{URL::to('/searchrefundedpayments')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchrefundedpayments" class="form-control" placeholder="search payment by name or amount">
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
<th>Cust<br>id</th>
<!-- <th>Cust<br>Name</th> -->
<th>Total<br>Amount</th>
<!-- <th>Date</th> -->
<th>Refund<br>Status</th>

</thead>
<tbody>

@foreach ($shipments as $row )
@if($row->refund_status == "Refunded")
<tr>
<td>{{$row->payment_id}}</td>
<td>{{$row->user_id}}</td>
<!-- <td>{{$row->name}}</td> -->
<td>

{{$row->totalexpected}}
</td>
<!-- <td>{{$row->updated_at}}</td> -->
</td>
<!-- <td>@if($row->status == 0) PENDING @else APPROVED @endif</td> -->
<td>@if($row->refund_status == "Pending") Pending 
@elseif($row->refund_status == "Refunded") Refunded 
<!-- @elseif($row->status == "Archived") Archived -->
@elseif($row->refund_status == "Rejected") Rejected
 @endif</td>
 
<!-- </br>
<a href="{{route('payment_archive', ['id'=>$row->id])}}"> ARCHIVE </a></td> -->

</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
