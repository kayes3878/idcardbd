@extends("la.layouts.app")

@section("contentheader_title", "Edit cssackmanagement: ")
@section("contentheader_description", $cssackmanagement->$view_col)
@section("section", "CsSackManagements")
@section("section_url", url(config('laraadmin.adminRoute') . '/cssackmanagements'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsSackManagement Edit : ".$cssackmanagement->$view_col)

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
				{!! Form::model($cssackmanagement, ['route' => [config('laraadmin.adminRoute') . '.cssackmanagements.update', $cssackmanagement->id ], 'method'=>'PUT', 'id' => 'cssackmanagement-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'distribution_no')
					@la_input($module, 'date')
					@la_input($module, 'item')
					@la_input($module, 'category')
					@la_input($module, 'store_list')
					@la_input($module, 'party')
					@la_input($module, 'quantity')
					@la_input($module, 'return_date')
					@la_input($module, 'returned')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cssackmanagements') }}">Cancel</a></button>
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
	$("#cssackmanagement-edit-form").validate({
		
	});
});
</script>
@endpush