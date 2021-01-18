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
	var customer_id 		= document.getElementById('production_order_customer_id').value;
	var type_id1 		= document.getElementsByName('production_order_type_id[]');
	var count      = type_id1.length;

	for(i=1;i<=count;i++){
			
		if(document.getElementById('production_order_type_id'+i).checked == true){
		var type_id=document.getElementById('production_order_type_id'+i).value;
	
		}
	
	}
	$.get('sales-detail.php',

		{branch_id:branch_id,type_id:type_id,customer_id:customer_id},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}


function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;

			var invoice_entry_id 		= ord_id;
			var inv_id                  = 1;
			inv_id                      =inv_id + 1;

			var invoice_entry_no 		= document.getElementById('invoice_entry_no'+ord_id).value;

			var invoice_entry_date 		= document.getElementById('invoice_entry_date'+ord_id).value;
			var invoice_entry_type_id 	= document.getElementById('invoice_entry_type_id'+ord_id).value;
			var type_id 				= document.getElementById('type_id'+ord_id).value;
			var po_cnt 					= document.getElementById('invoice_entry_po_cnt'+ord_id).value;
			var table 					= document.getElementById('so_detail');
			//var production_no			= invoice_entry_no+"-"+po_cnt;
			var production_no			= invoice_entry_no;
			var row_cnt     		= parseFloat(table.rows.length)-1;	 			

				$( "#so_detail_display" ).append( 

				"<tr><td>"+invoice_entry_no+"</td><td>"+invoice_entry_date+"<input type='hidden'  name='production_order_invoice_entry_id' id='production_order_invoice_entry_id' value='"+invoice_entry_id+"'  class='dc_id'  /> </td></tr>");
				document.getElementById('production_order_no').value	= production_no;
				
				if(type_id==1){
					//$('#production_order_type_id1').show();
					$('#production_order_type_id2').hide();
					$('#production_order_type_id3').hide();
				}else if(type_id==2){
					$('#production_order_type_id1').hide();
					$('#production_order_type_id3').hide();
					
				}else if(type_id==4){
					$('#production_order_type_id1').hide();
					$('#production_order_type_id2').hide();
					
				}

		}

	}

}

