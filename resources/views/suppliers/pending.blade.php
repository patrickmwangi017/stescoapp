@extends('layouts.appmason')

@section('content')
<u>All Supplies Pending Acceptance</u>
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
@if($row->supplier_id == $supplier->id && $row->request_status=="Pending")
<tr>
<td>{{$row->id}}</td>

<td>{{$row->product}}</td>
<td>{{$row->quantity}}</td>
<td>{{$row->comment}}</td>
<td>
<a href="{{route('is_accepted', ['id'=>$row->id])}}" class="btn btn-success" >Accept</a>
<br>
<a href="{{route('is_rejected', ['id'=>$row->id])}}" class="btn btn-danger" >Reject</a>
</td>
</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
