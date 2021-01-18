checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('damage_entry_list_form').elements.length; i++) {

	  document.getElementById('damage_entry_list_form').elements[i].checked = checked;

	}

}

function GetProddisplay(){
		var gin_type 		= document.getElementById('damage_entry_type_id').value;
		$('.prduc_detail').hide();
		if(gin_type==3){
			$('.prduc_detail').show();
		}
		getTableHeader(gin_type);
}
function getTableHeader(id){
	//$('#product_detail >tbody >tr').remove();
	if(id ==2){
	$('.rls').show(); $('.as').hide(); 
	}else if(id==3){
	$('.rls').show(); $('.as').hide(); 
	}else if(id==1){
	$('.as').show();  $('.rls').hide(); ;
	}else{
		$('.rls').hide();
		$('.as').hide();
	}
	
}


function GetSodetail(){

	var branch_id 		= document.getElementById('damage_entry_branch_id').value;
	$.get('sales-detail.php',

		{branch_id:branch_id},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;

			var production_entry_id 		= ord_id;

			var production_entry_no 		= document.getElementById('production_entry_no'+ord_id).value;

			var production_entry_date 		= document.getElementById('production_entry_date'+ord_id).value;

			var production_entry_type 		= document.getElementById('production_entry_type'+ord_id).value;
			var table 				= document.getElementById('so_detail');

			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+production_entry_no+"</td><td>"+production_entry_date+"<input type='hidden'  name='damage_entry_production_entry_id' id='damage_entry_production_entry_id' value='"+production_entry_id+"'  class='dc_id'  /> </tr>");


		}

	}

}

function GetDetail(){

	var damage_entry_type_id 		= document.getElementById('damage_entry_type_id').value;
	var m_id 			= getQuotationId();
	if(damage_entry_type_id==3){
	var production_entry_id 	= document.getElementById('damage_entry_production_entry_id').value;
		$.get('product-detail.php',
	
			{production_entry_id:production_entry_id,m_id:m_id,t_id:damage_entry_type_id},
	
			function(data) { $('#dynamic-content').html( data ); }
	
		);	
	}
	else{
		$.get('raw-product-detail.php',
	
			{m_id:m_id,t_id:damage_entry_type_id},
	
			function(data) { $('#dynamic-content').html( data ); }
	
		);	
	}
		

}

