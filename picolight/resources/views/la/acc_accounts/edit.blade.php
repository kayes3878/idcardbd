@extends("la.layouts.app")

@section("contentheader_title", "Edit acc_account: ")
@section("contentheader_description", $acc_account->$view_col)
@section("section", "Acc_accounts")
@section("section_url", url(config('laraadmin.adminRoute') . '/acc_accounts'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Acc_account Edit : ".$acc_account->$view_col)

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
				{!! Form::model($acc_account, ['route' => [config('laraadmin.adminRoute') . '.acc_accounts.update', $acc_account->id ], 'method'=>'PUT', 'id' => 'acc_account-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'account_id')
					@la_input($module, 'account_no')
					@la_input($module, 'account_title')
					@la_input($module, 'acc_or_group')
					@la_input($module, 'acc_depth')
					@la_input($module, 'nature')
					@la_input($module, 'account_status')
					@la_input($module, 'parent_id')
					@la_input($module, 'opening_balance')
					@la_input($module, 'current_balance')
					@la_input($module, 'is_inventory_related')
					@la_input($module, 'ledger_type_id')
					@la_input($module, 'ledger_id')
					@la_input($module, 'company_id')
					@la_input($module, 'user_id')
					@la_input($module, 'modified_date')
					@la_input($module, 'final_parent_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/acc_accounts') }}">Cancel</a></button>
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
	$("#acc_account-edit-form").validate({
		
	});
});
</script>
@endpush