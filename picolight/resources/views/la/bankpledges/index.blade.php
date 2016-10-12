@extends("la.layouts.app")

@section("contentheader_title", "BankPledges")
@section("contentheader_description", "bankpledges listing")
@section("section", "BankPledges")
@section("sub_section", "Listing")
@section("htmlheader_title", "BankPledges Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add BankPledge</button>
@endsection

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Bank Pledge</h4>
			</div>
			{!! Form::open(['action' => 'LA\BankPledgesController@store', 'id' => 'bankpledge-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    <div class="form-group">
                    <label for="date_pledge">Date :</label>
                    <div class="input-group date">
                    <input class="form-control valid" placeholder="Enter Date" name="date_pledge" type="text" value="" aria-invalid="false"><span class="input-group-addon"><span class="fa fa-calendar"></span></span></div></div>

                    <div class="form-group row input-sm">
						<?php $i = 0; ?>

		          		<div class="wall col-md-2">
		          			
		          		</div>
		          		<div class="col-md-12 text-center">
			              <table class="table table-bordered"" id="data_table" >
						      <tr class="info">
						        <th class="text-left input-sm" style="display:none;">item_id</th>
						        <th class="text-left input-sm" style="display:none;">item_categorie_id</th>
						        <th class="text-left input-sm">Item Categorie Name</th>
						        <th class="text-left input-sm" >Jute Receive Id</th>
						        <th class="text-left input-sm" >Unit Type (Bundle)</th>
						        <th class="text-left input-sm" >Sub Unit Type(KG)</th>
						        <th class="text-left input-sm" >quantity (Bundle)</th>
						        <th class="text-left input-sm" >Sub Unit Quantity(KG)</th>
						        <th class="text-left input-sm" >Stock In Hand</th>
						        <th class="text-left input-sm" ></th>
						        <th class="text-left input-sm" >Delete</th>
								</tr>

						      	@foreach ($jutereceives as $receive)
								<?php $i ++; ?>
							       	<tr id='row{{$i}}'>
							        <td class="text-left input-sm" style="display:none;">
		                  			<input type="text" class="form-control text-right input-sm" style='border:none;' name="item_id[{{$i}}]" id="item_categorie_id[{{$i}}]" value='{{$receive-> item_id}}' readonly></td>
							        <td class="text-left input-sm" style="display:none;">
		                  			<input type="text" class="form-control text-right input-sm" style='border:none;' name="item_categorie_id[{{$i}}]" id="item_categorie_id[{{$i}}]" value='{{$receive-> itemcategorie_id}}' readonly></td>
							        <td class="text-left input-sm">
		                  			<input type="text" class="form-control text-right input-sm" style='border:none;' name="item_categorie_name[{{$i}}]" id="item_categorie_name[{{$i}}]" value='{{$receive-> itemcategory->category_name}}' readonly></td>
							        <td class="text-left input-sm" >
		                  			<input type="text" class="form-control text-right input-sm" style='border:none;' name="jute_receive_id[{{$i}}]" id="jute_receive_id[{{$i}}]" value='{{$receive->id}}' readonly></td>
							        <td class="text-left input-sm" >
		                  			<input type="text" class="form-control text-right input-sm" style='border:none;' name="unit_type[{{$i}}]" id="unit_type[{{$i}}]" value='{{$receive->unit_type}}' readonly></td>
							        <td class="text-left input-sm" >
		                  			<input type="text" class="form-control text-right input-sm" style='border:none;' name="sub_unit_type[{{$i}}]" id="sub_unit_type[{{$i}}]" value='{{$receive->sub_unit_type}}' readonly></td>
							        <td class="text-left input-sm" > 
		                  			<input type="text" class="form-control text-right detailquantity input-sm" style='border:none;' name="quantity[{{$i}}]" id="quantity[{{$i}}]" value='{{$receive->quantity}}' readonly></td>
							        <td class="text-left input-sm" >
		                  			<input type="text" class="form-control text-right detailamnt input-sm" style='border:none;' name="sub_unit_quantity[{{$i}}]" id="sub_unit_quantity[{{$i}}]" value='{{$receive->sub_unit_quantity}}' readonly></td>
							        <td class="text-left input-sm" >
		                  			<input type="text" class="form-control text-right totalstockinhand input-sm" style='border:none;' name="stock_in_hand[{{$i}}]" id="stock_in_hand[{{$i}}]" value='{{$receive->sub_unit_quantity}}' readonly></td>
		                  			<td class="text-left input-sm" >
		                  			<input  type="checkbox" id="checkbox{{$i}}" name="checkbox{{$i}}" onclick='check({{$i}})'  value="1" > </td>
							        <td class="text-left input-sm" >
									<input type='button' value='Delete' class='delete btn btn-danger input-sm ' onclick='delete_row({{$i}})'>
							        </td>
							      	</tr>
								@endforeach
						      

								<tfoot>
								<tr class="">
						        <td class="text-left input-sm" style="display:none;">item_id</td>
						        <td class="text-left input-sm" style="display:none;">item_categorie_id</td>
						        <td class="text-left input-sm"></td>
						        <td class="text-left input-sm" ></td>
						        <td class="text-left input-sm" ></td>
						        <td class="text-left input-sm" >Total</td>
						        <td class="text-left input-sm" >
		                  		<input type="text" class="form-control text-right input-sm" style='border:none;' name="t_quantity" id="t_quantity" value="0" readonly></td>
						        <td class="text-left input-sm" >
		                  		<input type="text" class="form-control text-right input-sm" style='border:none;' name="totalsub_unit_quantity" id="totalsub_unit_quantity" value="0" readonly></td>
						        <td class="text-left input-sm" >
		                  		<input type="text" class="form-control text-right input-sm" style='border:none;' name="total_stock_in_hand" id="total_stock_in_hand" value="0" readonly></td>
						        <td class="text-left input-sm" ></td>
						        <td class="text-left input-sm" ></td>
						      </tr>
							  </tfoot>
						  </table>
		          			<input type="hidden" value='{{$i}}' id="detail_max_number" class="input-sm" name="detail_max_number">
						  
						</div>
						<!-- <label class="col-md-10 control-label text-right">Total amount</label>
			            <div class="col-md-2 text-right">
		                  <input type="text" class="form-control text-right input-sm" name="total_amt" id="total_amt" value="0">            
			            </div> -->

		          	</div>
                    <!-- @la_form($module) -->
					
					{{--
					@la_input($module, 'bankpledge_no')
					@la_input($module, 'date_pledge')
					@la_input($module, 'item_id')
					@la_input($module, 'item_categorie_id')
					@la_input($module, 'jute_receive_id')
					@la_input($module, 'jute_receive')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_unit_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'pledge_status')
					@la_input($module, 'returned_date')
					@la_input($module, 'user_id')
					@la_input($module, 'stock_in_hand')
					--}}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/bankpledge_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#bankpledge-add-form").validate({
		
	});
});
</script>

