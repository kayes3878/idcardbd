@extends("la.layouts.app")

@section("contentheader_title", "Jute Receives")
@section("contentheader_description", "jute receives listing")
@section("section", "JuteReceives")
@section("sub_section", "Listing")
@section("htmlheader_title", "Jute Receives Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Jute Receive</button>
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
				<h4 class="modal-title" id="myModalLabel">Add Jute Receive</h4>
			</div>
			{!! Form::open(['action' => 'LA\JuteReceivesController@store', 'id' => 'jutereceife-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
			<div class="panel panel-default">
				<div class="panel-body" >
                    <!-- @la_form($module) -->
					<div  >

						<div class="form-group col-xs-6">
							<label for="supplier_id">Supplier* :</label>
							<select  class="form-control select2-hidden-accessible " required="1" data-placeholder="Enter Supplier"
							rel="select2" id="supplier_id" name="supplier_id" tabindex="-1" aria-hidden="true" aria-required="true">
							 @foreach ($jmSuppliers as $supplier)
							<option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        	@endforeach
							<!-- <option value="1">Md Karim</option>
							<option value="2">Md amin</option>
							 -->
							</select>
							
						</div>
						 
					 
					</div>
					<div class="form-group col-xs-12">
					 
						<div class="form-group col-xs-2">
						<label for="item_id">Item* :</label>
						<select class="form-control select2-hidden-accessible" required="1" data-placeholder="Enter Item" rel="select2" name="item_id" id="item_id" tabindex="-1" aria-hidden="true" aria-required="true">
						
						<option >Select</option>
						<option value="1">Jute</option>
						<option value="2">Oil</option>
						</select>
						 
						</div>	


						<div class="form-group col-xs-2">
						<label for="item_categorie_id">Categorie* :</label>
						<select class="form-control select2-hidden-accessible" required="1" data-placeholder="Enter Categorie" rel="select2" name="item_categorie_id" id="item_categorie_id" tabindex="-1" aria-hidden="true" aria-required="true">
						
						</select>
						
						</div> 
						<!-- <div class="form-group  col-xs-2">
						<label for="sub_unit_type_m">sub_unit_type* :</label>
						<input class="form-control valid" placeholder="Enter Unit" required="1" name="unit" type="number" value="0" aria-required="true" aria-invalid="false">
						</div>
						

						<div class="form-group  col-xs-2">
						<label for="unit1">Unit* :</label>
						<input class="form-control valid" placeholder="Enter Unit" required="1" name="" type="number" value="0" aria-required="true" aria-invalid="false">
						</div> -->
						

						<div class="form-group col-xs-2">
							<label for="add_btn"  style="opacity: 0;">Add Button* :</label>
						    <input aria-hidden="true" aria-required="true" type="button" name="add_btn" class="add btn btn-warning " id="add" onclick="add_row();" value="Add">
							<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
						</div>
					</div>
					
					<div class="form-group row input-sm">
		          		<div class="wall col-md-2">
		          			
		          		</div>
		          		<div class="col-md-12 text-center">
		          			<input type="hidden" value="0" id="detail_max_number" class="input-sm" name="detail_max_number">
			              <table class="table table-bordered"" id="data_table" >
						      <tr class="info">
						        <th class="text-left input-sm" style="display:none;">item_id</th>
						        <th class="text-left input-sm" style="display:none;">item_categorie_id</th>
						        <th class="text-left input-sm" >Jute</th>
						        <th class="text-left input-sm" style="display:none;">unit_type(Bundle)</th>
						        <th class="text-left input-sm" style="display:none;">Sub Unit Type (KG)</th>
						        <th class="text-left input-sm" >Quantity (Bundle)</th>
						        <th class="text-left input-sm" >Sub Quantity (KG)</th>
						        <!-- <th class="text-left input-sm" >Total Quantity</th> -->
						        <th class="text-left input-sm" >Delete</th>
						      </tr>
						      <!--  <tr >
						        <td class="text-left input-sm" style="display:none;">
						        	<input type='text' style='border:none;' class='text-center ' name='item_categorie_id' value='1' readonly></td>td> 
					        	<td class="text-left input-sm" >
						        	<input type='text' style='border:none;' class='text-center ' name='item_categorie_name' value='1' readonly></td>td>
						        <td class="text-left input-sm" >
						        	<input type='text' style='border:none;' class='text-center ' name='unit_type' value='BUndle' readonly></td>
						        <td class="text-left input-sm" >
						        	<input type='text' style='border:none;' class='text-center ' name='sub_unit_type' value='KG' ></td>
						        <td class="text-left input-sm" >
						        	<input type='text' class='text-right ' name='quantity' value='' ></td>
						        <td class="text-left input-sm" >
						        	<input type='text' class='text-right ' name='sub_unit_quantity' value='' ></td>
						        <td class="text-left input-sm" >
						        	<input type='text'  class='text-right ' name='total_quantity' value='' ></td>
						        <td class="text-left input-sm" >
						        	<input type='button' value='' class='delete btn btn-danger input-sm ' onclick='delete_row()'>
						        </td>
						      </tr> -->
								<tfoot>
								<tr class="">
						        <td class="text-left input-sm" style="display:none;">item_id</td>
						        <td class="text-left input-sm" style="display:none;">item_categorie_id</td>
						        <td class="text-left input-sm" style="display:none;"></td>
						        <td class="text-left input-sm" style="display:none;">unit_type</td>
						        <td class="text-right input-sm" >Total</td>
						        <td class="text-left input-sm" >
		                  		<input type="text" class="form-control text-right input-sm" style='border:none;' name="t_quantity" id="t_quantity" value="0" readonly></td>
						        <td class="text-left input-sm" >
		                  		<input type="text" class="form-control text-right input-sm" style='border:none;' name="total_sub_qnt" id="total_sub_qnt" value="0" readonly></td>
						        <!-- <td class="text-left input-sm" >
		                  		<input type="text" class="form-control text-right input-sm" style='border:none;' name="total_qnt" id="total_qnt" value="0" readonly></td> -->
						        <td class="text-left input-sm" ></td>
						      </tr>
							  </tfoot>
						  </table>
						  
						</div>
						<!-- <label class="col-md-10 control-label text-right">Total amount</label>
			            <div class="col-md-2 text-right">
		                  <input type="text" class="form-control text-right input-sm" name="total_amt" id="total_amt" value="0">            
			            </div> -->

		          	</div>
					 
							 
					 
					

					{{--
					@la_input($module, 'jute_receive_no')
					@la_input($module, 'date_receive_jute')
					@la_input($module, 'supplier_id')
					@la_input($module, 'item_id')
					@la_input($module, 'item_categorie_id')
					@la_input($module, 'item_categorie')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_unit_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'is_bank_paedge')
					@la_input($module, 'is_bill_paid')
					@la_input($module, 'user_id')
					--}}
					
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
					</div>
					{!! Form::close() !!}
					</div>

				</div>
			</div>
		</div>


		</div>
	</div>
<div class="pdf">

	<!-- <a href="{{ url(config('laraadmin.adminRoute') .'/htmltopdfview', ['download'=>'pdf'] )}}">Download PDF</a>
 -->	
	 
	 <a href="{{URL:: to('getreportPDF') }}">Download PDF</a>

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
        ajax: "{{ url(config('laraadmin.adminRoute') . '/jutereceife_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#jutereceife-add-form").validate({
		
	});
});
</script>


