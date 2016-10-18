@extends("la.layouts.app")

@section("contentheader_title", "CardGroups")
@section("contentheader_description", "cardgroups listing")
@section("section", "CardGroups")
@section("sub_section", "Listing")
@section("htmlheader_title", "CardGroups Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add CardGroup</button>
@endsection

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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>


<?php
// src='".asset('/la-assets/img/user4-128x128.jpg')."'

 $html = "<div id='card_div' class='col-md-12' style='border-radius: 10px;border: 1px solid #000000;padding: 4px;width: 324px;height: 204px; '>
	<div class='col-md-7'>
	<h5 style='position: relative; top: 20px; font-family:courier;'> @{{Imrul Kayes}} <br> @{{MD.Abdul Ghani}} <br> @{{Mamataz Begum}} <br> @{{+8801717745374}} <br> </h5>
	</div>
	<div class='col-md-4'  style=' position: relative; top: 30px;'>
	<img class='preview' id='preview' alt='' style='border-radius: 10px;border: 1px solid #73AD21;padding: 1px;width: 100px; height: 110px;'>
	</div>
</div>"?>

<?php $html_back = "<div id='card_back_div' class='col-md-12' style='border-radius: 10px;border: 1px solid #000000;padding: 4px;width: 324px;height: 204px; '>
	<div class='col-md-7'>
	<h5 style='font-family:courier;'> @{{Imrul Kayes}} <br> @{{MD.Abdul Ghani}} <br> @{{Mamataz Begum}} <br> @{{+8801717745374}} <br> </h5>
	</div>
	<div class='col-md-4'>
	</div>
	</div>"?>

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add CardGroup</h4>
			</div>
			{!! Form::open(['action' => 'LA\CardGroupsController@store', 'id' => 'cardgroup-add-form', 'files' => true]) !!}
			<div class="modal-body" ng-app="">
				<div class="box-body">
                    <!-- @la_form($module) -->

			<div class="modal-body">
				<!-- <div class="box-body col-md-6"> -->
				<div class="row">
                 	<div class="form-group col-md-4">
                    
                    <label for="group_type_id"> Group Name :</label>
                    <select class="form-control select2-hidden-accessible" data-placeholder="Enter Group Name" rel="select2" name="group_type_id" tabindex="-1" aria-hidden="true">
							<option value="Select">Select</option>
                    		@foreach ($grouptypes as $grouptype)
							<option value="{{ $grouptype->id }}">{{ $grouptype->groupName }}</option>
                        	@endforeach
                        	</select>
                    
                    </div>
 					<div class="form-group  col-md-4">
                    <label for="layout">Layout :</label><select class="form-control select2-hidden-accessible" data-placeholder="Enter Layout" rel="select2" name="layout" tabindex="-1" aria-hidden="true">
                    <option value="landscape" selected="selected" >landscape</option>
                    <option value="portrait" >portrait</option></select>
                    </div>
                    <!-- <div class="form-group">
                    <label for="card_front_image_link">Fornt Side :</label>
                    <input class="form-control" placeholder="Enter Bornt Side" ng-model="card_front_image_link" data-rule-url="true" name="card_front_image_link" type="text" value=""></div> -->

 					
                </div>
                <div class="row">
                		 <div class="form-group col-md-12">
	                    <label for="description">Description :</label>
	                    <textarea  class="form-control" placeholder="Enter Description" data-rule-maxlength="1000" cols="30" rows="3" name="description"></textarea>
	                    </div>
                </div>
                
                <div class="row">
					<div class="form-group">
	               		<div class='col-md-8'><h4>Front Side</h4></div>
	               </div> 
               </div> 
                
                <div class="row">
                	<div class="form-group col-md-6" id="card_view">
                
                   </div> 

                	<div class="form-group col-md-4">
	                    <label for="image" style="display:block;">Fornt Background :</label>
	            		<input type="file" name="image" files="true" id="imgInp" onchange="loadFile(event);">
                    </div>
                </div>
                <div class="row">

                     <div class="form-group col-md-12">
                    <label for="view_html">View HTML* :</label>
                    <textarea onkeyup="cardHtml();"  class="form-control" placeholder="Enter View HTML"  cols="30" rows="10" name="view_html" id="view_html" value="">{{$html}}</textarea></div>
                </div>

                    
				<div class="row">
					<div class="form-group">
	               		<div class='col-md-8'><h4>Back Side</h4></div>
	               </div> 
               </div> 
                
                <div class="row">
            	    <div class="form-group col-md-6" id="card_view_back">
	               		 
                   	</div>
                    <div class="form-group col-md-4">
	                    <label for="image_back" style="display:block;">Back End Background :</label>
	            		<input type="file" name="image_back" id="image_back" files="true" id="imgInp_back" onchange="loadFileback(event);">
                    </div>

                    
                </div>
                <div class="row">
                	<div class="form-group col-md-12">
                    <label for="view_html_back">View HTML (Back Part)* :</label>
                    <textarea onkeyup="cardHtmlback();"  class="form-control" placeholder="Enter View HTML"  cols="30" rows="10" name="view_html_back" id="view_html_back" value="">{{$html_back}}</textarea></div>
                </div>
                    <!-- <div class="form-group">
                    <label for="card_Back_image_link">Back Side :</label>
                    <input class="form-control"  placeholder="Enter Back Side" data-rule-url="true" name="card_Back_image_link" type="text" value=""></div> -->
 

                   

                   

                    <div class="form-group">
                    <label for="user_id">User name :</label>
                    <select class="form-control select2-hidden-accessible" data-placeholder="Enter User name" rel="select2" name="user_id" tabindex="-1" aria-hidden="true">
                    <option value="1">kayes</option></select></div>

				<!-- </div> -->
				<!-- <div class="box-body col-md-6"> -->

                   
                   
               

                    
				<!-- </div> -->
				<div class="box-body col-md-12">






                    <!-- <div class="htmlbox" id="htmlbox_view_html" contenteditable=""></div>
                    
                    <input class="form-control" onchange="cardHtml();" placeholder="Enter View HTML" required="1"  name="view_html" id="view_html" type="hidden" value="" aria-required="true"></div> -->
 
				</div>
			</div>
					
					{{--
					@la_input($module, 'group_type_id')
					@la_input($module, 'card_front_image_link')
					@la_input($module, 'card_Back_image_link')
					@la_input($module, 'view_html')
					@la_input($module, 'description')
					@la_input($module, 'layout')
					@la_input($module, 'user_id')
					--}}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>

$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/cardgroup_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#cardgroup-add-form").validate({
		
	});
});
</script>
<script>
// var link = "{{asset('/la-assets/img/user4-128x128.jpg')}}";
// document.getElementById("preview").attr('src') = link;

