@extends("la.layouts.app")

@section("contentheader_title", "Edit jmproductionlineissue: ")
@section("contentheader_description", $jmproductionlineissue->$view_col)
@section("section", "JMProductionLineIssues")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmproductionlineissues'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMProductionLineIssue Edit : ".$jmproductionlineissue->$view_col)

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
				{!! Form::model($jmproductionlineissue, ['route' => [config('laraadmin.adminRoute') . '.jmproductionlineissues.update', $jmproductionlineissue->id ], 'method'=>'PUT', 'id' => 'jmproductionlineissue-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'serial')
					@la_input($module, 'jute_process_type')
					@la_input($module, 'proguction_line_id')
					@la_input($module, 'unit_type')
					@la_input($module, 'sub_unit_type')
					@la_input($module, 'in_hand_q')
					@la_input($module, 'total_quantity')
					@la_input($module, 'total_sub_unit_quantity')
					@la_input($module, 'pacca_q')
					@la_input($module, 'total_pacca_q')
					@la_input($module, 'kacha_q')
					@la_input($module, 'total_Kacha_q')
					@la_input($module, 'Cut_q')
					@la_input($module, 'total_cut_q')
					@la_input($module, 'Stock')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmproductionlineissues') }}">Cancel</a></button>
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
	$("#jmproductionlineissue-edit-form").validate({
		
	});
});
</script>
@endpush