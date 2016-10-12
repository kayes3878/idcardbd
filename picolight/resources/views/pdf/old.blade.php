 
<!DOCTYPE html> 
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>PDF Report</title>

	<style type="text/css">

	/*@font-face {
	  font-family: 'siyamrupali';
	  font-style: normal;
	  /*font-weight: 100%;*/
	  /*font-size: x-small;*/
	  /*src: url(https://www.omicronlab.com/download/fonts/AdorshoLipi_20-07-2007.ttf);
	  format('truetype');*/


	#main{
		width:100%;
		padding:5px 10px 5px 10px;
		margin:3px 10px 0 0
		-webkit-border-radius: 5px; 
	    -moz-border-radius: 5px; 
		overflow: hidden;
		border-radius: 5px; 
		border:thin #333 solid;
	}

	#sub{
		width: auto;
		margin: 0 auto;
		border: none;
		overflow: hidden;
	}

	th{
		height: 30px;
		font-size:15px;
		text-align: center;
		background-color:rgb(0, 163, 136);
    	color: white;
	}

	#maintr:nth-child(even){

			
		text-align: center;
		background-color: #f2f2f2;
		overflow: hidden;
	}

	#subtr{

		border: none;
		text-align: center;
		overflow: hidden;
	}

	body {
	margin:0px;
	overflow: hidden;
	text-decoration:none;
	font-size:11px;
	border-bottom:medium #000 solid;

	}

	td{

		border-bottom-color: rgb(221, 221, 221);
		border-bottom-style: solid;
		border-bottom-width: 1px;
		border-collapse: collapse;
		border-image-outset: 0 0 0 0;
		border-image-repeat: stretch stretch;
		border-image-slice: 100% 100% 100% 100%;
		border-image-source: none;
		border-image-width: 1 1 1 1;
		border-left-color: rgb(221, 221, 221);
		border-left-style: solid;
		border-left-width: 1px;
		border-right-color: rgb(221, 221, 221);
		border-right-style: solid;
		border-right-width: 1px;
		border-top-color: rgb(221, 221, 221);
		border-top-style: solid;
		border-top-width: 0px;
		text-align: center;
	}

	</style>

</head>

<body>

<img src="{{asset('/la-assets/img/reportbanner.png')}}" alt="Cold Storage" style="width:450px;height:auto; margin : 20px; padding-left: 100px;">

<table id="main">

	<thead>
		<tr id="headtr">
			<th>ID</th>
			<th>Receive No</th>
			<th>Receive Date</th>
			<th > Supplier </th>
			<!-- <th>Item</th> -->
			<th>Total Quantity</th>
			<th>Paid</th>
			<th>Issued By</th>
		</tr>

	</thead>

	<tbody>

		@foreach($jutereceives as $key => $jutereceive)

		<tr id="maintr">
			
			<td>{{$jutereceive-> id}}</td>
			<td >{{$jutereceive-> jute_receive_no}}</td>
			<td>{{$jutereceive-> date_receive_jute}}</td>
			<td>
				<table id="sub">
					<tr id="subtr">
						<td style="display:block";>Address : {{$jutereceive-> supplier->address}} </td>
						<td style="display:block";>Mobile : {{$jutereceive-> supplier->mobile}} </td>
						<td style="display:block";>Name : {{$jutereceive-> supplier->name}}</td>
					</tr>
				
				</table>
			</td>
			<!-- <td>{{$jutereceive-> item->item_name}}</td> -->
			<td>{{$jutereceive-> total_quantity}}</td>
			<td>{{$jutereceive-> is_bill_paid}}</td>
			<td>{{$jutereceive-> user->name}}</td>
		</tr>

		@endforeach

	</tbody>
</table>
</body>

</html> 