// alert(link);
						 
var idcardview=$("#view_html").val();
$('#card_view').html(idcardview);
preview.src = "{{asset('/image/def_photo.png')}}";

 
function cardHtml() 
{

	var idcardview=$("#view_html").val();
	// alert(idcardview);
	$('#card_view').html(idcardview);
	var urlimg =document.getElementById("imgInp").value ;
	// alert(urlimg);
	document.getElementById("card_div").style.backgroundImage = "url('" + URL.createObjectURL(document.getElementById('imgInp').files[0]); + "')";

	// oldimg = $('.preview').attr('src');
	preview.src = "{{asset('/image/def_photo.png')}}";
		 
}
var idcardviewback=$("#view_html_back").val();
$('#card_view_back').html(idcardviewback);

function cardHtmlback() 
{
	var idcardviewback=$("#view_html_back").val();
	// alert(idcardviewback);
	$('#card_view_back').html(idcardviewback);
	document.getElementById("card_back_div").style.backgroundImage = "url('" + URL.createObjectURL(document.getElementById('image_back').files[0]); + "')";

}
</script>
<script type="text/javascript">
	var loadFile = function(event) {
			     
				var forntsite = URL.createObjectURL(event.target.files[0]);
				document.getElementById("card_div").style.backgroundImage = "url('" + forntsite + "')";
				preview.src = "{{asset('/image/def_photo.png')}}";

			   
			};
	var loadFileback = function(event) {

				var file = document.getElementById("image_back").files[0];
				var backside = URL.createObjectURL(file);
				document.getElementById("card_back_div").style.backgroundImage = "url('" + backside + "')";
			};

$('.submit-button').on('click', function(event) {
  alert('This is a dummy submit button. It does nothing.');
  event.preventDefault();
});

// document.getElementByID("imgtest").src = string;
</script>
@endpush