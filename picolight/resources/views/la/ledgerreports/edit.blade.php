@extends("la.layouts.app")

@section("contentheader_title", "Edit ledgerreport: ")
@section("contentheader_description", $ledgerreport->$view_col)
@section("section", "Ledgerreports")
@section("section_url", url(config('laraadmin.adminRoute') . '/ledgerreports'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Ledgerreport Edit : ".$ledgerreport->$view_col)

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
				{!! Form::model($ledgerreport, ['route' => [config('laraadmin.adminRoute') . '.ledgerreports.update', $ledgerreport->id ], 'method'=>'PUT', 'id' => 'ledgerreport-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'author')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/ledgerreports') }}">Cancel</a></button>
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
	$("#ledgerreport-edit-form").validate({
		
	});
});
</script>
@endpush