checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('delivery_entry_list_form').elements.length; i++) {

	  document.getElementById('delivery_entry_list_form').elements[i].checked = checked;

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

	var branch_id 		= document.getElementById('delivery_entry_branch_id').value;

	$.get('sales-detail.php',

		{branch_id:branch_id},

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
			var invoice_entry_type_id 		= document.getElementById('invoice_entry_type_id'+ord_id).value;
			var dc_cnt 					= document.getElementById('invoice_entry_dc_cnt'+ord_id).value;
			var delivery_entry_no		= invoice_entry_no;
			
			var table 					= document.getElementById('so_detail');
			var row_cnt     			= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+invoice_entry_no+"</td><td>"+invoice_entry_date+"<input type='hidden'  name='delivery_entry_invoice_entry_id' id='delivery_entry_invoice_entry_id' value='"+invoice_entry_id+"'  class='dc_id'  /><input type='hidden'  name='delivery_entry_type_id' id='delivery_entry_type_id' value='"+invoice_entry_type_id+"'  /> </td></tr>");
			document.getElementById('delivery_entry_no').value	= delivery_entry_no;
			
			getTableHeader(invoice_entry_type_id);
		}

	}

}





function GetDetail(){

	var m_id 			= getQuotationId();

	var invoice_entry_id 			= document.getElementById('delivery_entry_invoice_entry_id').value;

	$.get('product-detail.php',

		{m_id:m_id,invoice_entry_id:invoice_entry_id},

		function(data) { $('#dynamic-content').html( data ); }
		
	);	

}

