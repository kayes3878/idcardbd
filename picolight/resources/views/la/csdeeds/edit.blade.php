@extends("la.layouts.app")

@section("contentheader_title", "Edit csdeed: ")
@section("contentheader_description", $csdeed->$view_col)
@section("section", "CsDeeds")
@section("section_url", url(config('laraadmin.adminRoute') . '/csdeeds'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsDeed Edit : ".$csdeed->$view_col)

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
				{!! Form::model($csdeed, ['route' => [config('laraadmin.adminRoute') . '.csdeeds.update', $csdeed->id ], 'method'=>'PUT', 'id' => 'csdeed-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'deed_no')
					@la_input($module, 'date')
					@la_input($module, 'party')
					@la_input($module, 'sr_no')
					@la_input($module, 'quantity')
					@la_input($module, 'empty_sacks')
					@la_input($module, 'rent_per_sacks')
					@la_input($module, 'empty_sacks_price')
					@la_input($module, 'total_rent')
					@la_input($module, 'total_empty_sacks_price')
					@la_input($module, 'total_liabilities')
					@la_input($module, 'unit')
					@la_input($module, 'user_id')
					@la_input($module, 'status')
					@la_input($module, 'loan_received')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csdeeds') }}">Cancel</a></button>
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
	$("#csdeed-edit-form").validate({
		
	});
});
</script>
@endpush