<style type="text/css">
	table, td, th{
    /*border: 1px solid grey ;*/
     border: 2px solid rgba(179, 179, 179, .5);
    -webkit-background-clip: padding-box; /* for Safari */
    background-clip: padding-box;
}
</style>


@extends("la.layouts.app")

@section("contentheader_title", "Debitvouchers")
@section("contentheader_description", "debitvouchers listing")
@section("section", "Debitvouchers")
@section("sub_section", "Listing")
@section("htmlheader_title", "Debitvouchers Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Debitvoucher</button>
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
			<div class="modal-header modal-lg">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Debitvoucher</h4>
			</div>
			{!! Form::open(['action' => 'LA\DebitvouchersController@store', 'id' => 'debitvoucher-add-form']) !!}
			<div class="modal-body modal-lg">
				<div class="box-body">






                    
    		<div class="panel panel-default">
    			<div class="panel-body" >
<input value="{{ $xy->id }}" id="xy" type="hidden">
    				<div class="form-group row input-sm" style="column-gap:0px;" >
			            <div class="col-md-2">
				            <label class=" control-label text-right">Voucher No.</label>
				            <input type="button" onclick="voucher_g()">
			                <input type="text" class="form-control input-sm" name="voucher_no" id="voucher_no"  value="{{ old('voucher_no') }}{{ $voucher->voucher_no }}">
			            </div>
			            
			            <div class="col-md-2 ">
				            <label class=" control-label text-right">Date</label>
			                <input type="date" class="form-control input-sm" name="trans_date" id="trans_date" value="{{ old('trans_date') }}{{ $voucher->trans_date }}">
			            </div>
			            <div class="col-md-2">
			            	<label class=" control-label text-right">Payment Method</label>	
				            <select id="trans_method" class="form-control input-sm">
							      <option value="-1">--Select--
				            	@foreach ($items as $item)
							      <option value="{{ $item->id}}">{{  $item->method_tile }}</li>
	                    		@endforeach
				            </select>
			            </div>
			            
			            <div class="col-md-2 ">
				            <label class="control-label text-right">Voucher For</label>
				            <select type="text" id="voucher_for" class="form-control input-sm">
			            	@foreach ($acc_items as $item)
                         
						      <option value="{{ $item ->id }}">{{ $item ->account_title }}</li>
						    	
                    		@endforeach
			            </select>
			            </div>
			            
			            <div class="col-md-2">
			            	<label class="control-label text-right">Amount TK.</label>
		                  	<input type="text" class="form-control input-sm" name="debit_amt" id="debit_amt" value="{{ old('debit_amt') }}{{ $voucher->debit_amt }}">
		            	
		            	</div>
		            	<div class=" col-md-2">
		            	<label style="opacity: 0;">    ;ndvnbdvfndsvfnbsdv</label>
						    <input type="button" class="add btn btn-warning " id="add" onclick="add_row();" value="Add">
						</div>

			            <!-- <div class="col-md-3">
		              		<label class="control-label text-right">Pament A/C</label>		              
				            <select type="text" class="form-control">
							      <option value="">	
				            </select>
			            </div>  -->
		          	</div>

    		<!-- 	</div>
    		</div> -->

    		<!-- <div class="panel panel-default">
    			<div class="panel-body" > -->

    				

		          	<div class="form-group row input-sm">
		          		<div class="col-md-2">
		          			
		          		</div>
		          		<div class="col-md-12 text-center">
		          			<input type="hidden" value="0" id="detail_max_number" class="input-sm" name="detail_max_number">
			              <table class="table input-sm" id="data_table" >
						      <tr>
						        <th class="text-center input-sm" width='25'>Account No.</th>
						        <th class="text-center input-sm" width='25'>Account Title</th>
						        <th class="text-center input-sm" width='25'>Amount</th>
						        <th class="text-center input-sm" width='25'>Delete</th>
						      </tr>
						  </table>
						  
						</div>
						<label class="col-md-10 control-label text-right">Total amount</label>
			            <div class="col-md-2 text-right">
		                  <input type="text" class="form-control text-right input-sm" name="total_amt" id="total_amt" value="0{{ $voucher->total_amt }}">            
			            </div>
		          	</div>

		          	

    		<!-- 	</div>
    		</div> -->

    		<!-- <div class="panel panel-default">
    			<div class="panel-body" > -->

    				<div class="form-group row input-sm">
			            <div class="col-md-12">
		                    <label class="control-label text-right">Description</label>
		                    <textarea class="form-control input-sm" rows="3" id="trans_description" name="trans_description" value="{{ old('trans_description') }}{{ $voucher->trans_description }}"></textarea>
			            </div>
		          	</div>

		          	<div class="form-group row input-sm" style="column-gap:0px;">
			            <div class=" col-md-4 ">
							<label class=" control-label text-right input-sm">Approved BY</label>
							<input type="text" class="form-control input-sm" name="approved_by" value="{{ old('approved_by') }}{{ $voucher->approved_by }}">
						</div> 
						<div class="col-sm-4" style="background-color:lavenderblush;"></div>
			            <div class="col-md-4 ">
				            <label class=" control-label text-right input-sm">Approved Date</label>
			                <input type="date" class="form-control input-sm" name="approved_date" id="approved_date" value="{{ old('approved_date') }}{{ $voucher->approved_date}}">
			            </div>
		          	</div>


		          	<div class="modal-footer">
						<button type="button" class="btn btn-default input-sm" data-dismiss="modal">Close</button>
						{!! Form::submit( 'Submit', ['class'=>'btn btn-success ']) !!}
					</div>
			{!! Form::close() !!}

    			</div>
    		</div>
    		<p><input type="text" id="ww"></p>
    	
				</div>
			</div>
			
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
        ajax: "{{ url(config('laraadmin.adminRoute') . '/debitvoucher_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#debitvoucher-add-form").validate({
		
	});
});
</script>



