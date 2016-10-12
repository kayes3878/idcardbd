@extends("la.layouts.app")

@section("contentheader_title", "Edit jutemillinventory: ")
@section("contentheader_description", $jutemillinventory->$view_col)
@section("section", "Jutemillinventorys")
@section("section_url", url(config('laraadmin.adminRoute') . '/jutemillinventorys'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Jutemillinventory Edit : ".$jutemillinventory->$view_col)

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
				{!! Form::model($jutemillinventory, ['route' => [config('laraadmin.adminRoute') . '.jutemillinventorys.update', $jutemillinventory->id ], 'method'=>'PUT', 'id' => 'jutemillinventory-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'code')
					@la_input($module, 'date')
					@la_input($module, 'item_id')
					@la_input($module, 'item_categorie_id')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_unit_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'stock_in_store')
					@la_input($module, 'stock_from')
					@la_input($module, 'isInStock')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jutemillinventorys') }}">Cancel</a></button>
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
	$("#jutemillinventory-edit-form").validate({
		
	});
});
</script>
@endpush