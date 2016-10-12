@extends("la.layouts.app")

@section("contentheader_title", "Edit jmbankaccountinfo: ")
@section("contentheader_description", $jmbankaccountinfo->$view_col)
@section("section", "JMBankAccountInfos")
@section("section_url", url(config('laraadmin.adminRoute') . '/jmbankaccountinfos'))
@section("sub_section", "Edit")

@section("htmlheader_title", "JMBankAccountInfo Edit : ".$jmbankaccountinfo->$view_col)

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
				{!! Form::model($jmbankaccountinfo, ['route' => [config('laraadmin.adminRoute') . '.jmbankaccountinfos.update', $jmbankaccountinfo->id ], 'method'=>'PUT', 'id' => 'jmbankaccountinfo-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'bank_name')
					@la_input($module, 'branch')
					@la_input($module, 'account_name')
					@la_input($module, 'account_no')
					@la_input($module, 'opening_date')
					@la_input($module, 'opening_balance')
					@la_input($module, 'current_balance')
					@la_input($module, 'loan')
					@la_input($module, 'user_id')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/jmbankaccountinfos') }}">Cancel</a></button>
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
	$("#jmbankaccountinfo-edit-form").validate({
		
	});
});
</script>
@endpush