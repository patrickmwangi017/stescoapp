@extends('layouts.appstockmanager')



@section('content')
<strong>All Payments</strong>
@if(session('message'))
<div class="alert alert-success">
{{session('message')}}
</div>
@endif
<div class="col-md-16">
    <form action="{{URL::to('/searchallpayments')}}" method="POST" role="search">
    {{csrf_field()}}
    <div class="input-group">
        <input type="search" name="searchallpayments" class="form-control" placeholder="search payment by mpesa-code, status or amount">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
            <span class="glyphicon-search"></span></button>
        </span>
    </div>

</form>
</div>
<div class="col-md-5">
<div class="box box-default box-solid">
<div class="box-header with-border">

                    <h3 class="box-title">Add new products to stock</h3>
                    <a href="#addSupplyer" role="button" class="btn btn-warning btn-sm  pull-right" title="Add new Product" data-toggle="modal"><i class="fa fa-user-plus" ></i></a>



                    <!-- /.box-tools -->
                </div>
                </div>
                </div>


<!-- <div class="table-responsive"> -->
<table class="table">
<thead class="text-primary">
<!-- <th>Prod<br>ID</th> -->
<th>Prod<br>Name</th>
<!-- <th>Paid<br>for</th> -->
<th>Price</th>
<th>QTY</th>
<th>Status</th>
<th>Actions</th>
</thead>
<tbody>
@foreach ($products as $row )
@if($row->status=="Archived")
<tr>
<!-- <td>{{$row->id}}</td> -->
<td>{{$row->productName}}</td>

<td>{{$row->Price}}</td>
<td>{{$row->quantity_available}}</td>
<td>{{$row->status}}</td>

<td>@if($row->status == "Published")<a href="{{route('is_prodarchive', ['id'=>$row->id])}}" class="btn btn-danger" > ARCHIVE </a>
<br>
<a href="{{route('is_prodedit', ['id'=>$row->id])}}" class="btn btn-info" > Manage </a>
@elseif($row->status == "Archived")<a href="{{route('is_prodapprove', ['id'=>$row->id])}}" class="btn btn-success" > PUBLISH </a>
<br>
<a href="{{route('is_prodedit', ['id'=>$row->id])}}" class="btn btn-info" > Manage </a>
<!-- <a href="{{route('payment_archive', ['id'=>$row->id])}}"> ARCHIVE </a></td> -->
@endif
</td>
</tr>
@endif
@endforeach
</tbody>
</table>
</div>
<div class="modal fade" id="addSupplyer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add new Product</h4>
                    </div>
                    <div class="modal-body">
                    <form action="{{URL::to('add_new_product')}}" method="POST">
                        <table class="table">

                            <tbody>
                                
                                <tr>
                                    <td></td>
                                    <td>Product Name</td>
                                    <td><input type="text" id="productName" name="productName" required/></td>

                                </tr>


                                <tr>
                                    <td></td>
                                    <td>Product Description</td>


                                    <td><input type="text" id="Description" name="Description" /></td>

                                </tr>

                                <tr>
                                    <td></td>
                                    <td>Unit</td>


                                    <td><select id="unit" name="unit" required>

                                <option value="-1">Select...</option>
                                        <option value="Tonne"> Tonne</option>
                                        <option value="Piece"> Piece</option>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Price per Unit</td>


                                    <td><input type="number" id="Price" name="Price" /></td>

                                </tr>

                                <tr>
                                    <td></td>
                                    <td>Quantity Available</td>


                                    <td><input type="number" id="quantity_available" value="0" name="quantity_available" /></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Picture</td>


                                    <td><input type="file" id="Picture" name="Picture" /></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Status</td>


                                    <td><select id="status" name="status" required>
                                <option value="-1">Select...</option>

                                <option value="Published">Published</option>
                                <option value="Archived">Archived</option>

                            </select></td>


                                </tr>
                                <tr>
                                    <td></td>

                                    <td></td>
                                    <td></td>

                                </tr>
                            </tbody>
                        </table>
                        <!-- data-dismiss="modal" -->
                        <button type="submit" class="btn btn-success btn-sm">SAVE</button>
                        {{ csrf_field() }}
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        
@endsection
