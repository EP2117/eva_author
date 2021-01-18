checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('gin_entry_list_form').elements.length; i++) {

	  document.getElementById('gin_entry_list_form').elements[i].checked = checked;

	}

}

checked = false;

function checkedAllraw () { 

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('raw_product_list_form').elements.length; i++) {

	  document.getElementById('raw_product_list_form').elements[i].checked = checked;

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
	}else{
		$('.rls').hide();
		$('.rws').hide();
		$('.ccs').hide();
		$('.as').show();
	}
	
}


function GetSodetail(){

	var branch_id 				= document.getElementById('gin_entry_branch_id').value;

	var gin_type 				=	 document.getElementById('gin_entry_type').value;
	var gin_entry_type_id 		= document.getElementById('gin_entry_type_id').value;
	
	var gin_entry_type 		= document.getElementById('gin_entry_type').value;
	
	$.get('sales-detail.php',

		{gin_type:gin_type,branch_id:branch_id,gin_entry_type_id:gin_entry_type_id,gin_entry_type:gin_entry_type},

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

			var production_order_type 		= document.getElementById('production_order_type'+ord_id).value;
			var production_order_type_id 	= document.getElementById('production_order_type_id'+ord_id).value;
			var customer_name 	= document.getElementById('customer_name'+ord_id).value;
			var table 				= document.getElementById('so_detail');

			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+production_order_no+"</td><td>"+production_order_date+"<input type='hidden'  name='gin_entry_production_order_id' id='gin_entry_production_order_id' value='"+production_order_id+"'  class='dc_id'  /> </td><td>"+production_order_type+"</td><td>"+customer_name+"</td> </tr>");

		}

	}

}

