checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('invoice_entry_list_form').elements.length; i++) {

	  document.getElementById('invoice_entry_list_form').elements[i].checked = checked;

	}

}
/*function getTableHeader(id){
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
	
}*/

function getTableHeader(id){
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

	var branch_id 		= document.getElementById('invoice_entry_branch_id').value;
	var entry_type 		= document.getElementById('invoice_entry_type').value;
	$.get('sales-detail.php',

		{branch_id:branch_id,entry_type:entry_type},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;

			var quotation_entry_id 		= ord_id;

			var quotation_entry_no 		= document.getElementById('quotation_entry_no'+ord_id).value;

			var quotation_entry_date 		= document.getElementById('quotation_entry_date'+ord_id).value;
			var advance_amount 				= document.getElementById('advance_amount'+ord_id).value;
			var gross_amount 				= document.getElementById('gross_amount'+ord_id).value;
			var transport_amount 			= document.getElementById('transport_amount'+ord_id).value;
			var tax_per 					= document.getElementById('tax_per'+ord_id).value;
			var tax_amount 					= document.getElementById('tax_amount'+ord_id).value;
			var net_amount 					= document.getElementById('net_amount'+ord_id).value;
			var inv_cnt 					= document.getElementById('quotation_entry_inv_cnt'+ord_id).value;
			
			var invoice_no					= quotation_entry_no+"-"+inv_cnt;
			
			var type_id 					= document.getElementById('quotation_entry_type_id'+ord_id).value;
			var table 						= document.getElementById('so_detail');

			var row_cnt     				= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+quotation_entry_no+"</td><td>"+quotation_entry_date+"<input type='hidden'  name='invoice_entry_quotation_entry_id' id='invoice_entry_quotation_entry_id' value='"+quotation_entry_id+"'  class='dc_id'  /><input type='hidden'  name='invoice_entry_type_id' id='invoice_entry_type_id' value='"+type_id+"'  /></td></tr>");
				
				getTableHeader(type_id);
				document.getElementById('invoice_entry_advance_amount').value	= advance_amount;
				document.getElementById('invoice_entry_gross_amount').value	= gross_amount;
				document.getElementById('invoice_entry_transport_amount').value	= transport_amount;
				document.getElementById('invoice_entry_tax_per').value	= tax_per;
				document.getElementById('invoice_entry_tax_amount').value	= tax_amount;
				document.getElementById('invoice_entry_net_amount').value	= net_amount;
				document.getElementById('invoice_entry_no').value	= invoice_no;
			

		}

	}

}





function GetDetail(){

	var m_id 			= getQuotationId();

	var quotation_entry_id 			= document.getElementById('invoice_entry_quotation_entry_id').value;
	var t_id						= $('#invoice_entry_type_id').val();
	var entry_type 					= document.getElementById('invoice_entry_type').value;
	$.get('product-detail.php',
		{m_id:m_id,quotation_entry_id:quotation_entry_id,entry_type:entry_type,product_type_id:t_id},
		function(data) { $('#dynamic-content').html(data); }
	);	

}

