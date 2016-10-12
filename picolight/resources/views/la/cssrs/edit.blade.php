@extends("la.layouts.app")

@section("contentheader_title", "Edit cssr: ")
@section("contentheader_description", $cssr->$view_col)
@section("section", "CsSRs")
@section("section_url", url(config('laraadmin.adminRoute') . '/cssrs'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsSR Edit : ".$cssr->$view_col)

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
				{!! Form::model($cssr, ['route' => [config('laraadmin.adminRoute') . '.cssrs.update', $cssr->id ], 'method'=>'PUT', 'id' => 'cssr-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'booking_no')
					@la_input($module, 'date')
					@la_input($module, 'party')
					@la_input($module, 'agent')
					@la_input($module, 'potato_type')
					@la_input($module, 'empty_sacks')
					@la_input($module, 'transportation_free_cose')
					@la_input($module, 'other_cost')
					@la_input($module, 'others_cost_details')
					@la_input($module, 'unit')
					@la_input($module, 'quantity')
					@la_input($module, 'available_quantity')
					@la_input($module, 'sr_no')
					@la_input($module, 'user_id')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cssrs') }}">Cancel</a></button>
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
	$("#cssr-edit-form").validate({
		
	});
});
</script>
@endpush