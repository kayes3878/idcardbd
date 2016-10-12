@extends('layouts.report')

@section('content')
<div class="container">

<!-- <img src="{{asset('/la-assets/img/reportbanner.png')}}" alt="Cold Storage" style="width:450px;height:auto; margin : 20px; padding-left: 100px;"> -->

<div class="modal-body">
	<div class="box-body">

            <!-- style="margin-rignt:80px" -->
					<table id="example1" class="table table-bordered" style="font-size:13px;" align="center">
					<thead>
						<tr class="success">
		                <th>Date</th>
						<th>Category</th>		 
		                <th>Quantity (Bundle)</th>
		                <th>Sub Unit Quantity (KG)</th>
		                <th >Total</th>
								    <!-- <th>Total Quantity</th> -->
						</tr>
									
					</thead>
						@foreach($bankpledges as $bankpledge)

						<tr>
						<td>{{$bankpledge-> date_pledge}}</td>
		                <td>{{$bankpledge-> itemcategory->category_name}}</td>
		                <td>{{$bankpledge-> quantity}}</td>
		                <td>{{$bankpledge-> sub_unit_quantity}}</td>
						<td>{{$bankpledge-> total_quantity}}</td>
						</tr>
						@endforeach
									
						</table>

</div>
</div>
</div>
@endsection