function AddproductDetail(){
	var apnd	= '';
	var table 						= document.getElementById('product_detail');
	var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
	var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
	var row_cnt_as     				= $('#product_detail_as >tbody >tr').length;	
	var row_cnt						= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as)+1;
	
	var x						= document.getElementsByName("quotation_entry_product_detail_id[]");
	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) {
			
			var ord_id 						=  x[i].value;

			var detail_id 					= ord_id;

			var product_name 				= document.getElementById('product_name'+ord_id).value;

			var product_id 					= document.getElementById('product_id'+ord_id).value;

			var product_code 				= document.getElementById('product_code'+ord_id).value;

			var product_uom 				= document.getElementById('product_uom'+ord_id).value;

			var product_colour_name			= document.getElementById('product_colour_name'+ord_id).value;
			var product_brand_name			= document.getElementById('product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('product_thick_ness'+ord_id).value;
		
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
			var product_type				= document.getElementById('product_type'+ord_id).value;
			var product_colour_id			= document.getElementById('product_colour_id'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;

			var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
			var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
			var row_cnt_as     				= $('#product_detail_as >tbody >tr').length;	
			var row_cnt						= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as)+1;
			var apnd						= '';
			
			if(t_id == 1){
			 	var total_length			= ((product_s_width_inches * (eval(product_sl_feet)+eval(product_sl_feet_in)) ) / product_width_inches)*product_qty;
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="invoice_entry_product_detail_quotation_detail_id[]" id="invoice_entry_product_detail_quotation_detail_id" value="'+detail_id+'" /><input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type" value="'+t_id+'" /><input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id'+row_cnt+'" value="" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden" id="invoice_entry_product_detail_color_id'+row_cnt+'" name="invoice_entry_product_detail_color_id[]" value="'+product_colour_id+'"></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden" id="invoice_entry_product_detail_product_thick'+row_cnt+'" name="invoice_entry_product_detail_product_thick[]" value="'+product_thick_ness_id+'"></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches'+row_cnt+'"  onBlur="GetTotalLength('+row_cnt+'),GetWcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet'+row_cnt+'" onBlur="GetLcalFeet(1,'+row_cnt+'),GetTotalLength('+row_cnt+');"  value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'"  /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_met[]" id="invoice_entry_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'"  /><input type="hidden" name="invoice_entry_product_detail_s_weight_inches[]" id="invoice_entry_product_detail_s_weight_inches'+row_cnt+'"    value=""   /><input type="hidden"  name="invoice_entry_product_detail_s_weight_mm[]" id="invoice_entry_product_detail_s_weight_mm'+row_cnt+'"  value=""   /></td>';
			
			apnd	+= ' <td><input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'"  onBlur="GetTotalLength('+row_cnt+'),discountPerFind('+row_cnt+');"  /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_tot_length[]" id="invoice_entry_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"   /><input  type="hidden"  name="invoice_entry_product_detail_inv_tot_length[]" id="invoice_entry_product_detail_inv_tot_length'+row_cnt+'" readonly value="'+total_length+'"   /> </td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate'+row_cnt+'"  value="'+product_rate+'"  onBlur="discountPerFind('+row_cnt+')" /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total'+row_cnt+'"  value="'+product_total_amt+'" readonly=""    /></td></tr>';
				
			$("#product_detail_rls_display").append(apnd);	
			}else if(t_id == 2){
				
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type" value="'+product_type+'"  /><input type="hidden"  name="invoice_entry_product_detail_quotation_detail_id[]" id="invoice_entry_product_detail_quotation_detail_id" value="'+detail_id+'" /><input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type" value="'+t_id+'" /><input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id'+row_cnt+'" value="" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden" id="invoice_entry_product_detail_color_id'+row_cnt+'" name="invoice_entry_product_detail_color_id[]" value="'+product_colour_id+'"></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden" id="invoice_entry_product_detail_product_thick'+row_cnt+'" name="invoice_entry_product_detail_product_thick[]" value="'+product_thick_ness_id+'"></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_inches[]" id="invoice_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetLcalc(3,'+row_cnt+'),RawdiscountPerFind('+row_cnt+')"   value="'+product_s_weight_inches+'"   /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_mm[]" id="invoice_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetLcalc(4,'+row_cnt+')"  value="'+product_s_weight_mm+'"   /><input type="hidden"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'"  value="" /></td>';
			
			apnd	+= ' </td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate'+row_cnt+'"  value="'+product_rate+'"   onBlur="RawdiscountPerFind('+row_cnt+')"    /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total'+row_cnt+'" value="'+product_total_amt+'" /></td></tr>';	
				
			$("#product_detail_rws_display").append(apnd);	
			}else{ 
			
			apnd	+= '<tr><td>'+product_name+'<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="invoice_entry_product_detail_quotation_detail_id[]" id="invoice_entry_product_detail_quotation_detail_id" value="'+detail_id+'" /><input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type" value="'+t_id+'" /><input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id'+row_cnt+'" value="" /></td>';
			
			apnd	+= '<td>'+product_uom+'</td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'" value="'+product_qty+'"   onBlur="AccdiscountPerFind('+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate'+row_cnt+'"  value="'+product_rate+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total'+row_cnt+'"  value="'+product_total_amt+'"  /></td></tr>';
			
			$("#product_detail_as_display").append(apnd);	
			}
			
			

			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}
	totalAmount();
}

function get_color(id,type){
	if(type==1){
	$.get('get_color.php',{type:type},function(data){$('#invoice_entry_product_detail_color_id'+id).html(data)});
	}else{
	$.get('get_color.php',{type:type},function(data){$('#invoice_entry_product_detail_product_thick'+id).html(data)});
	}
}
function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('invoice_entry_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('invoice_entry_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('invoice_entry_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('invoice_entry_product_detail_width_mm'+id).value 			= data_t[2];
			document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('invoice_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('invoice_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('invoice_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
			}
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
function RawdiscountPerFind(id)
{	
	var product_qty 		= document.getElementById('invoice_entry_product_detail_s_weight_inches'+id).value;
	var product_price		= document.getElementById('invoice_entry_product_detail_rate'+id).value;
	if(product_qty == '' || product_qty == ' ') {
		product_qty = 0;
	}
	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));
	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));
	var product_amount  	= parseFloat(product_qty) * parseFloat(product_price);
	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(0));
	document.getElementById('invoice_entry_product_detail_total'+id).value =  product_amount;
	totalAmount();
}
function AccdiscountPerFind(id)
{	
	var product_qty 		= document.getElementById('invoice_entry_product_detail_qty'+id).value;
	var product_price		= document.getElementById('invoice_entry_product_detail_rate'+id).value;
	if(product_qty == '' || product_qty == ' ') {
		product_qty = 0;
	}
	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));
	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));
	var product_amount  	= parseFloat(product_qty) * parseFloat(product_price);
	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(0));
	document.getElementById('invoice_entry_product_detail_total'+id).value =  product_amount;
	totalAmount();
}
function discountPerFind(id)
{	
	var product_qty 		= document.getElementById('invoice_entry_product_detail_tot_length'+id).value;
	var product_price		= document.getElementById('invoice_entry_product_detail_rate'+id).value;
	if(product_qty == '' || product_qty == ' ') {
		product_qty = 0;
	}
	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));
	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));
	var product_amount  	= parseFloat(product_qty) * parseFloat(product_price);
	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(0));
	document.getElementById('invoice_entry_product_detail_total'+id).value =  product_amount;
	totalAmount();
}

