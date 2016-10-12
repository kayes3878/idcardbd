@extends("la.layouts.app")

@section("contentheader_title", "Edit bankpledgereturn: ")
@section("contentheader_description", $bankpledgereturn->$view_col)
@section("section", "BankPledgeReturns")
@section("section_url", url(config('laraadmin.adminRoute') . '/bankpledgereturns'))
@section("sub_section", "Edit")

@section("htmlheader_title", "BankPledgeReturn Edit : ".$bankpledgereturn->$view_col)

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
				{!! Form::model($bankpledgereturn, ['route' => [config('laraadmin.adminRoute') . '.bankpledgereturns.update', $bankpledgereturn->id ], 'method'=>'PUT', 'id' => 'bankpledgereturn-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'bankpledge_return_no')
					@la_input($module, 'item_id')
					@la_input($module, 'item_categorie_id')
					@la_input($module, 'date_pledge_return')
					@la_input($module, 'jute_receive_id')
					@la_input($module, 'jute_receive')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_unit_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'stock_in_bankPledge')
					@la_input($module, 'pledge_status')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/bankpledgereturns') }}">Cancel</a></button>
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
	$("#bankpledgereturn-edit-form").validate({
		
	});
});
</script>
@endpush