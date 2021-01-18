checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('gatepass_entry_list_form').elements.length; i++) {

	  document.getElementById('gatepass_entry_list_form').elements[i].checked = checked;

	}
}
function getTableHeader(id){
	//$('#product_detail >tbody >tr').remove();
	var fruits	= id.split(',');
	var a = fruits.indexOf("1");
	if(fruits.includes("1") ==true){
	$('#product_detail_rls').show();
	}
	if(fruits.includes("2") ==true){
	$('#product_detail_rws').show();
	}
	if(fruits.includes("4") ==true){
	$('#product_detail_as').show();
	}
}
function GetSodetail(){

	var branch_id 		= document.getElementById('gatepass_entry_branch_id').value;

	$.get('sales-detail.php',

		{branch_id:branch_id},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {
			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;
			var delivery_customer_id 		= ord_id;
			var delivery_customer_no 		= document.getElementById('delivery_customer_no'+ord_id).value;
			var delivery_customer_date 		= document.getElementById('delivery_customer_date'+ord_id).value;
			var delivery_customer_type_id 		= document.getElementById('delivery_customer_type_id'+ord_id).value;
			var table 					= document.getElementById('so_detail');
			var row_cnt     			= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+delivery_customer_no+"</td><td>"+delivery_customer_date+"<input type='hidden'  name='gatepass_entry_delivery_customer_id' id='gatepass_entry_delivery_customer_id' value='"+delivery_customer_id+"'  class='dc_id'  /><input type='hidden'  name='gatepass_entry_type_id' id='gatepass_entry_type_id' value='"+delivery_customer_type_id+"'  /> </td></tr>");

			
			getTableHeader(delivery_customer_type_id);
		}

	}

}





