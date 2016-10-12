@extends("la.layouts.app")

@section("contentheader_title", "Edit acctransactiondetail: ")
@section("contentheader_description", $acctransactiondetail->$view_col)
@section("section", "AccTransactionDetails")
@section("section_url", url(config('laraadmin.adminRoute') . '/acctransactiondetails'))
@section("sub_section", "Edit")

@section("htmlheader_title", "AccTransactionDetail Edit : ".$acctransactiondetail->$view_col)

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
				{!! Form::model($acctransactiondetail, ['route' => [config('laraadmin.adminRoute') . '.acctransactiondetails.update', $acctransactiondetail->id ], 'method'=>'PUT', 'id' => 'acctransactiondetail-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'trans_d_id')
					@la_input($module, 'trans_m_id')
					@la_input($module, 'account_id')
					@la_input($module, 'credit_amt')
					@la_input($module, 'debit_amt')
					@la_input($module, 'comments')
					@la_input($module, 'company_id')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/acctransactiondetails') }}">Cancel</a></button>
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
	$("#acctransactiondetail-edit-form").validate({
		
	});
});
</script>
@endpush