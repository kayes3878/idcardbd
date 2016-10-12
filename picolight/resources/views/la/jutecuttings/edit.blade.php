@extends("la.layouts.app")

@section("contentheader_title", "Edit jutecutting: ")
@section("contentheader_description", $jutecutting->$view_col)
@section("section", "JuteCuttings")
@section("section_url", url(config('laraadmin.adminRoute') . '/jutecuttings'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JuteCutting Edit : ".$jutecutting->$view_col)

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

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($jutecutting, ['route' => [config('laraadmin.adminRoute') . '.jutecuttings.update', $jutecutting->id ], 'method'=>'PUT', 'id' => 'jutecutting-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'cutting_serial')
					@la_input($module, 'item_id')
					@la_input($module, 'item_categorie_id')
					@la_input($module, 'proguction_line_id')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_unit_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'total_sub_unit_quantity')
					@la_input($module, 'total_cut_sub_unit')
					@la_input($module, 'total_pacca_sub_unit')
					@la_input($module, 'total_westage_sub_unit')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jutecuttings') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
				
				@if($errors->any())
				<ul class="alert alert-danger">
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#jutecutting-edit-form").validate({
		
	});
});
</script>
@endpush