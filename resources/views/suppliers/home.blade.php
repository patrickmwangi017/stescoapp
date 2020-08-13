@extends('layouts.appmason')

@section('content')
<u>All My Requested Supplies</u>
@if(session('message'))
<div class="alert alert-success">
{{session('message')}}
</div>
@endif



<!-- <div class="table-responsive"> -->
<table class="table">
<thead class="text-primary">

<th>Supply ID</th>
<th>Product</th>
<th>Quantity</th>
<th>Comment</th>
<th>Action</th>

</thead>
<tbody>
@foreach ($supplies as $row )
@if($row->supplier_id == $supplier->id)
<tr>
<td>{{$row->id}}</td>

<td>{{$row->product}}</td>
<td>{{$row->quantity}}</td>
<td>{{$row->comment}}</td>
<td>
@if($row->request_status=="Pending")
<a href="{{route('is_accepted', ['id'=>$row->id])}}" class="btn btn-success" >Accept</a>
<br>
<a href="{{route('is_rejected', ['id'=>$row->id])}}" class="btn btn-danger" >Reject</a>
@elseif ($row->request_status=="Accepted")Accepted
@elseif ($row->request_status=="Rejected")Rejected
@endif
</td>
</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
