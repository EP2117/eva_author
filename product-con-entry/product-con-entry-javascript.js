checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('product_con_entry_list_form').elements.length; i++) {

	  document.getElementById('product_con_entry_list_form').elements[i].checked = checked;

	}

}

function GetSodetail(){
	var branch_id 		= document.getElementById('product_con_entry_branch_id').value;
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

			var table 				= document.getElementById('so_detail');

			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+invoice_entry_no+"</td><td>"+invoice_entry_date+"<input type='hidden'  name='product_con_entry_invoice_entry_id' id='product_con_entry_invoice_entry_id' value='"+invoice_entry_id+"'  class='dc_id'  /></td></tr>");

			

		}

	}

}





function GetDetail(){

	var m_id 			= getQuotationId();

	var invoice_entry_id 			= document.getElementById('product_con_entry_invoice_entry_id').value;

	$.get('product-detail.php',

		{m_id:m_id,purchase_invoice_id:invoice_entry_id},

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
			var product_qty				= document.getElementById('product_detail_qty'+ord_id).value;
			var table 					= document.getElementById('product_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	

			$( "#product_detail_display" ).append("<tr><td>"+product_code+"</td><td>"+product_name+"<input type='hidden'  name='product_con_entry_product_detail_product_id' id='product_con_entry_product_detail_product_id' value='"+product_id+"' /><input type='hidden'  name='product_con_entry_product_detail_invoice_detail_id' id='product_con_entry_product_detail_invoice_detail_id' value='"+detail_id+"' /> </td><td><input class='form-control' type='text'  name='product_uom' id='product_uom' value='"+product_uom+"'   /></td><td><input class='form-control' type='text'  name='product_colour_name' id='product_colour_name' value='"+product_colour_name+"'   /></td><td><input class='form-control' type='text'  name='product_con_entry_product_detail_width_inches' id='product_con_entry_product_detail_width_inches' value=''  onblur='GetWcalc(2)' value=''  /></td><td><input class='form-control' type='text'  name='product_con_entry_product_detail_width_mm' id='product_con_entry_product_detail_width_mm'  onblur='GeWLcalc(3)' value='' /></td><td><input class='form-control' type='text'  name='product_con_entry_product_detail_length_feet' id='product_con_entry_product_detail_length_feet' onblur='GetLcalc(1)' value=''   /></td><td><input class='form-control' type='text'  name='product_con_entry_product_detail_length_mm' id='product_con_entry_product_detail_length_mm'  value=''   onblur='GetLcalc(3)' /></td><td><input class='form-control' type='text'  name='product_con_entry_product_detail_qty' id='product_con_entry_product_detail_qty' value='"+product_qty+"'   /></td><td><input class='form-control' type='text'  name='product_con_entry_product_detail_total_qty' id='product_con_entry_product_detail_total_qty' value='' onblur='GetChildproduct()'  /></td></tr>");

		}

	}

}
function GetWcalc(calculation_id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('product_con_entry_product_detail_width_inches').value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('product_con_entry_product_detail_width_mm').value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_product_detail_width_inches').value 		= data_t[1];
			document.getElementById('product_con_entry_product_detail_width_mm').value 			= data_t[2];
		}

	);

}
function GetLcalc(calculation_id){
	if(calculation_id==1){
		var calc_amount 	= document.getElementById('product_con_entry_product_detail_length_feet').value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('product_con_entry_product_detail_length_mm').value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_product_detail_length_feet').value 			= parseFloat(data_t[0]);
			document.getElementById('product_con_entry_product_detail_length_mm').value 			= data_t[2];
		}
	);
}


function GetCLcalc(calculation_id,id){

	if(calculation_id==1){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_length_feet_'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_length_mm_'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_child_product_detail_length_feet_'+id).value 		= parseFloat(data_t[0]);
			document.getElementById('product_con_entry_child_product_detail_length_mm_'+id).value 			= data_t[2];
		}
	);

}
function GetChildproduct(){
	var total_qty				= document.getElementById('product_con_entry_product_detail_total_qty').value;
	var product_id				= document.getElementById('product_con_entry_product_detail_product_id').value;
	var width_inches			= document.getElementById('product_con_entry_product_detail_width_inches').value;
	var width_mm				= document.getElementById('product_con_entry_product_detail_width_mm').value;
	$.get('child-product-detail.php',
		{total_qty:total_qty,product_id:product_id,width_inches:width_inches,width_mm:width_mm},
		function(data) { $('#child_product_detail_display').html( data ); }
	);	


}
function GetCCWcalc(calculation_id,id){
	if(calculation_id==2){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_con_width_inches_'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_con_width_mm_'+id).value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_child_product_detail_con_width_inches_'+id).value 		= data_t[1];
			document.getElementById('product_con_entry_child_product_detail_con_width_mm_'+id).value 			= data_t[2];
		}
	);
}

