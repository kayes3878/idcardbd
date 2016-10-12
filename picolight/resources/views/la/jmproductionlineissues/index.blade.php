@extends("la.layouts.app")

@section("contentheader_title", "JMProductionLineIssues")
@section("contentheader_description", "jmproductionlineissues listing")
@section("section", "JMProductionLineIssues")
@section("sub_section", "Listing")
@section("htmlheader_title", "JMProductionLineIssues Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add JMProductionLineIssue</button>
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
				<h4 class="modal-title" id="myModalLabel">Add JMProductionLineIssue</h4>
			</div>
			{!! Form::open(['action' => 'LA\JMProductionLineIssuesController@store', 'id' => 'jmproductionlineissue-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'serial')
					@la_input($module, 'jute_process_type')
					@la_input($module, 'proguction_line_id')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'in_hand_q')
					@la_input($module, 'total_quantity')
					@la_input($module, 'total_sub_unit_quantity')
					@la_input($module, 'pacca_q')
					@la_input($module, 'total_pacca_q')
					@la_input($module, 'kacha_q')
					@la_input($module, 'total_Kacha_q')
					@la_input($module, 'Cut_q')
					@la_input($module, 'total_cut_q')
					@la_input($module, 'Stock')
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
        ajax: "{{ url(config('laraadmin.adminRoute') . '/jmproductionlineissue_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#jmproductionlineissue-add-form").validate({
		
	});
});
</script>
@endpush