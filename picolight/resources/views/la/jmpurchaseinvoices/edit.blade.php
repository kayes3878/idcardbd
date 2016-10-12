@extends("la.layouts.app")

@section("contentheader_title", "Edit jmpurchaseinvoice: ")
@section("contentheader_description", $jmpurchaseinvoice->$view_col)
@section("section", "JMPurchaseInvoices")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmpurchaseinvoices'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMPurchaseInvoice Edit : ".$jmpurchaseinvoice->$view_col)

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
				{!! Form::model($jmpurchaseinvoice, ['route' => [config('laraadmin.adminRoute') . '.jmpurchaseinvoices.update', $jmpurchaseinvoice->id ], 'method'=>'PUT', 'id' => 'jmpurchaseinvoice-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'invoice_type')
					@la_input($module, 'date')
					@la_input($module, 'invoice_no')
					@la_input($module, 'supplier_id')
					@la_input($module, 'supplier_bill_id')
					@la_input($module, 'jute_receive_bill')
					@la_input($module, 'item_id')
					@la_input($module, 'item_categorie_id')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_unit_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'grand_total')
					@la_input($module, 'bill_status')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmpurchaseinvoices') }}">Cancel</a></button>
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
	$("#jmpurchaseinvoice-edit-form").validate({
		
	});
});
</script>
@endpush