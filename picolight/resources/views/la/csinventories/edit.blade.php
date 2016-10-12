@extends("la.layouts.app")

@section("contentheader_title", "Edit csinventory: ")
@section("contentheader_description", $csinventory->$view_col)
@section("section", "CsInventories")
@section("section_url", url(config('laraadmin.adminRoute') . '/csinventories'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsInventory Edit : ".$csinventory->$view_col)

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
				{!! Form::model($csinventory, ['route' => [config('laraadmin.adminRoute') . '.csinventories.update', $csinventory->id ], 'method'=>'PUT', 'id' => 'csinventory-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'date')
					@la_input($module, 'item')
					@la_input($module, 'category')
					@la_input($module, 'unit')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_quantity')
					@la_input($module, 'inhand_quantity')
					@la_input($module, 'inhand_sub_quantity')
					@la_input($module, 'stock_status')
					@la_input($module, 'detail')
					@la_input($module, 'user_id')
					@la_input($module, 'sr_no')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csinventories') }}">Cancel</a></button>
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
	$("#csinventory-edit-form").validate({
		
	});
});
</script>
@endpush