<script type="text/javascript" >  
	// var table_len= Number($("#detail_max_number").val()) -1;
	// 	$("#detail_max_number").val(table_len);
calculateTotalAmount();
function check(i)
{	
	if ($('#checkbox'+i+'').val()== 0) {
		$('#checkbox'+i+'').val(1);
    	// alert($('#checkbox'+i+'').val())
	}
	else{
		$('#checkbox'+i+'').val(0)
    	// alert($('#checkbox'+i+'').val())
	}


	// $('#checkbox'+i+'').click(function() {
 //  	if ($(this).is(':checked')) {
 //  		$('#checkbox'+i+'').val(1);
 //    alert($('#checkbox'+i+'').val())
 //  	}
 //  	if ($(this).is(':unchecked')) {
 //  		$('#checkbox'+i+'').val(0);

 //    alert($('#checkbox'+i+'').val())
 //  	}
	// });
	
}


function delete_row(no)
{	
	document.getElementById("row"+no+"").outerHTML="";
	calculateTotalAmount()
	
}
// function checkClick(no)
// {	
// 	document.getElementById("row"+no+"").outerHTML="";
// 	calculateTotalAmount()
	
// }
function calculateTotalAmount()
{

	var totalsub_unit_quantity = 0;

	$(".detailamnt").each(function()	
	{
		totalsub_unit_quantity += Number($(this).val());
	});
	$("#totalsub_unit_quantity").val(totalsub_unit_quantity);

	var detailquantity = 0;

	$(".detailquantity").each(function()	
	{
		detailquantity += Number($(this).val());
	});
	$("#t_quantity").val(detailquantity);

	var totalstockinhand = 0;

	$(".totalstockinhand").each(function()	
	{
		totalstockinhand += Number($(this).val());
	});
	$("#total_stock_in_hand").val(totalstockinhand);
}


</script>
@endpush