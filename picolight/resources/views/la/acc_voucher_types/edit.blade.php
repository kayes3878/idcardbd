@extends("la.layouts.app")

@section("contentheader_title", "Edit acc_voucher_type: ")
@section("contentheader_description", $acc_voucher_type->$view_col)
@section("section", "Acc_voucher_types")
@section("section_url", url(config('laraadmin.adminRoute') . '/acc_voucher_types'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Acc_voucher_type Edit : ".$acc_voucher_type->$view_col)

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
				{!! Form::model($acc_voucher_type, ['route' => [config('laraadmin.adminRoute') . '.acc_voucher_types.update', $acc_voucher_type->id ], 'method'=>'PUT', 'id' => 'acc_voucher_type-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'voucher_type_id')
					@la_input($module, 'voucher_type')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/acc_voucher_types') }}">Cancel</a></button>
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
	$("#acc_voucher_type-edit-form").validate({
		
	});
});
</script>
@endpush