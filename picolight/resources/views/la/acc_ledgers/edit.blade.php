@extends("la.layouts.app")

@section("contentheader_title", "Edit acc_ledger: ")
@section("contentheader_description", $acc_ledger->$view_col)
@section("section", "Acc_ledgers")
@section("section_url", url(config('laraadmin.adminRoute') . '/acc_ledgers'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Acc_ledger Edit : ".$acc_ledger->$view_col)

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
				{!! Form::model($acc_ledger, ['route' => [config('laraadmin.adminRoute') . '.acc_ledgers.update', $acc_ledger->id ], 'method'=>'PUT', 'id' => 'acc_ledger-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'ledger_id')
					@la_input($module, 'ledger_name')
					@la_input($module, 'ledger_type')
					@la_input($module, 'ledger_type_id')
					@la_input($module, 'address')
					@la_input($module, 'country_id')
					@la_input($module, 'currency_id')
					@la_input($module, 'contact_person')
					@la_input($module, 'bank_acc_type')
					@la_input($module, 'business_type')
					@la_input($module, 'phone')
					@la_input($module, 'fax')
					@la_input($module, 'email')
					@la_input($module, 'remarks')
					@la_input($module, 'team_id')
					@la_input($module, 'account_id')
					@la_input($module, 'modified_date')
					@la_input($module, 'company_id')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/acc_ledgers') }}">Cancel</a></button>
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
	$("#acc_ledger-edit-form").validate({
		
	});
});
</script>
@endpush