function GetDetail(){

	var invoice_entry_id 	= document.getElementById('production_order_invoice_entry_id').value;//alert(invoice_entry_id);
	var production_type 	= document.getElementById('production_order_type').value;
	
	var type_id1 		= document.getElementsByName('production_order_type_id[]');
	
	var count      = type_id1.length;

	for(i=1;i<=count;i++){
		if(document.getElementById('production_order_type_id'+i).checked == true){
		var type_id=document.getElementById('production_order_type_id'+i).value;
		}
	}
	var m_id 			= getQuotationId();
	/*var inv_no          = 1;
	inv_no = inv_no +1;*/

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
			var product_width_inches		= parseFloat(document.getElementById('product_width_inches'+ord_id).value).toFixed(3);
			var product_brand_name		= document.getElementById('product_brand_name'+ord_id).value;
			var product_width_mm			= parseFloat(document.getElementById('product_width_mm'+ord_id).value).toFixed(0);

			var product_s_width_inches		= parseFloat(document.getElementById('product_s_width_inches'+ord_id).value).toFixed(3);
			var product_s_width_mm			= parseFloat(document.getElementById('product_s_width_mm'+ord_id).value).toFixed(0);
			var product_sl_feet				= parseFloat(document.getElementById('product_sl_feet'+ord_id).value).toFixed(2);

			var product_sl_feet_in			= parseFloat(document.getElementById('product_sl_feet_in'+ord_id).value).toFixed(3);

			var product_sl_feet_mm			= parseFloat(document.getElementById('product_sl_feet_mm'+ord_id).value).toFixed(0);
			var product_sl_feet_met			= parseFloat(document.getElementById('product_sl_feet_met'+ord_id).value).toFixed(3);
			
			var product_s_weight_met			= parseFloat(document.getElementById('product_s_weight_met'+ord_id).value).toFixed(3);

			var product_s_weight_inches		= parseFloat(document.getElementById('product_s_weight_inches'+ord_id).value).toFixed(3);
			var product_s_weight_mm			= parseFloat(document.getElementById('product_s_weight_mm'+ord_id).value).toFixed(0);
			var product_sale_length			= document.getElementById('product_sale_length'+ord_id).value;
			var product_tot_length			= parseFloat(document.getElementById('product_tot_length'+ord_id).value).toFixed(3);
			var product_rate				= parseFloat(document.getElementById('product_rate'+ord_id).value).toFixed(0);
			var product_qty					= parseFloat(document.getElementById('product_detail_qty'+ord_id).value).toFixed(0);
			var product_total_amt			= parseFloat(document.getElementById('product_total_amt'+ord_id).value).toFixed(0);
			var product_mother_child_type	= document.getElementById('product_mother_child_type'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			
			//alert(t_id);
			
			if(t_id == 1){
			 	var total_length			= ((product_s_width_inches * product_sl_feet ) / product_width_inches)*product_qty;
			apnd	+= '<tr><td><input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_order_product_detail_invoice_detail_id[]" id="production_order_product_detail_invoice_detail_id" value="'+detail_id+'" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_colour_id[]" id="production_order_product_detail_product_colour_id'+row_cnt+'" value="'+product_colour_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_inches+'"  readonly /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" readonly /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet[]" id="production_order_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  readonly /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_in[]" id="production_order_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'" readonly /></td><td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_mm[]" id="production_order_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'" readonly /><input class="form-control" type="hidden"  name="production_order_product_detail_sl_feet_met[]" id="production_order_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'"  /></td>';
			

			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_sale_length[]" id="production_order_product_detail_sale_length'+row_cnt+'"  value="'+product_sale_length+'" readonly /><td><input class="form-control" type="text"  name="production_order_product_detail_tot_length[]" id="production_order_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"   /><input  type="hidden"  name="production_order_product_detail_inv_tot_length[]" id="production_order_product_detail_inv_tot_length'+row_cnt+'" readonly value="'+total_length+'"   /></td><td><input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty'+row_cnt+'"  value="'+product_qty+'"    onBlur="GetTotalLength('+row_cnt+')" onKeyUp="get_stock('+row_cnt+')" readonly /><input class="form-control" type="hidden"  name="production_order_product_detail_max_qty[]" id="production_order_product_detail_max_qty'+row_cnt+'"  value="'+product_qty+'"    onBlur="GetTotalLength('+row_cnt+')"  /></td> </tr>';
			
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td><input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_order_product_detail_invoice_detail_id[]" id="production_order_product_detail_invoice_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_colour_id[]" id="production_order_product_detail_product_colour_id'+row_cnt+'" value="'+product_colour_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  readonly /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'" readonly /></td>';
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" readonly /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" readonly /></td>';
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_weight_inches[]" id="production_order_product_detail_s_weight_inches'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"   value="'+product_s_weight_inches+'" readonly /></td><td><input class="form-control" type="text"  name="production_order_product_detail_s_weight_mm[]" id="production_order_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetLcalc(3,'+row_cnt+')"   value="'+product_s_weight_mm+'" readonly /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_weight_met[]" id="production_order_product_detail_s_weight_met'+row_cnt+'"  onblur="GetLcalc(4,'+row_cnt+')"  value="'+product_s_weight_met+'" readonly /></td></tr>';	
				
				
			}else if(t_id == 3){
			
			apnd	+= '<tr><td><input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_order_product_detail_invoice_detail_id[]" id="production_order_product_detail_invoice_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_color_id[]" id="production_order_product_detail_product_color_id'+row_cnt+'" value="'+product_color_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="production_order_product_detail_product_thick[]" id="production_order_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_width_inches[]" id="production_order_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'" onBlur="GetTotalLength('+row_cnt+')" readonly /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_width_mm[]" id="production_order_product_detail_width_mm'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"  onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_s_width_inches[]" id="production_order_product_detail_s_width_inches'+row_cnt+'" onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" readonly /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_s_width_mm[]" id="production_order_product_detail_s_width_mm'+row_cnt+'"   onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet[]" id="production_order_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'" readonly /></td> <td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_in[]" id="production_order_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"   value="'+product_sl_feet_in+'" readonly /></td><td><input class="form-control" type="text"  name="production_order_product_detail_sl_feet_mm[]" id="production_order_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'" readonly /><input class="form-control" type="hidden"  name="production_order_product_detail_sl_feet_met[]" id="production_order_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'"  readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_order_product_detail_sale_length[]" id="production_order_product_detail_sale_length'+row_cnt+'"  value="'+product_sale_length+'" readonly /></td><td><input class="form-control" type="text"  name="production_order_product_detail_tot_length[]" id="production_order_product_detail_tot_length'+row_cnt+'"  value="'+product_tot_length+'" readonly /></td><td><input class="form-control" type="text"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty'+row_cnt+'" value="'+product_qty+'" onblur="get_stock('+row_cnt+')"  /><input class="form-control" type="hidden"  name="production_order_product_detail_max_qty[]" id="production_order_product_detail_max_qty'+row_cnt+'"  value="'+product_qty+'"    onBlur="GetTotalLength('+row_cnt+')"  readonly /></td></tr>';
				
				
			}else{ 
			
			apnd	+= '<tr><td><input type="hidden"  name="production_order_product_detail_mother_child_type[]" id="production_order_product_detail_mother_child_type" value="'+product_mother_child_type+'" />'+product_name+'<input type="hidden"  name="production_order_product_detail_product_id[]" id="production_order_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_order_product_detail_product_type[]" id="production_order_product_detail_product_type" value="'+product_type+'"/><input type="hidden"  name="production_order_product_detail_invoice_detail_id[]" id="production_order_product_detail_invoice_detail_id" value="'+detail_id+'" /></td>';
			
			apnd	+= '<td>'+product_uom+'</td>';
			
			apnd	+= '<td><input class="form-control" type="text" onblur="get_stock('+row_cnt+')"  name="production_order_product_detail_qty[]" id="production_order_product_detail_qty'+row_cnt+'" value="'+product_qty+'" readonly /></td></tr>';
			
			}
			
			

			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}
	$( "#product_detail_display" ).append(apnd);

}

