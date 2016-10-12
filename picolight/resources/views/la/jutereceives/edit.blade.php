@extends("la.layouts.app")

@section("contentheader_title", "Edit jute Receive: ")
@section("contentheader_description", $jutereceife->$view_col)
@section("section", "JuteReceives")
@section("section_url", url(config('laraadmin.adminRoute') . '/jutereceives'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Jute Receive Edit : ".$jutereceife->$view_col)

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
				{!! Form::model($jutereceife, ['route' => [config('laraadmin.adminRoute') . '.jutereceives.update', $jutereceife->id ], 'method'=>'PUT', 'id' => 'jutereceife-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'jute_receive_no')
					@la_input($module, 'date_receive_jute')
					@la_input($module, 'supplier_id')
					@la_input($module, 'item_id')
					@la_input($module, 'item_categorie_id')
					@la_input($module, 'item_categorie')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_unit_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'is_bank_paedge')
					@la_input($module, 'is_bill_paid')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jutereceives') }}">Cancel</a></button>
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
	$("#jutereceife-edit-form").validate({
		
	});
});
</script>
@endpush