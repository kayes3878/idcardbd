@extends("la.layouts.app")

@section("contentheader_title", "Edit cspurchaseinvoice: ")
@section("contentheader_description", $cspurchaseinvoice->$view_col)
@section("section", "CsPurchaseInvoices")
@section("section_url", url(config('laraadmin.adminRoute') . '/cspurchaseinvoices'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsPurchaseInvoice Edit : ".$cspurchaseinvoice->$view_col)

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
				{!! Form::model($cspurchaseinvoice, ['route' => [config('laraadmin.adminRoute') . '.cspurchaseinvoices.update', $cspurchaseinvoice->id ], 'method'=>'PUT', 'id' => 'cspurchaseinvoice-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'invoice_no')
					@la_input($module, 'date')
					@la_input($module, 'bill_no')
					@la_input($module, 'purchase_type')
					@la_input($module, 'suppliers')
					@la_input($module, 'item')
					@la_input($module, 'category')
					@la_input($module, 'unit')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'Actual_price')
					@la_input($module, 'Purchase_price')
					@la_input($module, 'total_Purchase_price')
					@la_input($module, 'grans_total_price')
					@la_input($module, 'payment_status')
					@la_input($module, 'due_amount')
					@la_input($module, 'detail')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cspurchaseinvoices') }}">Cancel</a></button>
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
	$("#cspurchaseinvoice-edit-form").validate({
		
	});
});
</script>
@endpush