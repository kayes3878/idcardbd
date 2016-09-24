@extends("la.layouts.app")

@section("contentheader_title", "Edit cardgroup: ")
@section("contentheader_description", $cardgroup->$view_col)
@section("section", "CardGroups")
@section("section_url", url(config('laraadmin.adminRoute') . '/cardgroups'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CardGroup Edit : ".$cardgroup->$view_col)

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
				{!! Form::model($cardgroup, ['route' => [config('laraadmin.adminRoute') . '.cardgroups.update', $cardgroup->id ], 'method'=>'PUT', 'id' => 'cardgroup-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'group_type_id')
					@la_input($module, 'card_front_image_link')
					@la_input($module, 'card_Back_image_link')
					@la_input($module, 'view_html')
					@la_input($module, 'description')
					@la_input($module, 'layout')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cardgroups') }}">Cancel</a></button>
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
	$("#cardgroup-edit-form").validate({
		
	});
});
</script>
@endpush