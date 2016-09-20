@extends("la.layouts.app")

@section("contentheader_title", "Edit card: ")
@section("contentheader_description", $card->$view_col)
@section("section", "Cards")
@section("section_url", url(config('laraadmin.adminRoute') . '/cards'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Card Edit : ".$card->$view_col)

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
				{!! Form::model($card, ['route' => [config('laraadmin.adminRoute') . '.cards.update', $card->id ], 'method'=>'PUT', 'id' => 'card-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					@la_input($module, 'fathername')
					@la_input($module, 'mathername')
					@la_input($module, 'Photo')
					@la_input($module, 'phone')
					@la_input($module, 'organization')
					@la_input($module, 'designation_class')
					@la_input($module, 'Group')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/cards') }}">Cancel</a></button>
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
	$("#card-edit-form").validate({
		
	});
});
</script>
@endpush