@extends("la.layouts.app")

@section("contentheader_title", "Edit creditvoucher: ")
@section("contentheader_description", $creditvoucher->$view_col)
@section("section", "Creditvouchers")
@section("section_url", url(config('laraadmin.adminRoute') . '/creditvouchers'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Creditvoucher Edit : ".$creditvoucher->$view_col)

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
				{!! Form::model($creditvoucher, ['route' => [config('laraadmin.adminRoute') . '.creditvouchers.update', $creditvoucher->id ], 'method'=>'PUT', 'id' => 'creditvoucher-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'trans_date')
					@la_input($module, 'voucher_no')
					@la_input($module, 'voucher_type')
					@la_input($module, 'trans_method_id')
					@la_input($module, 'trans_description')
					@la_input($module, 'approved_by')
					@la_input($module, 'approved_date')
					@la_input($module, 'module')
					@la_input($module, 'credit_amt')
					@la_input($module, 'trans_m_id')
					@la_input($module, 'account_id')
					@la_input($module, 'debit_amt')
					@la_input($module, 'user_id')
					@la_input($module, 'address')
					@la_input($module, 'price')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/creditvouchers') }}">Cancel</a></button>
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
	$("#creditvoucher-edit-form").validate({
		
	});
});
</script>
@endpush