function GetDetail(){

	var m_id 			= getQuotationId();

	var delivery_customer_id 			= document.getElementById('gatepass_entry_delivery_customer_id').value;

	$.get('product-detail.php',

		{m_id:m_id,delivery_customer_id:delivery_customer_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){
		
		
	var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
	var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
	var row_cnt_as     				= $('#product_detail_as >tbody >tr').length;	
	var row_cnt						= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as)+1;
		
		
	var x						= document.getElementsByName("delivery_customer_product_detail_id[]");
	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) {
			
			var ord_id 						=  x[i].value;

			var detail_id 				= ord_id;

			var product_name 			= document.getElementById('product_name'+ord_id).value;

			var product_id 				= document.getElementById('product_id'+ord_id).value;

			var product_code 			= document.getElementById('product_code'+ord_id).value;

			var product_uom 			= document.getElementById('product_uom'+ord_id).value;

			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_color_id		= document.getElementById('product_color_id'+ord_id).value;
			var product_brand_name		= document.getElementById('product_brand_name'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_val		= document.getElementById('product_thick_ness_val'+ord_id).value;

			var product_width_inches		= document.getElementById('product_width_inches'+ord_id).value;

			var product_width_mm			= document.getElementById('product_width_mm'+ord_id).value;

			var product_s_width_inches		= document.getElementById('product_s_width_inches'+ord_id).value;
			var product_s_width_mm			= document.getElementById('product_s_width_mm'+ord_id).value;
			var product_sl_feet				= document.getElementById('product_sl_feet'+ord_id).value;

			var product_sl_feet_in			= document.getElementById('product_sl_feet_in'+ord_id).value;

			var product_sl_feet_mm			= document.getElementById('product_sl_feet_mm'+ord_id).value;
			var product_sl_feet_met			= document.getElementById('product_sl_feet_met'+ord_id).value;
			var product_s_weight_inches		= document.getElementById('product_s_weight_inches'+ord_id).value;
			var product_s_weight_mm			= document.getElementById('product_s_weight_mm'+ord_id).value;
			var product_tot_length			= document.getElementById('product_tot_length'+ord_id).value;
			var product_rate				= document.getElementById('product_rate'+ord_id).value;
			var product_qty					= document.getElementById('product_detail_qty'+ord_id).value;
			var product_total_amt			= document.getElementById('product_total_amt'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			var apnd	= '';
			if(t_id == 1){
			 
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="gatepass_entry_product_detail_product_id[]" id="gatepass_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="gatepass_entry_product_detail_product_type[]" id="gatepass_entry_product_detail_product_type" value="2" /><input type="hidden"  name="gatepass_entry_product_detail_delivery_detail_id[]" id="gatepass_entry_product_detail_delivery_detail_id" value="'+detail_id+'" /><input type="hidden"  name="gatepass_entry_product_detail_entry_type[]" id="gatepass_entry_product_detail_entry_type" value="'+t_id+'" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="gatepass_entry_product_detail_color_id[]" id="gatepass_entry_product_detail_color_id'+row_cnt+'" value="'+product_color_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness_val+'<input type="hidden"  name="gatepass_entry_product_detail_product_thick[]" id="gatepass_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_width_inches[]" id="gatepass_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="gatepass_entry_product_detail_width_mm[]" id="gatepass_entry_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_width_inches[]" id="gatepass_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_width_mm[]" id="gatepass_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_sl_feet[]" id="gatepass_entry_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="gatepass_entry_product_detail_sl_feet_in[]" id="gatepass_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'"  /></td><td><input class="form-control" type="text"  name="gatepass_entry_product_detail_sl_feet_mm[]" id="gatepass_entry_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="gatepass_entry_product_detail_sl_feet_met[]" id="gatepass_entry_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'"  /><input type="hidden" name="gatepass_entry_product_detail_s_weight_inches[]" id="gatepass_entry_product_detail_s_weight_inches'+row_cnt+'"    value=""   /><input type="hidden"  name="gatepass_entry_product_detail_s_weight_mm[]" id="gatepass_entry_product_detail_s_weight_mm'+row_cnt+'"  value=""   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_qty[]" id="gatepass_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'"  onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="gatepass_entry_product_detail_tot_length[]" id="gatepass_entry_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"   /></td></tr>';
			$("#product_detail_rls_display").append(apnd);	
			GetTotalLength(row_cnt);
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="gatepass_entry_product_detail_product_id[]" id="gatepass_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="gatepass_entry_product_detail_product_type[]" id="gatepass_entry_product_detail_product_type" value="2" /><input type="hidden"  name="gatepass_entry_product_detail_delivery_detail_id[]" id="gatepass_entry_product_detail_delivery_detail_id" value="'+detail_id+'" /><input type="hidden"  name="gatepass_entry_product_detail_entry_type[]" id="gatepass_entry_product_detail_entry_type" value="'+t_id+'" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="gatepass_entry_product_detail_color_id[]" id="gatepass_entry_product_detail_color_id'+row_cnt+'" value="'+product_color_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness_val+'<input type="hidden"  name="gatepass_entry_product_detail_product_thick[]" id="gatepass_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_width_inches[]" id="gatepass_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="gatepass_entry_product_detail_width_mm[]" id="gatepass_entry_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  /></td>';
			
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_width_inches[]" id="gatepass_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_width_mm[]" id="gatepass_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /><input type="hidden"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'"  value="" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_weight_inches[]" id="gatepass_entry_product_detail_s_weight_inches'+row_cnt+'"   onblur="GetWeightClc(1,'+row_cnt+')"  value="'+product_s_weight_inches+'"   /></td> <td><input class="form-control" type="text"  name="gatepass_entry_product_detail_s_weight_mm[]" id="gatepass_entry_product_detail_s_weight_mm'+row_cnt+'"   onblur="GetWeightClc(2,'+row_cnt+')"  value="'+product_s_weight_mm+'"   /></td>';
			
				
			$("#product_detail_rws_display").append(apnd);	

			}else{ 
			
			apnd	+= '<tr><td>'+product_name+'<input type="hidden"  name="gatepass_entry_product_detail_product_id[]" id="gatepass_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="gatepass_entry_product_detail_product_type[]" id="gatepass_entry_product_detail_product_type" value="1" /><input type="hidden"  name="gatepass_entry_product_detail_delivery_detail_id[]" id="gatepass_entry_product_detail_delivery_detail_id" value="'+detail_id+'" /><input type="hidden"  name="gatepass_entry_product_detail_entry_type[]" id="gatepass_entry_product_detail_entry_type" value="'+t_id+'" /></td>';
			
			apnd	+= '<td>'+product_uom+'</td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gatepass_entry_product_detail_qty[]" id="gatepass_entry_product_detail_qty'+row_cnt+'" value="'+product_qty+'"  /></td></tr>';
			$("#product_detail_as_display").append(apnd);	
			}
			
			

			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}

}
function GetWeightClc(type,id){
	var prod_ton =$('#delivery_customer_product_detail_s_weight_inches'+id).val();
	var prod_kg =$('#delivery_customer_product_detail_s_weight_mm'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#delivery_customer_product_detail_s_weight_mm'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#delivery_customer_product_detail_s_weight_inches'+id).val(prod_val);
	}
	
	
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

function discountPerFind(id)

{	

	var product_qty 		= document.getElementById('gatepass_entry_product_detail_qty'+id).value;

	var product_feet 		= document.getElementById('gatepass_entry_product_detail_length_feet'+id).value;

	var product_price		= document.getElementById('gatepass_entry_product_detail_rate'+id).value;

		

	if(product_qty == '' || product_qty == ' ') {

		product_qty = 0;

	}

	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));

	var product_feet 		= (isNaN(product_feet)? 0.00 : parseFloat(product_feet));

	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));

	

	var product_tot_len		= parseFloat(product_qty) * parseFloat(product_feet);

	var product_amount  	= parseFloat(product_tot_len) * parseFloat(product_price);

	var product_tot_len 	=  (isNaN(product_tot_len)? 0.00 :parseFloat(product_tot_len).toFixed(2));

	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(2));

	document.getElementById('gatepass_entry_product_detail_total_length'+id).value =  product_tot_len;

	document.getElementById('gatepass_entry_product_detail_amount'+id).value =  product_amount;

	totalAmount();

}