function totalAmount(){

	var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
	var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
	var row_cnt_as     			= $('#product_detail_as >tbody >tr').length;	
	var total_row					= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as);
	var sum_val = 0;
	for(var i=1; i<=parseInt(total_row); i++) {
		var total_detail_amt 	= document.getElementById('invoice_entry_product_detail_total'+i).value;
		var toal_amount 	 	= (isNaN(total_detail_amt)?0.00:parseFloat(total_detail_amt));
		sum_val 				= parseFloat(sum_val)+parseFloat(toal_amount);
	}

	var gross_amount			= (isNaN(sum_val)?0.00:parseFloat(sum_val).toFixed(0));

	document.getElementById('invoice_entry_gross_amount').value 	= gross_amount;

	

	var transport_amount		= document.getElementById('invoice_entry_transport_amount').value;

	var tax_per					= document.getElementById('invoice_entry_tax_per').value;

	var advance_amount			= document.getElementById('invoice_entry_advance_amount').value;



	var transport_amount 		= (isNaN(transport_amount)? 0.00 : parseFloat(transport_amount));

	var tax_per 				= (isNaN(tax_per)? 0.00 : parseFloat(tax_per));

	var advance_amount 			= (isNaN(advance_amount)? 0.00 : parseFloat(advance_amount));

	//var tax_amount				= (tax_per*gross_amount)/100;
	var tax_amount				= (gross_amount/tax_per);
	var tax_amount 				= (isNaN(tax_amount)? 0.00 : parseFloat(tax_amount));

	 document.getElementById('invoice_entry_tax_amount').value	= tax_amount.toFixed(0);

	var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount)+parseFloat(tax_amount);

	var net_amount				= parseFloat(net_amount)-parseFloat(advance_amount);

	var net_amount 				= (isNaN(net_amount)? 0.00 : parseFloat(net_amount));

	document.getElementById('invoice_entry_net_amount').value 	= net_amount.toFixed(0);

}



function getDueDate(){

	var inv_date = document.getElementById('invoice_entry_date').value;

	var cr_day = document.getElementById('invoice_entry_credit_days').value;

	if(cr_day == '') {

		cr_day = 0;	

	}
	$.get(

		"../ajax-file/get-due-date.php",

		{inv_date:inv_date, cr_day:cr_day},

		function(data) { 

			document.getElementById('invoice_entry_due_date').value = data.trim() ;

		}

	);		
}
function GetTotalLength(id){
	var product_qty 	= document.getElementById('invoice_entry_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value;
	var sales_length_f 	= document.getElementById('invoice_entry_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value;
	var sales_length	= Number(sales_length_f)+Number(sales_length_i);
	var width 			= document.getElementById('invoice_entry_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('invoice_entry_product_detail_tot_length'+id).value = total_length_val.toFixed(2);
	
}



function GetLcalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('invoice_entry_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		//var calc_amount 	= document.getElementById('invoice_entry_product_detail_length_meter'+id).value;	

	}
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			
			if(calculation_id==1){
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
			}

			/*document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value 		= data_t[1];

			document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];*/

			//document.getElementById('invoice_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);


}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('invoice_entry_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('invoice_entry_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('invoice_entry_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('invoice_entry_product_detail_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('invoice_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('invoice_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}