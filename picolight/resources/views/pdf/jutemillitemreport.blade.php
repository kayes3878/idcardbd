@extends('layouts.report')

@section('content')
<div class="container">
    <div class="modal-body">
	<div class="box-body">

	<table id="example1" class="table table-bordered" style="font-size:10px;">

		<thead>
			<tr class="success">
				<th>ID</th>
				<th>Name</th>
				<th>Code</th>
				<th>Description</th>
				<th>USER</th>
			</tr>

		</thead>

		<tbody>

			@foreach($jutemillitems as $key => $jutemillitem)

			<tr>
				
				<td>{{$jutemillitem-> id}}</td>
				<td>{{$jutemillitem-> item_name}}</td>
				<td>{{$jutemillitem-> item_code}}</td>
				<td>{{$jutemillitem-> item_discription}}</p></td>
				<td>{{$jutemillitem-> user_id}}</td>
			
			</tr>

			@endforeach

		</tbody>
	</table>
	</div>
	</div>
</div>
@endsection


