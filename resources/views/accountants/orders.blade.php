@extends('layouts.appacc')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Accountants Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in as Accountant!
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- <div class="table-responsive"> -->
<table class="table">
<thead class="text-primary">
<th>ID</th>
<th>Cart</th>
<th>STATUS</th>
<th>ACTION</th>

</thead>
<tbody>

@foreach ($orders as $row )
<tr>
<td>{{$row->id}}</td>
<td>{{$row->cart}}</td>
<!-- <td>@if($row->status == 0) PENDING @else APPROVED @endif</td> -->
<td>@if($row->status == 0) PENDING 
@elseif($row->status == 1) APPROVED 
@elseif($row->status == 2) REJECTED
 @endif</td>

<td><a href="{{route('is_order', ['id'=>$row->id])}}" class="btn btn-success" > APPROVE </a>
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