function AddproductDetail(){
		var apnd	= '';
		
			var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
			var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
			var row_cnt_as     			= $('#product_detail_as >tbody >tr').length;	
			var row_cnt					= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as)+1;
	var x						= document.getElementsByName("invoice_entry_product_detail_id[]");
	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) {
			var ord_id 					=  x[i].value;

			var detail_id 				= ord_id;

			var product_name 			= document.getElementById('product_name'+ord_id).value;

			var product_id 				= document.getElementById('product_id'+ord_id).value;

			var product_code 			= document.getElementById('product_code'+ord_id).value;

			var product_uom 			= document.getElementById('product_uom'+ord_id).value;

			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_brand_name		= document.getElementById('product_brand_name'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
			var product_width_inches		= document.getElementById('product_width_inches'+ord_id).value;

			var product_width_mm			= document.getElementById('product_width_mm'+ord_id).value;
			var product_sale_length			= document.getElementById('product_sale_length'+ord_id).value;
			product_sale_length =  product_sale_length.replace("'","&#039;");
			product_sale_length =  product_sale_length.replace('"',"&quot;"); 

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
			
			var product_is_opp						= document.getElementById('product_is_opp'+ord_id).value;
			var product_sale_by						= document.getElementById('product_sale_by'+ord_id).value;
			var product_sale_feet					= document.getElementById('product_sale_feet'+ord_id).value;
			
			var apnd						= '';
			if(t_id == 1){
			 
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="delivery_entry_product_detail_product_is_opp[]" id="delivery_entry_product_detail_product_is_opp'+row_cnt+'" value="'+product_is_opp+'" /><input type="hidden"  name="delivery_entry_product_detail_sale_by[]" id="delivery_entry_product_detail_sale_by'+row_cnt+'" value="'+product_sale_by+'" /><input type="hidden"  name="delivery_entry_product_detail_product_id[]" id="delivery_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="delivery_entry_product_detail_product_type[]" id="delivery_entry_product_detail_product_type" value="2" /><input type="hidden"  name="delivery_entry_product_detail_invoice_detail_id[]" id="delivery_entry_product_detail_invoice_detail_id" value="'+detail_id+'" /><input type="hidden"  name="delivery_entry_product_detail_entry_type[]" id="delivery_entry_product_detail_entry_type" value="'+t_id+'" /><input type="hidden"  name="delivery_entry_product_detail_id[]" id="delivery_entry_product_detail_id" value="" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'</td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="delivery_entry_product_detail_product_thick[]" id="delivery_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_entry_product_detail_width_inches[]" id="delivery_entry_product_detail_width_inches'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+'),GetWcalc(2,'+row_cnt+');" value="'+product_width_inches+'" readonly /></td> <td><input class="form-control" type="text"  name="delivery_entry_product_detail_width_mm[]" id="delivery_entry_product_detail_width_mm'+row_cnt+'"  onBlur="GetWcalc(3,'+row_cnt+'),GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'" readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_entry_product_detail_s_width_inches[]" id="delivery_entry_product_detail_s_width_inches'+row_cnt+'"   onBlur="GetWcalS(2,'+row_cnt+'),GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" readonly /></td> <td><input class="form-control" type="text"  name="delivery_entry_product_detail_s_width_mm[]" id="delivery_entry_product_detail_s_width_mm'+row_cnt+'" onBlur="GetWcalS(3,'+row_cnt+'),GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" readonly /></td>';
			
			apnd += '<td><input class="form-control" type="text"  name="delivery_entry_product_detail_sale_length[]" id="delivery_entry_product_detail_sale_length'+row_cnt+'" value="'+product_sale_length+'" readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_entry_product_detail_sl_feet[]" id="delivery_entry_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'" readonly /></td> <td><input class="form-control" type="text"  name="delivery_entry_product_detail_sl_feet_in[]" id="delivery_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'" readonly /></td><td><input class="form-control" type="text"  name="delivery_entry_product_detail_sl_feet_mm[]" id="delivery_entry_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'" readonly /></td><td><input class="form-control" type="text"  name="delivery_entry_product_detail_sl_feet_met[]" id="delivery_entry_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'" readonly /><input type="hidden" name="delivery_entry_product_detail_s_weight_inches[]" id="delivery_entry_product_detail_s_weight_inches'+row_cnt+'"    value=""   /><input type="hidden"  name="delivery_entry_product_detail_s_weight_mm[]" id="delivery_entry_product_detail_s_weight_mm'+row_cnt+'"  value=""   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_entry_product_detail_qty[]" id="delivery_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'" onBlur="GetTotalLength('+row_cnt+')" readonly  /></td><td><input class="form-control" type="text"  name="delivery_entry_product_detail_tot_length[]" id="delivery_entry_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"  readonly /></td></tr>';
			
			$("#product_detail_rls_display").append(apnd);	
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="delivery_entry_product_detail_product_is_opp[]" id="delivery_entry_product_detail_product_is_opp'+row_cnt+'" value="'+product_is_opp+'" /><input type="hidden"  name="delivery_entry_product_detail_sale_by[]" id="delivery_entry_product_detail_sale_by'+row_cnt+'" value="'+product_sale_by+'" /><input type="hidden"  name="delivery_entry_product_detail_product_id[]" id="delivery_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="delivery_entry_product_detail_product_type[]" id="delivery_entry_product_detail_product_type" value="2" /><input type="hidden"  name="delivery_entry_product_detail_invoice_detail_id[]" id="delivery_entry_product_detail_invoice_detail_id" value="'+detail_id+'" /><input type="hidden"  name="delivery_entry_product_detail_entry_type[]" id="delivery_entry_product_detail_entry_type" value="'+t_id+'" /><input type="hidden"  name="delivery_entry_product_detail_id[]" id="delivery_entry_product_detail_id" value="" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'</td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="delivery_entry_product_detail_product_thick[]" id="delivery_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_entry_product_detail_width_inches[]" id="delivery_entry_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value="'+product_width_inches+'" readonly /></td> <td><input class="form-control" type="text"  name="delivery_entry_product_detail_width_mm[]" id="delivery_entry_product_detail_width_mm'+row_cnt+'"   onBlur="GetWcalc(3,'+row_cnt+')" value="'+product_width_mm+'" readonly  /></td>';
			
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_entry_product_detail_s_width_inches[]" id="delivery_entry_product_detail_s_width_inches'+row_cnt+'"   onBlur="GetWcalS(2,'+row_cnt+')"  value="'+product_s_width_inches+'" readonly /></td> <td><input class="form-control" type="text"  name="delivery_entry_product_detail_s_width_mm[]" id="delivery_entry_product_detail_s_width_mm'+row_cnt+'" onBlur="GetWcalS(3,'+row_cnt+')" value="'+product_s_width_mm+'" readonly /><input type="hidden"  name="delivery_entry_product_detail_qty[]" id="delivery_entry_product_detail_qty'+row_cnt+'" value=""  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_entry_product_detail_s_weight_inches[]" id="delivery_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetWeightClc(1,'+row_cnt+')"   value="'+product_s_weight_inches+'"  readonly /></td> <td><input class="form-control" type="text"  name="delivery_entry_product_detail_s_weight_mm[]" id="delivery_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetWeightClc(1,'+row_cnt+')"  value="'+product_s_weight_mm+'"  readonly /></td>';
			
			$("#product_detail_rws_display").append(apnd);	
				
			}else{ 
			
			apnd	+= '<tr><td>'+product_name+'<input type="hidden"  name="delivery_entry_product_detail_product_is_opp[]" id="delivery_entry_product_detail_product_is_opp'+row_cnt+'" value="'+product_is_opp+'" /><input type="hidden"  name="delivery_entry_product_detail_product_id[]" id="delivery_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="delivery_entry_product_detail_product_type[]" id="delivery_entry_product_detail_product_type" value="1" /><input type="hidden"  name="delivery_entry_product_detail_invoice_detail_id[]" id="delivery_entry_product_detail_invoice_detail_id" value="'+detail_id+'" /><input type="hidden"  name="delivery_entry_product_detail_entry_type[]" id="delivery_entry_product_detail_entry_type" value="'+t_id+'" /><input type="hidden"  name="delivery_entry_product_detail_id[]" id="delivery_entry_product_detail_id" value="" /></td>';
			
			apnd	+= '<td>'+product_uom+'</td>';
			
			/* apnd	+= '<td><input class="form-control" type="text"  name="delivery_entry_product_detail_qty[]" id="delivery_entry_product_detail_qty'+row_cnt+'" value="'+product_qty+'" readonly  /></td></tr>'; */
			if(product_sale_by == "qty") {
				apnd	+= '<td><input class="form-control" style="display:inline-block;width:20%" type="text"  name="delivery_entry_product_detail_sale_by[]" id="delivery_entry_product_detail_sale_by'+row_cnt+'" value="QTY" readonly  />&nbsp;&nbsp;&nbsp;<input class="form-control" style="display:inline-block;width:60%" type="text"  name="delivery_entry_product_detail_qty[]" id="delivery_entry_product_detail_qty'+row_cnt+'" value="'+product_qty+'" readonly  /></td></tr>';
			} else {
				apnd	+= '<td><input class="form-control" style="display:inline-block;width:20%" type="text"  name="delivery_entry_product_detail_sale_by[]" id="delivery_entry_product_detail_sale_by'+row_cnt+'" value="FEET" readonly  />&nbsp;&nbsp;&nbsp;<input class="form-control" style="display:inline-block;width:60%" type="text"  name="delivery_entry_product_detail_qty[]" id="delivery_entry_product_detail_qty'+row_cnt+'" value="'+product_sale_feet+'" readonly  /></td></tr>';
			}
			
			
				$("#product_detail_as_display").append(apnd);	
			}
			
			

			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}
	//totalAmount();

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

	var product_qty 		= document.getElementById('delivery_entry_product_detail_qty'+id).value;

	var product_feet 		= document.getElementById('delivery_entry_product_detail_length_feet'+id).value;

	var product_price		= document.getElementById('delivery_entry_product_detail_rate'+id).value;

		

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

	document.getElementById('delivery_entry_product_detail_total_length'+id).value =  product_tot_len;

	document.getElementById('delivery_entry_product_detail_amount'+id).value =  product_amount;

	totalAmount();

}


