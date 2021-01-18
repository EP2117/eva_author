checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('quotation_entry_list_form').elements.length; i++) {

	  document.getElementById('quotation_entry_list_form').elements[i].checked = checked;

	}

}

$(document).ready(function(){
	var id	= $('#quotation_entry_type_id').val();
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



function GetDetail(){
	
	var m_id 			= getQuotationId();
	var t_id			= $('#quotation_entry_type_id').val();
	if(t_id !='' && t_id !=0 ){
	
		$.get('product-detail.php',
	
			{m_id:m_id,t_id:t_id},
	
			function(data) { $('#dynamic-content').html( data ); }
	
		);	
	}else{
		alert('Please Select Type...');	
	}
}

function AddproductDetail(){
		
		  var t_id					= document.getElementById('quotation_entry_type_id').value;
	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) { 

		if (document.getElementById('product_list_form').elements[i].checked == true) {

			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;
			var product_id 				= document.getElementById('product_id'+ord_id).value;
			var product_name 			= document.getElementById('product_name'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;
			var product_type 			= document.getElementById('product_type'+ord_id).value;
			var product_uom_id 			= document.getElementById('product_uom_id'+ord_id).value;
			var product_uom_name 		= document.getElementById('product_uom_name'+ord_id).value;
			if(t_id != 4){
			var product_brand_name 		= document.getElementById('product_brand_name'+ord_id).value;
			var product_brand_id 		= document.getElementById('product_brand_id'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id		= document.getElementById('product_colour_id'+ord_id).value;

			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_val	= document.getElementById('product_thick_ness_val'+ord_id).value;
			var product_type			= document.getElementById('product_type'+ord_id).value;
			var product_inches			= document.getElementById('product_inches'+ord_id).value;
			var product_inches_mm		= document.getElementById('product_inches_mm'+ord_id).value;
			var mas_product_id 			= document.getElementById('mas_product_id'+ord_id).value;
			}
			var table 					= document.getElementById('product_detail');
			
			
			var row_cnt     			= $('#product_detail >tbody >tr').length+1;	 
			var apnd					='';
			if(t_id == 1){
			 
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="quotation_entry_product_detail_product_id[]" id="quotation_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="quotation_entry_product_detail_product_brand_id[]" id="quotation_entry_product_detail_product_brand_id" value="'+product_brand_id+'" /><input type="hidden"  name="quotation_entry_product_detail_product_type[]" id="quotation_entry_product_detail_product_type" value="'+product_type+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="quotation_entry_product_detail_product_color_id[]" id="quotation_entry_product_detail_product_color_id'+row_cnt+'" value="'+product_colour_id+'"   /><input type="hidden"  name="quotation_entry_product_detail_product_uom_id[]" id="quotation_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td><input type="hidden"  name="quotation_entry_product_detail_product_thick[]" id="quotation_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness+'"   /><input class="form-control" type="text"  name="quotation_entry_product_detail_product_thick_val[]" id="quotation_entry_product_detail_product_thick_val'+row_cnt+'" value="'+product_thick_ness_val+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_inches[]" id="quotation_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_inches+'"  /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_mm[]" id="quotation_entry_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_inches_mm+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_width_inches[]" id="quotation_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_width_mm[]" id="quotation_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet[]" id="quotation_entry_product_detail_sl_feet'+row_cnt+'" onBlur="GetLcalFeet(1,'+row_cnt+'),GetTotalLength('+row_cnt+');"  /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet_in[]" id="quotation_entry_product_detail_sl_feet_in'+row_cnt+'" onBlur="GetLcalFeet(1,'+row_cnt+'),GetTotalLength('+row_cnt+');" /></td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet_mm[]" id="quotation_entry_product_detail_sl_feet_mm'+row_cnt+'" onBlur="GetLcalFeet(3,'+row_cnt+'),GetTotalLength('+row_cnt+');"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_qty[]" id="quotation_entry_product_detail_qty'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"  onBlur="GetTotalLength(3,'+row_cnt+'),discountPerFind('+row_cnt+');"  /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_tot_length[]" id="quotation_entry_product_detail_tot_length'+row_cnt+'" readonly  /></td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_rate[]" id="quotation_entry_product_detail_rate'+row_cnt+'"   onBlur="discountPerFind('+row_cnt+')" /></td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_total[]" id="quotation_entry_product_detail_total'+row_cnt+'"   /></td></tr>';
			
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="quotation_entry_product_detail_product_id[]" id="quotation_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="quotation_entry_product_detail_mas_product_id[]" id="quotation_entry_product_detail_mas_product_id'+row_cnt+'" value="'+mas_product_id+'" /> <input type="hidden"  name="quotation_entry_product_detail_product_brand_id[]" id="quotation_entry_product_detail_product_brand_id" value="'+product_brand_id+'" /><input type="hidden"  name="quotation_entry_product_detail_product_type[]" id="quotation_entry_product_detail_product_type" value="'+product_type+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="quotation_entry_product_detail_product_color_id[]" id="quotation_entry_product_detail_product_color_id'+row_cnt+'" value="'+product_colour_id+'"   /><input type="hidden"  name="quotation_entry_product_detail_product_uom_id[]" id="quotation_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td><input type="hidden"  name="quotation_entry_product_detail_product_thick[]" id="quotation_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness+'"   /><input class="form-control" type="text"  name="quotation_entry_product_detail_product_thick_val[]" id="quotation_entry_product_detail_product_thick_val'+row_cnt+'" value="'+product_thick_ness_val+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_inches[]" id="quotation_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_inches+'"  /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_mm[]" id="quotation_entry_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_inches_mm+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_weight_inches[]" id="quotation_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetWeightClc(1,'+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_weight_mm[]" id="quotation_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetWeightClc(2,'+row_cnt+')" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_qty[]" id="quotation_entry_product_detail_qty'+row_cnt+'" onBlur="AccdiscountPerFind('+row_cnt+')"   /></td> </td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_rate[]" id="quotation_entry_product_detail_rate'+row_cnt+'" onBlur="AccdiscountPerFind('+row_cnt+')"   /></td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_total[]" id="quotation_entry_product_detail_total'+row_cnt+'"  /></td></tr>';	
				
				
			}else if(t_id == 3){
			
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="quotation_entry_product_detail_product_id[]" id="quotation_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="quotation_entry_product_detail_product_brand_id[]" id="quotation_entry_product_detail_product_brand_id" value="'+product_brand_id+'" /><input type="hidden"  name="quotation_entry_product_detail_product_type[]" id="quotation_entry_product_detail_product_type" value="'+product_type+'"  />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="quotation_entry_product_detail_product_color_id[]" id="quotation_entry_product_detail_product_color_id'+row_cnt+'" value="'+product_colour_id+'"   /><input type="hidden"  name="quotation_entry_product_detail_product_uom_id[]" id="quotation_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td><input type="hidden"  name="quotation_entry_product_detail_product_thick[]" id="quotation_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness+'"   /><input class="form-control" type="text"  name="quotation_entry_product_detail_product_thick_val[]" id="quotation_entry_product_detail_product_thick_val'+row_cnt+'" value="'+product_thick_ness_val+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_inches[]" id="quotation_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_inches+'" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_width_mm[]" id="quotation_entry_product_detail_width_mm'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"  onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_inches_mm+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_width_inches[]" id="quotation_entry_product_detail_s_width_inches'+row_cnt+'" onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_s_width_mm[]" id="quotation_entry_product_detail_s_width_mm'+row_cnt+'"   onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet[]" id="quotation_entry_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet_in[]" id="quotation_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_sl_feet_mm[]" id="quotation_entry_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_qty[]" id="quotation_entry_product_detail_qty'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+'),discountPerFind('+row_cnt+');"   /></td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_tot_length[]" id="quotation_entry_product_detail_tot_length'+row_cnt+'" readonly /></td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_rate[]" id="quotation_entry_product_detail_rate'+row_cnt+'"   onBlur="discountPerFind('+row_cnt+')"  /></td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_total[]" id="quotation_entry_product_detail_total'+row_cnt+'" readonly=""  /></td></tr>';
				
				
			}else{ 
			
			apnd	+= '<tr><td>'+product_name+'<input type="hidden"  name="quotation_entry_product_detail_product_id[]" id="quotation_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="quotation_entry_product_detail_product_type[]" id="quotation_entry_product_detail_product_type"  value="'+product_type+'" /></td>';
			
			apnd	+= '<td>'+product_uom_name+'<input type="hidden"  name="quotation_entry_product_detail_product_uom_id[]" id="quotation_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="quotation_entry_product_detail_qty[]" id="quotation_entry_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="quotation_entry_product_detail_rate[]" id="quotation_entry_product_detail_rate'+row_cnt+'" onBlur="AccdiscountPerFind('+row_cnt+')"   /></td><td><input class="form-control" type="text"  name="quotation_entry_product_detail_total[]" id="quotation_entry_product_detail_total'+row_cnt+'"   /></td></tr>';
			
			}
			
			$("#product_detail_display").append(apnd);	

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
function AccdiscountPerFind(id)

{	

	var product_qty 		= document.getElementById('quotation_entry_product_detail_qty'+id).value;
	var product_price		= document.getElementById('quotation_entry_product_detail_rate'+id).value;
	if(product_qty == '' || product_qty == ' ') {
		product_qty = 0;
	}
	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));
	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));
	var product_amount  	= parseFloat(product_qty) * parseFloat(product_price);
	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(2));
	document.getElementById('quotation_entry_product_detail_total'+id).value =  product_amount;

	totalAmount();

}
function discountPerFind(id)

{	

	var product_qty 		= document.getElementById('quotation_entry_product_detail_tot_length'+id).value;
	var product_price		= document.getElementById('quotation_entry_product_detail_rate'+id).value;
	if(product_qty == '' || product_qty == ' ') {
		product_qty = 0;
	}
	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));
	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));
	var product_amount  	= parseFloat(product_qty) * parseFloat(product_price);
	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(2));
	document.getElementById('quotation_entry_product_detail_total'+id).value =  product_amount;

	totalAmount();

}

