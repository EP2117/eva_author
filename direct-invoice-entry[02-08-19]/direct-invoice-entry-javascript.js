checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('quotation_entry_list_form').elements.length; i++) {

	  document.getElementById('quotation_entry_list_form').elements[i].checked = checked;

	}

}

$(document).ready(function(){
	var id	= $('#invoice_entry_type_id').val();
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
});

function getTableHeader(id){
	if(document.getElementById('invoice_entry_type_id1').checked==true){
		$('#product_detail_rls').show();
	}else{
		$('#product_detail_rls').hide();
	}
	if(document.getElementById('invoice_entry_type_id2').checked==true){
		$('#product_detail_rws').show();
	}else{
		$('#product_detail_rws').hide();
	}
	if(document.getElementById('invoice_entry_type_id4').checked==true){
		$('#product_detail_as').show();
	}else{
		$('#product_detail_as').hide();
	}
}



function GetDetail(t_id){
	
	var m_id 			= getQuotationId();
	var brand_id		= document.getElementById('invoice_entry_brand_id').value;
	//alert(t_id);
	if(t_id !='' && t_id !=0 && brand_id!=''){
	
		$.get('product-detail.php',
	
			{m_id:m_id,t_id:t_id,brand_id:brand_id},
	
			function(data) { $('#dynamic-content').html( data ); }
	
		);	
	}else{
		alert('Please Select Type...');	
	}
}

