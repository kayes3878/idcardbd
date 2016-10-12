@extends("la.layouts.app")

@section("contentheader_title", "Edit jmloomproduction: ")
@section("contentheader_description", $jmloomproduction->$view_col)
@section("section", "JMLoomProductions")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmloomproductions'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMLoomProduction Edit : ".$jmloomproduction->$view_col)

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
				{!! Form::model($jmloomproduction, ['route' => [config('laraadmin.adminRoute') . '.jmloomproductions.update', $jmloomproduction->id ], 'method'=>'PUT', 'id' => 'jmloomproduction-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'serial')
					@la_input($module, 'date')
					@la_input($module, 'item')
					@la_input($module, 'category')
					<!-- @la_input($module, 'calc_max_production')
					@la_input($module, 'terget_parcent')
					@la_input($module, 'achivet_parcent_Piece')
					@la_input($module, 'achivet_parcent') -->
					@la_input($module, 'terget_q_piece')
					@la_input($module, 'terget_q')
					@la_input($module, 'unit_type')
					@la_input($module, 'sun_unit_type')
					@la_input($module, 'production_quantity_Piece')
					@la_input($module, 'production_quantity')
					@la_input($module, 'total_production_quantity_Piec')
					@la_input($module, 'total_production_quantity')
					@la_input($module, 'total_achivet_parcent_piece')
					@la_input($module, 'total_achivet_parcent')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmloomproductions') }}">Cancel</a></button>
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
	$("#jmloomproduction-edit-form").validate({
		
	});
});
</script>
@endpush