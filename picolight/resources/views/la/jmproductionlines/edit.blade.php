@extends("la.layouts.app")

@section("contentheader_title", "Edit jmproductionline: ")
@section("contentheader_description", $jmproductionline->$view_col)
@section("section", "JMProductionlines")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmproductionlines'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMProductionline Edit : ".$jmproductionline->$view_col)

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
				{!! Form::model($jmproductionline, ['route' => [config('laraadmin.adminRoute') . '.jmproductionlines.update', $jmproductionline->id ], 'method'=>'PUT', 'id' => 'jmproductionline-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'stock_code')
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
					@la_input($module, 'parent_id')
					@la_input($module, 'isProcessJute')
					@la_input($module, 'process_jute')
					@la_input($module, 'process_quantity')
					@la_input($module, 'process_sub_unit_quantity')
					@la_input($module, 'process_total_quantity')
					@la_input($module, 'process_stock_in_store')
					@la_input($module, 'isInStock')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmproductionlines') }}">Cancel</a></button>
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
	$("#jmproductionline-edit-form").validate({
		
	});
});
</script>
@endpush