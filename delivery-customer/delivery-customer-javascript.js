checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('delivery_customer_list_form').elements.length; i++) {

	  document.getElementById('delivery_customer_list_form').elements[i].checked = checked;

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

	var branch_id 		= document.getElementById('delivery_customer_branch_id').value;
	var customer_id 		= document.getElementById('delivery_customer_customer_id').value;

	$.get('sales-detail.php',

		{branch_id:branch_id,customer_id:customer_id},

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
			var delivery_customer_no	= invoice_entry_no+"-"+dc_cnt;
			var table 					= document.getElementById('so_detail');
			var row_cnt     			= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+invoice_entry_no+"</td><td>"+invoice_entry_date+"<input type='hidden'  name='delivery_customer_invoice_entry_id' id='delivery_customer_invoice_entry_id' value='"+invoice_entry_id+"'  class='dc_id'  /><input type='hidden'  name='delivery_customer_type_id' id='delivery_customer_type_id' value=''  class='dc_id'  /><input type='hidden'  name='delivery_customer_prd_type' id='delivery_customer_prd_type' value='"+invoice_entry_type_id+"'  class=''  /></tr>");

			document.getElementById('delivery_customer_no').value	= delivery_customer_no;
			
		}

	}

}





function GetDetail(){

	var m_id 			= getQuotationId();

	var invoice_entry_id 			= document.getElementById('delivery_customer_invoice_entry_id').value;

	$.get('product-detail.php',

		{m_id:m_id,invoice_entry_id:invoice_entry_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){
		
	var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
	var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
	var row_cnt_as     				= $('#product_detail_as >tbody >tr').length;	
	var row_cnt						= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as)+1;
		
		
	var x						= document.getElementsByName("invoice_entry_product_detail_id[]");
	var typ_t					= document.getElementById('delivery_customer_type_id').value;

	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) {
			var ord_id 					=  x[i].value;

			var detail_id 				= ord_id; //alert(detail_id);

			var product_name 			= document.getElementById('product_name'+ord_id).value;

			var product_id 				= document.getElementById('product_id'+ord_id).value;

			var product_code 			= document.getElementById('product_code'+ord_id).value;

			var product_uom 			= document.getElementById('product_uom'+ord_id).value; 
			
			var product_brand_id 			= document.getElementById('product_brand_id'+ord_id).value; 

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
			var product_type			= document.getElementById('product_type'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			var product_mother_child_type	= document.getElementById('product_mother_child_type'+ord_id).value; 
			
			var product_is_opp				= document.getElementById('product_is_opp'+ord_id).value;
			var product_opp_feet_per_qty 	= document.getElementById('product_opp_feet_per_qty'+ord_id).value;
			var product_sale_by 			= document.getElementById('product_sale_by'+ord_id).value;
			var product_sale_feet 			= document.getElementById('product_sale_feet'+ord_id).value;
			var apnd						= '';
			
			if(t_id == 1){
			 
			apnd	+= '<tr><td><input type="hidden"  name="delivery_customer_product_is_opp[]" id="delivery_customer_product_is_opp'+row_cnt+'" value="0" /><input type="hidden"  name="delivery_customer_product_opp_feet_per_qty[]" id="delivery_customer_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input type="hidden"  name="delivery_customer_product_detail_sale_by[]" id="delivery_customer_product_detail_sale_by'+row_cnt+'" value="" /><input type="hidden"  name="delivery_customer_product_detail_mother_child_type[]" id="delivery_customer_product_detail_mother_child_type" value="'+product_mother_child_type+'" /><input type="hidden"  name="delivery_customer_product_detail_brand_id[]" id="delivery_customer_product_detail_brand_id" value="'+product_brand_id+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="delivery_customer_product_detail_product_id[]" id="delivery_customer_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="delivery_customer_product_detail_product_type[]" id="delivery_customer_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="delivery_customer_product_detail_invoice_detail_id[]" id="delivery_customer_product_detail_invoice_detail_id" value="'+detail_id+'" /><input type="hidden"  name="delivery_customer_product_detail_entry_type[]" id="delivery_customer_product_detail_entry_type" value="1" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="delivery_customer_product_detail_color_id[]" id="delivery_customer_product_detail_color_id'+row_cnt+'" value="'+product_color_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness_val+'<input type="hidden"  name="delivery_customer_product_detail_product_thick[]" id="delivery_customer_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_customer_product_detail_width_inches[]" id="delivery_customer_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="delivery_customer_product_detail_width_mm[]" id="delivery_customer_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_width_inches[]" id="delivery_customer_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_width_mm[]" id="delivery_customer_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_customer_product_detail_sl_feet[]" id="delivery_customer_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(10,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="delivery_customer_product_detail_sl_feet_in[]" id="delivery_customer_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(10,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'"  /></td><td><input class="form-control" type="text"  name="delivery_customer_product_detail_sl_feet_mm[]" id="delivery_customer_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="delivery_customer_product_detail_sl_feet_met[]" id="delivery_customer_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'"  /><input type="hidden" name="delivery_customer_product_detail_s_weight_inches[]" id="delivery_customer_product_detail_s_weight_inches'+row_cnt+'"    value="'+product_s_weight_inches+'"   /><input type="hidden"  name="delivery_customer_product_detail_s_weight_mm[]" id="delivery_customer_product_detail_s_weight_mm'+row_cnt+'"  value="'+product_s_weight_mm+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_customer_product_detail_qty[]" id="delivery_customer_product_detail_qty'+row_cnt+'"  value="'+product_qty+'"  onBlur="GetTotalLength('+row_cnt+')" /></td><td><input class="form-control" type="text"  name="delivery_customer_product_detail_tot_length[]" id="delivery_customer_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"   /></td> </tr>';
			
			$("#product_detail_rls_display").append(apnd);
			var typ_t	= typ_t+t_id+",";
			}else if(t_id == 2){
				
			apnd	+= '<tr><td><input type="hidden"  name="delivery_customer_product_is_opp[]" id="delivery_customer_product_is_opp'+row_cnt+'" value="0" /><input type="hidden"  name="delivery_customer_product_opp_feet_per_qty[]" id="delivery_customer_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input type="hidden"  name="delivery_customer_product_detail_sale_by[]" id="delivery_customer_product_detail_sale_by'+row_cnt+'" value="" /><input type="hidden"  name="delivery_customer_product_detail_mother_child_type[]" id="delivery_customer_product_detail_mother_child_type" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="delivery_customer_product_detail_product_id[]" id="delivery_customer_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="delivery_customer_product_detail_product_type[]" id="delivery_customer_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="delivery_customer_product_detail_invoice_detail_id[]" id="delivery_customer_product_detail_invoice_detail_id" value="'+detail_id+'" /><input type="hidden"  name="delivery_customer_product_detail_entry_type[]" id="delivery_customer_product_detail_entry_type" value="2" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="delivery_customer_product_detail_color_id[]" id="delivery_customer_product_detail_color_id'+row_cnt+'" value="'+product_color_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness_val+'<input type="hidden"  name="delivery_customer_product_detail_product_thick[]" id="delivery_customer_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_customer_product_detail_width_inches[]" id="delivery_customer_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="delivery_customer_product_detail_width_mm[]" id="delivery_customer_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  /></td>';
			
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_width_inches[]" id="delivery_customer_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+');GetLcalFeet(9,'+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_width_mm[]" id="delivery_customer_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /><input type="hidden"  name="delivery_customer_product_detail_qty[]" id="delivery_customer_product_detail_qty'+row_cnt+'"  value="1" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_weight_inches[]" id="delivery_customer_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetWeightClc(1,'+row_cnt+')"   value="'+product_s_weight_inches+'"   /></td> <td><input class="form-control" type="text"  name="delivery_customer_product_detail_s_weight_mm[]" id="delivery_customer_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetWeightClc(2,'+row_cnt+')"  value="'+product_s_weight_mm+'"   /><input class="form-control" type="hidden"  name="delivery_customer_product_detail_sl_feet_mm[]" id="delivery_customer_product_detail_sl_feet_mm'+row_cnt+'"   value="'+product_sl_feet_mm+'"  /><input class="form-control" type="hidden"  name="delivery_customer_product_detail_sl_feet_met[]" id="delivery_customer_product_detail_sl_feet_met'+row_cnt+'" value="'+product_sl_feet_met+'"  /> <input class="form-control" type="hidden"  name="delivery_customer_product_detail_sl_feet[]" id="delivery_customer_product_detail_sl_feet'+row_cnt+'"  value="'+product_sl_feet+'" /> <input class="form-control" type="hidden"  name="delivery_customer_product_detail_sl_feet_in[]" id="delivery_customer_product_detail_sl_feet_in'+row_cnt+'" value="'+product_sl_feet_in+'" /></td>';
			
			$("#product_detail_rws_display").append(apnd);	
			var typ_t	= typ_t+t_id+",";	
			}else{ 
			
			apnd	+= '<tr><td><input type="hidden"  name="delivery_customer_product_detail_mother_child_type[]" id="delivery_customer_product_detail_mother_child_type" value="'+product_mother_child_type+'" />'+product_name+'<input type="hidden"  name="delivery_customer_product_detail_product_id[]" id="delivery_customer_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="delivery_customer_product_detail_product_type[]" id="delivery_customer_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="delivery_customer_product_detail_invoice_detail_id[]" id="delivery_customer_product_detail_invoice_detail_id" value="'+detail_id+'" /><input type="hidden"  name="delivery_customer_product_detail_entry_type[]" id="delivery_customer_product_detail_entry_type" value="4" /></td>';
			
			apnd	+= '<td>'+product_uom+'</td>';
			
			if(product_sale_by == 'feet') {
				apnd	+= '<td><input type="hidden"  name="delivery_customer_product_is_opp[]" id="delivery_customer_product_is_opp'+row_cnt+'" value="'+product_is_opp+'" /><input type="hidden"  name="delivery_customer_product_opp_feet_per_qty[]" id="delivery_customer_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input class="form-control" type="text"  name="delivery_customer_product_detail_sale_by[]" id="delivery_customer_product_detail_sale_by'+row_cnt+'"  value="FEET" style="width:20%;display:inline-block" readonly  />&nbsp;&nbsp;&nbsp;<input class="form-control" type="text"  name="delivery_customer_product_detail_qty[]" id="delivery_customer_product_detail_qty'+row_cnt+'" value="'+product_sale_feet+'"  style="width:60%;display:inline-block" /></td></tr>';
			} else {
				apnd	+= '<td><input type="hidden"  name="delivery_customer_product_is_opp[]" id="delivery_customer_product_is_opp'+row_cnt+'" value="'+product_is_opp+'" /><input type="hidden"  name="delivery_customer_product_opp_feet_per_qty[]" id="delivery_customer_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input class="form-control" type="text"  name="delivery_customer_product_detail_sale_by[]" id="delivery_customer_product_detail_sale_by'+row_cnt+'"  value="QTY" style="width:20%;display:inline-block" readonly  />&nbsp;&nbsp;&nbsp;<input class="form-control" type="text"  name="delivery_customer_product_detail_qty[]" id="delivery_customer_product_detail_qty'+row_cnt+'" value="'+product_qty+'"  style="width:60%;display:inline-block" /></td></tr>';
			}
			
			/* apnd	+= '<td><input class="form-control" type="text"  name="delivery_customer_product_detail_qty[]" id="delivery_customer_product_detail_qty'+row_cnt+'" value="'+product_qty+'"  /></td></tr>'; */
			
			
			$("#product_detail_as_display").append(apnd);	
			var typ_t	= typ_t+t_id+",";
			}
			
			getTableHeader(t_id);

			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}
	document.getElementById('delivery_customer_type_id').value = typ_t;
	totalAmount();

}
 function GetWeightClc(type,id){
	var prod_ton =$('#gatepass_entry_product_detail_s_weight_inches'+id).val();
	var prod_kg =$('#gatepass_entry_product_detail_s_weight_mm'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#gatepass_entry_product_detail_s_weight_mm'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#gatepass_entry_product_detail_s_weight_inches'+id).val(prod_val);
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

	var product_qty 		= document.getElementById('delivery_customer_product_detail_qty'+id).value;

	var product_feet 		= document.getElementById('delivery_customer_product_detail_length_feet'+id).value;

	var product_price		= document.getElementById('delivery_customer_product_detail_rate'+id).value;

		

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

	document.getElementById('delivery_customer_product_detail_total_length'+id).value =  product_tot_len;

	document.getElementById('delivery_customer_product_detail_amount'+id).value =  product_amount;

	totalAmount();

}

function totalAmount()

{

	var table 				= document.getElementById('product_detail');

	var total_row     		= parseFloat(table.rows.length)-2;			

	var sum_val = 0;

	for(var i=1; i<=parseInt(total_row); i++) {

		var total_detail_amt 	= document.getElementById('delivery_customer_product_detail_amount'+i).value;

		var toal_amount 	 	= (isNaN(total_detail_amt)?0.00:parseFloat(total_detail_amt));

		sum_val 				= parseFloat(sum_val)+parseFloat(toal_amount);

	}

	var gross_amount			= (isNaN(sum_val)?0.00:parseFloat(sum_val).toFixed(2));

	document.getElementById('delivery_customer_gross_amount').value 	= gross_amount;

	

	var transport_amount		= document.getElementById('delivery_customer_transport_amount').value;

	var tax_per					= document.getElementById('delivery_customer_tax_per').value;

	var advance_amount			= document.getElementById('delivery_customer_advance_amount').value;



	var transport_amount 		= (isNaN(transport_amount)? 0.00 : parseFloat(transport_amount));

	var tax_per 				= (isNaN(tax_per)? 0.00 : parseFloat(tax_per));

	var advance_amount 			= (isNaN(advance_amount)? 0.00 : parseFloat(advance_amount));

	var tax_amount				= (tax_per*gross_amount)/100;

	var tax_amount 				= (isNaN(tax_amount)? 0.00 : parseFloat(tax_amount));

	 document.getElementById('delivery_customer_tax_amount').value	= tax_amount;

	var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount)+parseFloat(tax_amount);

	var net_amount				= parseFloat(net_amount)-parseFloat(advance_amount);

	var net_amount 				= (isNaN(net_amount)? 0.00 : parseFloat(net_amount));

	document.getElementById('delivery_customer_net_amount').value 	= net_amount;

}





function getDueDate(){
	var inv_date = document.getElementById('delivery_customer_date').value;
	var cr_day = document.getElementById('delivery_customer_credit_days').value;
	if(cr_day == '') {
		cr_day = 0;	
	}
	$.get(

		"../ajax-file/get-due-date.php",

		{inv_date:inv_date, cr_day:cr_day},

		function(data) { 

			document.getElementById('delivery_customer_due_date').value = data.trim() ;

		}

	);		
}
function GetTotalLength(id){
	var product_qty 	= document.getElementById('delivery_customer_product_detail_qty'+id).value;	
	var sales_width 	= document.getElementById('delivery_customer_product_detail_s_width_inches'+id).value;
	var sales_length_f 	= document.getElementById('delivery_customer_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('delivery_customer_product_detail_sl_feet_in'+id).value;
	//var sales_length	= Number(sales_length_f)+Number(sales_length_i);
	var sales_length	= Number(sales_length_f)+(Number(sales_length_i)/12)
	var width 			= document.getElementById('delivery_customer_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('delivery_customer_product_detail_tot_length'+id).value = (sales_length*product_qty).toFixed(2);
	
}



function GetLcalFeet(calculation_id,id){
	
var pr_id=$("#delivery_customer_product_detail_product_id"+id).val();
var child_type=$("#delivery_customer_product_mother_child_type"+id).val();
var thick=$("#delivery_customer_product_detail_product_thick"+id).val();
var brand_id=$("#delivery_customer_product_detail_brand_id"+id).val(); //alert(brand_id);
var width_inches=$("#delivery_customer_product_detail_width_inches"+id).val();

	if(calculation_id==10){

		var calc_amount_feet 	= document.getElementById('delivery_customer_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('delivery_customer_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('delivery_customer_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('delivery_customer_product_detail_sl_feet_met'+id).value;	

	}else if(calculation_id==9){

		var calc_amount 	= document.getElementById('delivery_customer_product_detail_s_weight_inches'+id).value;	

	} 
	
	
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount,pr_id:pr_id,child_type:child_type,thick:thick,brand_id:brand_id,width_inches:width_inches},

		function(data) {
			
			
			var data_t	= data.split('@'); 
			if(calculation_id==10){
				document.getElementById('delivery_customer_product_detail_sl_feet_mm'+id).value 		= data_t[2];
				document.getElementById('delivery_customer_product_detail_sl_feet_met'+id).value 		= data_t[3];
				document.getElementById('delivery_customer_product_detail_s_weight_inches'+id).value 	= data_t[4];
				document.getElementById('delivery_customer_product_detail_s_weight_mm'+id).value 		= data_t[5];
				
			}
			else if(calculation_id==3){
				document.getElementById('delivery_customer_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
				document.getElementById('delivery_customer_product_detail_sl_feet_met'+id).value 		= data_t[3];
				document.getElementById('delivery_customer_product_detail_sl_feet_in'+id).value		= '';
			}
			else if(calculation_id==4){
				document.getElementById('delivery_customer_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
				document.getElementById('delivery_customer_product_detail_sl_feet_mm'+id).value 		= data_t[2];
				document.getElementById('delivery_customer_product_detail_sl_feet_in'+id).value		= '';
			}
			else if(calculation_id==9){ 
				document.getElementById('delivery_customer_product_detail_sl_feet'+id).value 		= data_t[2];
				document.getElementById('delivery_customer_product_detail_sl_feet_in'+id).value 		= data_t[3];
				document.getElementById('delivery_customer_product_detail_sl_feet_mm'+id).value 		= data_t[4];
				document.getElementById('delivery_customer_product_detail_sl_feet_met'+id).value 		= data_t[5];
			}
			
			
			

			/*var data_t	= data.split('@'); 
			
			if(calculation_id==10){
				document.getElementById('delivery_customer_product_detail_sl_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('delivery_customer_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
			}*/

			/*document.getElementById('delivery_customer_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('delivery_customer_product_detail_sl_feet_in'+id).value 		= data_t[1];

			document.getElementById('delivery_customer_product_detail_sl_feet_mm'+id).value 		= data_t[2];*/

			//document.getElementById('delivery_customer_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('delivery_customer_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('delivery_customer_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('delivery_customer_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('delivery_customer_product_detail_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('delivery_customer_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('delivery_customer_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('delivery_customer_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('delivery_customer_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}