function totalAmount()

{

	var table 				= document.getElementById('product_detail');
	var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
	var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
	var row_cnt_as     				= $('#product_detail_as >tbody >tr').length;	
	var total_row						= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as);
	//var total_row     		= parseFloat(table.rows.length)-2;			

	var sum_val = 0;

	for(var i=1; i<=parseInt(total_row); i++) {

		var total_detail_amt 	= document.getElementById('gatepass_entry_product_detail_amount'+i).value;

		var toal_amount 	 	= (isNaN(total_detail_amt)?0.00:parseFloat(total_detail_amt));

		sum_val 				= parseFloat(sum_val)+parseFloat(toal_amount);

	}

	var gross_amount			= (isNaN(sum_val)?0.00:parseFloat(sum_val).toFixed(2));

	document.getElementById('gatepass_entry_gross_amount').value 	= gross_amount;

	

	var transport_amount		= document.getElementById('gatepass_entry_transport_amount').value;

	var tax_per					= document.getElementById('gatepass_entry_tax_per').value;

	var advance_amount			= document.getElementById('gatepass_entry_advance_amount').value;



	var transport_amount 		= (isNaN(transport_amount)? 0.00 : parseFloat(transport_amount));

	var tax_per 				= (isNaN(tax_per)? 0.00 : parseFloat(tax_per));

	var advance_amount 			= (isNaN(advance_amount)? 0.00 : parseFloat(advance_amount));

	var tax_amount				= (tax_per*gross_amount)/100;

	var tax_amount 				= (isNaN(tax_amount)? 0.00 : parseFloat(tax_amount));

	 document.getElementById('gatepass_entry_tax_amount').value	= tax_amount;

	var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount)+parseFloat(tax_amount);

	var net_amount				= parseFloat(net_amount)-parseFloat(advance_amount);

	var net_amount 				= (isNaN(net_amount)? 0.00 : parseFloat(net_amount));

	document.getElementById('gatepass_entry_net_amount').value 	= net_amount;

}





function getDueDate(){
	var inv_date = document.getElementById('gatepass_entry_date').value;
	var cr_day = document.getElementById('gatepass_entry_credit_days').value;
	if(cr_day == '') {
		cr_day = 0;	
	}
	$.get(

		"../ajax-file/get-due-date.php",

		{inv_date:inv_date, cr_day:cr_day},

		function(data) { 

			document.getElementById('gatepass_entry_due_date').value = data.trim() ;

		}

	);		
}
function GetTotalLength(id){
	var product_qty 	= document.getElementById('gatepass_entry_product_detail_qty'+id).value;	
	var sales_width 	= document.getElementById('gatepass_entry_product_detail_s_width_inches'+id).value;
	var sales_length_f 	= document.getElementById('gatepass_entry_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('gatepass_entry_product_detail_sl_feet_in'+id).value;
	//var sales_length	= Number(sales_length_f)+Number(sales_length_i);
	var sales_length	= Number(sales_length_f)+(Number(sales_length_i)/12);
	var width 			= document.getElementById('gatepass_entry_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('gatepass_entry_product_detail_tot_length'+id).value = (sales_length*product_qty).toFixed(2);
	
}



function GetLcalFeet(calculation_id,id){
	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('gatepass_entry_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('gatepass_entry_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('gatepass_entry_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		//var calc_amount 	= document.getElementById('gatepass_entry_product_detail_length_meter'+id).value;	

	}
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			
			if(calculation_id==1){
				document.getElementById('gatepass_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('gatepass_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
			}

			/*document.getElementById('gatepass_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('gatepass_entry_product_detail_sl_feet_in'+id).value 		= data_t[1];

			document.getElementById('gatepass_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];*/

			//document.getElementById('gatepass_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('gatepass_entry_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('gatepass_entry_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('gatepass_entry_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('gatepass_entry_product_detail_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('gatepass_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('gatepass_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('gatepass_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('gatepass_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}