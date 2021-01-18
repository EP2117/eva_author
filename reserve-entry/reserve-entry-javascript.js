checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('reserve_entry_list_form').elements.length; i++) {

	  document.getElementById('reserve_entry_list_form').elements[i].checked = checked;

	}

}


function GetRawDetail(){

	var m_id 			= getQuotationId();

	$.get('raw-product-detail.php',

		{m_id:m_id},

		function(data) { $('#raw_detail_content').html( data ); }

	);	

}


function GetDetail(){

	var m_id 			= getQuotationId();
	var t_id			= document.getElementById('reserve_entry_type_id').value;
	$.get('product-detail.php',

		{m_id:m_id,t_id:t_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){
		 var t_id	= document.getElementById('reserve_entry_type_id').value;
	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) {

		if (document.getElementById('product_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;
			var product_id 				= document.getElementById('product_id'+ord_id).value;
			var product_name 			= document.getElementById('product_name'+ord_id).value;
			var product_brand_name 		= document.getElementById('product_brand_name'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;

			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;

			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_type			= document.getElementById('product_type'+ord_id).value;
			if(t_id==1 || t_id==2){ 
			var product_width_inches	= document.getElementById('product_width_inches'+ord_id).value;
			var product_width_mm		= document.getElementById('product_width_mm'+ord_id).value;
			var product_length_feet		= document.getElementById('product_length_feet'+ord_id).value;
			var product_length_mm		= document.getElementById('product_length_mm'+ord_id).value;
			var product_tone			= document.getElementById('product_tone'+ord_id).value;
			var product_kg				= document.getElementById('product_kg'+ord_id).value;
			var osf_uom_ton				= document.getElementById('osf_uom_ton'+ord_id).value;
			
			}
			var table 					= document.getElementById('product_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	

			var row_cnt     			= $('#product_detail >tbody >tr').length+1;	 
			var apnd					='';
			if(t_id==1){ 
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="reserve_entry_product_detail_product_id[]" id="reserve_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="reserve_entry_product_detail_product_type[]" id="reserve_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="reserve_entry_product_detail_osf_uom_ton[]" id="reserve_entry_product_detail_osf_uom_ton" value="'+osf_uom_ton+'" /> </td>';

			apnd	+= '<td  >'+product_colour_name+'</td>';

			apnd	+= '<td >'+product_thick_ness+'</td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="reserve_entry_product_detail_width_inches[]" id="reserve_entry_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  readonly /></td> <td><input class="form-control" type="text"  name="reserve_entry_product_detail_width_mm[]" id="reserve_entry_product_detail_width_mm'+row_cnt+'"   value="'+product_width_mm+'"  readonly/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="reserve_entry_product_detail_length_feet[]" id="reserve_entry_product_detail_length_feet'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value="'+product_length_feet+'" readonly /></td> <td><input class="form-control" type="text"  name="reserve_entry_product_detail_length_meter[]" id="reserve_entry_product_detail_length_meter'+row_cnt+'"   value="'+product_length_mm+'"  readonly/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="reserve_entry_product_detail_qty[]" id="reserve_entry_product_detail_qty'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"   /></td></tr>';
			}else if(t_id == 2){
				
			apnd	+= '<tr><td style="width:5%" >'+product_brand_name+'</td><td style="width:5%" >'+product_name+'<input type="hidden"  name="reserve_entry_product_detail_product_id[]" id="reserve_entry_product_detail_product_id" value="'+product_id+'" /> <input type="hidden"  name="reserve_entry_product_detail_product_type[]" id="reserve_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="reserve_entry_product_detail_osf_uom_ton[]" id="reserve_entry_product_detail_osf_uom_ton" value="'+osf_uom_ton+'" />';
			
			apnd	+= '<td  >'+product_colour_name+'</td>';

			apnd	+= '<td >'+product_thick_ness+'</td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="reserve_entry_product_detail_length_feet[]" id="reserve_entry_product_detail_length_feet'+row_cnt+'"  value="'+product_length_feet+'" readonly /></td> <td><input class="form-control" type="text"  name="reserve_entry_product_detail_length_meter[]" id="reserve_entry_product_detail_length_meter'+row_cnt+'"   value="'+product_length_mm+'"  readonly/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="reserve_entry_product_detail_tone[]" id="reserve_entry_product_detail_tone'+row_cnt+'"  value="'+product_tone+'" readonly /></td> <td><input class="form-control" type="text"  name="reserve_entry_product_detail_kg[]" id="reserve_entry_product_detail_kg'+row_cnt+'"   value="'+product_kg+'"  readonly/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="reserve_entry_product_detail_qty[]" id="reserve_entry_product_detail_qty'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"   /></td></tr>';
			
			
			}else{ 
			
			apnd	+= '<tr><td style="width:30%">'+product_name+'<input type="hidden"  name="reserve_entry_product_detail_product_id[]" id="reserve_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="reserve_entry_product_detail_product_type[]" id="reserve_entry_product_detail_product_type"  value="'+product_type+'" /></td>';
			
			apnd	+= '<td style="width:30%">'+product_uom+'</td>';
			
			apnd	+= '<td style="width:40%"><input class="form-control" type="text"  name="reserve_entry_product_detail_qty[]" id="reserve_entry_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  /></td></tr>';
			
			}
			$("#product_detail_display").append(apnd);
			
				get_color(row_cnt,1);
				get_color(row_cnt,2);
		}
	}
}
  function GetWeightClc(type,id){
	var prod_ton =$('#reserve_entry_product_detail_s_weight_inches'+id).val();
	var prod_kg =$('#reserve_entry_product_detail_s_weight_mm'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#reserve_entry_product_detail_s_weight_mm'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#reserve_entry_product_detail_s_weight_inches'+id).val(prod_val);
	}
	
	
 }
 function GetTotalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_tot_feet'+id).value;	
	}
	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_tot_meter'+id).value;	

	}

	
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			if(calculation_id==1){
				document.getElementById('reserve_entry_product_detail_tot_meter'+id).value 		= data_t[3];
			}
			else if(calculation_id==4){
				document.getElementById('reserve_entry_product_detail_tot_feet'+id).value 			= parseFloat(data_t[0]);
			}

		}

	);

}

