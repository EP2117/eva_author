checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('credit_note_entry_list_form').elements.length; i++) {

	  document.getElementById('credit_note_entry_list_form').elements[i].checked = checked;

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

function get_stock(id){ 
	
	var po_qty=Number($("#credit_note_entry_product_detail_qty"+id).val());
	var product_qty=Number($("#credit_note_entry_product_detail_max_qty"+id).val());
	if(parseFloat(po_qty)>parseFloat(product_qty)){
	$("#credit_note_entry_product_detail_qty"+id).val('');
	}
}


function GetSodetail(){

	var branch_id 		= document.getElementById('credit_note_entry_branch_id').value;

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
			var invoice_entry_type_id 	= document.getElementById('invoice_entry_type_id'+ord_id).value;
			var cn_cnt 					= document.getElementById('invoice_entry_cn_cnt'+ord_id).value;
			var table 				= document.getElementById('so_detail');
			var credit_note_entry_no		= invoice_entry_no+"-"+cn_cnt;
			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+invoice_entry_no+"</td><td>"+invoice_entry_date+"<input type='hidden'  name='credit_note_entry_invoice_entry_id' id='credit_note_entry_invoice_entry_id' value='"+invoice_entry_id+"'  class='dc_id'  /><input type='hidden'  name='credit_note_entry_type_id' id='credit_note_entry_type_id' value='"+invoice_entry_type_id+"' />  </td></tr>");
				$("#credit_note_entry_no").val(credit_note_entry_no);
			getTableHeader(invoice_entry_type_id);

		}

	}

}

