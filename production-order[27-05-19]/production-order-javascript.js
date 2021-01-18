checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('production_order_list_form').elements.length; i++) {

	  document.getElementById('production_order_list_form').elements[i].checked = checked;

	}

}


function GetRawDetail(){

	var m_id 			= getQuotationId();

	$.get('raw-product-detail.php',

		{m_id:m_id},

		function(data) { $('#raw_detail_content').html( data ); }

	);	

}


function GetDetail(t_id){

	var m_id 			= getQuotationId();

	$.get('product-detail.php',

		{m_id:m_id,t_id:t_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){
	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) {

		if (document.getElementById('product_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;
			var product_id 				= document.getElementById('product_id'+ord_id).value;
			var product_name 			= document.getElementById('product_name'+ord_id).value;
			var product_brand_name 		= document.getElementById('product_brand_name'+ord_id).value;
			var product_brand_id 		= document.getElementById('product_brand_id'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;

			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_uom_id 			= document.getElementById('product_uom_id'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;

			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_type			= document.getElementById('product_type'+ord_id).value;
			var t_id					= document.getElementById('product_type_id'+ord_id).value;
			var mother_child_type					= document.getElementById('product_mother_child_type'+ord_id).value;
			var table 					= document.getElementById('product_detail');


			var row_cnt_rls     		= $('#product_detail_rls >tbody >tr').length;	
			var row_cnt_rws     		= $('#product_detail_rws >tbody >tr').length;	
			var row_cnt_as     			= $('#product_detail_as >tbody >tr').length;	
			var row_cnt					= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as);
			var apnd					='';
			if(t_id==1){  
			apnd	+= '<tr><td><input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_brand_id[]" id="production_order_product_detail_product_brand_id" value="'+product_brand_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_order_product_detail_entry_type[]" id="production_order_product_detail_entry_type" value="'+t_id+'" />';
			/*
			apnd	+= '<td ><select  name="production_order_product_detail_product_color_id[]" id="production_order_product_detail_product_color_id'+row_cnt+'" onfocus="get_color('+row_cnt+',1);"><option value=""> --Select-- </option></select><input type="hidden"  name="production_order_product_detail_product_uom_id[]" id="production_order_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';*/
			
			apnd	+= '<td ><input type="hidden"  name="production_order_product_detail_product_uom_id[]" id="production_order_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /><select name="production_order_product_detail_product_color_id[]" id="production_order_product_detail_product_color_id'+row_cnt+'" style=" width:100%"> <option value="">--Select--</option></select></td>';
			
			
			apnd	+= '<td  ><select  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick'+row_cnt+'" onfocus="get_color('+row_cnt+',2);"><option value=""> --Select-- </option></select></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value=""  /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm'+row_cnt+'"  onBlur="GetWcalc(3,'+row_cnt+')"onBlur="GetTotalLength('+row_cnt+')" value=""  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet[]" id="production_order_product_detail_sl_feet'+row_cnt+'" onBlur="GetLcalFeet(1,'+row_cnt+'),GetTotalLength('+row_cnt+');"  /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_in[]" id="production_order_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td><td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_mm[]" id="production_order_product_detail_sl_feet_mm'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+');"  /></td><td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_met[]" id="production_order_product_detail_sl_feet_met'+row_cnt+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_ext_feet[]" id="production_order_product_detail_ext_feet'+row_cnt+'" onBlur="GetLcalFeetExtr(1,'+row_cnt+'),GetTotalLength('+row_cnt+');"  /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_ext_feet_in[]" id="production_order_product_detail_ext_feet_in'+row_cnt+'" onblur="GetLcalFeetExtr(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td><td><input class="form-control" type="text"  name="production_order_product_detail_ext_feet_mm[]" id="production_order_product_detail_ext_feet_mm'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+');"  /><td><input class="form-control" type="text"  name="production_order_product_detail_ext_feet_met[]" id="production_order_product_detail_ext_feet_met'+row_cnt+'" /><input type="hidden"  name="production_order_product_detail_s_weight_inches[]" id="production_order_product_detail_s_weight_inches'+row_cnt+'" /><input type="hidden"  name="production_order_product_detail_s_weight_mm[]" id="production_order_product_detail_s_weight_mm'+row_cnt+'"  /></td></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"  onBlur="GetTotalLength(3,'+row_cnt+'),discountPerFind('+row_cnt+');"  /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_tot_length[]" id="production_order_product_detail_tot_length'+row_cnt+'" readonly  /><input  type="hidden"  name="production_order_product_detail_inv_tot_length[]" id="production_order_product_detail_inv_tot_length'+row_cnt+'" readonly value=""   /></td></tr>';
			$("#product_detail_rls_display").append(apnd);	
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td style="width:5%" ><input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_brand_name+'</td><td style="width:5%" >'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /> <input type="hidden"  name="production_order_product_detail_product_brand_id[]" id="production_order_product_detail_product_brand_id'+row_cnt+'" value="'+product_brand_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_order_product_detail_entry_type[]" id="production_order_product_detail_entry_type" value="'+t_id+'" />';
			
			apnd	+= '<td style="width:5%" ><select  name="production_order_product_detail_product_color_id[]" id="production_order_product_detail_product_color_id'+row_cnt+'" onfocus="get_color('+row_cnt+',1);"><option value=""> --Select-- </option></select><input type="hidden"  name="production_order_product_detail_product_uom_id[]" id="production_order_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td style="width:5%" ><select  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick'+row_cnt+'" onfocus="get_color('+row_cnt+',2);"><option value=""> --Select-- </option></select></td>';
			
			apnd	+= '<td ><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value=""  /></td> <td ><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm'+row_cnt+'"   onBlur="GetWcalc(3,'+row_cnt+')" value=""  /></td>';

			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>';
			
			apnd	+= '<td ><input class="form-control" type="text"  name="production_order_product_detail_s_weight_inches[]" id="production_order_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetWeightClc(1,'+row_cnt+'),RawdiscountPerFind('+row_cnt+')"  /></td> <td ><input class="form-control" type="text"  name="production_order_product_detail_s_weight_mm[]" id="production_order_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetWeightClc(2,'+row_cnt+')" /><input type="hidden"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty'+row_cnt+'"  /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_tot_feet[]" id="production_order_product_detail_tot_feet'+row_cnt+'" onBlur="GetTotalFeet(1,'+row_cnt+')" /></td> <td ><input class="form-control" type="text"  name="production_order_product_detail_tot_meter[]" id="production_order_product_detail_tot_meter'+row_cnt+'"  onBlur="GetTotalFeet(4,'+row_cnt+')" /></td></tr>';
			
			$("#product_detail_rws_display").append(apnd);		
			}else{ 
			
			apnd	+= '<tr><td style="width:30%"><input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type"  value="'+product_type+'" /><input type="hidden"  name="production_order_product_detail_entry_type[]" id="production_order_product_detail_entry_type" value="'+t_id+'" /></td>';
			
			apnd	+= '<td style="width:30%">'+product_uom+'<input type="hidden"  name="production_order_product_detail_product_uom_id[]" id="production_order_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td style="width:40%"><input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  /></td></tr>';
			$("#product_detail_as_display").append(apnd);	
			}
				get_color(row_cnt,1);
				get_color(row_cnt,2);
		}
	}
}
  function GetWeightClc(type,id){
	var prod_ton =$('#production_order_product_detail_s_weight_inches'+id).val();
	var prod_kg =$('#production_order_product_detail_s_weight_mm'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#production_order_product_detail_s_weight_mm'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#production_order_product_detail_s_weight_inches'+id).val(prod_val);
	}
	
	
 }
 function GetTotalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_order_product_detail_tot_feet'+id).value;	
	}
	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_order_product_detail_tot_meter'+id).value;	

	}

	
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			if(calculation_id==1){
				document.getElementById('production_order_product_detail_tot_meter'+id).value 		= data_t[3];
			}
			else if(calculation_id==4){
				document.getElementById('production_order_product_detail_tot_feet'+id).value 			= parseFloat(data_t[0]);
			}

		}

	);

}

