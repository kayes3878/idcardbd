


@extends("la.layouts.app")

@section("contentheader_title", "Journalvouchers")
@section("contentheader_description", "journalvouchers listing")
@section("section", "Journalvouchers")
@section("sub_section", "Listing")
@section("htmlheader_title", "Journalvouchers Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Journalvoucher</button>
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
				<h4 class="modal-title" id="myModalLabel">Add Journalvoucher</h4>
			</div>
			{!! Form::open(['action' => 'LA\JournalvouchersController@store', 'id' => 'journalvoucher-add-form']) !!}
			<div class="modal-body modal-lg">
				<div class="box-body">






                    
    		<div class="panel panel-default">
    			<div class="panel-body" >

    				<div class="form-group row " >
			            <div class="col-md-2">
		              		<label class=" control-label text-right">Voucher No.</label>
		                  	<input type="text" class="form-control" name="voucher_no" id="voucher_no" value="{{ old('voucher_no') }}{{ $voucher->voucher_no }}">
			            </div>
			            
			            <div class="col-md-2">
			            	<label class=" control-label text-right">Date</label>
		                  	<!-- <input type="date" class="form-control" name="trans_date" data-behavior="datepicker" id="trans_date" value="{{ old('trans_date') }}{{ $voucher->trans_date }}"> -->
			            	<input class="date form-control" name="trans_date" id="trans_date" type="text">
			            </div>
			            <!-- <div class="col-md-2">
			            	<label class="control-label text-right">Received From</label>
				            <select type="text" id="voucher_for" class="form-control">
						      <option value="">
			            	</select>
			            </div> -->
			            <div class="col-md-2 ">
				            <label class="control-label text-right">Received From</label>
				            <select type="text" id="voucher_for" class="form-control ">
				            	@foreach ($acc_items as $item)
							      	<option value="{{ $item ->account_no }}">{{ $item ->account_title }}</li>
	                    		@endforeach
			            	</select>
			            </div>
			            <div class="col-md-2">
			            	<label class="control-label text-right">Type</label>
			                <select type="text" id="debit_credit" class="form-control">
							      <option value="Debit">Debit
							      <option value="Credit">Credit
				            </select>
		            	</div>
		            	<div class="col-md-2">
		            		<label class="control-label text-right">Amount TK.</label>
		                  	<input type="text" class="form-control" name="debit_amt" id="debit_amt" value="{{ old('debit_amt') }}{{ $voucher->debit_amt }}">
		            	</div>
		            	<div class=" col-md-2">
		            		<label style="opacity: 0;">    ;ndvnbdvfndsvfnbsdv</label>
						    <input type="button" class="add btn btn-warning control-label" id="add" onclick="add_row();" value="Add">
						</div> 
		          	</div>

		          	<!-- <div id="hidden_div_CollectionMethod" class="form-group row">
		              <label class="col-md-2 control-label text-right">Collection Method</label>		              
			            <div class="col-md-2">
				            <select id="trans_method" class="form-control">
							      <option value="-1">--Select--
				            	
							      <option value="">
	                    		
				            </select>
			            </div>			        
		              <label class="col-md-2 control-label text-right">Received A/C</label>		              
			            <div class="col-md-2">
			            <select type="text" class="form-control">
			            	                        
						      <option value="">		
                    		
			            </select>
			            </div>                  
		          	</div> -->
    			</div>
    		</div>

    		<div class="panel panel-default">
    			<div class="panel-body" >
    				<!-- <div class="form-group row">
		                <label class="control-label text-right">Received From</label>
			            <div class="col-md-2">
			            <select type="text" id="voucher_for" class="form-control">
						      <option value="">
			            </select>
			            </div>
			            <label class="col-md-2 control-label text-right">Amount TK.</label>
			            <div class="col-md-2">
		                  	<input type="text" class="form-control" name="debit_amt" id="debit_amt" value="">
		            	</div> 
		            	
		            	<div class="row text-right col-md-2">
						      	<input type="button" class="add btn btn-warning control-label" id="add" onclick="add_row();" value="Add">
						</div>
			    		            
		    		</div> -->

		          	<div class="form-group row">
		          		<div class="col-md-2">
		          			
		          		</div>
		          		<div class="col-md-12 trxt-center">
		          			<input type="hidden" value="0" id="detail_max_number" name="detail_max_number">
			              <table class="table" id="data_table">
						      <tr>
						        <th class="text-center" >Account No.</th>
						        <th class="text-center">Account Title</th>
						        <th class="text-center">Debit</th>
						        <th class="text-center">Credit</th>
						        <th class="text-center">Delete</th>
						      </tr>
						  </table>
						  
						</div>
						<label class="col-md-10 control-label text-right">Total Debit amount</label>
			            <div class="col-md-2 text-right">
		                  <span id="tdebit_amt">0</span>
			            </div>
			            <label class="col-md-10 control-label text-right">Total Credit amount</label>
			            <div class="col-md-2 text-right">
		                  <span id="tcredit_amt" >0</span>
			            </div>
		          	</div>

		          	

    			</div>
    		</div>

    		<div class="panel panel-default">
    			<div class="panel-body" >

    				<div class="form-group row">
		              
			            <div class="col-md-12">
			            	<label class="control-label text-right">Description</label>
		                  	<textarea class="form-control" rows="3" id="trans_description" name="trans_description" value="{{ old('trans_description') }}{{ $voucher->trans_description }}"></textarea>
		                  
			            </div>
		          	</div>

		          	

		          	<div class="form-group row">
			            <div class=" col-md-4">
			            	<label class=" control-label text-right">Approved BY</label>
						    <input type="text" class="form-control" name="approved_by" value="{{ old('approved_by') }}{{ $voucher->approved_by }}">
						</div> 
						<div class="col-sm-4" style="background-color:lavenderblush;"></div>
			            <div class="col-md-4">
			            	<label class="control-label text-right">Approve Date</label>
		                  	<input type="date" class="form-control" name="approved_date" value="{{ old('approved_date') }}{{ $voucher->approved_date}}"> 
			            </div>
		          	</div>

    			</div>
    		</div>
    		
		          	<div class="modal-footer">
						<button type="button" class="btn btn-default input-sm" data-dismiss="modal">Close</button>
						{!! Form::submit( 'Submit', ['class'=>'btn btn-success ']) !!}
					</div>
			{!! Form::close() !!}

    			</div>
    		</div>
    		
    	
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
        ajax: "{{ url(config('laraadmin.adminRoute') . '/journalvoucher_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#journalvoucher-add-form").validate({
		
	});
});
</script>


