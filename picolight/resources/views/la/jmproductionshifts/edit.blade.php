@extends("la.layouts.app")

@section("contentheader_title", "Edit jmproductionshift: ")
@section("contentheader_description", $jmproductionshift->$view_col)
@section("section", "JMProductionShifts")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmproductionshifts'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMProductionShift Edit : ".$jmproductionshift->$view_col)

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
				{!! Form::model($jmproductionshift, ['route' => [config('laraadmin.adminRoute') . '.jmproductionshifts.update', $jmproductionshift->id ], 'method'=>'PUT', 'id' => 'jmproductionshift-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'group')
					@la_input($module, 'shift')
					@la_input($module, 'time_started')
					@la_input($module, 'time_end')
					@la_input($module, 'duration')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmproductionshifts') }}">Cancel</a></button>
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
	$("#jmproductionshift-edit-form").validate({
		
	});
});
</script>
@endpush