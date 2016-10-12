@extends("la.layouts.app")

@section("contentheader_title", "Edit jmproducedistribution: ")
@section("contentheader_description", $jmproducedistribution->$view_col)
@section("section", "JMProduceDistributions")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmproducedistributions'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMProduceDistribution Edit : ".$jmproducedistribution->$view_col)

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
				{!! Form::model($jmproducedistribution, ['route' => [config('laraadmin.adminRoute') . '.jmproducedistributions.update', $jmproducedistribution->id ], 'method'=>'PUT', 'id' => 'jmproducedistribution-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'serial')
					@la_input($module, 'date')
					@la_input($module, 'item')
					@la_input($module, 'categorys')
					@la_input($module, 'production_inventory_id')
					@la_input($module, 'distribute_to')
					@la_input($module, 'unit_type')
					@la_input($module, 'sun_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_quantity')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmproducedistributions') }}">Cancel</a></button>
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
	$("#jmproducedistribution-edit-form").validate({
		
	});
});
</script>
@endpush