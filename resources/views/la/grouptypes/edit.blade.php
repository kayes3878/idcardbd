@extends("la.layouts.app")

@section("contentheader_title", "Edit grouptype: ")
@section("contentheader_description", $grouptype->$view_col)
@section("section", "GroupTypes")
@section("section_url", url(config('laraadmin.adminRoute') . '/grouptypes'))
@section("sub_section", "Edit")

@section("htmlheader_title", "GroupType Edit : ".$grouptype->$view_col)

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
				{!! Form::model($grouptype, ['route' => [config('laraadmin.adminRoute') . '.grouptypes.update', $grouptype->id ], 'method'=>'PUT', 'id' => 'grouptype-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'groupName')
					@la_input($module, 'description')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/grouptypes') }}">Cancel</a></button>
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
	$("#grouptype-edit-form").validate({
		
	});
});
</script>
@endpush