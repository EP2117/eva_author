checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('stock_transfer_list_form').elements.length; i++) {

	  document.getElementById('stock_transfer_list_form').elements[i].checked = checked;

	}

}

function GetProddisplay(id){
		var gin_type 		= document.getElementById('stock_transfer_type').value;
		$('.c_type_id').hide();
		$('.prduc_detail').hide();
		if(gin_type==2){
			$('.c_type_id').show();
		}
		else if(gin_type==1){
			$('.prduc_detail').show();
		}
}
function getTableHeader(id){
	//$('#product_detail >tbody >tr').remove();
	if(id ==1){
	$('.rls').show(); $('.rws').hide(); $('.ccs').hide(); $('.as').hide();
	}else if(id==2){
	$('.rws').show(); $('.rls').hide(); $('.ccs').hide(); $('.as').hide();
	}else if(id==4){
	$('.as').show(); $('.rws').hide(); $('.rls').hide(); ;
	}else{
		$('.rls').hide();
		$('.rws').hide();
		$('.as').hide();
	}
	
}


function GetSodetail(){

	var branch_id 		= document.getElementById('stock_transfer_branch_id').value;

	var gin_type 		= document.getElementById('stock_transfer_type').value;

	$.get('sales-detail.php',

		{gin_type:gin_type,branch_id:branch_id},

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
			var table 						= document.getElementById('so_detail');
			var row_cnt     				= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+production_order_no+"</td><td>"+production_order_date+"<input type='hidden'  name='stock_transfer_production_order_id' id='stock_transfer_production_order_id' value='"+production_order_id+"'  class='dc_id'  /><input type='hidden'  name='stock_transfer_type_id' id='stock_transfer_type_id' value='"+production_order_type_id+"'  class='dc_id'  /> </td><td>"+production_order_type+"</td> </tr>");

			getTableHeader(production_order_type_id);

		}

	}

}

function GetDetail(){ 

	var stock_transfer_type_id 		= document.getElementById('stock_transfer_type_id').value;
	
	var stock_transfer_type 		= document.getElementById('stock_transfer_type').value;
	
	var m_id 			= getQuotationId();
	
	if(stock_transfer_type==1){
	var production_order_id 	= document.getElementById('stock_transfer_production_order_id').value;
	
		$.get('product-detail.php',
	
			{production_order_id:production_order_id,m_id:m_id,t_id:stock_transfer_type_id},
	
			function(data) { $('#dynamic-content').html( data ); }
	
		);	
	}
	else{
		$.get('raw-product-detail.php',
	
			{m_id:m_id,t_id:stock_transfer_type_id},
	
			function(data) { $('#dynamic-content').html( data ); }
	
		);	
	}
		

}

