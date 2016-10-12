@extends("la.layouts.app")

@section("contentheader_title", "Edit jmproductioninventory: ")
@section("contentheader_description", $jmproductioninventory->$view_col)
@section("section", "JMProductionInventorys")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmproductioninventorys'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMProductionInventory Edit : ".$jmproductioninventory->$view_col)

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
				{!! Form::model($jmproductioninventory, ['route' => [config('laraadmin.adminRoute') . '.jmproductioninventorys.update', $jmproductioninventory->id ], 'method'=>'PUT', 'id' => 'jmproductioninventory-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'date')
					@la_input($module, 'item')
					@la_input($module, 'categorys')
					@la_input($module, 'unit_type')
					@la_input($module, 'production_quantity')
					@la_input($module, 'production_sub_quantity')
					@la_input($module, 'distribution')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmproductioninventorys') }}">Cancel</a></button>
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
	$("#jmproductioninventory-edit-form").validate({
		
	});
});
</script>
@endpush