@extends("la.layouts.app")

@section("contentheader_title", "Edit cssrmanagement: ")
@section("contentheader_description", $cssrmanagement->$view_col)
@section("section", "CsSRManagements")
@section("section_url", url(config('laraadmin.adminRoute') . '/cssrmanagements'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsSRManagement Edit : ".$cssrmanagement->$view_col)

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
				{!! Form::model($cssrmanagement, ['route' => [config('laraadmin.adminRoute') . '.cssrmanagements.update', $cssrmanagement->id ], 'method'=>'PUT', 'id' => 'cssrmanagement-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'sr_no')
					@la_input($module, 'seasons')
					@la_input($module, 'year')
					@la_input($module, 'date')
					@la_input($module, 'number_of_bags')
					@la_input($module, 'rest_no_of_bags')
					@la_input($module, 'status')
					@la_input($module, 'owner')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cssrmanagements') }}">Cancel</a></button>
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
	$("#cssrmanagement-edit-form").validate({
		
	});
});
</script>
@endpush