function get_color(id,type){
	if(type==1){
	$.get('get_color.php',{type:type},function(data){$('#reserve_entry_product_detail_product_color_id'+id).html(data)});
	}else{
	$.get('get_color.php',{type:type},function(data){$('#reserve_entry_product_detail_product_thick'+id).html(data)});
	}
}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('reserve_entry_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('reserve_entry_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('reserve_entry_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('reserve_entry_product_detail_width_mm'+id).value 			= data_t[2];
			document.getElementById('reserve_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('reserve_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('reserve_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('reserve_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('reserve_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('reserve_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
			}
		}

	);

}
function GetLcalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('reserve_entry_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('reserve_entry_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_sl_feet_mm'+id).value;	

	}

	
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			if(calculation_id==1){
				document.getElementById('reserve_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('reserve_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
			}
			document.getElementById('reserve_entry_product_detail_sl_feet_met'+id).value 		= data_t[3];

		}

	);

}
function GetLcalFeetExtr(calculation_id,id){

	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('reserve_entry_product_detail_ext_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('reserve_entry_product_detail_ext_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_ext_feet_mm'+id).value;	

	}

	
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			if(calculation_id==1){
				document.getElementById('reserve_entry_product_detail_ext_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('reserve_entry_product_detail_ext_feet'+id).value 			= parseFloat(data_t[0]);
			}
			document.getElementById('reserve_entry_product_detail_ext_feet_met'+id).value 			= data_t[3];

		}

	);

}
function GetTotalLength(id){
	var product_qty 	= document.getElementById('reserve_entry_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('reserve_entry_product_detail_s_width_inches'+id).value;
	var sales_length_f 	= document.getElementById('reserve_entry_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('reserve_entry_product_detail_sl_feet_in'+id).value;
	var sales_length_ef 	= document.getElementById('reserve_entry_product_detail_ext_feet'+id).value;
	var sales_length_ei 	= document.getElementById('reserve_entry_product_detail_ext_feet_in'+id).value;
	
	var sales_length	= Number(sales_length_f)+Number(sales_length_i)+Number(sales_length_ef)+Number(sales_length_ei);
	var width 			= document.getElementById('reserve_entry_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('reserve_entry_product_detail_tot_length'+id).value = (total_length_val).toFixed(2);
	//document.getElementById('reserve_entry_product_detail_inv_tot_length'+id).value = total_length_val.toFixed(2);
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

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_width_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_width_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_width_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_width_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('reserve_entry_product_detail_width_feet'+id).value 		= data_t[0];

			document.getElementById('reserve_entry_product_detail_width_inches'+id).value 		= data_t[1];

			document.getElementById('reserve_entry_product_detail_width_mm'+id).value 			= data_t[2];

			document.getElementById('reserve_entry_product_detail_width_meter'+id).value 		= data_t[3];

		}

	);

}

function GetLcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_length_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_length_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_length_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('reserve_entry_product_detail_length_feet'+id).value 		= data_t[0];

			document.getElementById('reserve_entry_product_detail_length_inches'+id).value 		= data_t[1];

			document.getElementById('reserve_entry_product_detail_length_mm'+id).value 			= data_t[2];

			document.getElementById('reserve_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetEcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_ext_length_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('reserve_entry_product_detail_ext_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('reserve_entry_product_detail_ext_length_feet'+id).value 		= data_t[0];

			document.getElementById('reserve_entry_product_detail_ext_length_meter'+id).value 		= data_t[3];

		}

	);

}

function getTableHeader(id){
	$('#product_detail >tbody >tr').remove();
	if(id ==1){
	$('.rls').show(); $('.rws').hide(); $('.ccs').hide(); $('.as').hide();
	}else if(id==2){
	$('.rws').show(); $('.rls').hide(); $('.ccs').hide(); $('.as').hide();
	}else if(id==3){
	$('.ccs').show(); $('.rws').hide(); $('.rls').hide(); $('.as').hide();
	}else if(id==4){
	$('.as').show();  $('.rws').hide(); $('.ccs').hide(); $('.rls').hide();
	}else{
		$('.rls').hide();
		$('.rws').hide();
		$('.ccs').hide();
		$('.as').hide();
	}
	
}