function GetDetail(){

	var invoice_entry_id 	= document.getElementById('credit_note_entry_invoice_entry_id').value;
	var production_type 	= document.getElementById('credit_note_entry_type').value;
	var m_id 			= getQuotationId();

	$.get('product-detail.php',

		{invoice_entry_id:invoice_entry_id,m_id:m_id,production_type:production_type},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){
	var apnd = '';
	var table 					= document.getElementById('product_detail');
	
	var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
	var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
	var row_cnt_as     				= $('#product_detail_as >tbody >tr').length;	
	var row_cnt						= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as)+1;
	
	var x						= document.getElementsByName("invoice_entry_product_detail_id[]");
	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) { 
			var ord_id 					=  x[i].value;
			var detail_id 				= ord_id;

			var product_id 					= document.getElementById('product_id'+ord_id).value;
			var product_name 				= document.getElementById('product_name'+ord_id).value;
			var product_code 				= document.getElementById('product_code'+ord_id).value;
			var product_uom 				= document.getElementById('product_uom'+ord_id).value;
			var product_type 				= document.getElementById('product_type'+ord_id).value;
			var product_colour_name			= document.getElementById('product_colour_name'+ord_id).value;
			var product_color_id			= document.getElementById('product_color_id'+ord_id).value;
			var product_thick_ness			= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
			var product_width_inches		= document.getElementById('product_width_inches'+ord_id).value;
			var product_brand_name			= document.getElementById('product_brand_name'+ord_id).value;
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
			var product_total_amt			= document.getElementById('product_total_amt'+ord_id).value;
			var product_mother_child_type	= document.getElementById('product_mother_child_type'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			
			var product_is_opp				= document.getElementById('product_is_opp'+ord_id).value;;
			var product_opp_feet_per_qty 	= document.getElementById('product_opp_feet_per_qty'+ord_id).value;
			var product_sale_by 			= document.getElementById('product_sale_by'+ord_id).value;
			var product_sale_feet 			= document.getElementById('product_sale_feet'+ord_id).value;
			
			var apnd						= '';
			//alert(t_id);
			if(t_id == 1){
			 var total_length			= ((product_s_width_inches * product_sl_feet ) / product_width_inches)*product_qty;
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="credit_note_entry_product_detail_product_id[]" id="credit_note_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="credit_note_entry_product_is_opp[]" id="credit_note_entry_product_is_opp'+row_cnt+'" value="0" /><input type="hidden"  name="credit_note_entry_product_opp_feet_per_qty[]" id="credit_note_entry_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input type="hidden"  name="credit_note_entry_product_detail_sale_by[]" id="credit_note_entry_product_detail_sale_by'+row_cnt+'" value="" /><input type="hidden"  name="credit_note_entry_product_detail_mother_child_type[]" id="credit_note_entry_product_detail_mother_child_type" value="'+product_mother_child_type+'" /><input type="hidden"  name="credit_note_entry_product_detail_product_type[]" id="credit_note_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="credit_note_entry_product_detail_invoice_detail_id[]" id="credit_note_entry_product_detail_invoice_detail_id" value="'+detail_id+'" /><input type="hidden"  name="credit_note_entry_product_detail_entry_type[]" id="credit_note_entry_product_detail_entry_type" value="'+t_id+'" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input class="form-control" type="hidden"  name="credit_note_entry_product_detail_product_color_id[]" id="credit_note_entry_product_detail_product_color_id'+row_cnt+'" value="'+product_color_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="credit_note_entry_product_detail_product_thick[]" id="credit_note_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_width_inches[]" id="credit_note_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_inches+'" readonly /></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_width_mm[]" id="credit_note_entry_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'" readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_width_inches[]" id="credit_note_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" readonly/></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_width_mm[]" id="credit_note_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" readonly/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_sl_feet[]" id="credit_note_entry_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'" readonly /></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_sl_feet_in[]" id="credit_note_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'" readonly /></td><td><input class="form-control" type="text"  name="credit_note_entry_product_detail_sl_feet_mm[]" id="credit_note_entry_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'" readonly /></td><td><input class="form-control" type="text"  name="credit_note_entry_product_detail_sl_feet_met[]" id="credit_note_entry_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'" readonly /><input type="hidden" name="credit_note_entry_product_detail_s_weight_inches[]" id="credit_note_entry_product_detail_s_weight_inches'+row_cnt+'"    value=""   /><input type="hidden"  name="credit_note_entry_product_detail_s_weight_mm[]" id="credit_note_entry_product_detail_s_weight_mm'+row_cnt+'"  value=""   /></td>';
			

			apnd	+= '<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_qty[]" id="credit_note_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'" onBlur="GetTotalLength('+row_cnt+'),discountPerFind('+row_cnt+')" onKeyUp="get_stock('+row_cnt+')"  /><input class="form-control" type="hidden"  name="credit_note_entry_product_detail_max_qty[]" id="credit_note_entry_product_detail_max_qty'+row_cnt+'"  value="'+product_qty+'" /></td><td><input class="form-control" type="text"  name="credit_note_entry_product_detail_tot_length[]" id="credit_note_entry_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"  readonly /><input  type="hidden"  name="credit_note_entry_product_detail_inv_tot_length[]" id="credit_note_entry_product_detail_inv_tot_length'+row_cnt+'" readonly value="'+total_length+'"   /></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_rate[]" id="credit_note_entry_product_detail_rate'+row_cnt+'"  value="'+product_rate+'"  readonly /></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_total[]" id="credit_note_entry_product_detail_total'+row_cnt+'"  value="'+product_total_amt+'"  readonly  /></td> </tr>';
			
			$("#product_detail_rls_display").append(apnd);	
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="credit_note_entry_product_detail_product_id[]" id="credit_note_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="credit_note_entry_product_is_opp[]" id="credit_note_entry_product_is_opp'+row_cnt+'" value="0" /><input type="hidden"  name="credit_note_entry_product_opp_feet_per_qty[]" id="credit_note_entry_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input type="hidden"  name="credit_note_entry_product_detail_sale_by[]" id="credit_note_entry_product_detail_sale_by'+row_cnt+'" value="" /><input type="hidden"  name="credit_note_entry_product_detail_product_type[]" id="credit_note_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="credit_note_entry_product_detail_invoice_detail_id[]" id="credit_note_entry_product_detail_invoice_detail_id" value="'+detail_id+'" /><input type="hidden"  name="credit_note_entry_product_detail_entry_type[]" id="credit_note_entry_product_detail_entry_type" value="'+t_id+'" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input class="form-control" type="hidden"  name="credit_note_entry_product_detail_product_color_id[]" id="credit_note_entry_product_detail_product_color_id'+row_cnt+'" value="'+product_color_id+'"   /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input class="form-control" type="hidden"  name="credit_note_entry_product_detail_product_thick[]" id="credit_note_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"  readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_width_inches[]" id="credit_note_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'" readonly /></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_width_mm[]" id="credit_note_entry_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'" readonly /></td>';
			apnd	+= '<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_width_inches[]" id="credit_note_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" readonly/></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_width_mm[]" id="credit_note_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" readonly /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_weight_inches[]" id="credit_note_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetWeightClc(1,'+row_cnt+'),RawdiscountPerFind('+row_cnt+')"   value="'+product_s_weight_inches+'"   /></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_s_weight_mm[]" id="credit_note_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetWeightClc(1,'+row_cnt+')"  value="'+product_s_weight_mm+'"   /><input type="hidden"  name="credit_note_entry_product_detail_qty[]" id="credit_note_entry_product_detail_qty'+row_cnt+'"  value="" /></td>';
			
			apnd	+= ' <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_rate[]" id="credit_note_entry_product_detail_rate'+row_cnt+'"  value="'+product_rate+'"  onBlur="RawdiscountPerFind('+row_cnt+')"    /></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_total[]" id="credit_note_entry_product_detail_total'+row_cnt+'"  value="'+product_total_amt+'"   /></td></tr>';
			//alert(apnd);
			$("#product_detail_rws_display").append(apnd);	
				
			}else{ 
			
			apnd	+= '<tr><td>'+product_name+'<input type="hidden"  name="credit_note_entry_product_detail_product_id[]" id="credit_note_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="credit_note_entry_product_detail_product_type[]" id="credit_note_entry_product_detail_product_type" value="'+product_type+'"/><input type="hidden"  name="credit_note_entry_product_detail_invoice_detail_id[]" id="credit_note_entry_product_detail_invoice_detail_id" value="'+detail_id+'" /><input type="hidden"  name="credit_note_entry_product_detail_entry_type[]" id="credit_note_entry_product_detail_entry_type" value="'+t_id+'" /></td>';
			
			apnd	+= '<td>'+product_uom+'</td>';
			
			/* apnd	+= '<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_qty[]" id="credit_note_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'" onBlur="GetTotalLength('+row_cnt+'),discountPerFind('+row_cnt+')" onKeyUp="get_stock('+row_cnt+')"  /><input class="form-control" type="hidden"  name="credit_note_entry_product_detail_max_qty[]" id="credit_note_entry_product_detail_max_qty'+row_cnt+'"  value="'+product_qty+'" /></td>'; */
			
			if(product_sale_by == 'feet') {
				apnd	+= '<td><input type="hidden"  name="credit_note_entry_product_is_opp[]" id="credit_note_entry_product_is_opp'+row_cnt+'" value="'+product_is_opp+'" /><input type="hidden"  name="credit_note_entry_product_opp_feet_per_qty[]" id="credit_note_entry_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input class="form-control" type="text"  name="credit_note_entry_product_detail_sale_by[]" id="credit_note_entry_product_detail_sale_by'+row_cnt+'"  value="FEET" style="width:20%;display:inline-block" readonly  />&nbsp;&nbsp;&nbsp;<input class="form-control" type="text"  name="credit_note_entry_product_detail_qty[]" id="credit_note_entry_product_detail_qty'+row_cnt+'"  value="'+product_sale_feet+'" onBlur="GetTotalLength('+row_cnt+'),discountPerFind('+row_cnt+')" onKeyUp="get_stock('+row_cnt+')" style="width:60%;display:inline-block" /><input class="form-control" type="hidden"  name="credit_note_entry_product_detail_max_qty[]" id="credit_note_entry_product_detail_max_qty'+row_cnt+'"  value="'+product_sale_feet+'" /></td>';
			} else {
				apnd	+= '<td><input type="hidden"  name="credit_note_entry_product_is_opp[]" id="credit_note_entry_product_is_opp'+row_cnt+'" value="'+product_is_opp+'" /><input type="hidden"  name="credit_note_entry_product_opp_feet_per_qty[]" id="credit_note_entry_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input class="form-control" type="text"  name="credit_note_entry_product_detail_sale_by[]" id="credit_note_entry_product_detail_sale_by'+row_cnt+'"  value="QTY" style="width:20%;display:inline-block" readonly  />&nbsp;&nbsp;&nbsp;<input class="form-control" type="text"  name="credit_note_entry_product_detail_qty[]" id="credit_note_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'" onBlur="GetTotalLength('+row_cnt+'),discountPerFind('+row_cnt+')" onKeyUp="get_stock('+row_cnt+')" style="width:60%;display:inline-block" /><input class="form-control" type="hidden"  name="credit_note_entry_product_detail_max_qty[]" id="credit_note_entry_product_detail_max_qty'+row_cnt+'"  value="'+product_qty+'" /></td>';
			}
			
			apnd  	+= '<td><input class="form-control" type="text"  name="credit_note_entry_product_detail_rate[]" id="credit_note_entry_product_detail_rate'+row_cnt+'"  value="'+product_rate+'"    /></td></td> <td><input class="form-control" type="text"  name="credit_note_entry_product_detail_total[]" id="credit_note_entry_product_detail_total'+row_cnt+'"  value="'+product_total_amt+'"    /></td></tr>';
			
			$("#product_detail_as_display").append(apnd);	
			}
			
			

			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}

}
function RawdiscountPerFind(id)