function totalAmount()

{

	var table 				= document.getElementById('product_detail');

	var total_row     		= parseFloat(table.rows.length)-7;			

	var sum_val = 0;

	for(var i=1; i<=parseInt(total_row); i++) {

		var total_detail_amt 	= document.getElementById('quotation_entry_product_detail_total'+i).value;

		var toal_amount 	 	= (isNaN(total_detail_amt)?0.00:parseFloat(total_detail_amt));

		sum_val 				= parseFloat(sum_val)+parseFloat(toal_amount);

	}

	var gross_amount			= (isNaN(sum_val)?0.00:parseFloat(sum_val).toFixed(2));

	document.getElementById('quotation_entry_gross_amount').value 	= gross_amount;

	

	var transport_amount		= document.getElementById('quotation_entry_transport_amount').value;

	var tax_per					= document.getElementById('quotation_entry_tax_per').value;

	var advance_amount			= document.getElementById('quotation_entry_advance_amount').value;



	var transport_amount 		= (isNaN(transport_amount)? 0.00 : parseFloat(transport_amount));

	var tax_per 				= (isNaN(tax_per)? 0.00 : parseFloat(tax_per));

	var advance_amount 			= (isNaN(advance_amount)? 0.00 : parseFloat(advance_amount));

	var tax_amount				= (tax_per*gross_amount)/100;

	var tax_amount 				= (isNaN(tax_amount)? 0.00 : parseFloat(tax_amount));

	 document.getElementById('quotation_entry_tax_amount').value	= tax_amount;

	var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount)+parseFloat(tax_amount);

	var net_amount				= parseFloat(net_amount)-parseFloat(advance_amount);

	var net_amount 				= (isNaN(net_amount)? 0.00 : parseFloat(net_amount));

	document.getElementById('quotation_entry_net_amount').value 	= net_amount;

}