function AddproductDetail(){
	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) {

		if (document.getElementById('product_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;

			var detail_id 					= ord_id;
			var product_name 				= document.getElementById('product_name'+ord_id).value;
			var product_id 					= document.getElementById('product_id'+ord_id).value;
			var product_code 				= document.getElementById('product_code'+ord_id).value;
			var product_uom 				= document.getElementById('product_uom'+ord_id).value;
			var product_type				= document.getElementById('product_type'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			if(t_id==1 || t_id==2){ 
			var product_width_inches	= document.getElementById('product_width_inches'+ord_id).value;
			var product_width_mm		= document.getElementById('product_width_mm'+ord_id).value;
			var product_length_feet		= document.getElementById('product_length_feet'+ord_id).value;
			var product_length_mm		= document.getElementById('product_length_mm'+ord_id).value;
			var product_tone			= document.getElementById('product_tone'+ord_id).value;
			var product_kg				= document.getElementById('product_kg'+ord_id).value;
			var product_colour_name			= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
			
			}
			var table 					= document.getElementById('product_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	
			var apnd = '';
			if(t_id==1){ 
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="stock_transfer_product_detail_product_id[]" id="stock_transfer_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="stock_transfer_product_detail_product_type[]" id="stock_transfer_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="stock_transfer_product_detail_po_detail_id[]" id="stock_transfer_product_detail_po_detail_id" value="'+detail_id+'" /></td>';

			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="stock_transfer_product_detail_product_color_id[]" id="stock_transfer_product_detail_product_color_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="stock_transfer_product_detail_product_thick[]" id="stock_transfer_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_transfer_product_detail_width_inches[]" id="stock_transfer_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  readonly /></td> <td><input class="form-control" type="text"  name="stock_transfer_product_detail_width_mm[]" id="stock_transfer_product_detail_width_mm'+row_cnt+'"   value="'+product_width_mm+'"  readonly/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_transfer_product_detail_length_feet[]" id="stock_transfer_product_detail_length_feet'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value="'+product_length_feet+'" readonly /></td> <td><input class="form-control" type="text"  name="stock_transfer_product_detail_length_meter[]" id="stock_transfer_product_detail_length_meter'+row_cnt+'"   value="'+product_length_mm+'"  readonly/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_transfer_product_detail_qty[]" id="stock_transfer_product_detail_qty'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"   /></td><td><input class="form-control" type="text"  name="stock_transfer_product_detail_tot_length[]" id="stock_transfer_product_detail_tot_length'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"  readonly  /></td></tr>';
			}else if(t_id == 2){
				
			apnd	+= '<tr><td style="width:5%" >'+product_brand_name+'</td><td style="width:5%" >'+product_name+'<input type="hidden"  name="stock_transfer_product_detail_product_id[]" id="stock_transfer_product_detail_product_id" value="'+product_id+'" /> <input type="hidden"  name="stock_transfer_product_detail_product_type[]" id="stock_transfer_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="stock_transfer_product_detail_po_detail_id[]" id="stock_transfer_product_detail_po_detail_id" value="'+detail_id+'" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="stock_transfer_product_detail_product_color_id[]" id="stock_transfer_product_detail_product_color_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="stock_transfer_product_detail_product_thick[]" id="stock_transfer_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_transfer_product_detail_width_inches[]" id="stock_transfer_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  readonly /></td> <td><input class="form-control" type="text"  name="stock_transfer_product_detail_width_mm[]" id="stock_transfer_product_detail_width_mm'+row_cnt+'"   value="'+product_width_mm+'"  readonly/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_transfer_product_detail_weight_tone[]" id="stock_transfer_product_detail_weight_tone'+row_cnt+'"  value="'+product_tone+'" readonly /></td> <td><input class="form-control" type="text"  name="stock_transfer_product_detail_weight_kg[]" id="stock_transfer_product_detail_weight_kg'+row_cnt+'"   value="'+product_kg+'"  readonly/></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_transfer_product_detail_qty[]" id="stock_transfer_product_detail_qty'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"   /></td></tr>';
			
			
			}else{ 
			
			apnd	+= '<tr><td>'+product_code+'</td><td style="width:30%">'+product_name+'<input type="hidden"  name="stock_transfer_product_detail_product_id[]" id="stock_transfer_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="stock_transfer_product_detail_product_type[]" id="stock_transfer_product_detail_product_type"  value="'+product_type+'" /><input type="hidden"  name="stock_transfer_product_detail_po_detail_id[]" id="stock_transfer_product_detail_po_detail_id" value="'+detail_id+'" /></td>';
			
			apnd	+= '<td style="width:30%">'+product_uom+'</td>';
			
			apnd	+= '<td style="width:40%"><input class="form-control" type="text"  name="stock_transfer_product_detail_qty[]" id="stock_transfer_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  /></td></tr>';
			
			}
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		$("#product_detail_display" ).append(apnd);
		}
	}

}
function GetTotalLength(id){
	
	var product_qty 	= document.getElementById('stock_transfer_product_detail_qty'+id).value;
	var sales_length 	= document.getElementById('stock_transfer_product_detail_length_feet'+id).value;
	var width 			= document.getElementById('stock_transfer_product_detail_width_inches'+id).value;
	
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((36 * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('stock_transfer_product_detail_tot_length'+id).value = total_length_val.toFixed(2);
}



function GetLcalFeet(calculation_id,id){
	if(calculation_id==1){

		var calc_amount 	= document.getElementById('stock_transfer_product_detail_sl_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('stock_transfer_product_detail_sl_feet_in'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('stock_transfer_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		//var calc_amount 	= document.getElementById('stock_transfer_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('stock_transfer_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('stock_transfer_product_detail_sl_feet_in'+id).value 		= data_t[1];

			document.getElementById('stock_transfer_product_detail_sl_feet_mm'+id).value 		= data_t[2];

			//document.getElementById('stock_transfer_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('stock_transfer_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('stock_transfer_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('stock_transfer_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('stock_transfer_product_detail_width_mm'+id).value 			= data_t[2];
		}

	);

}
function GetWcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('stock_transfer_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('stock_transfer_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('stock_transfer_product_detail_s_width_inches'+id).value 		= data_t[1];
			document.getElementById('stock_transfer_product_detail_s_width_mm'+id).value 			= data_t[2];
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
	var stock_transfer_type_id 	= document.getElementById('stock_transfer_type_id').value;
	//var production_order_id 	= document.getElementById('stock_transfer_production_order_id').value;
	$.get('raw-product-detail.php',

		{m_id:m_id,rp_id:rp_id,t_id:stock_transfer_type_id},

		function(data) {$('#dynamic-content').html( data );  }

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
	for (var i = 0; i < document.getElementById('raw_product_list_form').elements.length; i++) {

		if (document.getElementById('raw_product_list_form').elements[i].checked ==true) {

			var ord_id 						=  document.getElementById('raw_product_list_form').elements[i].value;

			var detail_id 					= ord_id;
			var product_name 				= document.getElementById('raw_product_name'+ord_id).value;
			var product_id 					= document.getElementById('raw_product_id'+ord_id).value;
			var product_code 				= document.getElementById('raw_product_code'+ord_id).value;
			var product_uom 				= document.getElementById('raw_product_uom'+ord_id).value;
			var product_colour_name			= document.getElementById('raw_product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('raw_product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('raw_product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('raw_product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('raw_product_thick_ness_id'+ord_id).value;
			var product_width_inches		= document.getElementById('raw_product_width_inches'+ord_id).value;
			var product_width_mm			= document.getElementById('raw_product_width_mm'+ord_id).value;
			var product_sl_feet				= document.getElementById('raw_product_sl_feet'+ord_id).value;
			var product_sl_feet_mm			= document.getElementById('raw_product_sl_feet_mm'+ord_id).value;
			
			var product_tone				= document.getElementById('raw_product_ton'+ord_id).value;
			var product_kg					= document.getElementById('raw_product_kg'+ord_id).value;
			var apnd						= '';
			 
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="stock_transfer_raw_product_detail_product_id[]" id="stock_transfer_raw_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="stock_transfer_raw_product_detail_product_type[]" id="stock_transfer_raw_product_detail_product_type" value="2" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="stock_transfer_raw_product_detail_product_color_id[]" id="stock_transfer_raw_product_detail_product_color_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="stock_transfer_raw_product_detail_product_thick[]" id="stock_transfer_raw_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_transfer_raw_product_detail_width_inches[]" id="stock_transfer_raw_product_detail_width_inches'+row_cnt+'"  onkeyup="GetRLcalc(2,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="stock_transfer_raw_product_detail_width_mm[]" id="stock_transfer_raw_product_detail_width_mm'+row_cnt+'"   onBlur="GetRTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_transfer_raw_product_detail_sl_feet[]" id="stock_transfer_raw_product_detail_sl_feet'+row_cnt+'" onblur="GetRLcalFeet(1,'+row_cnt+')"  onBlur="GetRTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="stock_transfer_raw_product_detail_sl_feet_mm[]" id="stock_transfer_raw_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetRLcalFeet(3,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')"  value="'+product_sl_feet_mm+'"   /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="stock_transfer_raw_product_detail_ton[]" id="stock_transfer_raw_product_detail_ton'+row_cnt+'"  onBlur="GetRTotalLength('+row_cnt+')" value="'+product_tone+'"   /></td><td><input class="form-control" type="text"  name="stock_transfer_raw_product_detail_kg[]" id="stock_transfer_raw_product_detail_kg'+row_cnt+'" readonly  value="'+product_kg+'"  /></td></tr>';
			
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		$("#raw_product_detail_display" ).append(apnd);
		}
	}

}	
 function GetRWeightClc(type,id){
		var product_id		=$("#stock_transfer_raw_product_detail_mas_product_id"+id).val();
		var prd_thick		=$("#stock_transfer_raw_product_detail_product_thick"+id).val();
		if(type==1){
			var prd_qty_val		=$("#stock_transfer_raw_product_detail_s_weight_inches"+id).val();
 		}else{
			var prd_qty_val		=$("#stock_transfer_raw_product_detail_s_weight_mm"+id).val();
		}
		$.get(
			"../ajax-file/product-weight-calc.php",
			{product_id:product_id,prd_thick:prd_thick,prd_type:type,prd_qty_val:prd_qty_val},
			function(data) {
				if(type==1){
					$("#stock_transfer_raw_product_detail_s_weight_mm"+id).val(data);
				}else{
					$("#stock_transfer_raw_product_detail_s_weight_inches"+id).val(data);
				}
			}
		);
 }

function GetRLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('stock_transfer_raw_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('stock_transfer_raw_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('stock_transfer_raw_product_detail_s_width_inches'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('stock_transfer_raw_product_detail_s_width_mm'+id).value 			= data_t[2];
			}
		}

	);

}
function GetRLcalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('stock_transfer_raw_product_detail_sl_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('stock_transfer_raw_product_detail_sl_feet_in'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('stock_transfer_raw_product_detail_sl_feet_mm'+id).value;	

	}

	else if(calculation_id==4){

		//var calc_amount 	= document.getElementById('stock_transfer_raw_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('stock_transfer_raw_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);

			document.getElementById('stock_transfer_raw_product_detail_sl_feet_in'+id).value 		= data_t[1];

			document.getElementById('stock_transfer_raw_product_detail_sl_feet_mm'+id).value 		= data_t[2];

			//document.getElementById('stock_transfer_raw_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}
function GetRTotalLength(id){
	
	var product_qty 	= document.getElementById('stock_transfer_raw_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('stock_transfer_raw_product_detail_s_width_inches'+id).value;
	var sales_length 	= document.getElementById('stock_transfer_raw_product_detail_sl_feet'+id).value;
	var width 			= document.getElementById('stock_transfer_raw_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('stock_transfer_raw_product_detail_tot_length'+id).value = total_length_val.toFixed(2);
	
}


function GetcustomerDetail(){

	var cus_id 	= document.getElementById('stock_transfer_customer_id').value;	

	$.get('../ajax-file/customer-detail.php',

		{cus_id:cus_id},

		function(data) { 

			var s_data	= data.split('@');

			document.getElementById('stock_transfer_address').value 		= s_data[6];

			document.getElementById('stock_transfer_contact_no').value 	= s_data[7];

			

		}

	);	

}

