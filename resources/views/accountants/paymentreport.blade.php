<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Payment Report</title>
  <style>
    @include('PDF.style')
  </style>
</head>
<body>
<header class="clearfix">
  <div id="logo">
    {{--<img src="logo.png">--}}
  </div>
  <h3>Payment Report</h3>

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
	
          <th class="service">Payment ID</th>
          <th class="service">Cust Name</th>
          <th class="desc">Address</th>
		  <th class="desc">Total Paid</th>
		  <th class="desc">Date Paid</th>
          <th class="desc">Payment Status</th>
        </tr>
        </thead>
        <tbody>
        @php
          $i=0;
        @endphp
		@foreach ($shipments as $row )
@if($row->payment_status == "Approved")
          <tr>
            
            <td class="desc">{{$row->payment_id}}</td>

            <td class="desc">{{$row->name}}</td>
            
            <td class="qty">{{$row->town}} <br> {{$row->postaladdress}}</td>
            <td class="unit">{{$row->totalexpected}}</td>
            <td class="unit">{{$row->created_at}}</td>
			<td class="unit">@if($row->payment_status == "Pending")Pending     
             @elseif($row->payment_status == "Approved")Approved
			 @elseif($row->payment_status == "Rejected")Rejected
             @endif</td>
          </tr>
		  @endif
@endforeach

        </tbody>
      </table>


	
</body>
</html>

