@extends("la.layouts.app")

@section("contentheader_title", "Edit jutemillitemcategory: ")
@section("contentheader_description", $jutemillitemcategory->$view_col)
@section("section", "JuteMillItemCategories")
@section("section_url", url(config('laraadmin.adminRoute') . '/jutemillitemcategories'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JuteMillItemCategory Edit : ".$jutemillitemcategory->$view_col)

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
				{!! Form::model($jutemillitemcategory, ['route' => [config('laraadmin.adminRoute') . '.jutemillitemcategories.update', $jutemillitemcategory->id ], 'method'=>'PUT', 'id' => 'jutemillitemcategory-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'item_id')
					@la_input($module, 'category_name')
					@la_input($module, 'sub_unit_type_id')
					@la_input($module, 'item_category_discription')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jutemillitemcategories') }}">Cancel</a></button>
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
	$("#jutemillitemcategory-edit-form").validate({
		
	});
});
</script>
@endpush