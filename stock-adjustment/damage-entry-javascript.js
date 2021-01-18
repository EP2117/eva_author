checked = false;

function checkedAll() {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('stock_adjustment_list_form').elements.length; i++) {

	  document.getElementById('stock_adjustment_list_form').elements[i].checked = checked;

	}

}

function GetProddisplay(){
		var gin_type 		= document.getElementById('stock_adjustment_type_id').value;
		/*$('.prduc_detail').hide();
		if(gin_type==3){
			$('.prduc_detail').show();
		}*/
		getTableHeader(gin_type);
}
function getTableHeader(id){
	//$('#product_detail >tbody >tr').remove();
	if(id ==1){
	$('.rls').show(); $('.as').hide(); 
	}else if(id==3){
	$('.rls').show(); $('.as').hide(); 
	}else if(id==2){
	$('.as').show();  $('.rls').hide(); ;
	}else{
		$('.rls').hide();
		$('.as').hide();
	}
	
}



function GetDetail(){

	var stock_adjustment_type_id 		= document.getElementById('stock_adjustment_type_id').value;
	var m_id 			= getQuotationId();
	
		$.get('raw-product-detail.php',
	
			{m_id:m_id,t_id:stock_adjustment_type_id},
	
			function(data) { $('#dynamic-content').html( data ); }
	
		);	
}

