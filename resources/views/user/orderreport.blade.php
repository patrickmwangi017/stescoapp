<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Order Report {{$shipments->order_id}}</title>
  <style>
    @include('PDF.style')
  </style>
</head>
<body>
<header class="clearfix">
  <div id="logo">
    {{--<img src="logo.png">--}}
  </div>
  <h3>Order Report {{$shipments->order_id}}</h3>

  <div id="company" class="clearfix" style="padding-right: 50px;">

    <div>Hello {{$shipments->name}}<br>Kanini Haraka Enterprises</div>
    <div>P.O Box 267,
    </div>
    <div>Mweiga, Nyeri</div>

    <div><a href="mailto:davin@gmail.com">davin@gmail.com"</a></div>
  </div>


</header>

<hr>


<div id="project" >
  <div style="font-size: 15px;">Bill To: {{$shipments->name}}</div><br>

  <span>
      <div>{{$shipments->address}}</div>
  
      </span>
</div>

  <div id="project-right" style="padding-right: 50px;">
 <span style="color: green; border:1px solid green; border-radius: 10% ;width: 200px;
	height: 200px; font-size: 20px; ">PAID</span>
  
        <div style="font-size: 15px;">Order ID: {{$shipments->order_id}}</div><br>
        <div style="font-size: 15px;">Created at: {{$shipments->created_at}}</div>
        <div style="font-size: 15px;">Total price: {{$shipments->totalexpected}}</div><br>



      </div>

      <table style="padding-top: 100px;">
        <thead>
        <tr>
          <th class="service">No</th>
          <th class="service">Prod. ID</th>
          <th class="desc">Product Name</th>
    

          <th>Qty</th>
          <th>Unit price</th>
          <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        @php
          $i=0;
        @endphp
        @foreach($cart->items as $item)
          <tr>
            <td class="service">{{++$i}}</td>
            <td class="desc">{{ $item['item']['id']}}</td>

            <td class="desc">{{ $item['item']['productName']}}</td>
            
            <td class="qty">{{$item['qty']}}</td>
            <td class="unit">{{ $item['item']['Price']}}</td>
            <td class="total"> {{$item['price']}}</td>
          </tr>
        @endforeach

       
         
          <tr>
            <td  class="sum" colspan="5">SUBTOTAL</td>
            <td class="total">{{$cart->totalPrice}}</td>
          </tr>
        
    

          <tr>
            <td colspan="5" class="grand total" style="text-align: right;">GRAND TOTAL</td>
              <td class="grand total"> {{$cart->totalPrice}}</td>
          </tr>
    


        </tbody>
      </table>
      <br>
      <div id="notices" style="float: left">
        <div class="notice">________________</div>
        <div>Authorise signature</div>
      </div>

      <div style="float: right; padding-right: 50px">
        <div class="notice">__________________</div>
        <div>Manager signature</div>
      </div>

</body>
</html>