function GetDetail(){

	var production_order_id 	= document.getElementById('gin_entry_production_order_id').value;
	var gin_entry_type_id 		= document.getElementById('gin_entry_type_id').value;
	var m_id 					= getQuotationId();

	$.get('product-detail.php',

		{production_order_id:production_order_id,m_id:m_id,t_id:gin_entry_type_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){
	var x		= document.getElementsByName("production_order_product_detail_id[]");
	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) {

			var ord_id 	=  x[i].value; //alert(x[i].value);
			//ord_id = ord_id.slice(0, - 1);
			console.log(ord_id);
			var detail_id 					= ord_id.slice(0, - 1);
			var product_name 				= document.getElementById('product_name'+ord_id).value;
			
			var product_is_opp 				= document.getElementById('product_is_opp'+ord_id).value;
			var product_sale_by 			= document.getElementById('product_sale_by'+ord_id).value;
			var product_sale_feet 			= document.getElementById('product_sale_feet'+ord_id).value;
			
			var product_id 					= document.getElementById('product_id'+ord_id).value;
			var product_code 				= document.getElementById('product_code'+ord_id).value;
			var product_uom 				= document.getElementById('product_uom'+ord_id).value;
			var uom_id 						= document.getElementById('uom_id'+ord_id).value;
			var product_colour_name			= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
			var product_width_inches		= parseFloat(document.getElementById('product_width_inches'+ord_id).value).toFixed(3);
			var product_width_mm			= parseFloat(document.getElementById('product_width_mm'+ord_id).value).toFixed(3);
			var product_s_width_inches		= parseFloat(document.getElementById('product_s_width_inches'+ord_id).value).toFixed(3);
			var product_s_width_mm			= parseFloat(document.getElementById('product_s_width_mm'+ord_id).value).toFixed(3);
			var product_sl_feet				= parseFloat(document.getElementById('product_sl_feet'+ord_id).value).toFixed(2);
			var product_sl_feet_in			= parseFloat(document.getElementById('product_sl_feet_in'+ord_id).value).toFixed(2);
			var product_sl_feet_mm			= parseFloat(document.getElementById('product_sl_feet_mm'+ord_id).value).toFixed(2);
			var product_sl_feet_met			= parseFloat(document.getElementById('product_sl_feet_met'+ord_id).value).toFixed(2);
			var product_ext_feet			= parseFloat(document.getElementById('product_ext_feet'+ord_id).value).toFixed(2);
			var product_ext_feet_in			= parseFloat(document.getElementById('product_ext_feet_in'+ord_id).value).toFixed(2);
			var product_ext_feet_mm			= parseFloat(document.getElementById('product_ext_feet_mm'+ord_id).value).toFixed(2);
			var product_ext_feet_met		= parseFloat(document.getElementById('product_ext_feet_met'+ord_id).value).toFixed(2);
			
			var product_s_weight_inches		= parseFloat(document.getElementById('product_s_weight_inches'+ord_id).value).toFixed(3);
			var product_s_weight_mm			= parseFloat(document.getElementById('product_s_weight_mm'+ord_id).value).toFixed(3);
			var product_tot_feet			= parseFloat(document.getElementById('product_tot_feet'+ord_id).value).toFixed(2); //alert(product_tot_feet);
			var product_tot_meter			= parseFloat(document.getElementById('product_tot_meter'+ord_id).value).toFixed(2);
			var product_tot_length			= parseFloat(document.getElementById('product_tot_length'+ord_id).value).toFixed(2);
			var product_qty					= parseFloat(document.getElementById('product_detail_qty'+ord_id).value).toFixed(0);
			var product_sale_length			= document.getElementById('product_detail_sale_length'+ord_id).value;
			product_sale_length=product_sale_length.replace(/'/g,"&#39;").replace(/"/g,'&#34;');
			var product_type				= document.getElementById('product_type'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			var mother_child_type			= document.getElementById('mother_child_type'+ord_id).value; 
			var product_brand_id			= document.getElementById('product_brand_id'+ord_id).value;
			var row_cnt_rls     		= $('#product_detail_rls >tbody >tr').length;	
			var row_cnt_rws     		= $('#product_detail_rws >tbody >tr').length;	
			var row_cnt_as     			= $('#product_detail_as >tbody >tr').length;	
			var row_cnt					= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as);
			var apnd = '';
			
			//Added loop counter variable 'i' in some fixed id inside looping by AuthorsMM
			if(t_id == 1){
			 
			apnd	+= '<tr><td><input type="hidden"  name="gin_entry_product_detail_mother_child_type[]" id="gin_entry_product_detail_mother_child_type'+i+'" value="'+mother_child_type+'" />'+product_code+'</td><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="gin_entry_product_detail_product_id[]" id="gin_entry_product_detail_product_id'+i+'" value="'+product_id+'" /><input type="hidden"  name="gin_entry_product_detail_product_type[]" id="gin_entry_product_detail_product_type'+i+'" value="'+product_type+'" /><input type="hidden"  name="gin_entry_product_detail_po_detail_id[]" id="gin_entry_product_detail_po_detail_id'+i+'" value="'+detail_id+'" /> <input type="hidden"  name="gin_entry_product_detail_product_brand_id[]" id="gin_entry_product_detail_product_brand_id'+i+'" value="'+product_brand_id+'" />';
			
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="gin_entry_product_detail_product_color_id[]" id="gin_entry_product_detail_product_color_id'+i+'" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="gin_entry_product_detail_product_thick[]" id="gin_entry_product_detail_product_thick'+i+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gin_entry_product_detail_width_inches[]" id="gin_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_inches+'" size="300"  /></td> <td><input class="form-control" type="text"  name="gin_entry_product_detail_width_mm[]" id="gin_entry_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gin_entry_product_detail_s_width_inches[]" id="gin_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="gin_entry_product_detail_s_width_mm[]" id="gin_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gin_entry_product_detail_sl_feet[]" id="gin_entry_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="gin_entry_product_detail_sl_feet_in[]" id="gin_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'"  /></td><td><input class="form-control" type="text"  name="gin_entry_product_detail_sl_feet_mm[]" id="gin_entry_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="gin_entry_product_detail_sl_feet_met[]" id="gin_entry_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gin_entry_product_detail_ext_feet[]" id="gin_entry_product_detail_ext_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet+'"  /></td> <td><input class="form-control" type="text"  name="gin_entry_product_detail_ext_feet_in[]" id="gin_entry_product_detail_ext_feet_in'+row_cnt+'" onblur="GetLcalFeet(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_ext_feet_in+'"  /></td><td><input class="form-control" type="text"  name="gin_entry_product_detail_ext_feet_mm[]" id="gin_entry_product_detail_ext_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="gin_entry_product_detail_ext_feet_met[]" id="gin_entry_product_detail_ext_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet_met+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gin_entry_product_detail_sale_length[]" id="gin_entry_product_detail_sale_length'+row_cnt+'"  value="'+product_sale_length+'"   /></td><td><input class="form-control" type="text"  name="gin_entry_product_detail_qty[]" id="gin_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'"    readonly /></td><td><input class="form-control" type="text"  name="gin_entry_product_detail_tot_length[]" id="gin_entry_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"   /></td></tr>';
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td style="width:5%"><input type="hidden"  name="gin_entry_product_detail_mother_child_type[]" id="gin_entry_product_detail_mother_child_type'+i+'" value="'+mother_child_type+'" />'+product_brand_name+'</td><td style="width:5%">'+product_name+'<input type="hidden"  name="gin_entry_product_detail_product_id[]" id="gin_entry_product_detail_product_id'+i+'" value="'+product_id+'" /><input type="hidden"  name="gin_entry_product_detail_product_type[]" id="gin_entry_product_detail_product_type'+i+'" value="'+product_type+'" /><input type="hidden"  name="gin_entry_product_detail_po_detail_id[]" id="gin_entry_product_detail_po_detail_id'+i+'" value="'+detail_id+'" /> <input type="hidden"  name="gin_entry_product_detail_product_brand_id[]" id="gin_entry_product_detail_product_brand_id'+i+'" value="'+product_brand_id+'" /></td>';
			
			apnd	+= '<td style="width:5%">'+product_colour_name+'<input type="hidden"  name="gin_entry_product_detail_product_color_id[]" id="gin_entry_product_detail_product_color_id'+i+'" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="gin_entry_product_detail_product_thick[]" id="gin_entry_product_detail_product_thick'+i+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td style="width:10%"><input class="form-control" type="text"  name="gin_entry_product_detail_width_inches[]" id="gin_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td style="width:10%"><input class="form-control" type="text"  name="gin_entry_product_detail_width_mm[]" id="gin_entry_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gin_entry_product_detail_s_width_inches[]" id="gin_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="gin_entry_product_detail_s_width_mm[]" id="gin_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td style="width:10%"><input class="form-control" type="text"  name="gin_entry_product_detail_s_weight_inches[]" id="gin_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetLcalc(3,'+row_cnt+')"   value="'+product_s_weight_inches+'"   /></td> <td style="width:10%"><input class="form-control" type="text"  name="gin_entry_product_detail_s_weight_mm[]" id="gin_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetLcalc(4,'+row_cnt+')"  value="'+product_s_weight_mm+'"   /></td>';
			
			apnd	+= '<td style="width:10%"><input class="form-control" type="text"  name="gin_entry_product_detail_tot_feet[]" id="gin_entry_product_detail_tot_feet'+row_cnt+'" onBlur="GetTotalFeet(1,'+row_cnt+')" value="'+product_tot_feet+'" /></td> <td style="width:10%"><input class="form-control" type="text"  name="gin_entry_product_detail_tot_meter[]" id="gin_entry_product_detail_tot_meter'+row_cnt+'"  onBlur="GetTotalFeet(4,'+row_cnt+')"value="'+product_tot_meter+'" /></td></tr>';
				
			}else {
			apnd	+= '<tr><td><input type="hidden"  name="gin_entry_product_detail_mother_child_type[]" id="gin_entry_product_detail_mother_child_type'+i+'" value="'+mother_child_type+'" />'+product_code+'</td><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="gin_entry_product_detail_product_id[]" id="gin_entry_product_detail_product_id'+i+'" value="'+product_id+'" /><input type="hidden"  name="gin_entry_product_detail_product_type[]" id="gin_entry_product_detail_product_type'+i+'" value="'+product_type+'" /><input type="hidden"  name="gin_entry_product_detail_po_detail_id[]" id="gin_entry_product_detail_po_detail_id'+i+'" value="'+detail_id+'" /> <input type="hidden"  name="gin_entry_product_detail_product_brand_id[]" id="gin_entry_product_detail_product_brand_id'+i+'" value="'+product_brand_id+'" />';
			
			apnd	+= '<td style="width:30%">'+product_uom+'<input type="hidden"  name="gin_entry_product_detail_product_uom_id[]" id="gin_entry_product_detail_product_uom_id'+row_cnt+'" value="'+uom_id+'"   /><input type="hidden"  name="gin_entry_product_detail_product_color_id[]" id="gin_entry_product_detail_product_color_id'+i+'" value="'+product_colour_id+'" /><input type="hidden"  name="gin_entry_product_detail_product_thick[]" id="gin_entry_product_detail_product_thick'+i+'" value="'+product_thick_ness_id+'"   /></td>';
			
			if(product_is_opp == 1) {
			apnd += '<td><select  name="gin_entry_product_detail_sale_by[]" id="gin_entry_product_detail_sale_by'+row_cnt+'" class="form-control" style="width:30%;display:inline-block" readonly >';
				if(product_sale_by == 'qty') {
					apnd += '<option value="qty" selected>QTY</option><option value="feet" >FEET</option></select>&nbsp;&nbsp;&nbsp;<input class="form-control" style="display:inline-block;width:60%" type="text"  name="gin_entry_product_detail_qty[]" id="gin_entry_product_detail_qty'+row_cnt+'" value="'+product_qty+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  readonly />';
				} else {
					apnd += '<option value="qty">QTY</option><option value="feet" selected >FEET</option></select>&nbsp;&nbsp;&nbsp;<input class="form-control" style="display:inline-block;width:60%" type="text"  name="gin_entry_product_detail_qty[]" id="gin_entry_product_detail_qty'+row_cnt+'" value="'+product_qty+'" onBlur="AccdiscountPerFind('+row_cnt+')"   readonly />';
				}
			}
			else {
				apnd += '<td><select  name="gin_entry_product_detail_sale_by[]" id="gin_entry_product_detail_sale_by'+row_cnt+'" class="form-control" style="width:30%;display:inline-block" readonly ><option value="qty">QTY</option></select>&nbsp;&nbsp;&nbsp;<input class="form-control" style="display:inline-block;width:60%" type="text"  name="gin_entry_product_detail_qty[]" id="gin_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'" onBlur="AccdiscountPerFind('+row_cnt+')"  readonly />';
			}
			apnd += '</td></tr>';
			
			/*apnd	+= '<td style="width:40%"><input class="form-control" type="text"  name="gin_entry_product_detail_qty[]" id="gin_entry_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  value="'+product_qty+'"  /></td></tr>';*/
				
			}
			//discountPerFind(row_cnt);
			//alert(apnd):
		
		
		$("#product_detail_display" ).append(apnd);
		//GetLcalFeet(1,row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}

}
function GetTotalLength(id){
	
	var product_qty 	= document.getElementById('gin_entry_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('gin_entry_product_detail_s_width_inches'+id).value;
	
	var sales_length_f 	= document.getElementById('gin_entry_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('gin_entry_product_detail_sl_feet_in'+id).value;
	var sales_length_ef 	= document.getElementById('gin_entry_product_detail_ext_feet'+id).value;
	var sales_length_ei 	= document.getElementById('gin_entry_product_detail_ext_feet_in'+id).value;
	
	//var sales_length_ef 	= document.getElementById('production_order_product_detail_ext_feet'+id).value;
	//var sales_length_ei 	= document.getElementById('production_order_product_detail_ext_feet_in'+id).value;
	var sales_length	= Number(sales_length_f)+Number(sales_length_i)+Number(sales_length_ef)+Number(sales_length_ei);
	var width 			= document.getElementById('gin_entry_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('gin_entry_product_detail_tot_length'+id).value = (sales_length*product_qty).toFixed(2);
	
	
}



function GetLcalFeet(calculation_id,id){
	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('gin_entry_product_detail_sl_feet'+id).value;	
		var calc_amount_in 	= document.getElementById('gin_entry_product_detail_sl_feet_in'+id).value;
		var calc_amount		= Number(calc_amount_feet)+Number(calc_amount_in);
	}
	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('gin_entry_product_detail_sl_feet_mm'+id).value;	

	}

	
	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			
			if(calculation_id==1){
				document.getElementById('gin_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[2]).toFixed(2);
			}
			else if(calculation_id==3){
				document.getElementById('gin_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]).toFixed(2);
			}
			document.getElementById('gin_entry_product_detail_sl_feet_met'+id).value 		=  parseFloat(data_t[3]).toFixed(2);

		}

	);
}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('gin_entry_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('gin_entry_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('gin_entry_product_detail_width_inches'+id).value 		= parseFloat(data_t[1]).toFixed(3);
			document.getElementById('gin_entry_product_detail_width_mm'+id).value 			= parseFloat(data_t[2]).toFixed(3);
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('gin_entry_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('gin_entry_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('gin_entry_product_detail_s_width_inches'+id).value 		= parseFloat(data_t[1]).toFixed(3);
			document.getElementById('gin_entry_product_detail_s_width_mm'+id).value 			= parseFloat(data_t[2]).toFixed(3);
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
function getProductId(){
	var m_id = '';
	var x = $('.sp_id').map(function() { return this.value; }).get();
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


function GetRawDetail(){

	var m_id 			= getProductId();
	var rp_id 			= getRawProductId();
	var product_id 	= "";
	var product_color_id = "";
	var product_brand_id = "";
	var product_thick = "";
	var gin_entry_type_id = "";
	var godown_id = "";
	for(var i=0; i<document.getElementsByName('gin_entry_product_detail_product_id[]').length; i++) {
		id = "gin_entry_product_detail_product_id"+i;
		if (product_id == '') {
			product_id = '"'+$("#"+id).val()+'"';
		} else {
			product_id = product_id + ',"'+$("#"+id).val()+'"';
		}
	}
	//var product_id 		= document.getElementById('gin_entry_product_detail_product_id').value; 
	
	for(var i=0; i<document.getElementsByName('gin_entry_product_detail_product_color_id[]').length; i++) {
		id = "gin_entry_product_detail_product_color_id"+i;
		if (product_color_id == '') {
			product_color_id = '"'+$("#"+id).val()+'"';
		} else {
			product_color_id = product_color_id + ',"'+$("#"+id).val()+'"';
		}
	}	
	//var product_color_id 	= document.getElementById('gin_entry_product_detail_product_color_id').value;
	
	for(var i=0; i<document.getElementsByName('gin_entry_product_detail_product_brand_id[]').length; i++) {
		id = "gin_entry_product_detail_product_brand_id"+i;
		if (product_brand_id == '') {
			product_brand_id = '"'+$("#"+id).val()+'"';
		} else {
			product_brand_id = product_brand_id + ',"'+$("#"+id).val()+'"';
		}
	}
	//var product_brand_id 	= document.getElementById('gin_entry_product_detail_product_brand_id').value;
	
	for(var i=0; i<document.getElementsByName('gin_entry_product_detail_product_thick[]').length; i++) {
		id = "gin_entry_product_detail_product_thick"+i;
		if (product_thick == '') {
			product_thick = '"'+$("#"+id).val()+'"';
		} else {
			product_thick = product_thick + ',"'+$("#"+id).val()+'"';
		}
	}
	//alert(product_thick);
	//var product_thick 		= document.getElementById('gin_entry_product_detail_product_thick0').value;
	
	var gin_entry_type_id 	= document.getElementById('gin_entry_type_id').value;
	var godown_id       	= document.getElementById('gin_entry_from_godown_id').value;
	
	$.get('raw-product-detail.php',

		{m_id:m_id,rp_id:rp_id,product_id:product_id,gin_entry_type_id:gin_entry_type_id,product_color_id:product_color_id,product_brand_id:product_brand_id,product_thick:product_thick,godown_id:godown_id},

		function(data) { $('#raw_product_content').html( data ); }

	);	

}
function getRawProductId(){
	var m_id = '';
	var x = $('.sr_id').map(function() { return this.value; }).get();
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
function AddRawproductDetail(){
	var x		= document.getElementsByName("chk_product_id[]");
	for (var k = 0; k < x.length; k++) {
		if (x[k].checked ==true) {
			var ord_id 	=  x[k].value;

			var detail_id 					= ord_id.slice(0, - 1);;
			var product_name 				= document.getElementById('raw_product_name'+ord_id).value;
			var product_id 					= document.getElementById('raw_product_id'+ord_id).value;
			var product_code 				= document.getElementById('raw_product_code'+ord_id).value;
			var product_uom 				= document.getElementById('raw_product_uom'+ord_id).value;
			var product_colour_name			= document.getElementById('raw_product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('raw_product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('raw_product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('raw_product_thick_ness'+ord_id).value; //alert(product_thick_ness);
			var product_thick_ness_id		= document.getElementById('raw_product_thick_ness_id'+ord_id).value;
			var product_width_inches		= parseFloat(document.getElementById('raw_product_width_inches'+ord_id).value).toFixed(3);
			var product_width_mm			= parseFloat(document.getElementById('raw_product_width_mm'+ord_id).value).toFixed(3);
			var product_sl_feet				= parseFloat(document.getElementById('raw_product_sl_feet'+ord_id).value).toFixed(2);
			var product_sl_feet_mm			= parseFloat(document.getElementById('raw_product_sl_feet_mm'+ord_id).value).toFixed(2);
			var raw_product_osf_uom_ton		= parseFloat(document.getElementById('raw_product_osf_uom_ton'+ord_id).value).toFixed(2);
			var product_tone				= parseFloat(document.getElementById('raw_product_ton'+ord_id).value).toFixed(6);
			var product_kg					= parseFloat(document.getElementById('raw_product_kg'+ord_id).value).toFixed(2);
			var mother_child_type			= document.getElementById('mother_child_type'+ord_id).value;
			var row_cnt     			= $('#raw_product_detail >tbody >tr').length+1;	 
			
			var apnd						= '';
			 
			apnd	+= '<tr><td><input type="hidden"  name="gin_entry_raw_product_detail_mother_child_type[]" id="gin_entry_raw_product_detail_mother_child_type'+row_cnt+'" value="'+mother_child_type+'"  />'+product_brand_name+'</td><td>'+product_code+'</td><td>'+product_name+'<input type="hidden"  name="gin_entry_raw_product_detail_product_id[]" id="gin_entry_raw_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="gin_entry_raw_product_detail_product_type[]" id="gin_entry_raw_product_detail_product_type" value="2" /><input type="hidden"  name="gin_entry_raw_product_detail_product_osf_uom_ton[]" id="gin_entry_raw_product_detail_product_osf_uom_ton'+row_cnt+'" value="'+raw_product_osf_uom_ton+'"  /> ';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="gin_entry_raw_product_detail_product_color_id[]" id="gin_entry_raw_product_detail_product_color_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="gin_entry_raw_product_detail_product_thick[]" id="gin_entry_raw_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="gin_entry_raw_product_detail_width_inches[]" id="gin_entry_raw_product_detail_width_inches'+row_cnt+'" onBlur="GetRLcalS(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="gin_entry_raw_product_detail_width_mm[]" id="gin_entry_raw_product_detail_width_mm'+row_cnt+'"   onBlur="GetRLcalS(3,'+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="gin_entry_raw_product_detail_sl_feet[]" id="gin_entry_raw_product_detail_sl_feet'+row_cnt+'" onblur="GetRLcalFeet(1,'+row_cnt+')"  onBlur="GetRTotalLength('+row_cnt+')" value="'+product_sl_feet+'" readonly  /></td> <td><input class="form-control" type="text"  name="gin_entry_raw_product_detail_sl_feet_mm[]" id="gin_entry_raw_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetRLcalFeet(4,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')"  value="'+product_sl_feet_mm+'" readonly   /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="gin_entry_raw_product_detail_ton[]" id="gin_entry_raw_product_detail_ton'+row_cnt+'"  onBlur="GetRRWeightClc(1,'+row_cnt+')" value="'+product_tone+'" readonly   /></td><td><input class="form-control" type="text"  name="gin_entry_raw_product_detail_kg[]" id="gin_entry_raw_product_detail_kg'+row_cnt+'" readonly  value="'+product_kg+'" readonly /></td></tr>';
			
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		$("#raw_product_detail_display" ).append(apnd);
		}
	}

}	

  function GetRRWeightClc(type,id){
	var prod_ton =$('#gin_entry_raw_product_detail_ton'+id).val();
	var prod_kg =$('#gin_entry_raw_product_detail_kg'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#gin_entry_raw_product_detail_kg'+id).val(prod_val).toFixed(2);
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#gin_entry_raw_product_detail_ton'+id).val(prod_val).toFixed(2);
	}
	
	
 }

function GetRLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('gin_entry_raw_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('gin_entry_raw_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('gin_entry_raw_product_detail_width_inches'+id).value 		= parseFloat(data_t[1]).toFixed(3);
			}
			if(calculation_id==2){
			document.getElementById('gin_entry_raw_product_detail_width_mm'+id).value 			= parseFloat(data_t[2]).toFixed(3);
			}
		}

	);

}
function GetRLcalFeet(calculation_id,id){

	var product_osf_uom_ton 	= document.getElementById('gin_entry_raw_product_detail_product_osf_uom_ton'+id).value;
	if(calculation_id==1){

		var calc_amount 	= document.getElementById('gin_entry_raw_product_detail_sl_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('gin_entry_raw_product_detail_sl_feet_mm'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('gin_entry_raw_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]).toFixed(2);


			document.getElementById('gin_entry_raw_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[3]).toFixed(2);
			document.getElementById('gin_entry_raw_product_detail_ton'+id).value 		= (eval(data_t[0])*eval(product_osf_uom_ton)).toFixed(2);
			GetRRWeightClc(1,id)

			//document.getElementById('gin_entry_raw_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}
function GetRTotalLength(id){
	
	var product_qty 	= document.getElementById('gin_entry_raw_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('gin_entry_raw_product_detail_s_width_inches'+id).value;
	var sales_length 	= document.getElementById('gin_entry_raw_product_detail_sl_feet'+id).value;
	var width 			= document.getElementById('gin_entry_raw_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('gin_entry_raw_product_detail_tot_length'+id).value = total_length_val.toFixed(2);
	
}


function GetcustomerDetail(){

	var cus_id 	= document.getElementById('gin_entry_customer_id').value;	

	$.get('../ajax-file/customer-detail.php',

		{cus_id:cus_id},

		function(data) { 

			var s_data	= data.split('@');

			document.getElementById('gin_entry_address').value 		= s_data[6];

			document.getElementById('gin_entry_contact_no').value 	= s_data[7];

			

		}

	);	

}