function AddproductDetail(){
	var x						= document.getElementsByName("chk_product_id[]");
	//console.log(x);
	for (var k = 0; k < x.length; k++) {
		if (x[k].checked ==true) {
			var ord_id 					=  x[k].value;
            
			var detail_id 					= ord_id;
			var product_name 				= document.getElementById('product_name'+ord_id).value;
		
			var product_id 					= document.getElementById('product_id'+ord_id).value;
			var product_code 				= document.getElementById('product_code'+ord_id).value;
			var product_uom 				= document.getElementById('product_uom'+ord_id).value;
			var product_type				= document.getElementById('product_type'+ord_id).value;
			var t_id						= document.getElementById('stock_adjustment_type_id').value;
			if(t_id!=2){ 
			//console.log('ID',t_id);
			//alert('1');
			/*var product_length_feet		= document.getElementById('product_length_feet'+ord_id).value;
			console.log('product_length_feet',product_length_feet);
			var product_length_mm		= document.getElementById('product_length_mm'+ord_id).value;
			var product_tone			= document.getElementById('product_tone'+ord_id).value;
			var product_kg				= document.getElementById('product_kg'+ord_id).value;*/
			
			var product_colour_name			= document.getElementById('product_colour_name'+ord_id).value;
			//var product_colour_id			= document.getElementById('product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('product_thick_ness'+ord_id).value;
			//var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
				//var product_osf_ton			= document.getElementById('product_osf_ton'+ord_id).value;
			}
			var table 					= document.getElementById('product_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	
			var apnd = '';
			if(t_id!=2){  
			//alert('1');
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="stock_adjustment_product_detail_product_id[]" id="stock_adjustment_product_detail_product_id" value="'+ord_id+'" /></td>';
			apnd	+= '<td>'+product_uom+'</td>';
			apnd	+= '<td>'+product_colour_name+'</td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="stock_adjustment_product_detail_product_thick[]" id="stock_adjustment_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness+'"/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_add_feet[]" id="stock_adjustment_product_detail_add_feet'+row_cnt+'"  onChange="GetLcalFeet(1,'+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="stock_adjustment_product_detail_add_mm[]" id="stock_adjustment_product_detail_add_mm'+row_cnt+'" onChange="GetLcalFeet(4,'+row_cnt+')"/></td>';

			apnd	+= '<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_add_tone[]" id="stock_adjustment_product_detail_add_tone'+row_cnt+'"  onChange="GetWeightClc(1,'+row_cnt+')"  /> </td><td><input class="form-control" type="text"  name="stock_adjustment_product_detail_add_kg[]" id="stock_adjustment_product_detail_add_kg'+row_cnt+'"   onChange="GetWeightClc(1,'+row_cnt+')" /></td>';
			apnd	+= '<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_less_feet[]" id="stock_adjustment_product_detail_less_feet'+row_cnt+'"  onChange="GetLcalFeet1(1,'+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="stock_adjustment_product_detail_less_mm[]" id="stock_adjustment_product_detail_less_mm'+row_cnt+'" onChange="GetLcalFeet1(4,'+row_cnt+')"/></td>';
				apnd	+= '<td><input class="form-control" type="text"  name="stock_adjustment_product_detail_less_tone[]" id="stock_adjustment_product_detail_less_tone'+row_cnt+'"  onChange="GetWeightClc1(1,'+row_cnt+')"  /></td><td><input class="form-control" type="text"  name="stock_adjustment_product_detail_less_kg[]" id="stock_adjustment_product_detail_less_kg'+row_cnt+'"   onChange="GetWeightClc1(3,'+row_cnt+')" /></td></tr>';
			
		$("#product_detail_display" ).append(apnd);
		GetLcalFeet(1,row_cnt);
			
			}else{ 
			
			apnd	+= '<tr><td style="width:30%">'+product_name+'<input type="hidden"  name="stock_adjustment_product_detail_product_id[]" id="stock_adjustment_product_detail_product_id" /><input type="hidden"  name="stock_adjustment_product_detail_product_type[]" id="stock_adjustment_product_detail_product_type"  value="'+product_type+'" /></td>';
			
			apnd	+= '<td style="width:30%">'+product_uom+'</td>';
			
			apnd	+= '<td style="width:25%"><input class="form-control" type="text"  name="stock_adjustment_product_detail_add_qty[]" id="stock_adjustment_product_detail_add_qty'+row_cnt+'"  onchange="AccdiscountPerFind('+row_cnt+')"  /></td><td style="width:25%"><input class="form-control" type="text"  name="stock_adjustment_product_detail_less_qty[]" id="stock_adjustment_product_detail_less_qty'+row_cnt+'" onchange="AccdiscountPerFind('+row_cnt+')"  /></td></tr>';
		$("#product_detail_display" ).append(apnd);
			}
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}

}
 function GetWeightClc(type,id){
	var prod_ton =$('#stock_adjustment_product_detail_add_tone'+id).val();
	var prod_kg =$('#stock_adjustment_product_detail_add_kg'+id).val();
	if(type==1){
		var prod_val	= parseFloat(prod_ton*1000);
		$('#stock_adjustment_product_detail_add_kg'+id).val(prod_val)	;
	}
	if(type==3){
		var prod_val	= parseFloat(prod_kg*0.001);
		$('#stock_adjustment_product_detail_add_tone'+id).val(prod_val);
	}
	
	
 }


 function GetWeightClc1(type,id){//alert(type);
 
	var prod_ton =$('#stock_adjustment_product_detail_less_tone'+id).val();
	var prod_kg =$('#stock_adjustment_product_detail_less_kg'+id).val();
	if(type==1){
		var prod_val	= parseFloat(prod_ton*1000);
		$('#stock_adjustment_product_detail_less_kg'+id).val(prod_val); alert(prod_val);
	}
	if(type==3){
		var prod_val	= parseFloat(prod_kg*0.001);
		$('#stock_adjustment_product_detail_less_tone'+id).val(prod_val);
	}
 }





function GetLcalFeet(calculation_id,id){
		var osf_tone 	= document.getElementById('stock_adjustment_product_detail_add_tone'+id).value;	
	if(calculation_id==1){

		var calc_amount 	= document.getElementById('stock_adjustment_product_detail_add_feet'+id).value;	

	}
	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('stock_adjustment_product_detail_add_mm'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('stock_adjustment_product_detail_add_feet'+id).value 			= parseFloat(data_t[0]);


			document.getElementById('stock_adjustment_product_detail_add_mm'+id).value 		= data_t[3];
			var data1 = data_t[0];
			if(data1==''){
				data1=0;
			}
			if(osf_tone==''){
				osf_tone=0;
			}

			document.getElementById('stock_adjustment_product_detail_add_tone'+id).value 		= parseFloat(data1)*parseFloat(osf_tone);//alert(osf_tone);
			GetWeightClc(1,id);

		}

	);

}




function GetLcalFeet1(calculation_id,id){
		var osf_tone 	= document.getElementById('stock_adjustment_product_detail_less_tone'+id).value;	
	if(calculation_id==1){

		var calc_amount 	= document.getElementById('stock_adjustment_product_detail_less_feet'+id).value;	

	}
	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('stock_adjustment_product_detail_less_mm'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('stock_adjustment_product_detail_less_feet'+id).value 			= parseFloat(data_t[0]);


			document.getElementById('stock_adjustment_product_detail_less_mm'+id).value 		= data_t[3];

			document.getElementById('stock_adjustment_product_detail_less_tone'+id).value 		= parseFloat(data_t[0])*parseFloat(osf_tone);
			GetWeightClc(1,id);

		}

	);

}