function AddproductDetail(){
		
		var table = $('#product_detail_popup').DataTable();	 
		table.$('.check_prd_id:checkbox:checked').each(function(){ 
			var ord_id 					=  $(this).val();
			
			var t_id 					= table.$("#product_type_id"+ord_id).val();
			var product_id 				= table.$("#product_id"+ord_id).val();
			var product_name 			= table.$("#product_name"+ord_id).val();
			var product_code 			= table.$("#product_code"+ord_id).val();
			var product_type 			= table.$("#product_type"+ord_id).val();
			var product_uom_id 			= table.$("#product_uom_id"+ord_id).val();
			var product_uom_name 		= table.$("#product_uom_name"+ord_id).val();
			if(t_id != 4){
			var product_brand_name 		= table.$("#product_brand_name"+ord_id).val();
			var product_brand_id 		= table.$("#product_brand_id"+ord_id).val();
			var product_colour_name		= table.$("#product_colour_name"+ord_id).val();
			var product_colour_id		= table.$("#product_colour_id"+ord_id).val();

			var product_thick_ness		= table.$("#product_thick_ness"+ord_id).val();
			var product_thick_ness_val	= table.$("#product_thick_ness_val"+ord_id).val();
			var product_type			= table.$("#product_type"+ord_id).val();
			var product_inches			= table.$("#product_inches"+ord_id).val(); 
			var product_inches_mm		= table.$("#product_inches_mm"+ord_id).val();
			var mas_product_id 			= table.$("#mas_product_id"+ord_id).val();
			
			
			}
			var product_mother_child_type 			= table.$("#product_mother_child_type"+ord_id).val();
			
			var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
			var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
			var row_cnt_as     			= $('#product_detail_as >tbody >tr').length;	
			var row_cnt					= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as)+1;
			var count_product_id 	     = table.$("#count_product_id"+ord_id).val(); 
			for(var kk=1;kk<=count_product_id;kk++){
				var apnd					='';
				if(t_id == 1){
				 
				apnd	+= '<tr><td><input type="hidden"  name="invoice_entry_product_detail_mother_child_type[]" id="invoice_entry_product_detail_mother_child_type'+row_cnt+'" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id'+row_cnt+'" value="'+product_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_brand_id[]" id="invoice_entry_product_detail_product_brand_id'+row_cnt+'" value="'+product_brand_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type" value="1" /></td>';
				
			apnd	+= '<td><select  name="invoice_entry_product_detail_product_color_id[]" id="invoice_entry_product_detail_product_color_id'+row_cnt+'" onfocus="get_color('+row_cnt+',1);"><option value=""> --Select-- </option></select><input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td><select  name="invoice_entry_product_detail_product_thick[]" id="invoice_entry_product_detail_product_thick'+row_cnt+'" onfocus="get_color('+row_cnt+',2);"><option value=""> --Select-- </option></select></td>';
				
				apnd	+= '<td><input class="form-control" type="hidden"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches'+row_cnt+'"   onBlur="GetTotalLength('+row_cnt+'),GetWcalc(2,'+row_cnt+')" value="36"  /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm'+row_cnt+'"  onBlur="GetTotalLength('+row_cnt+'),GetWcalc(3,'+row_cnt+')" value="'+product_inches_mm+'"  /><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>';
				
				apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet'+row_cnt+'" onBlur="GetLcalFeet(10,'+row_cnt+'),GetTotalLength('+row_cnt+');"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(10,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm'+row_cnt+'"  onChange="GetLcalFeet(3,'+row_cnt+')"/></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_met[]" id="invoice_entry_product_detail_sl_feet_met'+row_cnt+'"   onChange="GetLcalFeet(4,'+row_cnt+')"/><input type="hidden"  name="invoice_entry_product_detail_s_weight_inches[]" id="invoice_entry_product_detail_s_weight_inches'+row_cnt+'" /><input type="hidden"  name="invoice_entry_product_detail_s_weight_mm[]" id="invoice_entry_product_detail_s_weight_mm'+row_cnt+'"  /></td>';
				
				apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"  onBlur="GetTotalLength(3,'+row_cnt+'),discountPerFind('+row_cnt+');"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_tot_length[]" id="invoice_entry_product_detail_tot_length'+row_cnt+'" readonly  /> <input type="hidden"  name="invoice_entry_product_detail_inv_tot_length[]" id="invoice_entry_product_detail_inv_tot_length'+row_cnt+'" readonly  /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate'+row_cnt+'"   onBlur="discountPerFind('+row_cnt+')" /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total'+row_cnt+'"   /></td></tr>';
			$("#product_detail_rls_display").append(apnd);	
				get_color(row_cnt,1);
				get_color(row_cnt,2);
				GetWcalc(2,row_cnt);
				
				}else if(t_id == 2){
					
				apnd	+= '<tr><td><input type="hidden"  name="invoice_entry_product_detail_mother_child_type[]" id="invoice_entry_product_detail_mother_child_type'+row_cnt+'" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id'+row_cnt+'" value="'+product_id+'" /><input type="hidden"  name="invoice_entry_product_detail_mas_product_id[]" id="invoice_entry_product_detail_mas_product_id'+row_cnt+'" value="'+mas_product_id+'" /> <input type="hidden"  name="invoice_entry_product_detail_product_brand_id[]" id="invoice_entry_product_detail_product_brand_id'+row_cnt+'" value="'+product_brand_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type" value="2" /></td>';
				
			apnd	+= '<td><select  name="invoice_entry_product_detail_product_color_id[]" id="invoice_entry_product_detail_product_color_id'+row_cnt+'" onfocus="get_color('+row_cnt+',1);"><option value=""> --Select-- </option></select><input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td><select  name="invoice_entry_product_detail_product_thick[]" id="invoice_entry_product_detail_product_thick'+row_cnt+'" onfocus="get_color('+row_cnt+',2);"><option value=""> --Select-- </option></select></td>';
				
				apnd	+= '<td><input class="form-control" type="hidden"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value="36"  /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm'+row_cnt+'"   onBlur="GetWcalc(3,'+row_cnt+')" value="'+product_inches_mm+'"  /><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>';
				
				apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_inches[]" id="invoice_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetWeightClc(1,'+row_cnt+');RawdiscountPerFind('+row_cnt+');GetLcalFeet(9,'+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_mm[]" id="invoice_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetWeightClc(2,'+row_cnt+')" /><input type="hidden"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'"   /></td><td><input type="text" class="form-control" name="invoice_entry_product_detail_s_weight_met[]" id="invoice_entry_product_detail_s_weight_met'+row_cnt+'"/></td>';
				
				apnd	+= '</td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate'+row_cnt+'" onBlur="RawdiscountPerFind('+row_cnt+')"   /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total'+row_cnt+'"  /> <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm'+row_cnt+'"  /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_met[]" id="invoice_entry_product_detail_sl_feet_met'+row_cnt+'"  /> <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet'+row_cnt+'"  /> <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in'+row_cnt+'" /></td></tr>';	
					
			$("#product_detail_rws_display").append(apnd);
				get_color(row_cnt,1);
				get_color(row_cnt,2);
				GetWcalc(2,row_cnt);
				}else{ 
				
				apnd	+= '<tr><td><input type="hidden"  name="invoice_entry_product_detail_mother_child_type[]" id="invoice_entry_product_detail_mother_child_type'+row_cnt+'" value="'+product_mother_child_type+'" />'+product_name+'<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id'+row_cnt+'" value="'+product_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type"  value="'+product_type+'" /><input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type" value="4" /></td>';
				
				apnd	+= '<td>'+product_uom_name+'<input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
				
				apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate'+row_cnt+'" onBlur="AccdiscountPerFind('+row_cnt+')"   /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total'+row_cnt+'"   /></td></tr>';
			$("#product_detail_as_display").append(apnd);	
				}
				
			
			row_cnt=Number(row_cnt)+1;	
			}	
			
				
		

	}); 

}
function get_color(id,type){
	if(type==1){
	$.get('get_color.php',{type:type},function(data){$('#invoice_entry_product_detail_product_color_id'+id).html(data)});
	}else{
	$.get('get_color.php',{type:type},function(data){$('#invoice_entry_product_detail_product_thick'+id).html(data)});
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

function totalAmount()

{

	var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
	var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
	var row_cnt_as     				= $('#product_detail_as >tbody >tr').length;	
	var total_row					= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as);

	var sum_val = 0;

	for(var i=1; i<=parseInt(total_row); i++) {

		var total_detail_amt 	= document.getElementById('invoice_entry_product_detail_total'+i).value;

		var toal_amount 	 	= (isNaN(total_detail_amt)?0.00:parseFloat(total_detail_amt));

		sum_val 				= parseFloat(sum_val)+parseFloat(toal_amount);

	}

	var gross_amount			= (isNaN(sum_val)?0.00:parseFloat(sum_val).toFixed(0));

	document.getElementById('invoice_entry_gross_amount').value 	= gross_amount;
	var dis_per					= Number(document.getElementById('invoice_entry_dis_per').value);
	if(dis_per!='' && dis_per>0){
		var dis_amount				= (dis_per*gross_amount)/100;
		document.getElementById('invoice_entry_dis_amount').value 	= dis_amount.toFixed(0);
	}
	else{
		var dis_amount				= document.getElementById('invoice_entry_dis_amount').value;
	}

	var transport_amount		= document.getElementById('invoice_entry_transport_amount').value;

	var tax_per					= document.getElementById('invoice_entry_tax_per').value;

	var advance_amount			= document.getElementById('invoice_entry_advance_amount').value;



	var transport_amount 		= Number(transport_amount);

	var tax_per 				= Number(tax_per);

	var advance_amount 			= Number(advance_amount);

	//var tax_amount				= (tax_per*gross_amount)/100;
	var tax_amount				= (gross_amount/tax_per);
	var tax_amount 				= Number(tax_amount);

	 document.getElementById('invoice_entry_tax_amount').value	= tax_amount.toFixed(0);

	//var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount);
	
	
	
	//var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount)+parseFloat(tax_amount);
	var total_amount			= (parseFloat(transport_amount)+parseFloat(gross_amount))-parseFloat(dis_amount);	
	
	document.getElementById('invoice_entry_total_amount').value	=Math.round(total_amount);
	
	
	//alert(parseFloat(advance_amount)+parseFloat(dis_amount));
	var net_amount				= parseFloat(total_amount)-(parseFloat(advance_amount));

	

	document.getElementById('invoice_entry_net_amount').value 	= net_amount.toFixed(2);

}

function GetTotalLength(id){
	var product_qty 	= document.getElementById('invoice_entry_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value;
	var sales_length_f 	= document.getElementById('invoice_entry_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value;
	var sales_length	= Number(sales_length_f)+(Number(sales_length_i)/12);
	var width 			= document.getElementById('invoice_entry_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('invoice_entry_product_detail_tot_length'+id).value = (sales_length*product_qty).toFixed(2);
	document.getElementById('invoice_entry_product_detail_inv_tot_length'+id).value = total_length_val.toFixed(2);
	
}



function GetLcalFeet(calculation_id,id){
	
	var pr_id=$("#invoice_entry_product_detail_product_id"+id).val();
	var child_type=$("#invoice_entry_product_detail_mother_child_type"+id).val();
	var thick=$("#invoice_entry_product_detail_product_thick"+id).val();
	var brand_id=$("#invoice_entry_product_detail_product_brand_id"+id).val();
	var width_inches=$("#invoice_entry_product_detail_s_width_inches"+id).val();
	//alert(pr_id);
	if(calculation_id==10){

		var calc_amount_feet 	= document.getElementById('invoice_entry_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+(Number(calc_amount_in)/12);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value;	

	}
	else if(calculation_id==9){

		var calc_amount 	= document.getElementById('invoice_entry_product_detail_s_weight_inches'+id).value;	

	}
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount,pr_id:pr_id,child_type:child_type,thick:thick,brand_id:brand_id,width_inches:width_inches},

		function(data) {

			var data_t	= data.split('@'); 
			
			if(calculation_id==10){
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= data_t[3];
				document.getElementById('invoice_entry_product_detail_s_weight_inches'+id).value 	= data_t[4];
				document.getElementById('invoice_entry_product_detail_s_weight_mm'+id).value 		= data_t[5];
			}
			else if(calculation_id==3){
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= data_t[3];
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value		= '';
			}
			else if(calculation_id==4){
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value		= '';
			}
			else if(calculation_id==9){ 
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 		= data_t[2];
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value 		= data_t[3];
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= data_t[4];
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= data_t[5];
			}
			

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
			document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('invoice_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
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
 /*function GetWeightClc(type,id){
		var product_id		=$("#invoice_entry_product_detail_mas_product_id"+id).val();
		var prd_thick		=$("#invoice_entry_product_detail_product_thick"+id).val();
		if(type==1){
			var prd_qty_val		=$("#invoice_entry_product_detail_s_weight_inches"+id).val();
 		}else{
			var prd_qty_val		=$("#invoice_entry_product_detail_s_weight_mm"+id).val();
		}
		
		$.get(
			"../ajax-file/product-weight-calc.php",
			{product_id:product_id,prd_thick:prd_thick,prd_type:type,prd_qty_val:prd_qty_val},
			function(data) {
				if(type==1){
					$("#invoice_entry_product_detail_s_weight_mm"+id).val(data);
				}else{
					$("#invoice_entry_product_detail_s_weight_inches"+id).val(data);
				}
			}
		);
	
	
 }*/
   function GetWeightClc(type,id){
	var prod_ton =$('#invoice_entry_product_detail_s_weight_inches'+id).val();
	var prod_kg =$('#invoice_entry_product_detail_s_weight_mm'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#invoice_entry_product_detail_s_weight_mm'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#invoice_entry_product_detail_s_weight_inches'+id).val(prod_val);
	}
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
