@extends("la.layouts.app")

@section("contentheader_title", "Acc_accounts")
@section("contentheader_description", "acc_accounts listing")
@section("section", "Acc_accounts")
@section("sub_section", "Listing")
@section("htmlheader_title", "Acc_accounts Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Acc_account</button>
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

<!-- <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Acc_account</h4>
			</div> -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header modal-lg">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Acc_account</h4>
			</div>
			{!! Form::open(['action' => 'LA\Acc_accountsController@store', 'id' => 'acc_account-add-form']) !!}
			<div class="modal-body">
        <div class="box-body">

            
            <div class=" row form-group">
                <div class="col-md-2">
	                <label>Account Title* :</label>
	                <select type="text" id="acc_title" onChange="item();" class="form-control ">
	                		<option value="">select
		            	@foreach ($acc_items as $item)
					      	<option value="{{ $item ->account_no }}">{{ $item ->account_title }}</li>
                		@endforeach
	            	</select>
            	</div>
                <div class="col-md-2">
	                <label>Title head2* :</label>
	                <select type="text" id="head2" name="head2" class="form-control ">
	                		<option value="">select
		            	@foreach ($head2 as $item)
					      	<option value="{{ $item ->id }}">{{ $item ->account_title }}</li>
                		@endforeach
	            	</select>
            	</div>
            	<div class="col-md-2">
	                <label>Title head3* :</label>
	                <input class="form-control" placeholder="Enter 3rd title"  name="account_title" type="text" value="">
            	</div>
            	<div class="col-md-2">
	                <label>Account No :</label>
	                <input class="form-control" placeholder="Enter Account No" id="acc_text_id" name="account_no" type="text" value="" >
            	</div>
            	<div class="col-md-2">
	                <label>Account/Group* :</label>
	                <select type="text" id="acc_or_group" name="acc_or_group" class="form-control">
				      	<option value="">select
				      	<option value="Account">Account
				      	<option value="Group">Group
	            	</select>
            	</div>
            	<div class="col-md-2">
                	<label>Account Status* :</label>
	                <select type="text" id="account_status" name="account_status" class="form-control">
					    <option value="">select
					    <option value="Account">Active
					   	<option value="Group">Inactive
		           	</select>
            	</div>
            </div>

            <div class="row form-group">
            	<div class="col-md-4">
                	<label>Opening Balance* :</label>
                	<input class="form-control" placeholder="Enter Opening Balance" id="opening_balance" name="opening_balance" type="text" value="" aria-required="true">
            	</div>
	            <div class="col-md-4">
	                <label>Current Balance* :</label>
	                <input class="form-control" placeholder="Enter Current Balance" id="current_balance" name="current_balance" type="text" value="" aria-required="true">
	            </div>
	            <div class="col-md-4 text-center">
			        <label for="is_bank_paedge">Is Inventory Related:</label>
			        
			        <div class="radio text-center">
			            <label>
			                <input checked="checked" name="is_inventory_related" type="radio" value="">Yes
			            </label>
			            <label>
			                <input name="is_inventory_related" type="radio" value="">No
			            </label>
			        </div>
			    </div>
	            <!-- <div class="col-md-4">
	                <label>Is Inventory Related :</label>
	                <input class="form-control" name="is_inventory_related" type="checkbox" value="is_inventory_related" style="display: none;">
	                <div class="Switch Round On" style="vertical-align:top;margin-left:10px;">
	                    <div class="Toggle"></div>
	                </div>
	            </div> -->
            </div>
            
            
            {!! $tree !!}
            
            
            
            
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
        ajax: "{{ url(config('laraadmin.adminRoute') . '/acc_account_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#acc_account-add-form").validate({
		
	});
});
</script>

<script type="text/javascript" >
  
$(document).ready(function(){
     $("#acc_title").change(function(){
         var itemid = $('#acc_title').val();
             $(head2).find("option").remove();
             // $("#head2").val("select");
        	 $.get("{{ url(config('laraadmin.adminRoute') . '/sub_acc_title') }}" + '/' + itemid, function (data) {
 
            console.log(data);
             $.each(data, function(key, value) {
            $("#head2").append("<option value="+value.id+">" + value.account_title +"</option>");
            });

            })
    });
     $("#head2").change(function(){

            
                var partycode = $('#head2').val();
                // alert(partycode);

               
                $.get("{{ url(config('laraadmin.adminRoute') . '/sub_acc_code') }}" + '/' + partycode, function (data) {
            	console.log(data);
               	// var p = data[0].account_no;
               	var p = data[0].account_no;
               	// var aaa  = data.length();
               	$("#acc_text_id").val(p+'-'+'200');
                // alert(p);
                })
                // $.get("{{ url(config('laraadmin.adminRoute') . '/count_acc_code') }}" + '/' + partycode, function (data) {
               	// var p = data[0].id;
                // alert(p);
                // })

        });
});
</script>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" />
    <link href="http://www.expertphp.in/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://demo.expertphp.in/css/jquery.treeview.css" />
    <script src="http://demo.expertphp.in/js/jquery.js"></script>   
    <script src="http://demo.expertphp.in/js/jquery-treeview.js"></script>
    <script type="text/javascript" src="http://demo.expertphp.in/js/demo.js"></script>

@endpush