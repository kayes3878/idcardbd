@extends("la.layouts.app")

@section("contentheader_title", "CsPurchaseInvoices")
@section("contentheader_description", "cspurchaseinvoices listing")
@section("section", "CsPurchaseInvoices")
@section("sub_section", "Listing")
@section("htmlheader_title", "CsPurchaseInvoices Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add CsPurchaseInvoice</button>
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
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add CsPurchaseInvoice</h4>
			</div>
			{!! Form::open(['action' => 'LA\CsPurchaseInvoicesController@store', 'id' => 'cspurchaseinvoice-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'invoice_no')
					@la_input($module, 'date')
					@la_input($module, 'bill_no')
					@la_input($module, 'purchase_type')
					@la_input($module, 'suppliers')
					@la_input($module, 'item')
					@la_input($module, 'category')
					@la_input($module, 'unit')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'Actual_price')
					@la_input($module, 'Purchase_price')
					@la_input($module, 'total_Purchase_price')
					@la_input($module, 'grans_total_price')
					@la_input($module, 'payment_status')
					@la_input($module, 'due_amount')
					@la_input($module, 'detail')
					@la_input($module, 'user_id')
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
        ajax: "{{ url(config('laraadmin.adminRoute') . '/cspurchaseinvoice_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#cspurchaseinvoice-add-form").validate({
		
	});
});
</script>
@endpush