@extends('la.layouts.app')

@section('htmlheader_title')
	BankPledge View
@endsection


@section('main-content')
<div id="page-content" class="profile2">

		
		<!-- <div class="col-md-1 actions">
			<a href="{{ url(config('laraadmin.adminRoute') . '/bankpledges/'.$bankpledge->id.'/edit') }}" class="btn btn-xs btn-edit btn-default"><i class="fa fa-pencil"></i></a><br>
			{{ Form::open(['route' => [config('laraadmin.adminRoute') . '.bankpledges.destroy', $bankpledge->id], 'method' => 'delete', 'style'=>'display:inline']) }}
				<button class="btn btn-default btn-delete btn-xs" type="submit"><i class="fa fa-times"></i></button>
			{{ Form::close() }}
		</div> -->
	</div>

	<ul data-toggle="ajax-tab" class="nav nav-tabs profile" role="tablist">
		<li class=""><a href="{{ url(config('laraadmin.adminRoute') . '/bankpledges') }}" data-toggle="tooltip" data-placement="right" title="Back to BankPledges"><i class="fa fa-chevron-left"></i></a></li>
		<li class="active"><a role="tab" data-toggle="tab" class="active" href="#tab-general-info" data-target="#tab-info"><i class="fa fa-bars"></i> Details</a></li>
		<li class=""><a role="tab" data-toggle="tab" href="" data-target="#tab-timeline"><i class="fa fa-clock-o"></i> Note</a></li>
	</ul>

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active fade in" id="tab-info">
			<div class="tab-content">
				<div class="panel infolist">
					<div class="panel-default panel-heading">
						<h4>In Details</h4>
					</div>
					<div class="panel-body">
						@la_display($module, 'bankpledge_no')
						@la_display($module, 'date_pledge')
						@la_display($module, 'item_id')
						@la_display($module, 'item_categorie_id')
						@la_display($module, 'jute_receive_id')
						@la_display($module, 'jute_receive')
						@la_display($module, 'unit_type')
						@la_display($module, 'sub_unit_type')
						@la_display($module, 'quantity')
						@la_display($module, 'sub_unit_quantity')
						@la_display($module, 'total_quantity')
						@la_display($module, 'pledge_status')
						@la_display($module, 'returned_date')
						@la_display($module, 'user_id')
						@la_display($module, 'stock_in_hand')
					</div>
				</div>
			</div>
		</div>	
	</div>
	</div>
	</div>
</div>
@endsection