function get_color(id,type){
	if(type==1){
	$.get('get_color.php',{type:type},function(data){$('#production_order_product_detail_product_color_id'+id).html(data)});
	}else{
	$.get('get_color.php',{type:type},function(data){$('#production_order_product_detail_product_thick'+id).html(data)});
	}
}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('production_order_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('production_order_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('production_order_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('production_order_product_detail_width_mm'+id).value 			= data_t[2];
			document.getElementById('production_order_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('production_order_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('production_order_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('production_order_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('production_order_product_detail_s_width_inches'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('production_order_product_detail_s_width_mm'+id).value 			= data_t[2];
			}
		}

	);

}
function GetLcalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('production_order_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('production_order_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('production_order_product_detail_sl_feet_mm'+id).value;	

	}

	
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			if(calculation_id==1){
				document.getElementById('production_order_product_detail_sl_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('production_order_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
			}
			document.getElementById('production_order_product_detail_sl_feet_met'+id).value 		= data_t[3];

		}

	);

}
function GetLcalFeetExtr(calculation_id,id){

	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('production_order_product_detail_ext_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('production_order_product_detail_ext_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('production_order_product_detail_ext_feet_mm'+id).value;	

	}

	
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			if(calculation_id==1){
				document.getElementById('production_order_product_detail_ext_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('production_order_product_detail_ext_feet'+id).value 			= parseFloat(data_t[0]);
			}
			document.getElementById('production_order_product_detail_ext_feet_met'+id).value 			= data_t[3];

		}

	);

}
function GetTotalLength(id){
	var product_qty 	= document.getElementById('production_order_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('production_order_product_detail_s_width_inches'+id).value;
	var sales_length_f 	= document.getElementById('production_order_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('production_order_product_detail_sl_feet_in'+id).value;
	var sales_length_ef 	= document.getElementById('production_order_product_detail_ext_feet'+id).value;
	var sales_length_ei 	= document.getElementById('production_order_product_detail_ext_feet_in'+id).value;
	
	var sales_length	= Number(sales_length_f)+Number(sales_length_i)+Number(sales_length_ef)+Number(sales_length_ei);
	var width 			= document.getElementById('production_order_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('production_order_product_detail_tot_length'+id).value = (sales_length*product_qty).toFixed(2);
	document.getElementById('production_order_product_detail_inv_tot_length'+id).value = total_length_val.toFixed(2);
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

function Getcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_order_product_detail_width_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('production_order_product_detail_width_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('production_order_product_detail_width_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_order_product_detail_width_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_order_product_detail_width_feet'+id).value 		= data_t[0];

			document.getElementById('production_order_product_detail_width_inches'+id).value 		= data_t[1];

			document.getElementById('production_order_product_detail_width_mm'+id).value 			= data_t[2];

			document.getElementById('production_order_product_detail_width_meter'+id).value 		= data_t[3];

		}

	);

}

function GetLcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_order_product_detail_length_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('production_order_product_detail_length_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('production_order_product_detail_length_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_order_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_order_product_detail_length_feet'+id).value 		= data_t[0];

			document.getElementById('production_order_product_detail_length_inches'+id).value 		= data_t[1];

			document.getElementById('production_order_product_detail_length_mm'+id).value 			= data_t[2];

			document.getElementById('production_order_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetEcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_order_product_detail_ext_length_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_order_product_detail_ext_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_order_product_detail_ext_length_feet'+id).value 		= data_t[0];

			document.getElementById('production_order_product_detail_ext_length_meter'+id).value 		= data_t[3];

		}

	);

}

function getTableHeader(id){
	if(document.getElementById('production_order_type_id1').checked==true){
		$('.product_detail_rls_d').show();
	}else{
		$('.product_detail_rls_d').hide();
	}
	if(document.getElementById('production_order_type_id2').checked==true){
		$('#product_detail_rws').show();
	}else{
		$('#product_detail_rws').hide();
	}
	if(document.getElementById('production_order_type_id4').checked==true){
		$('#product_detail_as').show();
	}else{
		$('#product_detail_as').hide();
	}

	
}