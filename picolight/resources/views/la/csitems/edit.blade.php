@extends("la.layouts.app")

@section("contentheader_title", "Edit csitem: ")
@section("contentheader_description", $csitem->$view_col)
@section("section", "CsItems")
@section("section_url", url(config('laraadmin.adminRoute') . '/csitems'))
@section("sub_section", "Edit")

@section("htmlheader_title", "CsItem Edit : ".$csitem->$view_col)

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
				{!! Form::model($csitem, ['route' => [config('laraadmin.adminRoute') . '.csitems.update', $csitem->id ], 'method'=>'PUT', 'id' => 'csitem-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'item')
					@la_input($module, 'detail')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/csitems') }}">Cancel</a></button>
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
	$("#csitem-edit-form").validate({
		
	});
});
</script>
@endpush