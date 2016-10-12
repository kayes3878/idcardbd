@extends("la.layouts.app")

@section("contentheader_title", "Edit jmproductionitem: ")
@section("contentheader_description", $jmproductionitem->$view_col)
@section("section", "JMProductionItems")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmproductionitems'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMProductionItem Edit : ".$jmproductionitem->$view_col)

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
				{!! Form::model($jmproductionitem, ['route' => [config('laraadmin.adminRoute') . '.jmproductionitems.update', $jmproductionitem->id ], 'method'=>'PUT', 'id' => 'jmproductionitem-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'production_item')
					@la_input($module, 'production_item_dis')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmproductionitems') }}">Cancel</a></button>
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
	$("#jmproductionitem-edit-form").validate({
		
	});
});
</script>
@endpush