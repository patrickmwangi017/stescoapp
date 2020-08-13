@extends('layouts.app')
@section('content')
@if(session('message'))
<div class="alert alert-success">
{{session('message')}}
</div>
@endif
<div class="row">
<div class="col-md-4 col-md-offset-4">
<div class="col-md-12">
    <form action="" method="" role="search">
   
    <div class="input-group">
        <input type="search" name="searchservices" class="form-control" placeholder="search items by name">
        <span class="input-group-btn">
            <button type="" class="btn btn-default">
            <span class="glyphicon-search"></span></button>
        </span>
    </div>

</form>
</div>
<h1>My Profile</h1>
@if(count($errors)>0)
<div class="alert alert-danger">
@foreach($errors->all() as $error)
<p>{{$error}}</p>
@endforeach
</div>
@endif
<table class="table">
<form action="{{URL::to('update-user-info', ['id'=>$user->id])}}" method="POST">


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
<label for="address">Postal Town</label>
<input type="text" id="town" name="town" class="form-control" value="{{$user->town}}" >
@if ($errors->has('town'))
<span class="help-block">
 <strong>{{ $errors->first('town') }}</strong>
 </span>
@endif
</div>

<div class="form-group">
<label for="address">Postal Address</label>
<input type="text" id="postaladdress" name="postaladdress" class="form-control" value="{{$user->postaladdress}}" >
@if ($errors->has('postaladdress'))
<span class="help-block">
 <strong>{{ $errors->first('postaladdress') }}</strong>
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
<input type="text" id="Email" name="Email" class="form-control" value="{{$user->Email}}" >
@if ($errors->has('Email'))
<span class="help-block">
 <strong>{{ $errors->first('Email') }}</strong>
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