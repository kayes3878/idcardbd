@extends("la.layouts.app")

@section("contentheader_title", "Edit csloan: ")
@section("contentheader_description", $csloan->$view_col)
@section("section", "CsLoans")
@section("section_url", url(config('laraadmin.adminRoute') . '/csloans'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsLoan Edit : ".$csloan->$view_col)

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
				{!! Form::model($csloan, ['route' => [config('laraadmin.adminRoute') . '.csloans.update', $csloan->id ], 'method'=>'PUT', 'id' => 'csloan-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'loan_no')
					@la_input($module, 'date')
					@la_input($module, 'party')
					@la_input($module, 'party_deed')
					@la_input($module, 'sr_no')
					@la_input($module, 'loan_type')
					@la_input($module, 'loan_amount')
					@la_input($module, 'max_loan_amount')
					@la_input($module, 'Toatal_loan_amount')
					@la_input($module, 'party_previous_loan_amount')
					@la_input($module, 'total_liabilities')
					@la_input($module, 'user_id')
					@la_input($module, 'status')
					@la_input($module, 'loan_received')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csloans') }}">Cancel</a></button>
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
	$("#csloan-edit-form").validate({
		
	});
});
</script>
@endpush