function getDueDate(){
	var inv_date = document.getElementById('delivery_entry_date').value;
	var cr_day = document.getElementById('delivery_entry_credit_days').value;
	if(cr_day == '') {
		cr_day = 0;	
	}
	$.get(

		"../ajax-file/get-due-date.php",

		{inv_date:inv_date, cr_day:cr_day},

		function(data) { 

			document.getElementById('delivery_entry_due_date').value = data.trim() ;

		}

	);		
}
function GetTotalLength(id){
	var product_qty 	= document.getElementById('delivery_entry_product_detail_qty'+id).value;	
	var sales_width 	= document.getElementById('delivery_entry_product_detail_s_width_inches'+id).value;
	var sales_length_f 	= document.getElementById('delivery_entry_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('delivery_entry_product_detail_sl_feet_in'+id).value;
	var sales_length	= Number(sales_length_f)+Number(sales_length_i);
	var width 			= document.getElementById('delivery_entry_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('delivery_entry_product_detail_tot_length'+id).value = total_length_val.toFixed(2);
	
}



function GetLcalFeet(calculation_id,id){
	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('delivery_entry_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('delivery_entry_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('delivery_entry_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		//var calc_amount 	= document.getElementById('delivery_entry_product_detail_length_meter'+id).value;	

	}
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			
			if(calculation_id==1){
				document.getElementById('delivery_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('delivery_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
			}


		}

	);

}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('delivery_entry_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('delivery_entry_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('delivery_entry_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('delivery_entry_product_detail_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('delivery_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('delivery_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('delivery_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('delivery_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}
  function GetWeightClc(type,id){
	var prod_ton =$('#delivery_entry_product_detail_s_weight_inches'+id).val();
	var prod_kg =$('#delivery_entry_product_detail_s_weight_mm'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#delivery_entry_product_detail_s_weight_mm'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#delivery_entry_product_detail_s_weight_inches'+id).val(prod_val);
	}
  }