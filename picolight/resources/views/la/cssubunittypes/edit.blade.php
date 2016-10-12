@extends("la.layouts.app")

@section("contentheader_title", "Edit cssubunittype: ")
@section("contentheader_description", $cssubunittype->$view_col)
@section("section", "CsSubUnitTypes")
@section("section_url", url(config('laraadmin.adminRoute') . '/cssubunittypes'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsSubUnitType Edit : ".$cssubunittype->$view_col)

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
				{!! Form::model($cssubunittype, ['route' => [config('laraadmin.adminRoute') . '.cssubunittypes.update', $cssubunittype->id ], 'method'=>'PUT', 'id' => 'cssubunittype-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'unit')
					@la_input($module, 'sub_unit')
					@la_input($module, 'value')
					@la_input($module, 'detail')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cssubunittypes') }}">Cancel</a></button>
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
	$("#cssubunittype-edit-form").validate({
		
	});
});
</script>
@endpush