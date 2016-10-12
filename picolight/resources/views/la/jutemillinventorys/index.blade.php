@extends("la.layouts.app")

@section("contentheader_title", "Jutemillinventorys")
@section("contentheader_description", "jutemillinventorys listing")
@section("section", "Jutemillinventorys")
@section("sub_section", "Listing")
@section("htmlheader_title", "Jutemillinventorys Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Jutemillinventory</button>
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

<div style="margin-bottom: 40px;" class="pdf">
 
<a href="{{URL:: to('getinventoryREPORT') }}" class="btn btn-success btn-sm pull-right"> Report Download </a>

</div>
		<div>
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
</div>

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Jutemillinventory</h4>
			</div>
			{!! Form::open(['action' => 'LA\JutemillinventorysController@store', 'id' => 'jutemillinventory-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'code')
					@la_input($module, 'date')
					@la_input($module, 'item_id')
					@la_input($module, 'item_categorie_id')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_unit_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'stock_in_store')
					@la_input($module, 'stock_from')
					@la_input($module, 'isInStock')
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
        ajax: "{{ url(config('laraadmin.adminRoute') . '/jutemillinventory_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#jutemillinventory-add-form").validate({
		
	});
});
</script>
@endpush