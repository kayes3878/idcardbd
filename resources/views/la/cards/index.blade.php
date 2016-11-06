@extends("la.layouts.app")

@section("contentheader_title", "Cards")
@section("contentheader_description", "cards listing")
@section("section", "Cards")
@section("sub_section", "Listing")
@section("htmlheader_title", "Cards Listing")

@section("headerElems")
<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Card</button>
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

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Card</h4>
			</div>
			{!! Form::open(['action' => 'LA\CardsController@store', 'id' => 'card-add-form']) !!}
			<div class="modal-body" ng-app="">
				<div class="box-body">
                    <!-- @la_form($module) -->
                    
			            <!-- {!! $view !!} -->
                <div class="row">
                    <div class="form-group col-md-4">
                    
                    <label for="group_type_id"> Group Name :</label>
                    <select  class="form-control select2-hidden-accessible" data-placeholder="Enter Group Name" rel="select2" name="group_type_id" id="group_type_id" tabindex="-1" aria-hidden="true">
                            <option value="Select">Select</option>
                            @foreach ($grouptypes as $grouptype)
                            <option value="{{ $grouptype->cardtype->id }}">{{ $grouptype->cardtype->groupName }}</option>
                            @endforeach
                            </select>
                    
                    </div>
                    <div class="form-group col-md-3">
                    <label for="group_type_id"> Photo Picker :</label>
                    <input type="file"  name="image" files="true" id="imgInp" onchange="loadFile(event);">
                    </div>
            </div>
            <div class="row-fluid">
                <div class="form-group row col-md-4">
                    <div class="form-group" >
                    <label id="testlable"  for="name">Name* : </label>
                    <input onkeyup="hello()" class="form-control" placeholder="Enter Name"  ng-model="name" data-rule-minlength="3" data-rule-maxlength="256" required="1" name="name" id="name" type="text" value="" aria-required="true">
                    
                    </div>
                    <div class="form-group">
                    <label for="fathername">Father Name :</label>
                    <input class="form-control" placeholder="Enter Father Name" ng-model="fathername" data-rule-minlength="3" data-rule-maxlength="256" name="fathername" type="text" value="">
                    </div>
                     <div class="form-group">
                    <label for="mathername">Mather Name :</label>
                    <input class="form-control" placeholder="Enter Mather Name" ng-model="mathername" data-rule-minlength="3" data-rule-maxlength="256" name="mathername" type="text" value="">
                    </div>
                </div>  


                <div class="form-group col-md-5" id="card_view">
                
                </div> 
                
            </div>
            <dir class="row">
                <div class="form-group row col-md-4">

                    <div class="form-group "><label for="phone">Phone :</label>
                    <input class="form-control" placeholder="Enter Phone" data-rule-maxlength="20" ng-model="phone" name="phone" type="text" value="">
                    </div>
                    <div class="form-group ">
                    <label for="organization">Organization Name :</label>
                    <input class="form-control" placeholder="Enter Organization Name" data-rule-minlength="3" data-rule-maxlength="256" name="organization" type="text" value="">
                    </div>
                    <div class="form-group ">

                    <label for="designation_class">Designation / Class :</label>
                    <input class="form-control" placeholder="Enter Designation / Class" ng-model="designation_class" data-rule-minlength="4" data-rule-maxlength="256" name="designation_class" type="text" value="">
                    </div>
                </div>
            </dir>
            <div class="col-md-6">
        		  
                   <!--  <div class="form-group">
                        <label for="Photo" style="display:block;">Profile Image :</label>
                        <input class="form-control" placeholder="Enter Profile Image" data-rule-maxlength="256" name="Photo" type="hidden" value="0"><a class="btn btn-default btn_upload_image" file_type="image" selecter="Photo">Upload 
                        <i class="fa fa-cloud-upload"></i></a>
                        
                        <div class="uploaded_image hide"><img src="">
                        <i title="Remove Image" class="fa fa-times"></i>
                        </div>
                    </div> -->

                   
                    

                <!--     <div class="form-group">
                    

                    <div class="form-group">
                    <label for="Group">Group :</label>
                    <select class="form-control select2-hidden-accessible" data-placeholder="Enter Publisher" rel="select2" name="Group" tabindex="-1" aria-hidden="true">
                    <option value="Teacher">Teacher</option>
                    <option value="Employee">Employee</option>
                    <option value="Student" selected="selected">Student</option>
                    </select>
                    </div>
                    
                    </div> -->
                     
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
        ajax: "{{ url(config('laraadmin.adminRoute') . '/card_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#card-add-form").validate({
		
	});
});
</script>
<script type="text/javascript">
	var loadFile = function(event) {
    oldimg = $('.preview').attr('src');
    var preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(event.target.files[0]);
    newimg = preview.src;
    if(newimg.indexOf('/null') > -1) {
        preview.src = oldimg;
    }
};

$('.submit-button').on('click', function(event) {
  alert('This is a dummy submit button. It does nothing.');
  event.preventDefault();
});
var hello = function() {
    document.getElementById('testlable').innerHTML = $('#name').val();;
    // var typeid = ;
    // $('#testlable').text() = "kayess";
    // alert(typeid)


    }
 </script>
 
<script type="text/javascript">

// function cardHtml() 
// {

//     var idcardview=$("#view_html").val();
//     // alert(idcardview);
//     $('#card_view').html(idcardview);
    // var urlimg =document.getElementById("imgInp").value ;
    // // alert(urlimg);
    // document.getElementById("card_div").style.backgroundImage = "url('" + URL.createObjectURL(document.getElementById('imgInp').files[0]); + "')";

    // // oldimg = $('.preview').attr('src');
    // preview.src = "{{asset('/image/def_photo.png')}}";
         
// }

$(document).ready(function(){
     $("#group_type_id").change(function(){
       

         var typeid = $('#group_type_id').val();
         if (typeid=="Select") {
                    $('#card_view').empty();
            }
        else{
                 $.get("{{ url(config('laraadmin.adminRoute') . '/cardviewbygroup') }}" + '/' + typeid, function (data) {
                console.log(data);
                $('#card_view').html(data[0].view_html);
                var link = data[0].card_front_image_link;
                var link2 ="{{ asset('/image/uploads/cardbackground/') }}"+"/"+ link;
              
                document.getElementById("card_div").style.backgroundImage ="url('" + link2 + "')";
                preview.src = "{{asset('/image/def_photo.png')}}";
                 
                })
            
            }
             
             
    });
});
</script>

 
@endpush