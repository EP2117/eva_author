checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('production_order_list_form').elements.length; i++) {

	  document.getElementById('production_order_list_form').elements[i].checked = checked;

	}

}

function getTableHeader(id){
	//$('#product_detail >tbody >tr').remove();
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

function GetSodetail(){

	var branch_id 		= document.getElementById('production_order_branch_id').value;
	var type_id 		= document.getElementById('production_order_type_id').value;
	$.get('sales-detail.php',

		{branch_id:branch_id,type_id:type_id},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;

			var invoice_entry_id 		= ord_id;

			var invoice_entry_no 		= document.getElementById('invoice_entry_no'+ord_id).value;

			var invoice_entry_date 		= document.getElementById('invoice_entry_date'+ord_id).value;
			var invoice_entry_type_id 	= document.getElementById('invoice_entry_type_id'+ord_id).value;
			var po_cnt 					= document.getElementById('invoice_entry_po_cnt'+ord_id).value;
			var table 					= document.getElementById('so_detail');
			var production_no			= invoice_entry_no+"-"+po_cnt;
			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+invoice_entry_no+"</td><td>"+invoice_entry_date+"<input type='hidden'  name='production_order_invoice_entry_id' id='production_order_invoice_entry_id' value='"+invoice_entry_id+"'  class='dc_id'  /> </td></tr>");
				document.getElementById('production_order_no').value	= production_no;

		}

	}

}

function GetDetail(){

	var invoice_entry_id 	= document.getElementById('production_order_invoice_entry_id').value;
	var production_type 	= document.getElementById('production_order_type').value;
	var type_id 			= document.getElementById('production_order_type_id').value;
	var m_id 			= getQuotationId();

	$.get('product-detail.php',

		{invoice_entry_id:invoice_entry_id,m_id:m_id,production_type:production_type,type_id:type_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){
	var apnd = '';
	var x						= document.getElementsByName("invoice_entry_product_detail_id[]");
	var row_cnt     		= $('#product_detail_display >tbody >tr').length;				
	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) {
			
			var ord_id 					=  x[i].value;
			var detail_id 			= ord_id;

			var product_id 				= document.getElementById('product_id'+ord_id).value;
			var product_name 			= document.getElementById('product_name'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;
			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_type 			= document.getElementById('product_type'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id		= document.getElementById('product_colour_id'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
			var product_width_inches		= document.getElementById('product_width_inches'+ord_id).value;
			var product_brand_name		= document.getElementById('product_brand_name'+ord_id).value;
			var product_width_mm			= document.getElementById('product_width_mm'+ord_id).value;

			var product_s_width_inches		= document.getElementById('product_s_width_inches'+ord_id).value;
			var product_s_width_mm			= document.getElementById('product_s_width_mm'+ord_id).value;
			var product_sl_feet				= document.getElementById('product_sl_feet'+ord_id).value;

			var product_sl_feet_in			= document.getElementById('product_sl_feet_in'+ord_id).value;

			var product_sl_feet_mm			= document.getElementById('product_sl_feet_mm'+ord_id).value;

			var product_s_weight_inches		= document.getElementById('product_s_weight_inches'+ord_id).value;
			var product_s_weight_mm			= document.getElementById('product_s_weight_mm'+ord_id).value;
			var product_tot_length			= document.getElementById('product_tot_length'+ord_id).value;
			var product_rate				= document.getElementById('product_rate'+ord_id).value;
			var product_qty					= document.getElementById('product_detail_qty'+ord_id).value;
			var product_total_amt			= document.getElementById('product_total_amt'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			
			
			if(t_id == 1){
			 	var total_length			= ((product_s_width_inches * product_sl_feet ) / product_width_inches)*product_qty;
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_order_product_detail_invoice_detail_id[]" id="production_order_product_detail_invoice_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_colour_id[]" id="production_order_product_detail_product_colour_id'+row_cnt+'" value="'+product_colour_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet[]" id="production_order_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_in[]" id="production_order_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'"  /></td><td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_mm[]" id="production_order_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'"  /></td>';
			

			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_tot_length[]" id="production_order_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"   /><input  type="hidden"  name="production_order_product_detail_inv_tot_length[]" id="production_order_product_detail_inv_tot_length'+row_cnt+'" readonly value="'+total_length+'"   /></td><td><input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty'+row_cnt+'"  value="'+product_qty+'"    onBlur="GetTotalLength('+row_cnt+')" /></td> </tr>';
			
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_order_product_detail_invoice_detail_id[]" id="production_order_product_detail_invoice_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'</td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  /></td>';
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_weight_inches[]" id="production_order_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetLcalc(3,'+row_cnt+')"   value="'+product_s_weight_inches+'"   /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_weight_mm[]" id="production_order_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetLcalc(4,'+row_cnt+')"  value="'+product_s_weight_mm+'"   /></td></tr>';	
				
				
			}else if(t_id == 3){
			
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_order_product_detail_invoice_detail_id[]" id="production_order_product_detail_invoice_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'</td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"  onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches'+row_cnt+'" onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm'+row_cnt+'"   onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet[]" id="production_order_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'" /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_in[]" id="production_order_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"   value="'+product_sl_feet_in+'" /></td><td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_mm[]" id="production_order_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'" / /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_tot_length[]" id="production_order_product_detail_tot_length'+row_cnt+'"  value="'+product_tot_length+'" readonly /></td><td><input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty'+row_cnt+'" value="'+product_qty+'"  /></td></tr>';
				
				
			}else{ 
			
			apnd	+= '<tr><td>'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'"/><input type="hidden"  name="production_order_product_detail_invoice_detail_id[]" id="production_order_product_detail_invoice_detail_id" value="'+detail_id+'" /></td>';
			
			apnd	+= '<td>'+product_uom+'</td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty'+row_cnt+'" value="'+product_qty+'"  /></td></tr>';
			
			}
			
			

			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}
	$( "#product_detail_display" ).append(apnd);

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

function GetTotalLength(id){
	
	var sales_width 	= document.getElementById('production_order_product_detail_s_width_inches'+id).value;
	var product_qty 	= document.getElementById('production_order_product_detail_qty'+id).value;
	var sales_length_f 	= document.getElementById('production_order_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('production_order_product_detail_sl_feet_in'+id).value;
	var sales_length	= Number(sales_length_f)+(Number(sales_length_i)/12);
	var width 			= document.getElementById('production_order_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= (sales_width_val * sales_length_val ) / width_val;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('production_order_product_detail_tot_length'+id).value = (sales_length*product_qty).toFixed(2);
	
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

	else if(calculation_id==4){

		//var calc_amount 	= document.getElementById('advance_entry_product_detail_length_meter'+id).value;	

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

			/*document.getElementById('advance_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('advance_entry_product_detail_sl_feet_in'+id).value 		= data_t[1];

			document.getElementById('advance_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];*/

			//document.getElementById('advance_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);



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
		}

	);

}
function GetWcalS(calculation_id,id){

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
			document.getElementById('production_order_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('production_order_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}

function GetcustomerDetail(){

	var cus_id 	= document.getElementById('production_order_customer_id').value;	

	$.get('../ajax-file/customer-detail.php',

		{cus_id:cus_id},

		function(data) { 

			var s_data	= data.split('@');

			document.getElementById('production_order_address').value 		= s_data[6];

			document.getElementById('production_order_contact_no').value 	= s_data[7];

			

		}

	);	

}