function get_stock(id){ 
	
	var po_qty=Number($("#production_order_product_detail_qty"+id).val());
	var product_qty=Number($("#production_order_product_detail_max_qty"+id).val());
	if(parseFloat(po_qty)>parseFloat(product_qty)){
	$("#production_order_product_detail_qty"+id).val('');
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
	
	document.getElementById('production_order_product_detail_tot_length'+id).value = (sales_length*product_qty).toFixed(3);
	
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
				document.getElementById('production_order_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[2]).toFixed(0);
			}
			else if(calculation_id==3){
				document.getElementById('production_order_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]).toFixed(2);
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
			document.getElementById('production_order_product_detail_width_inches'+id).value 		= parseFloat(data_t[1]).toFixed(3);
			document.getElementById('production_order_product_detail_width_mm'+id).value 			= parseFloat(data_t[2]).toFixed(0);
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
			document.getElementById('production_order_product_detail_s_width_inches'+id).value 		= parseFloat(data_t[1]).toFixed(3);
			document.getElementById('production_order_product_detail_s_width_mm'+id).value 			= parseFloat(data_t[2]).toFixed(0);
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

function check_quantity(q_type,id)
{
	var qty 		= $("#production_order_product_detail_qty"+id).val();
	var po_qty 		= $("#production_order_product_detail_po_qty"+id).val();
	var non_po_qty 	= $("#production_order_product_detail_non_po_qty"+id).val();
	if(!(po_qty == '' || $.isNumeric(po_qty))){
		alert('Invalid Number!');
		setTimeout(function() {
			$("#production_order_product_detail_po_qty"+id).focus();
		}, 100);
		
		return false;
	} 
	if(!(non_po_qty == '' || $.isNumeric(non_po_qty))){
		alert('Invalid Number!');
		setTimeout(function() {
			$("#production_order_product_detail_non_po_qty"+id).focus();
		}, 100);
		
		return false;
	} 
	
	if(po_qty != '' && non_po_qty != '') {
		var total_qty = parseFloat(po_qty) + parseFloat(non_po_qty);
		if(total_qty > qty) { 
			alert('Invalid Quantity!');
			if(q_type == 'po') {
				$("#production_order_product_detail_po_qty"+id).val('');
				setTimeout(function() {
					$("#production_order_product_detail_po_qty"+id).focus();
				}, 100);
				
			} else {
				$("#production_order_product_detail_non_po_qty"+id).val('');
				setTimeout(function() {
					$("#production_order_product_detail_non_po_qty"+id).focus();
				}, 100);
				
			}
			return false;
		}
	} else if(po_qty != '') {
		if(parseFloat(po_qty) > parseFloat(qty)) { 
			alert('Invalid Quantity!');
			$("#production_order_product_detail_po_qty"+id).val('');
			setTimeout(function() {
				$("#production_order_product_detail_po_qty"+id).focus();
			}, 100);
			
			return false;
		}
	} else if(non_po_qty != '') {
		if(parseFloat(non_po_qty) > parseFloat(qty)) { 
			alert('Invalid Quantity!');
			$("#production_order_product_detail_non_po_qty"+id).val('');
			setTimeout(function() {
				$("#production_order_product_detail_non_po_qty"+id).focus();
			}, 100);
			
			return false;
		}
	} else {
	}
}

function reset_order(id)
{
	if (confirm('Are you sure to reset?')) {
		$("#reset"+id).text("Resetting...");
		$.get('order.php',
	
			{order_id:id},
	
			function(data) { 
				console.log(data);
				if(data.trim() == 'success') {
					$("#po"+id).text('New');
					$("#po"+id).removeClass('text-danger');
					$("#po"+id).addClass('text-primary');
					$("#reset"+id).hide();
					alert("Order has been successfully reset.");					
				}
			}
	
		);
	} else {
	}
}