function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('stock_adjustment_product_detail_add_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('stock_adjustment_product_detail_add_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('stock_adjustment_product_detail_add_inches'+id).value 		= data_t[1];
			document.getElementById('stock_adjustment_product_detail_add_mm'+id).value 			= data_t[2];
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('stock_adjustment_product_detail_add_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('stock_adjustment_product_detail_add_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('stock_adjustment_product_detail_add_inches'+id).value 		= data_t[1];
			document.getElementById('stock_adjustment_product_detail_add_mm'+id).value 			= data_t[2];
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
	var stock_adjustment_type_id 	= document.getElementById('stock_adjustment_type_id').value;
	//var production_entry_id 	= document.getElementById('stock_adjustment_production_entry_id').value;
	$.get('raw-product-detail.php', 
		  
		{m_id:m_id,rp_id:rp_id,t_id:stock_adjustment_type_id},

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
			
			var product_tone				= document.getElementById('raw_product_ton'+ord_id).value;
			var product_kg					= document.getElementById('raw_product_kg'+ord_id).value;
			var apnd						= '';
			 
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="stock_adjustment_raw_product_detail_product_id[]" id="stock_adjustment_raw_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="stock_adjustment_raw_product_detail_product_type[]" id="stock_adjustment_raw_product_detail_product_type" value="2" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="stock_adjustment_raw_product_detail_product_color_id[]" id="stock_adjustment_raw_product_detail_product_color_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="stock_adjustment_raw_product_detail_product_thick[]" id="stock_adjustment_raw_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_adjustment_raw_product_detail_sl_feet[]" id="stock_adjustment_raw_product_detail_sl_feet'+row_cnt+'" onblur="GetRLcalFeet(1,'+row_cnt+')"  onBlur="GetRTotalLength('+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="stock_adjustment_raw_product_detail_sl_feet_mm[]" id="stock_adjustment_raw_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetRLcalFeet(3,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')"    /></td>';
			apnd	+= '<td><input class="form-control" type="text"  name="stock_adjustment_raw_product_detail_ton[]" id="stock_adjustment_raw_product_detail_ton'+row_cnt+'"  onBlur="GetRTotalLength('+row_cnt+')"   /></td><td><input class="form-control" type="text"  name="stock_adjustment_raw_product_detail_kg[]" id="stock_adjustment_raw_product_detail_kg'+row_cnt+'"    /></td></tr>';
			apnd	+= '<td><input class="form-control" type="text"  name="stock_adjustment_raw_product_detail_sl_feet[]" id="stock_adjustment_raw_product_detail_sl_feet'+row_cnt+'" onblur="GetRLcalFeet(1,'+row_cnt+')"  onBlur="GetRTotalLength('+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="stock_adjustment_raw_product_detail_sl_feet_mm[]" id="stock_adjustment_raw_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetRLcalFeet(3,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')"    /></td>';
			apnd	+= '<td><input class="form-control" type="text"  name="stock_adjustment_raw_product_detail_ton[]" id="stock_adjustment_raw_product_detail_ton'+row_cnt+'"  onBlur="GetRTotalLength('+row_cnt+')"   /></td><td><input class="form-control" type="text"  name="stock_adjustment_raw_product_detail_kg[]" id="stock_adjustment_raw_product_detail_kg'+row_cnt+'"    /></td></tr>';
			
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		$("#raw_product_detail_display" ).append(apnd);
		}
	}

}	
 function GetRWeightClc(type,id){
		var product_id		=$("#stock_adjustment_raw_product_detail_mas_product_id"+id).val();
		var prd_thick		=$("#stock_adjustment_raw_product_detail_product_thick"+id).val();
		if(type==1){
			var prd_qty_val		=$("#stock_adjustment_raw_product_detail_s_weight_inches"+id).val();
 		}else{
			var prd_qty_val		=$("#stock_adjustment_raw_product_detail_s_weight_mm"+id).val();
		}
		$.get(
			"../ajax-file/product-weight-calc.php",
			{product_id:product_id,prd_thick:prd_thick,prd_type:type,prd_qty_val:prd_qty_val},
			function(data) {
				if(type==1){
					$("#stock_adjustment_raw_product_detail_s_weight_mm"+id).val(data);
				}else{
					$("#damage_entry_raw_product_detail_s_weight_inches"+id).val(data);
				}
			}
		);
 }

function GetRLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('stock_adjustment_raw_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('stock_adjustment_raw_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('stock_adjustment_raw_product_detail_s_width_inches'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('stock_adjustment_raw_product_detail_s_width_mm'+id).value 			= data_t[2];
			}
		}

	);

}
function GetRLcalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('stock_adjustment_raw_product_detail_sl_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('stock_adjustment_raw_product_detail_sl_feet_in'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('stock_adjustment_raw_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		//var calc_amount 	= document.getElementById('stock_adjustment_raw_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('stock_adjustment_raw_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('stock_adjustment_raw_product_detail_sl_feet_in'+id).value 		= data_t[1];

			document.getElementById('stock_adjustment_raw_product_detail_sl_feet_mm'+id).value 		= data_t[2];

			//document.getElementById('stock_adjustment_raw_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}
function GetRTotalLength(id){
	
	var product_qty 	= document.getElementById('stock_adjustment_raw_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('stock_adjustment_raw_product_detail_s_width_inches'+id).value;
	var sales_length 	= document.getElementById('stock_adjustment_raw_product_detail_sl_feet'+id).value;
	var width 			= document.getElementById('stock_adjustment_raw_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('stock_adjustment_raw_product_detail_tot_length'+id).value = total_length_val.toFixed(2);
	
}


function GetcustomerDetail(){

	var cus_id 	= document.getElementById('stock_adjustment_customer_id').value;	

	$.get('../ajax-file/customer-detail.php',

		{cus_id:cus_id},

		function(data) { 

			var s_data	= data.split('@');

			document.getElementById('stock_adjustment_address').value 		= s_data[6];

			document.getElementById('stock_adjustment_contact_no').value 	= s_data[7];

			

		}

	);	

}

