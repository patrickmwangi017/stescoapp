@extends('layouts.app')



@section('content')
<strong>Help Page</strong>
<br>
<div class="col-md-12">
    <form action="" method="" role="search">
   
    <div class="input-group">
        <input type="search" name="searchservices" class="form-control" placeholder="">
        <span class="input-group-btn">
            <button type="" class="btn btn-default">
            <span class="glyphicon-search"></span></button>
        </span>
    </div>

</form>
</div>
<strong class="text-success">Frequently Asked Questions (FAQs)</strong>
<br>
<br>

<ul class="list-group">
<li class="list-group">
                        <a href="#">
                            <i class="fa fa-tint"></i>
                            <span class="text-danger">How can I Sign Up?</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                           <p>Click on the <strong class="text-success">sign in</strong> link on the left side bar, select the designation you want to sign up as then follow the sign up link on the sign in page to sign up</p> 
                        <br>
                        
                    
                        <a href="#">
                            <i class="fa fa-tint"></i>
                            <span class="text-danger">How can I Sign In?</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                            <p>Click on the <strong class="text-success">sign in</strong> link on the left side bar, select the designation you want to sign in as then you enter your correct credentials</p>
                        
                    <br>
                        <a href="#">
                            <i class="fa fa-tint"></i>
                            <span class="text-danger">How can I add an item to cart?</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                        
                            <p>Click on the <strong class="text-success">Products</strong> link on the left side bar, search for the products you want to purchase and add them to cart</p>
                     <br>
                        <a href="#">
                            <i class="fa fa-tint"></i>
                            <span class="text-danger">How can I view my cart?</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                        
                            <p>Click on the <strong class="text-success">Shopping cart icon</strong> on the top navigation and you will see the items you've added to your cart</p>
                        <br>
                        <a href="#">
                            <i class="fa fa-tint"></i>
                            <span class="text-danger">How can I check out?</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                        
                            <p>Click on the <strong class="text-success">Checkout button</strong> on the shopping cart page and you will be prompted to pay to complete your transaction</p>
                        <br>
                        
                        <a href="#">
                            <i class="fa fa-tint"></i>
                            <span class="text-danger">How do I pay for Delivery?</span>
                            <span class="pull-right-container">
                            </span>
                        </a>
                        
                            <p>Delivery at Kanini Haraka Enterprises is <strong class="text-success">Totally Free</strong> </p>
                        <br>
                    </li>
                    </ul>
@endsection                    