function GetCCLcalc(calculation_id,id){
	if(calculation_id==1){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_con_length_feet_'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_con_length_mm_'+id).value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_child_product_detail_con_length_feet_'+id).value 		= data_t[0];
			document.getElementById('product_con_entry_child_product_detail_con_length_mm_'+id).value 			= data_t[2];
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
		}
	}
	return m_id;
}	

function discountPerFind(id)

{	

	var product_qty 		= document.getElementById('product_con_entry_product_detail_qty'+id).value;

	var product_feet 		= document.getElementById('product_con_entry_product_detail_length_feet'+id).value;

	var product_price		= document.getElementById('product_con_entry_product_detail_rate'+id).value;

		

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

	document.getElementById('product_con_entry_product_detail_total_length'+id).value =  product_tot_len;

	document.getElementById('product_con_entry_product_detail_amount'+id).value =  product_amount;

	totalAmount();

}

function totalAmount()

{

	var table 				= document.getElementById('product_detail');

	var total_row     		= parseFloat(table.rows.length)-2;			

	var sum_val = 0;

	for(var i=1; i<=parseInt(total_row); i++) {

		var total_detail_amt 	= document.getElementById('product_con_entry_product_detail_amount'+i).value;

		var toal_amount 	 	= (isNaN(total_detail_amt)?0.00:parseFloat(total_detail_amt));

		sum_val 				= parseFloat(sum_val)+parseFloat(toal_amount);

	}

	var gross_amount			= (isNaN(sum_val)?0.00:parseFloat(sum_val).toFixed(2));

	document.getElementById('product_con_entry_gross_amount').value 	= gross_amount;

	

	var transport_amount		= document.getElementById('product_con_entry_transport_amount').value;

	var tax_per					= document.getElementById('product_con_entry_tax_per').value;

	var advance_amount			= document.getElementById('product_con_entry_advance_amount').value;



	var transport_amount 		= (isNaN(transport_amount)? 0.00 : parseFloat(transport_amount));

	var tax_per 				= (isNaN(tax_per)? 0.00 : parseFloat(tax_per));

	var advance_amount 			= (isNaN(advance_amount)? 0.00 : parseFloat(advance_amount));

	var tax_amount				= (tax_per*gross_amount)/100;

	var tax_amount 				= (isNaN(tax_amount)? 0.00 : parseFloat(tax_amount));

	 document.getElementById('product_con_entry_tax_amount').value	= tax_amount;

	var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount)+parseFloat(tax_amount);

	var net_amount				= parseFloat(net_amount)-parseFloat(advance_amount);

	var net_amount 				= (isNaN(net_amount)? 0.00 : parseFloat(net_amount));

	document.getElementById('product_con_entry_net_amount').value 	= net_amount;

}





function getDueDate(){

	var inv_date = document.getElementById('product_con_entry_date').value;

	var cr_day = document.getElementById('product_con_entry_credit_days').value;

	if(cr_day == '') {

		cr_day = 0;	

	}
	$.get(
		"../ajax-file/get-due-date.php",

		{inv_date:inv_date, cr_day:cr_day},

		function(data) { 

			document.getElementById('product_con_entry_due_date').value = data.trim() ;

		}

	);		
}

///
function ChildtotalAmount()
{
	var table 					= document.getElementById('child_product_detail');
	var length_feet 			= document.getElementById('product_con_entry_product_detail_length_feet').value;
	var total_row     			= parseFloat(table.rows.length)-2;			
	var sum_val					= 0;
	var sum_tot_val 			= 0;
	for(var i=1; i<=parseInt(total_row); i++) {
		var total_length_feet 	= document.getElementById('product_con_entry_child_product_detail_length_feet_'+i).value;
		var total_length_feet 	= ((isNaN(total_length_feet) || total_length_feet=='' )?0.00:parseFloat(total_length_feet));
		sum_val 				= parseFloat(sum_val)+parseFloat(total_length_feet);
		if((parseFloat(length_feet)<parseFloat(sum_val))==true){
			document.getElementById('product_con_entry_child_product_detail_length_feet_'+i).value	= '0';
			document.getElementById('product_con_entry_child_product_detail_length_feet_'+i).value	= '0';
			sum_val 				= parseFloat(sum_val)-parseFloat(total_length_feet);
		}
	}
	document.getElementById('product_con_entry_child_length_feet_tot').value 	= sum_val;
	//document.getElementById('product_con_entry_child_total').value 				= sum_tot_val;
}