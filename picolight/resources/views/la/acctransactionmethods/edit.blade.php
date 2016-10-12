@extends("la.layouts.app")

@section("contentheader_title", "Edit acctransactionmethod: ")
@section("contentheader_description", $acctransactionmethod->$view_col)
@section("section", "AccTransactionMethods")
@section("section_url", url(config('laraadmin.adminRoute') . '/acctransactionmethods'))
@section("sub_section", "Edit")

@section("htmlheader_title", "AccTransactionMethod Edit : ".$acctransactionmethod->$view_col)

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
				{!! Form::model($acctransactionmethod, ['route' => [config('laraadmin.adminRoute') . '.acctransactionmethods.update', $acctransactionmethod->id ], 'method'=>'PUT', 'id' => 'acctransactionmethod-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'trans_method_id')
					@la_input($module, 'method_tile')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/acctransactionmethods') }}">Cancel</a></button>
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
	$("#acctransactionmethod-edit-form").validate({
		
	});
});
</script>
@endpush