
@extends('layouts.report')

@section('content')
<div class="container">

<div class="modal-body">
	<div class="box-body">

	<table id="example1" class="table table-bordered" style="font-size:13px;">

		<thead>
			<tr class="success">
				<th>ID</th>
				<th>Receive No</th>
				<th>Receive Date</th>
				<th > Supplier </th>
				<th>Item</th>
				<th>Total Quantity</th>
				<th>Paid</th>
				<th>Issued By</th>
			</tr>

		</thead>

		<tbody>

			@foreach($jutereceives as $key => $jutereceive)

			<tr>
				
			<td>{{$jutereceive-> id}}</td>
			<td >{{$jutereceive-> jute_receive_no}}</td>
			<td>{{$jutereceive-> date_receive_jute}}</td>
			<td>
				<table>
					<tr>
						<td style="display:block";>Address : {{$jutereceive-> supplier->address}} </td>
						<td style="display:block";>Mobile : {{$jutereceive-> supplier->mobile}} </td>
						<td style="display:block";>Name : {{$jutereceive-> supplier->name}}</td>
					</tr>
				
				</table>
			</td>
			<td>{{$jutereceive-> item->item_name}}</td>
			<td>{{$jutereceive-> total_quantity}}</td>
			<td>{{$jutereceive-> is_bill_paid}}</td>
			<td>{{$jutereceive-> user->name}}</td>
		</tr>

			@endforeach

		</tbody>
	</table>
	</div>
	</div>
    
</div>
@endsection