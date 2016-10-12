@extends("la.layouts.app")

@section("contentheader_title", "Edit jutemillsubunittype: ")
@section("contentheader_description", $jutemillsubunittype->$view_col)
@section("section", "JutemillSubUnitTypes")
@section("section_url", url(config('laraadmin.adminRoute') . '/jutemillsubunittypes'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JutemillSubUnitType Edit : ".$jutemillsubunittype->$view_col)

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
				{!! Form::model($jutemillsubunittype, ['route' => [config('laraadmin.adminRoute') . '.jutemillsubunittypes.update', $jutemillsubunittype->id ], 'method'=>'PUT', 'id' => 'jutemillsubunittype-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'unit_type_id')
					@la_input($module, 'sub_unit_type_title')
					@la_input($module, 'unit')
					@la_input($module, 'sub_unit')
					@la_input($module, 'item_discription')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jutemillsubunittypes') }}">Cancel</a></button>
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
	$("#jutemillsubunittype-edit-form").validate({
		
	});
});
</script>
@endpush