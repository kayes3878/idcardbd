@extends("la.layouts.app")

@section("contentheader_title", "Edit csbillpayment: ")
@section("contentheader_description", $csbillpayment->$view_col)
@section("section", "CsBillPayments")
@section("section_url", url(config('laraadmin.adminRoute') . '/csbillpayments'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsBillPayment Edit : ".$csbillpayment->$view_col)

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
				{!! Form::model($csbillpayment, ['route' => [config('laraadmin.adminRoute') . '.csbillpayments.update', $csbillpayment->id ], 'method'=>'PUT', 'id' => 'csbillpayment-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'bill_no')
					@la_input($module, 'invoice_no')
					@la_input($module, 'amount')
					@la_input($module, 'total_amount')
					@la_input($module, 'due')
					@la_input($module, 'status')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csbillpayments') }}">Cancel</a></button>
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
	$("#csbillpayment-edit-form").validate({
		
	});
});
</script>
@endpush