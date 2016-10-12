@extends("la.layouts.app")

@section("contentheader_title", "Edit csbillreceived: ")
@section("contentheader_description", $csbillreceived->$view_col)
@section("section", "CsBillReceiveds")
@section("section_url", url(config('laraadmin.adminRoute') . '/csbillreceiveds'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsBillReceived Edit : ".$csbillreceived->$view_col)

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
				{!! Form::model($csbillreceived, ['route' => [config('laraadmin.adminRoute') . '.csbillreceiveds.update', $csbillreceived->id ], 'method'=>'PUT', 'id' => 'csbillreceived-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'bill_collection_no')
					@la_input($module, 'party')
					@la_input($module, 'bill_title')
					@la_input($module, 'amount')
					@la_input($module, 'total_amount')
					@la_input($module, 'paid_amount')
					@la_input($module, 'total_due')
					@la_input($module, 'note')
					@la_input($module, 'user_id')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csbillreceiveds') }}">Cancel</a></button>
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
	$("#csbillreceived-edit-form").validate({
		
	});
});
</script>
@endpush