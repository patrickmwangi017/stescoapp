@extends('layouts.appacc')



@section('content')

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


<div class="table-responsive">
<table class="table">
<thead class="text-primary">
<th>payment id</th>
<th>Ordered goods</th>
<th>STATUS</th>
<th>ACTION</th>

</thead>
<tbody>

@foreach ($shipments as $row )
@if($row->status == "Archived")
<tr>
<td>{{$row->payment_id}}</td>
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
<!-- <td>@if($row->status == 0) PENDING @else APPROVED @endif</td> -->
<td>@if($row->status == "Pending") PENDING 
@elseif($row->status == "Approved") APPROVED 
@elseif($row->status == "Rejected") REJECTED
@elseif($row->status == "Archived") Archived
 @endif</td>
 

<td><a href="{{route('is_order', ['id'=>$row->id])}}" class="btn btn-success" > APPROVE </a>
</br>
<a href="{{route('order_reject', ['id'=>$row->id])}}"> REJECT </a></td>

</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
