@extends("la.layouts.app")

@section("contentheader_title", "Edit csgatepass: ")
@section("contentheader_description", $csgatepass->$view_col)
@section("section", "CsGatePasses")
@section("section_url", url(config('laraadmin.adminRoute') . '/csgatepasses'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsGatePass Edit : ".$csgatepass->$view_col)

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
				{!! Form::model($csgatepass, ['route' => [config('laraadmin.adminRoute') . '.csgatepasses.update', $csgatepass->id ], 'method'=>'PUT', 'id' => 'csgatepass-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'party')
					@la_input($module, 'do_lits')
					@la_input($module, 'date')
					@la_input($module, 'gp_no')
					@la_input($module, 'do_no')
					@la_input($module, 'sr_no')
					@la_input($module, 'do_quantity')
					@la_input($module, 'gp_quantity')
					@la_input($module, 'do_per_sacks_amount')
					@la_input($module, 'do_payment_amount')
					@la_input($module, 'do_payment_amount_paid')
					@la_input($module, 'do_payment_amount_due')
					@la_input($module, 'status')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csgatepasses') }}">Cancel</a></button>
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
	$("#csgatepass-edit-form").validate({
		
	});
});
</script>
@endpush