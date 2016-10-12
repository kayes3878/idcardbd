@extends("la.layouts.app")

@section("contentheader_title", "Edit bankpledge: ")
@section("contentheader_description", $bankpledge->$view_col)
@section("section", "BankPledges")
@section("section_url", url(config('laraadmin.adminRoute') . '/bankpledges'))
@section("sub_section", "Edit")

@section("htmlheader_title", "BankPledge Edit : ".$bankpledge->$view_col)

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
				{!! Form::model($bankpledge, ['route' => [config('laraadmin.adminRoute') . '.bankpledges.update', $bankpledge->id ], 'method'=>'PUT', 'id' => 'bankpledge-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'bankpledge_no')
					@la_input($module, 'date_pledge')
					@la_input($module, 'item_id')
					@la_input($module, 'item_categorie_id')
					@la_input($module, 'jute_receive_id')
					@la_input($module, 'jute_receive')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'quantity')
					@la_input($module, 'sub_unit_quantity')
					@la_input($module, 'total_quantity')
					@la_input($module, 'pledge_status')
					@la_input($module, 'returned_date')
					@la_input($module, 'user_id')
					@la_input($module, 'stock_in_hand')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/bankpledges') }}">Cancel</a></button>
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
	$("#bankpledge-edit-form").validate({
		
	});
});
</script>
@endpush