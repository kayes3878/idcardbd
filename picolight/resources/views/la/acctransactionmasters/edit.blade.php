@extends("la.layouts.app")

@section("contentheader_title", "Edit acctransactionmaster: ")
@section("contentheader_description", $acctransactionmaster->$view_col)
@section("section", "AccTransactionMasters")
@section("section_url", url(config('laraadmin.adminRoute') . '/acctransactionmasters'))
@section("sub_section", "Edit")

@section("htmlheader_title", "AccTransactionMaster Edit : ".$acctransactionmaster->$view_col)

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
				{!! Form::model($acctransactionmaster, ['route' => [config('laraadmin.adminRoute') . '.acctransactionmasters.update', $acctransactionmaster->id ], 'method'=>'PUT', 'id' => 'acctransactionmaster-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'trans_ma_id')
					@la_input($module, 'trans_date')
					@la_input($module, 'voucher_no')
					@la_input($module, 'voucher_payee')
					@la_input($module, 'method_ref_id')
					@la_input($module, 'method_ref_no')
					@la_input($module, 'trans_description')
					@la_input($module, 'approved_by')
					@la_input($module, 'approved_date')
					@la_input($module, 'modified_date')
					@la_input($module, 'module')
					@la_input($module, 'company_id')
					@la_input($module, 'user_id')
					@la_input($module, 'voucher_type')
					@la_input($module, 'trans_method_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/acctransactionmasters') }}">Cancel</a></button>
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
	$("#acctransactionmaster-edit-form").validate({
		
	});
});
</script>
@endpush