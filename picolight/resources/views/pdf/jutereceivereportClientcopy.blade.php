<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>PDF Report</title>

	<style type="text/css">

	/*@font-face {
	  font-family: 'siyamrupali';
	  font-style: normal;
	  /*font-weight: 100%;*/
	  /*font-size: x-small;*/
	  /*src: url(https://www.omicronlab.com/download/fonts/AdorshoLipi_20-07-2007.ttf);
	  format('truetype');*/


	#main{
		width:100%;
		padding:5px 10px 5px 10px;
		margin:3px 10px 0 0
		-webkit-border-radius: 5px; 
	    -moz-border-radius: 5px; 
		overflow: hidden;
		border-radius: 5px; 
		border:thin #333 solid;
	}

	#sub{
		width: auto;
		margin: 0 auto;
		border: none;
		overflow: hidden;
	}

	th{
		height: 30px;
		font-size:15px;
		text-align: center;
		background-color:rgb(192,192,192);
    	color: black;
	}

	#maintr:nth-child(even){

			
		text-align: center;
		background-color: #f2f2f2;
		overflow: hidden;
	}

	#subtr{

		border: none;
		text-align: center;
		overflow: hidden;
	}

	body {
	margin:0px;
	overflow: hidden;
	text-decoration:none;
	font-size:11px;
	border-bottom:medium #000 solid;

	}

	td{

		border-bottom-color: rgb(221, 221, 221);
		border-bottom-style: solid;
		border-bottom-width: 1px;
		border-collapse: collapse;
		border-image-outset: 0 0 0 0;
		border-image-repeat: stretch stretch;
		border-image-slice: 100% 100% 100% 100%;
		border-image-source: none;
		border-image-width: 1 1 1 1;
		border-left-color: rgb(221, 221, 221);
		border-left-style: solid;
		border-left-width: 1px;
		border-right-color: rgb(221, 221, 221);
		border-right-style: solid;
		border-right-width: 1px;
		border-top-color: rgb(221, 221, 221);
		border-top-style: solid;
		border-top-width: 0px;
		text-align: center;
	}

	</style>

</head>

<body>

<img src="{{asset('/la-assets/img/reportbanner.png')}}" alt="Cold Storage" style="width:450px;height:auto; margin : 20px; padding-left: 100px;">
<div>					
			@foreach($jutereceives as  $info)
			<div style="margin:10px">	
			<div class="col-xs-12">
            	<label>Date : {{$info->  created_at}}</label>
             
            </div> 
            <div class="col-xs-12">
            	<label>Jute Receive No : {{$info-> jute_receive_no}}</label>
             
            </div>  	
            <div class="col-xs-12">
						<label>Name : {{$info-> supplier->name}}</label>
						 
						</div>	
						<div class="col-xs-12">
						<label>Address : {{$info-> supplier->address}}</label>
						 
						</div>	
						<div class="col-xs-12">
						<label>Mobile No : {{$info-> supplier->mobile}}</label>
						</div>	
						</div>
						    <!-- <tr class="info"> -->
            <div >
            <!-- style="margin-rignt:80px" -->
					<table align="center" class="table table-bordered" id="data_table" >
						<tr>
		                <th>SL</th>
						<th>Item Name</th>
		                <th >Item categorie</th>
		                <th>Quantity (Bundle)</th>
		                <th>Sub Unit Quantity (KG)</th>
								    <!-- <th>Total Quantity</th> -->
						</tr>
									

						@foreach($jutereceives as  $jutereceive)

						<tr>
		                <td></td>
						<td>{{$jutereceive-> item->item_name}}</td>
		                <td>{{$jutereceive-> itemcategory->category_name}}</td>
		                <td>{{$jutereceive-> quantity}}</td>
		                <td>{{$jutereceive-> sub_unit_quantity}}</td>
								    <!-- <td>{{$jutereceive-> total_quantity}}</td> -->
						</tr>
						@endforeach
									

						<tfoot>
			                <td></td>
							<td></td>
			                <td></td>
			                <td>Total</td>
							<td>{{$info-> total_quantity}}</td>
						</tfoot>

						      <!--  <tr >
						        <td class="text-left input-sm" style="display:none;">
						        	<input type='text' style='border:none;' class='text-center ' name='item_categorie_id' value='1' readonly></td>td> 
					        	<td class="text-left input-sm" >
						        	<input type='text' style='border:none;' class='text-center ' name='item_categorie_name' value='1' readonly></td>td>
						        <td class="text-left input-sm" >
						        	<input type='text' style='border:none;' class='text-center ' name='unit_type' value='BUndle' readonly></td>
						        <td class="text-left input-sm" >
						        	<input type='text' style='border:none;' class='text-center ' name='sub_unit_type' value='KG' ></td>
						        <td class="text-left input-sm" >
						        	<input type='text' class='text-right ' name='quantity' value='' ></td>
						        <td class="text-left input-sm" >
						        	<input type='text' class='text-right ' name='sub_unit_quantity' value='' ></td>
						        <td class="text-left input-sm" >
						        	<input type='text'  class='text-right ' name='total_quantity' value='' ></td>
						        <td class="text-left input-sm" >
						        	<input type='button' value='' class='delete btn btn-danger input-sm ' onclick='delete_row()'>
						        </td>
						      </tr> -->
								<!-- <tfoot>
								<tr class="">
						        <td class="text-left input-sm" style="display:none;">item_id</td>
						        <td class="text-left input-sm" style="display:none;">item_categorie_id</td>
						        <td class="text-left input-sm" ></td>
						        <td class="text-left input-sm" style="display:none;">unit_type</td>
						        <td class="text-right input-sm" >Total</td>
						        <td class="text-left input-sm" >
		                  		<input type="text" class="form-control text-right input-sm" style='border:none;' name="t_quantity" id="t_quantity" value="0" readonly></td>
						        <td class="text-left input-sm" >
		                  		<input type="text" class="form-control text-right input-sm" style='border:none;' name="total_sub_qnt" id="total_sub_qnt" value="0" readonly></td>
						        <td class="text-left input-sm" >
		                  		<input type="text" class="form-control text-right input-sm" style='border:none;' name="total_qnt" id="total_qnt" value="0" readonly></td>
						        <td class="text-left input-sm" ></td>
						      </tr>
							  </tfoot> -->
						</table>
              </div>

              @break;

            @endforeach

</div>

</body>

</html>