function AddproductDetail(){
	var x						= document.getElementsByName("chk_product_id[]");
	for (var k = 0; k < x.length; k++) {
		if (x[k].checked ==true) {
			var ord_id 					=  x[k].value;

			var detail_id 					= ord_id;
			var product_name 				= document.getElementById('product_name'+ord_id).value;
			var product_id 					= document.getElementById('product_id'+ord_id).value;
			var product_code 				= document.getElementById('product_code'+ord_id).value;
			var product_uom 				= document.getElementById('product_uom'+ord_id).value;
			var product_type				= document.getElementById('product_type'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			if(t_id!=1){ 
			var product_width_inches	= document.getElementById('product_width_inches'+ord_id).value;
			var product_width_mm		= document.getElementById('product_width_mm'+ord_id).value;
			var product_length_feet		= document.getElementById('product_length_feet'+ord_id).value;
			var product_length_mm		= document.getElementById('product_length_mm'+ord_id).value;
			var product_tone			= document.getElementById('product_tone'+ord_id).value;
			var product_kg				= document.getElementById('product_kg'+ord_id).value;
			var product_colour_name			= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
			var product_osf_ton		    	= document.getElementById('product_osf_ton'+ord_id).value;
			}
			var product_mother_child_type	= document.getElementById('product_mother_child_type'+ord_id).value;
			var table 					= document.getElementById('product_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	
			var apnd = '';
			if(t_id!=1){ 
			apnd	+= '<tr><td><input type="hidden"  name="damage_entry_product_detail_mother_child_type[]" id="damage_entry_product_detail_mother_child_type" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="damage_entry_product_detail_product_id[]" id="damage_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="damage_entry_product_detail_product_type[]" id="damage_entry_product_detail_product_type" value="2" /><input type="hidden"  name="damage_entry_product_detail_po_detail_id[]" id="damage_entry_product_detail_po_detail_id" value="'+ord_id+'" />';
			apnd	+= '<td>'+product_uom+'</td>';
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="damage_entry_product_detail_product_color_id[]" id="damage_entry_product_detail_product_color_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="damage_entry_product_detail_product_thick[]" id="damage_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="damage_entry_product_detail_width_inches[]" id="damage_entry_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')"value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="damage_entry_product_detail_width_mm[]" id="damage_entry_product_detail_width_mm'+row_cnt+'"   onBlur="GetWcalc(3,'+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="damage_entry_product_detail_length_feet[]" id="damage_entry_product_detail_length_feet'+row_cnt+'"  value="'+product_length_feet+'" onBlur="GetLcalFeet(1,'+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="damage_entry_product_detail_length_mm[]" id="damage_entry_product_detail_length_mm'+row_cnt+'" value="'+product_length_mm+'" onBlur="GetLcalFeet(4,'+row_cnt+')" /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="damage_entry_product_detail_weight_tone[]" id="damage_entry_product_detail_weight_tone'+row_cnt+'"  onBlur="GetWeightClc(1,'+row_cnt+')" value="'+product_tone+'" readonly   /> <input type="hidden"  name="damage_entry_product_detail_osf_tone[]" id="damage_entry_product_detail_osf_tone'+row_cnt+'" value="'+product_osf_ton+'"   /></td><td><input class="form-control" type="text"  name="damage_entry_product_detail_weight_kg[]" id="damage_entry_product_detail_weight_kg'+row_cnt+'" readonly  value="'+product_kg+'"  onBlur="GetWeightClc(2,'+row_cnt+')" /></td></tr>';
		$("#product_detail_display" ).append(apnd);
		GetLcalFeet(1,row_cnt);
			
			}else{ 
			
			apnd	+= '<tr><td style="width:30%"><input type="hidden"  name="damage_entry_product_detail_mother_child_type[]" id="damage_entry_product_detail_mother_child_type" value="'+product_mother_child_type+'" />'+product_name+'<input type="hidden"  name="damage_entry_product_detail_product_id[]" id="damage_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="damage_entry_product_detail_product_type[]" id="damage_entry_product_detail_product_type"  value="'+product_type+'" /></td>';
			
			apnd	+= '<td style="width:30%">'+product_uom+'</td>';
			
			apnd	+= '<td style="width:40%"><input class="form-control" type="text"  name="damage_entry_product_detail_qty[]" id="damage_entry_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  /></td></tr>';
		$("#product_detail_display" ).append(apnd);
			}
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}

}
 function GetWeightClc(type,id){
	var prod_ton =$('#damage_entry_product_detail_weight_tone'+id).val();
	var prod_kg =$('#damage_entry_product_detail_weight_kg'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#damage_entry_product_detail_weight_kg'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#damage_entry_product_detail_weight_tone'+id).val(prod_val);
	}
	
	
 }




function GetLcalFeet(calculation_id,id){
		var osf_tone 	= document.getElementById('damage_entry_product_detail_osf_tone'+id).value;	
	if(calculation_id==1){

		var calc_amount 	= document.getElementById('damage_entry_product_detail_length_feet'+id).value;	

	}
	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('damage_entry_product_detail_length_mm'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('damage_entry_product_detail_length_feet'+id).value 			= parseFloat(data_t[0]);


			document.getElementById('damage_entry_product_detail_length_mm'+id).value 		= data_t[3];

			document.getElementById('damage_entry_product_detail_weight_tone'+id).value 		= eval(data_t[0])*eval(osf_tone);
			GetWeightClc(1,id);

		}

	);

}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('damage_entry_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('damage_entry_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('damage_entry_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('damage_entry_product_detail_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('damage_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('damage_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('damage_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('damage_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}
function getQuotationId(){

	

	var m_id = '';

	var x = $('.sd_id').map(function() { return this.value; }).get();

    //var x=document.getElementsByName("purchase_order_entry_id");

	for (var i = 0; i < x.length; i++) {

		if (m_id == '') {

			m_id = '"'+x[i]+'"';

			//m_id = document.getElementsByName("purchase_order_entry_id")[i].value;

		} else {

			m_id = m_id + ',"'+x[i]+'"';

			//m_id = m_id + ','+ document.getElementsByName("purchase_order_entry_id")[i].value ;

		}

	}

	return m_id;

}
function getProductId(){
	var m_id = '';
	var x = $('.sp_id').map(function() { return this.value; }).get();
    //var x=document.getElementsByName("purchase_order_entry_id");
	for (var i = 0; i < x.length; i++) {
		if (m_id == '') {
			m_id = '"'+x[i]+'"';
			//m_id = document.getElementsByName("purchase_order_entry_id")[i].value;
		} else {
			m_id = m_id + ',"'+x[i]+'"';
			//m_id = m_id + ','+ document.getElementsByName("purchase_order_entry_id")[i].value ;
		}
	}
	return m_id;
}


function GetRawDetail(){

	var m_id 			= getProductId();
	var rp_id 			= getRawProductId();
	var damage_entry_type_id 	= document.getElementById('damage_entry_type_id').value;
	//var production_entry_id 	= document.getElementById('damage_entry_production_entry_id').value;
	$.get('raw-product-detail.php',

		{m_id:m_id,rp_id:rp_id,t_id:damage_entry_type_id},

		function(data) {$('#dynamic-content').html( data );  }

	);	

}
function getRawProductId(){
	var m_id = '';
	var x = $('.sr_id').map(function() { return this.value; }).get();
    //var x=document.getElementsByName("purchase_order_entry_id");
	for (var i = 0; i < x.length; i++) {
		if (m_id == '') {
			m_id = '"'+x[i]+'"';
			//m_id = document.getElementsByName("purchase_order_entry_id")[i].value;
		} else {
			m_id = m_id + ',"'+x[i]+'"';
			//m_id = m_id + ','+ document.getElementsByName("purchase_order_entry_id")[i].value ;
		}
	}
	return m_id;
}
function AddRawproductDetail(){
	for (var i = 0; i < document.getElementById('raw_product_list_form').elements.length; i++) {

		if (document.getElementById('raw_product_list_form').elements[i].checked ==true) {

			var ord_id 						=  document.getElementById('raw_product_list_form').elements[i].value;

			var detail_id 					= ord_id;
			var product_name 				= document.getElementById('raw_product_name'+ord_id).value;
			var product_id 					= document.getElementById('raw_product_id'+ord_id).value;
			var product_code 				= document.getElementById('raw_product_code'+ord_id).value;
			var product_uom 				= document.getElementById('raw_product_uom'+ord_id).value;
			var product_colour_name			= document.getElementById('raw_product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('raw_product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('raw_product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('raw_product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('raw_product_thick_ness_id'+ord_id).value;
			var product_width_inches		= document.getElementById('raw_product_width_inches'+ord_id).value;
			var product_width_mm			= document.getElementById('raw_product_width_mm'+ord_id).value;
			var product_sl_feet				= document.getElementById('raw_product_sl_feet'+ord_id).value;
			var product_sl_feet_mm			= document.getElementById('raw_product_sl_feet_mm'+ord_id).value;
			var product_mother_child_type	= document.getElementById('product_mother_child_type'+ord_id).value;
			
			var product_tone				= document.getElementById('raw_product_ton'+ord_id).value;
			var product_kg					= document.getElementById('raw_product_kg'+ord_id).value;
			var apnd						= '';
			 
			apnd	+= '<tr><td><input type="hidden"  name="damage_entry_raw_product_detail_mother_child_tpye[]" id="damage_entry_raw_product_detail_mother_child_tpye" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="damage_entry_raw_product_detail_product_id[]" id="damage_entry_raw_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="damage_entry_raw_product_detail_product_type[]" id="damage_entry_raw_product_detail_product_type" value="2" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="damage_entry_raw_product_detail_product_color_id[]" id="damage_entry_raw_product_detail_product_color_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="damage_entry_raw_product_detail_product_thick[]" id="damage_entry_raw_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="damage_entry_raw_product_detail_width_inches[]" id="damage_entry_raw_product_detail_width_inches'+row_cnt+'"  onkeyup="GetRLcalc(2,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="damage_entry_raw_product_detail_width_mm[]" id="damage_entry_raw_product_detail_width_mm'+row_cnt+'"   onBlur="GetRTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="damage_entry_raw_product_detail_sl_feet[]" id="damage_entry_raw_product_detail_sl_feet'+row_cnt+'" onblur="GetRLcalFeet(1,'+row_cnt+')"  onBlur="GetRTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="damage_entry_raw_product_detail_sl_feet_mm[]" id="damage_entry_raw_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetRLcalFeet(3,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')"  value="'+product_sl_feet_mm+'"   /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="damage_entry_raw_product_detail_ton[]" id="damage_entry_raw_product_detail_ton'+row_cnt+'"  onBlur="GetRTotalLength('+row_cnt+')" value="'+product_tone+'"   /></td><td><input class="form-control" type="text"  name="damage_entry_raw_product_detail_kg[]" id="damage_entry_raw_product_detail_kg'+row_cnt+'" readonly  value="'+product_kg+'"  /></td></tr>';
			
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		$("#raw_product_detail_display" ).append(apnd);
		}
	}

}	
 function GetRWeightClc(type,id){
		var product_id		=$("#damage_entry_raw_product_detail_mas_product_id"+id).val();
		var prd_thick		=$("#damage_entry_raw_product_detail_product_thick"+id).val();
		if(type==1){
			var prd_qty_val		=$("#damage_entry_raw_product_detail_s_weight_inches"+id).val();
 		}else{
			var prd_qty_val		=$("#damage_entry_raw_product_detail_s_weight_mm"+id).val();
		}
		$.get(
			"../ajax-file/product-weight-calc.php",
			{product_id:product_id,prd_thick:prd_thick,prd_type:type,prd_qty_val:prd_qty_val},
			function(data) {
				if(type==1){
					$("#damage_entry_raw_product_detail_s_weight_mm"+id).val(data);
				}else{
					$("#damage_entry_raw_product_detail_s_weight_inches"+id).val(data);
				}
			}
		);
 }

function GetRLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('damage_entry_raw_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('damage_entry_raw_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('damage_entry_raw_product_detail_s_width_inches'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('damage_entry_raw_product_detail_s_width_mm'+id).value 			= data_t[2];
			}
		}

	);

}
function GetRLcalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('damage_entry_raw_product_detail_sl_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('damage_entry_raw_product_detail_sl_feet_in'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('damage_entry_raw_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		//var calc_amount 	= document.getElementById('damage_entry_raw_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('damage_entry_raw_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('damage_entry_raw_product_detail_sl_feet_in'+id).value 		= data_t[1];

			document.getElementById('damage_entry_raw_product_detail_sl_feet_mm'+id).value 		= data_t[2];

			//document.getElementById('damage_entry_raw_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}
function GetRTotalLength(id){
	
	var product_qty 	= document.getElementById('damage_entry_raw_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('damage_entry_raw_product_detail_s_width_inches'+id).value;
	var sales_length 	= document.getElementById('damage_entry_raw_product_detail_sl_feet'+id).value;
	var width 			= document.getElementById('damage_entry_raw_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('damage_entry_raw_product_detail_tot_length'+id).value = total_length_val.toFixed(2);
	
}


function GetcustomerDetail(){

	var cus_id 	= document.getElementById('damage_entry_customer_id').value;	

	$.get('../ajax-file/customer-detail.php',

		{cus_id:cus_id},

		function(data) { 

			var s_data	= data.split('@');

			document.getElementById('damage_entry_address').value 		= s_data[6];

			document.getElementById('damage_entry_contact_no').value 	= s_data[7];

			

		}

	);	

}

