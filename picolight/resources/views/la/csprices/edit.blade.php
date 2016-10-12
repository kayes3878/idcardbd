@extends("la.layouts.app")

@section("contentheader_title", "Edit csprice: ")
@section("contentheader_description", $csprice->$view_col)
@section("section", "CsPrices")
@section("section_url", url(config('laraadmin.adminRoute') . '/csprices'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsPrice Edit : ".$csprice->$view_col)

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
				{!! Form::model($csprice, ['route' => [config('laraadmin.adminRoute') . '.csprices.update', $csprice->id ], 'method'=>'PUT', 'id' => 'csprice-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'item')
					@la_input($module, 'category')
					@la_input($module, 'purchase_price')
					@la_input($module, 'selling_price')
					@la_input($module, 'unit_status')
					@la_input($module, 'detail')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csprices') }}">Cancel</a></button>
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
	$("#csprice-edit-form").validate({
		
	});
});
</script>
@endpush