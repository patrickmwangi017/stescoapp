@extends('layouts.appacc')
@section('content')
@if(session('message'))
<div class="alert alert-success">
{{session('message')}}
</div>
@endif

<div class="row">
<div class="col-md-4 col-md-offset-4">
<h1>Accountant Profile</h1>
@if(count($errors)>0)
<div class="alert alert-danger">
@foreach($errors->all() as $error)
<p>{{$error}}</p>
@endforeach
</div>
@endif
<table class="table">
<form action="{{URL::to('update-accountant-info', ['id'=>$user->id])}}" method="POST">
<div class="form-group">
<label for="name">Full Name</label>
<input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" >
@if ($errors->has('name'))
<span class="help-block">
 <strong>{{ $errors->first('name') }}</strong>
 </span>
@endif
</div>


<div class="form-group">
<label for="address">Address</label>
<input type="text" id="address" name="address" class="form-control" value="{{$user->address}}" >
@if ($errors->has('address'))
<span class="help-block">
 <strong>{{ $errors->first('address') }}</strong>
 </span>
@endif
</div>


<div class="form-group">
<label for="phone">Phone</label>
<input type="text" id="phone" name="phone" class="form-control" value="{{$user->phone}}" >
@if ($errors->has('phone'))
<span class="help-block">
 <strong>{{ $errors->first('phone') }}</strong>
 </span>
@endif
</div>


<div class="form-group">
<label for="Email">E-Mail</label>
<input type="text" id="email" name="email" class="form-control" value="{{$user->email}}" >
@if ($errors->has('email'))
<span class="help-block">
 <strong>{{ $errors->first('email') }}</strong>
 </span>
@endif
</div>


<div class="form-group">
<label for="password">Password</label>
<input type="text" id="password" name="password" class="form-control" value="{{$user->password}}" >
@if ($errors->has('password'))
<span class="help-block">
 <strong>{{ $errors->first('password') }}</strong>
 </span>
@endif
</div>

<div class="form-group">
<button type="submit" class="btn btn-primary">Update</button>
{{ csrf_field() }}
</div>

</form>
</table>
</div>
</div>
</div>
</div>
@endsection