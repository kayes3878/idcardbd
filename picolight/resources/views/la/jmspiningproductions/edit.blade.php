@extends("la.layouts.app")

@section("contentheader_title", "Edit jmspiningproduction: ")
@section("contentheader_description", $jmspiningproduction->$view_col)
@section("section", "JMSpiningProductions")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmspiningproductions'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMSpiningProduction Edit : ".$jmspiningproduction->$view_col)

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
				{!! Form::model($jmspiningproduction, ['route' => [config('laraadmin.adminRoute') . '.jmspiningproductions.update', $jmspiningproduction->id ], 'method'=>'PUT', 'id' => 'jmspiningproduction-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'serial')
					@la_input($module, 'date')
					@la_input($module, 'item')
					@la_input($module, 'category')
					@la_input($module, 'shift')
					@la_input($module, 'rpm')
					@la_input($module, 'tpi')
					@la_input($module, 'frame')
					@la_input($module, 'calc_max_production')
					@la_input($module, 'terget_parcent')
					@la_input($module, 'achivet_parcent')
					@la_input($module, 'unit_type')
					@la_input($module, 'production_quantity')
					@la_input($module, 'total_production_quantity')
					@la_input($module, 'total_achivet_parcent')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmspiningproductions') }}">Cancel</a></button>
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
	$("#jmspiningproduction-edit-form").validate({
		
	});
});
</script>
@endpush