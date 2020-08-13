@extends('layouts.appmason')

@section('content')
<u>All My Accepted Supplies</u>
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

@if($row->supplier_id == $supplier->id && $row->request_status == "Accepted") 
<tr>
<td>{{$row->id}}</td>

<td>{{$row->product}}</td>
<td>{{$row->quantity}}</td>
<td>{{$row->comment}}</td>
<td>
@if($row->supply_status=="Pending")
<a href="{{route('is_supplied', ['id'=>$row->id])}}" class="btn btn-success" >Supply</a>
@else Supplied
@endif
</td>
</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