<script type="text/javascript" >  
    document.getElementById("hidden_div_CollectionMethod").style.display= "none";

function add_row() 
{
	var debit_credit=$("#debit_credit").find(':selected').val();
	
	if (debit_credit == "Debit") {
		var debit_amt= $("#debit_amt").val();
		var credit_amt= 0;
	}
	else
	{
		var debit_amt= 0;
		var credit_amt= $("#debit_amt").val();
	}
	

if($.isNumeric($("#debit_amt").val()))
{

	var account_no=$("#voucher_for").find(':selected').val();
	var account_title=$("#voucher_for").find(':selected').text();



	var table_len= Number($("#detail_max_number").val()) + 1;
	$("#detail_max_number").val(table_len);

	$("#data_table").append(	
	"<tr class='text-center' id='row"+table_len+"'>"+
	"<td class='text-center'><input type='text' style='border:none;' class='text-center ' name='account_no["+table_len+"]' value='"+account_no+"' readonly></td>"+
	"<td>"+account_title+"</td>"+
	"<td id='age_row"+table_len+"'><input type='text' class='text-center debitamnt' style='border:none;' name='debit_amt["+table_len+"]' value='"+debit_amt+"' readonly></td>"+
	// "<td>"+
	"<td id='age_row2"+table_len+"'><input type='text' class='text-center creditamnt' style='border:none;' name='credit_amt["+table_len+"]' value='"+credit_amt+"' readonly></td>"+
	"<td>"+
	
	"<input type='button' value='Delete' class='delete btn btn-danger' onclick='delete_row("+table_len+")'>"+
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

	var totaldebitAmnt = 0;

	$(".debitamnt").each(function()	
	{
		totaldebitAmnt += Number($(this).val());
	});
	$("#tdebit_amt").text(totaldebitAmnt);

	var totalcreditAmnt = 0;

	$(".creditamnt").each(function()	
	{
		totalcreditAmnt += Number($(this).val());
	});
	$("#tcredit_amt").text(totalcreditAmnt);

}

function delete_row(no)
{	
	document.getElementById("row"+no+"").outerHTML="";
	calculateTotalAmount();
}


</script>

<script type="text/javascript">
    $('.date').datepicker({
       format: 'dd-mm-yyyy'
     });
</script>

@endpush