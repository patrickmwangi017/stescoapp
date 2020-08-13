@extends('layouts.appmason')

@section('content')
<u>All Acknowledged Supplies</u>
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


</thead>
<tbody>
@foreach ($supplies as $row )

@if($row->supplier_id == $supplier->id && $row->receive_status == "Received") 
<tr>
<td>{{$row->id}}</td>

<td>{{$row->product}}</td>
<td>{{$row->quantity}}</td>
<td>{{$row->comment}}</td>

</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@endsection
