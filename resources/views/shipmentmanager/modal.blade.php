@extends('layouts.appshipmentmanager')

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...

<table class="table">
<thead class="text-primary">
<th>Driver<br>Id</th>
<th>Driver<br>Name</th>
<th>Driver<br>Email</th>
<th>Driver<br>Status</th>
<th>ACTION</th>

</thead>
<tbody>
@foreach ($drivers as $driver )
<tr>
<td>{{$driver->id}}</td>
<td>{{$driver->name}}</td>
<td>{{$driver->email}}</td>
<td>{{$driver->status}}</td>
<td><a href="{{route('is_allocated', ['id1'=>$row->id], ['id'=>$driver->id])}}" class="btn btn-info" > Allocate </a></td>
</tr>
@endforeach
</tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection