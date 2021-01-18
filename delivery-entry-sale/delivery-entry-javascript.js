checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('do_god_entry_list_form').elements.length; i++) {

	  document.getElementById('do_god_entry_list_form').elements[i].checked = checked;

	}

}

function GetSodetail(){

	var branch_id 		= document.getElementById('do_god_entry_branch_id').value;

	$.get('sales-detail.php',

		{branch_id:branch_id},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;

			var production_order_id 		= ord_id;

			var production_order_no 		= document.getElementById('production_order_no'+ord_id).value;

			var production_order_date 		= document.getElementById('production_order_date'+ord_id).value;

			var table 				= document.getElementById('so_detail');

			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+production_order_no+"</td><td>"+production_order_date+"<input type='hidden'  name='do_god_entry_production_order_id' id='do_god_entry_production_order_id' value='"+production_order_id+"'  class='dc_id'  /></td></tr>");

			

		}

	}

}





function GetDetail(){

	var m_id 			= getQuotationId();

	var production_order_id 			= document.getElementById('do_god_entry_production_order_id').value;

	$.get('product-detail.php',

		{m_id:m_id,production_order_id:production_order_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){

	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) {

		if (document.getElementById('product_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;

			var detail_id 				= ord_id;

			var product_name 			= document.getElementById('product_name'+ord_id).value;

			var product_id 				= document.getElementById('product_id'+ord_id).value;

			var product_code 			= document.getElementById('product_code'+ord_id).value;

			var product_uom 			= document.getElementById('product_uom'+ord_id).value;

			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;

			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;

			var length_feet				= document.getElementById('production_order_product_detail_length_feet'+ord_id).value;

			var length_inches			= document.getElementById('production_order_product_detail_length_inches'+ord_id).value;

			var length_mm				= document.getElementById('production_order_product_detail_length_mm'+ord_id).value;

			var length_meter			= document.getElementById('production_order_product_detail_length_meter'+ord_id).value;
			var detail_type				= document.getElementById('production_order_product_detail_type'+ord_id).value;
			var product_qty				= document.getElementById('product_detail_qty'+ord_id).value;

			var table 					= document.getElementById('product_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	

			$( "#product_detail_display" ).append( 

			"<tr><td>"+product_code+"</td><td>"+product_name+"<input type='hidden'  name='do_god_entry_product_detail_product_id[]' id='do_god_entry_product_detail_product_id' value='"+product_id+"' /><input type='hidden'  name='do_god_entry_product_detail_production_detail_id[]' id='do_god_entry_product_detail_production_detail_id' value='"+detail_id+"' /> <input type='hidden'  name='do_god_entry_product_detail_type[]' id='do_god_entry_product_detail_type' value='"+detail_type+"' /></td><td><input class='form-control' type='text'  name='product_uom[]' id='product_uom"+row_cnt+"' value='"+product_uom+"'   /></td><td><input class='form-control' type='text'  name='do_god_entry_product_detail_length_feet[]' id='do_god_entry_product_detail_length_feet"+row_cnt+"' value='"+length_feet+"'  onblur='GetLcalc(1,"+row_cnt+")' value='"+length_feet+"'  /></td><td><input class='form-control' type='text'  name='do_god_entry_product_detail_length_inches[]' id='do_god_entry_product_detail_length_inches"+row_cnt+"'  onblur='GetLcalc(2,"+row_cnt+")' value='"+length_inches+"' /></td><td><input class='form-control' type='text'  name='do_god_entry_product_detail_length_mm[]' id='do_god_entry_product_detail_length_mm"+row_cnt+"' onblur='GetLcalc(3,"+row_cnt+")' value='"+length_mm+"'   /></td><td><input class='form-control' type='text'  name='do_god_entry_product_detail_length_meter[]' id='do_god_entry_product_detail_length_meter"+row_cnt+"'  value='"+length_meter+"'   onblur='GetLcalc(4,"+row_cnt+")' /></td><td><input class='form-control' type='text'  name='do_god_entry_product_detail_qty[]' id='do_god_entry_product_detail_qty"+row_cnt+"' value='"+product_qty+"'   /></td><td><textarea class='form-control'   name='do_god_entry_product_detail_remarks[]' id='do_god_entry_product_detail_remarks"+row_cnt+"'  ></textarea></td></tr>");

		}

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

	var product_qty 		= document.getElementById('do_god_entry_product_detail_qty'+id).value;

	var product_feet 		= document.getElementById('do_god_entry_product_detail_length_feet'+id).value;

	var product_price		= document.getElementById('do_god_entry_product_detail_rate'+id).value;

		

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

	document.getElementById('do_god_entry_product_detail_total_length'+id).value =  product_tot_len;

	document.getElementById('do_god_entry_product_detail_amount'+id).value =  product_amount;

	totalAmount();

}

function totalAmount()

{

	var table 				= document.getElementById('product_detail');

	var total_row     		= parseFloat(table.rows.length)-2;			

	var sum_val = 0;

	for(var i=1; i<=parseInt(total_row); i++) {

		var total_detail_amt 	= document.getElementById('do_god_entry_product_detail_amount'+i).value;

		var toal_amount 	 	= (isNaN(total_detail_amt)?0.00:parseFloat(total_detail_amt));

		sum_val 				= parseFloat(sum_val)+parseFloat(toal_amount);

	}

	var gross_amount			= (isNaN(sum_val)?0.00:parseFloat(sum_val).toFixed(2));

	document.getElementById('do_god_entry_gross_amount').value 	= gross_amount;

	

	var transport_amount		= document.getElementById('do_god_entry_transport_amount').value;

	var tax_per					= document.getElementById('do_god_entry_tax_per').value;

	var advance_amount			= document.getElementById('do_god_entry_advance_amount').value;



	var transport_amount 		= (isNaN(transport_amount)? 0.00 : parseFloat(transport_amount));

	var tax_per 				= (isNaN(tax_per)? 0.00 : parseFloat(tax_per));

	var advance_amount 			= (isNaN(advance_amount)? 0.00 : parseFloat(advance_amount));

	var tax_amount				= (tax_per*gross_amount)/100;

	var tax_amount 				= (isNaN(tax_amount)? 0.00 : parseFloat(tax_amount));

	 document.getElementById('do_god_entry_tax_amount').value	= tax_amount;

	var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount)+parseFloat(tax_amount);

	var net_amount				= parseFloat(net_amount)-parseFloat(advance_amount);

	var net_amount 				= (isNaN(net_amount)? 0.00 : parseFloat(net_amount));

	document.getElementById('do_god_entry_net_amount').value 	= net_amount;

}



function GetLcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('do_god_entry_product_detail_length_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('do_god_entry_product_detail_length_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('do_god_entry_product_detail_length_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('do_god_entry_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('do_god_entry_product_detail_length_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('do_god_entry_product_detail_length_inches'+id).value 		= data_t[1];

			document.getElementById('do_god_entry_product_detail_length_mm'+id).value 			= data_t[2];

			document.getElementById('do_god_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function getDueDate(){

	var inv_date = document.getElementById('do_god_entry_date').value;

	var cr_day = document.getElementById('do_god_entry_credit_days').value;

	if(cr_day == '') {

		cr_day = 0;	

	}

	

	$.get(

		"../ajax-file/get-due-date.php",

		{inv_date:inv_date, cr_day:cr_day},

		function(data) { 

			document.getElementById('do_god_entry_due_date').value = data.trim() ;

		}

	);		

	



}