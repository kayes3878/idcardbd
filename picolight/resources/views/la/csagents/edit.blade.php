@extends("la.layouts.app")

@section("contentheader_title", "Edit csagent: ")
@section("contentheader_description", $csagent->$view_col)
@section("section", "CsAgents")
@section("section_url", url(config('laraadmin.adminRoute') . '/csagents'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsAgent Edit : ".$csagent->$view_col)

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
				{!! Form::model($csagent, ['route' => [config('laraadmin.adminRoute') . '.csagents.update', $csagent->id ], 'method'=>'PUT', 'id' => 'csagent-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'agent_code')
					@la_input($module, 'name')
					@la_input($module, 'fathers_name')
					@la_input($module, 'address')
					@la_input($module, 'mobile')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csagents') }}">Cancel</a></button>
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
	$("#csagent-edit-form").validate({
		
	});
});
</script>
@endpush