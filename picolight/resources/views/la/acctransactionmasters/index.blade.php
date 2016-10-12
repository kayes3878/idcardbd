@extends("la.layouts.app")

@section("contentheader_title", "AccTransactionMasters")
@section("contentheader_description", "acctransactionmasters listing")
@section("section", "AccTransactionMasters")
@section("sub_section", "Listing")
@section("htmlheader_title", "AccTransactionMasters Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add AccTransactionMaster</button>
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
				<h4 class="modal-title" id="myModalLabel">Add AccTransactionMaster</h4>
			</div>
			{!! Form::open(['action' => 'LA\AccTransactionMastersController@store', 'id' => 'acctransactionmaster-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'trans_ma_id')
					@la_input($module, 'trans_date')
					@la_input($module, 'voucher_no')
					@la_input($module, 'voucher_payee')
					@la_input($module, 'method_ref_id')
					@la_input($module, 'method_ref_no')
					@la_input($module, 'trans_description')
					@la_input($module, 'approved_by')
					@la_input($module, 'approved_date')
					@la_input($module, 'modified_date')
					@la_input($module, 'module')
					@la_input($module, 'company_id')
					@la_input($module, 'user_id')
					@la_input($module, 'voucher_type')
					@la_input($module, 'trans_method_id')
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
        ajax: "{{ url(config('laraadmin.adminRoute') . '/acctransactionmaster_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#acctransactionmaster-add-form").validate({
		
	});
});
</script>
@endpush