@extends("la.layouts.app")

@section("contentheader_title", "Edit jutemillunittype: ")
@section("contentheader_description", $jutemillunittype->$view_col)
@section("section", "JutemillUnitTypes")
@section("section_url", url(config('laraadmin.adminRoute') . '/jutemillunittypes'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JutemillUnitType Edit : ".$jutemillunittype->$view_col)

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
				{!! Form::model($jutemillunittype, ['route' => [config('laraadmin.adminRoute') . '.jutemillunittypes.update', $jutemillunittype->id ], 'method'=>'PUT', 'id' => 'jutemillunittype-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'unit_type_title')
					@la_input($module, 'unit')
					@la_input($module, 'item_discription')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jutemillunittypes') }}">Cancel</a></button>
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
	$("#jutemillunittype-edit-form").validate({
		
	});
});
</script>
@endpush