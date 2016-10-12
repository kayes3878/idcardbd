@extends('layouts.report')

@section('content')
<div class="container">

<!-- <img src="{{asset('/la-assets/img/reportbanner.png')}}" alt="Cold Storage" style="width:450px;height:auto; margin : 20px; padding-left: 100px;"> -->

<div class="modal-body">
	<div class="box-body">

            <!-- style="margin-rignt:80px" -->
					<table id="example1" class="table table-bordered" style="font-size:10px;" align="center">
					<thead>
						<tr class="success">
		                <th>Date</th>
		                <th>Item</th>
						<th>Category</th>		 
		              	<th>Amount</th>
		              	<th>Quantity</th>	
		              	<th>Total Amount</th>
		              	
						</tr>
									
					</thead>
						@foreach($jutemillinventorys as $jutemillinventory)

						<tr>
						<td>{{$jutemillinventory-> date}}</td>
						<td>{{$jutemillinventory-> item->item_name}}</td>
		                <td>{{$jutemillinventory-> itemcategory->category_name}}</td>

		             	<td>{{$jutemillinventory->total_quantity}}</td>
		             	<td>{{$jutemillinventory->number}}</td>
		             	<td>{{$jutemillinventory->total}}</td>
			
						</tr>
						@endforeach
									
						</table>
<!-- 
						<div style="margin:10px">					
						
						
						<div class="col-xs-12">
			            	<label>
			            		Total : {{$jutemillinventory->select('id,item_id') ->groupBy('item_categorie_id')->sum('total_quantity')}}

			            	</label>
			           
			            </div> 
			            	
						</div>	 -->			
						
</div>
</div>
</div>
@endsection
