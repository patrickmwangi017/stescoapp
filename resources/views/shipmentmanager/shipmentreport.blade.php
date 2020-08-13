<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Shipment Report</title>
  <style>
    @include('PDF.style')
  </style>
</head>
<body>
<header class="clearfix">
  <div id="logo">
    {{--<img src="logo.png">--}}
  </div>
  <h3>Shipment Report</h3>

  <div id="company" class="clearfix" style="padding-right: 50px;">

    <div>Kanini Haraka Enterprises</div>
    <div>P.O Box 267,
    </div>
    <div>Mweiga, Nyeri</div>

    <div><a href="mailto:davin@gmail.com">davin@gmail.com"</a></div>
  </div>


</header>

<hr>

<table style="padding-top: 10px;">
        <thead>
        <tr>
		<th class="service">No</th>
          <th class="service">Order ID</th>
          <th class="service">Cust Name</th>
          <th class="desc">Address</th>
          <th class="desc">Allocated Driver</th>
		  <th class="desc">Delivery Status</th>
        </tr>
        </thead>
        <tbody>
        @php
          $i=0;
        @endphp
		@foreach ($shipments as $row )
@if($row->payment_status == "Approved")
          <tr>
            <td class="service">{{++$i}}</td>
            <td class="desc">{{$row->order_id}}</td>

            <td class="desc">{{$row->name}}</td>
            
            <td class="qty">{{$row->town}} <br> {{$row->postaladdress}}</td>
            <td class="unit">
			 @if($row->allocation_status == "Pending")Pending Allocation     
             @elseif($row->allocation_status == "Allocated")
             @foreach ($drivers as $driver ) 
             @if($driver->id==$row->driver_id)Driver Id:{{$driver->id}}<br>Name:{{$driver->name}}
             @endif
             @endforeach
             @endif
            </td>
            <td class="unit">
			@if($row->deliverystatus == "Pending")Pending     
             @elseif($row->deliverystatus == "Delivered")Delivered
             @endif
            </td>
        
          </tr>
		  @endif
@endforeach

        </tbody>
      </table>


	
</body>
</html>