function GetTotalLength(id){
	var product_qty 	= document.getElementById('quotation_entry_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('quotation_entry_product_detail_s_width_inches'+id).value;
	var sales_length_f 	= document.getElementById('quotation_entry_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('quotation_entry_product_detail_sl_feet_in'+id).value;
	var sales_length	= Number(sales_length_f)+Number(sales_length_i);
	var width 			= document.getElementById('quotation_entry_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('quotation_entry_product_detail_tot_length'+id).value = total_length_val.toFixed(2);
	
}



function GetLcalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('quotation_entry_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('quotation_entry_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('quotation_entry_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		//var calc_amount 	= document.getElementById('quotation_entry_product_detail_length_meter'+id).value;	

	}
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			
			if(calculation_id==1){
				document.getElementById('quotation_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('quotation_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
			}

			/*document.getElementById('quotation_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('quotation_entry_product_detail_sl_feet_in'+id).value 		= data_t[1];

			document.getElementById('quotation_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];*/

			//document.getElementById('quotation_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('quotation_entry_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('quotation_entry_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('quotation_entry_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('quotation_entry_product_detail_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('quotation_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('quotation_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('quotation_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('quotation_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('quotation_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('quotation_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('quotation_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('quotation_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
			}
		}

	);

}
 function GetWeightClc(type,id){
		var product_id		=$("#quotation_entry_product_detail_mas_product_id"+id).val();
		var prd_thick		=$("#quotation_entry_product_detail_product_thick"+id).val();
		if(type==1){
			var prd_qty_val		=$("#quotation_entry_product_detail_s_weight_inches"+id).val();
 		}else{
			var prd_qty_val		=$("#quotation_entry_product_detail_s_weight_mm"+id).val();
		}
		
		$.get(
			"../ajax-file/product-weight-calc.php",
			{product_id:product_id,prd_thick:prd_thick,prd_type:type,prd_qty_val:prd_qty_val},
			function(data) {
				if(type==1){
					$("#quotation_entry_product_detail_s_weight_mm"+id).val(data);
				}else{
					$("#quotation_entry_product_detail_s_weight_inches"+id).val(data);
				}
			}
		);
	
	
 }