<script type="text/javascript" >  

function add_row() 
{
	var debit_amt= $("#debit_amt").val();

if($.isNumeric(debit_amt))
{

	var account_no=$("#voucher_for").find(':selected').val();
	var account_title=$("#voucher_for").find(':selected').text();


	var table_len= Number($("#detail_max_number").val()) + 1;
	$("#detail_max_number").val(table_len);

	$("#data_table").append(	
	"<tr class='text-center' id='row"+table_len+"'>"+
	"<td width='25%' class='text-center input-sm'><input type='text' style='border:none;' class='text-center ' name='account_no["+table_len+"]' value='"+account_no+"' readonly></td>"+
	"<td width='25%' class='text-center input-sm'>"+account_title+"</td>"+
	"<td width='25%' class='text-center input-sm'id='age_row"+table_len+"'><input type='text' class='text-center detailamnt' style='border:none;' name='debit_amt["+table_len+"]' value='"+debit_amt+"' readonly></td>"+
	"<td width='25%' class='text-center input-sm'>"+	
	"<input type='button' value='Delete' class='delete btn btn-danger input-sm' onclick='delete_row("+table_len+")'>"+
	"</td></tr>"
	);	
	calculateTotalAmount();
}
else
{
	alert("Please give numeric value for debit amount.");
}
}


function calculateTotalAmount()
{

	var totalAmnt = 0;

	$(".detailamnt").each(function()	
	{
		totalAmnt += Number($(this).val());
	});
	$("#total_amt").val(totalAmnt);
}

	function delete_row(no)
	{	
		document.getElementById("row"+no+"").outerHTML="";
		calculateTotalAmount();
	}




	function voucher_g()
	{
		// var v_id = document.getElementById('').innerHTML;
		// alert(v_id);
		var p = document.getElementById("xy").value;
		// alert(p);
		// document.getElementById("voucher_no").innerHTML= p;
		// document.getElementById("ww").innerHTML = "p";
		var q = +p + +1;
		document.getElementById("voucher_no").value = "D"+"00"+q;

	}

</script>


@endpush