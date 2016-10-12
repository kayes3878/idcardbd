@extends("la.layouts.app")

@section("contentheader_title", "Edit cssupplier: ")
@section("contentheader_description", $cssupplier->$view_col)
@section("section", "CsSuppliers")
@section("section_url", url(config('laraadmin.adminRoute') . '/cssuppliers'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsSupplier Edit : ".$cssupplier->$view_col)

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
				{!! Form::model($cssupplier, ['route' => [config('laraadmin.adminRoute') . '.cssuppliers.update', $cssupplier->id ], 'method'=>'PUT', 'id' => 'cssupplier-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'supplier_code')
					@la_input($module, 'name')
					@la_input($module, 'fathers_name')
					@la_input($module, 'address')
					@la_input($module, 'mobile')
					@la_input($module, 'details')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cssuppliers') }}">Cancel</a></button>
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
	$("#cssupplier-edit-form").validate({
		
	});
});
</script>
@endpush