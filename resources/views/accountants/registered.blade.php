@extends('layouts.appacc')

@if(session('message'))
<div class="alert alert-success">
{{session('message')}}
</div>
@endif
@section('content')
<div class="table-responsive">
<table class="table">
<thead class="text-primary">
<th>ID</th>
<th>NAME</th>
<th>MPESA CODE</th>
<th>STATUS</th>
<th>ACTION</th>

</thead>
<tbody>
@foreach ($users as $row )
<tr>
<td>{{$row->id}}</td>
<td>{{$row->name}}</td>
<td>{{$row->mpesa_code}}</td>
<!-- <td>@if($row->status == 0) PENDING @else APPROVED @endif</td> -->
<td>@if($row->status == 0) PENDING 
@elseif($row->status == 1) APPROVED 
@elseif($row->status == 2) REJECTED
 @endif</td>

<td><a href="{{route('is_user', ['id'=>$row->id])}}" class="btn btn-success" > APPROVE </a>
</br>
<a href="{{route('is_user1', ['id'=>$row->id])}}"> REJECT </a></td>



<!-- <td><a href="{{route('is_user', ['id'=>$row->id])}}"  class="btn btn-success" >
@if($row->status == 0) APPROVE @else ARCHIVE @endif</a> -->

<!-- <td>
<a href="#" class="btn btn-success">EDIT</a>
</td>
<td>
<a href="#" class="btn btn-success">DELETE</a>
</td> -->


</tr>
@endforeach
</tbody>
</table>
</div>
@endsection