<script type="text/javascript" >
  
$(document).ready(function(){
     $("#item_id").change(function(){
         var itemid = $('#item_id').val();
             $(item_categorie_id).find("option").remove();
        	 $.get("{{ url(config('laraadmin.adminRoute') . '/jute_sub_item') }}" + '/' + itemid, function (data) {
 
            console.log(data);
             $.each(data, function(key, value) {
            $("#item_categorie_id").append("<option value="+value.id+">" + value.category_name +"</option>");
            });

            })
    });
});
</script>
<script type="text/javascript" >  

function add_row() 
{

	var item_categorie=$("#item_categorie_id").find(':selected').val();
	var item_categorie_title=$("#item_categorie_id").find(':selected').text();
	var item=$("#item_id").find(':selected').val();
	// alert(item);


	var table_len= Number($("#detail_max_number").val()) + 1;
	$("#detail_max_number").val(table_len);

	$("#data_table").append(	

	"<tr id='row"+table_len+"'>"+
	"<td class='text-left input-sm' style='display:none;'>"+
	"<input type='text' style='border:none;' class='text-center ' name='item_id["+table_len+"]' value='"+item+"' readonly></td>"+
	"<td class='text-left input-sm' style='display:none;'>"+
	"<input type='text' style='border:none;'  class='text-center ' name='item_categorie_id["+table_len+"]' value='"+item_categorie+"' readonly></td>"+
	"<td class='text-left input-sm' >"+
	"<input type='text' style='border:none;' class='text-left ' name='item_categorie_name["+table_len+"]' value='"+item_categorie_title+"' readonly></td>"+
	"<td class='text-left input-sm' style='display:none;'>"+
	"<input type='text' style='border:none;' class='text-center ' name='unit_type["+table_len+"]' value='1' readonly></td>"+
	"<td class='text-left input-sm'  style='display:none;'>"+
	"<input type='text' style='border:none;' class='text-center ' name='sub_unit_type["+table_len+"]' value='1' ></td>"+
	"<td class='text-left input-sm' >"+
	"<input type='text' class='text-right detailamnt' onkeyup='myCellChange("+table_len+")' name='quantity["+table_len+"]' id='quantity["+table_len+"]' value='0' ></td>"+
	"<td class='text-left input-sm' >"+
	"<input type='text' class='text-right detailamntsubq' onkeyup='myCellChange("+table_len+")' name='sub_unit_quantity["+table_len+"]' id='sub_unit_quantity["+table_len+"]' value='0' ></td>"+
	// "<td class='text-left input-sm' >"+
	// "<input type='text'  class='text-right detailamnttotal' name='total_quantity["+table_len+"]' id='total_quantity["+table_len+"]' value='0' ></td>"+
	"<td class='text-left input-sm' >"+
	"<input type='button' value='Delete' class='delete btn btn-danger input-sm ' onclick='delete_row("+table_len+")'>"+
	"</td>"+
	"</tr>"

	);	

	      	calculateTotalAmount();

// 	var debit_amt= $("#debit_amt").val();

// if($.isNumeric(debit_amt))
// {

// 	var account_no=$("#voucher_for").find(':selected').val();
// 	var account_title=$("#voucher_for").find(':selected').text();


// 	var table_len= Number($("#detail_max_number").val()) + 1;
// 	$("#detail_max_number").val(table_len);

// 	$("#data_table").append(	
// 	"<tr class='text-center' id='row"+table_len+"'>"+
// 	"<td width='25%' class='text-center input-sm'><input type='text' style='border:none;' class='text-center ' name='account_no["+table_len+"]' value='"+account_no+"' readonly></td>"+
// 	"<td width='25%' class='text-center input-sm'>"+account_title+"</td>"+
// 	"<td width='25%' class='text-center input-sm'id='age_row"+table_len+"'><input type='text' class='text-center detailamnt' style='border:none;' name='debit_amt["+table_len+"]' value='"+debit_amt+"' readonly></td>"+
// 	"<td width='25%' class='text-center input-sm'>"+	
// 	"<input type='button' value='Delete' class='delete btn btn-danger input-sm' onclick='delete_row("+table_len+")'>"+
// 	"</td></tr>"
// 	);	
// 	calculateTotalAmount();
// }
// else
// {
// 	alert("Please give numeric value for debit amount.");
// }
}
function myCellChange(indexno) {
	// var quantityBoxname = all.getAttribute('name');
	// var subQuantyTextBoxName = quantityBoxname.replace(/quantity/i, "sub_unit_quantity")
	var quantity = document.getElementById("quantity["+indexno+"]").value;
 	var subQuanty = document.getElementById("sub_unit_quantity["+indexno+"]").value;
 	if($.isNumeric(quantity) && $.isNumeric(subQuanty))
	{
		// var total = quantity*subQuanty;
		// document.getElementById("total_quantity["+indexno+"]").value = total;
 
    calculateTotalAmount();
    }
	else
	{
		alert("Please give numeric value for debit amount.");
	}
}

function calculateTotalAmount()
{

	var t_quantity = 0;

	$(".detailamnt").each(function()	
	{
		t_quantity += Number($(this).val());
	});
	$("#t_quantity").val(t_quantity);

	var total_sub_qnt = 0;

	$(".detailamntsubq").each(function()	
	{
		total_sub_qnt += Number($(this).val());
	});
	$("#total_sub_qnt").val(total_sub_qnt);

	// var total_qnt = 0;

	// $(".detailamnttotal").each(function()	
	// {
	// 	total_qnt += Number($(this).val());
	// });
	// $("#total_qnt").val(total_qnt);
}

	function delete_row(no)
	{	
		document.getElementById("row"+no+"").outerHTML="";
		calculateTotalAmount();
	}


</script>
@endpush