{	

	var product_qty 		= document.getElementById('credit_note_entry_product_detail_s_weight_inches'+id).value;
	var product_price		= document.getElementById('credit_note_entry_product_detail_rate'+id).value;
	if(product_qty == '' || product_qty == ' ') {
		product_qty = 0;
	}
	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));
	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));
	var product_amount  	= parseFloat(product_qty) * parseFloat(product_price);
	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(2));
	document.getElementById('credit_note_entry_product_detail_total'+id).value =  product_amount;

	totalAmount();

}
function AccdiscountPerFind(id)

{	

	var product_qty 		= document.getElementById('credit_note_entry_product_detail_qty'+id).value;
	var product_price		= document.getElementById('credit_note_entry_product_detail_rate'+id).value;
	if(product_qty == '' || product_qty == ' ') {
		product_qty = 0;
	}
	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));
	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));
	var product_amount  	= parseFloat(product_qty) * parseFloat(product_price);
	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(2));
	document.getElementById('credit_note_entry_product_detail_total'+id).value =  product_amount;

	totalAmount();

}
function discountPerFind(id)

{
	if(document.getElementById('credit_note_entry_product_detail_tot_length'+id)) {
		var product_qty 		= document.getElementById('credit_note_entry_product_detail_tot_length'+id).value;
	} else {
			if(document.getElementById('credit_note_entry_product_detail_qty'+id)) {
				var product_qty 		= document.getElementById('credit_note_entry_product_detail_qty'+id).value;
			} else {
				var product_qty  = 0;
			}
	}
	
	if(document.getElementById('credit_note_entry_product_detail_rate'+id)) {
		var product_price		= document.getElementById('credit_note_entry_product_detail_rate'+id).value;
	} else {
		var product_price = 0;
	}
	if(product_qty == '' || product_qty == ' ') {
		product_qty = 0;
	}
	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));
	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));
	var product_amount  	= parseFloat(product_qty) * parseFloat(product_price);
	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(2));
	document.getElementById('credit_note_entry_product_detail_total'+id).value =  product_amount;

	totalAmount();

}
  function GetWeightClc(type,id){
	var prod_ton =$('#credit_note_entry_product_detail_s_weight_inches'+id).val();
	var prod_kg =$('#credit_note_entry_product_detail_s_weight_mm'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#credit_note_entry_product_detail_s_weight_mm'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#credit_note_entry_product_detail_s_weight_inches'+id).val(prod_val);
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
function get_amt_note(id){

	qty1=Number($('#credit_note_entry_product_detail_qty'+id).val());
	rate1=Number($('#credit_note_entry_product_detail_rate'+id).val());
	
	total=qty1*rate1;
	
	$('#credit_note_entry_product_detail_total'+id).val(total.toFixed(2));
	
}
function GetTotalLength(id){ 
	var product_qty 	= document.getElementById('credit_note_entry_product_detail_qty'+id).value;
	if(document.getElementById('credit_note_entry_product_detail_s_width_inches'+id)) {
		var sales_width 	= document.getElementById('credit_note_entry_product_detail_s_width_inches'+id).value;
	} else {
		var sales_width = 0.00;
	}
	if(document.getElementById('credit_note_entry_product_detail_sl_feet'+id)) {
		var sales_length_f 	= document.getElementById('credit_note_entry_product_detail_sl_feet'+id).value; 
	} else {
		var sales_length_f = 0.00;
	}
	if(document.getElementById('credit_note_entry_product_detail_sl_feet_in'+id)) {
		var sales_length_i 	= document.getElementById('credit_note_entry_product_detail_sl_feet_in'+id).value;
	} else {
		var sales_length_i = 0.00;
	}
	var sales_length	= Number(sales_length_f)+(Number(sales_length_i)/12);
	if(document.getElementById('credit_note_entry_product_detail_width_inches'+id)) {
		var width 			= document.getElementById('credit_note_entry_product_detail_width_inches'+id).value;
	} else {
		var width = 0.00;
	}
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));//alert(total_length_val);
	
	if(document.getElementById('credit_note_entry_product_detail_tot_length'+id)) {
		document.getElementById('credit_note_entry_product_detail_tot_length'+id).value = (sales_length*product_qty).toFixed(2);
	}
	
	if(document.getElementById('credit_note_entry_product_detail_total'+id)) {
		document.getElementById('credit_note_entry_product_detail_total'+id).value = (document.getElementById('credit_note_entry_product_detail_rate'+id).value*product_qty).toFixed(2);
	}
	//document.getElementById('credit_note_entry_product_detail_inv_tot_length'+id).value = total_length_val.toFixed(2);
	
}

function totalAmount() {
	return true;
}



function GetLcalFeet(calculation_id,id){
	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('credit_note_entry_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('credit_note_entry_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('credit_note_entry_product_detail_sl_feet_mm'+id).value;	

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
				document.getElementById('credit_note_entry_product_detail_sl_feet_mm'+id).value 		= data_t[2];
			}
			else if(calculation_id==3){
				document.getElementById('credit_note_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);
			}

			
		}

	);

}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('credit_note_entry_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('credit_note_entry_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('credit_note_entry_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('credit_note_entry_product_detail_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('credit_note_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('credit_note_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('credit_note_entry_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('credit_note_entry_product_detail_s_width_mm'+id).value 			= data_t[2];
		}

	);

}

function GetcustomerDetail(){

	var cus_id 	= document.getElementById('credit_note_entry_customer_id').value;	

	$.get('../ajax-file/customer-detail.php',

		{cus_id:cus_id},

		function(data) { 

			var s_data	= data.split('@');

			document.getElementById('credit_note_entry_address').value 		= s_data[6];
			//document.getElementById('credit_note_entry_contact_no').value 	= s_data[7];

		}

	);	

}

