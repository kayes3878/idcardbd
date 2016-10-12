@extends("la.layouts.app")

@section("contentheader_title", "Edit bankdiposit: ")
@section("contentheader_description", $bankdiposit->$view_col)
@section("section", "BankDiposits")
@section("section_url", url(config('laraadmin.adminRoute') . '/bankdiposits'))
@section("sub_section", "Edit")

@section("htmlheader_title", "BankDiposit Edit : ".$bankdiposit->$view_col)

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
				{!! Form::model($bankdiposit, ['route' => [config('laraadmin.adminRoute') . '.bankdiposits.update', $bankdiposit->id ], 'method'=>'PUT', 'id' => 'bankdiposit-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'diposit_no')
					@la_input($module, 'bank_account_id')
					@la_input($module, 'diposit_date')
					@la_input($module, 'diposit_type')
					@la_input($module, 'diposited_branch')
					@la_input($module, 'diposited_by')
					@la_input($module, 'tranjection_reference_no')
					@la_input($module, 'diposit_from')
					@la_input($module, 'cheque_no')
					@la_input($module, 'amount')
					@la_input($module, 'grand_total')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/bankdiposits') }}">Cancel</a></button>
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
	$("#bankdiposit-edit-form").validate({
		
	});
});
</script>
@endpush