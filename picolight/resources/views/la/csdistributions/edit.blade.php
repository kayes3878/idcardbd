@extends("la.layouts.app")

@section("contentheader_title", "Edit csdistribution: ")
@section("contentheader_description", $csdistribution->$view_col)
@section("section", "CsDistributions")
@section("section_url", url(config('laraadmin.adminRoute') . '/csdistributions'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsDistribution Edit : ".$csdistribution->$view_col)

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
				{!! Form::model($csdistribution, ['route' => [config('laraadmin.adminRoute') . '.csdistributions.update', $csdistribution->id ], 'method'=>'PUT', 'id' => 'csdistribution-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'distribution_no')
					@la_input($module, 'date')
					@la_input($module, 'party')
					@la_input($module, 'deeds')
					@la_input($module, 'sr')
					@la_input($module, 'distribute_quantity')
					@la_input($module, 'tatal_payment')
					@la_input($module, 'per_sacks_payment_amt')
					@la_input($module, 'paid_amount')
					@la_input($module, 'due_amount')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csdistributions') }}">Cancel</a></button>
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
	$("#csdistribution-edit-form").validate({
		
	});
});
</script>
@endpush