checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('pdo_entry_list_form').elements.length; i++) {

	  document.getElementById('pdo_entry_list_form').elements[i].checked = checked;

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
	}
	
}


function GetSodetail(){

	var branch_id 		= document.getElementById('pdo_entry_branch_id').value;

	$.get('sales-detail.php',

		{branch_id:branch_id},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;

			var production_entry_id 		= ord_id;

			var production_entry_no 		= document.getElementById('production_entry_no'+ord_id).value;

			var production_entry_date 		= document.getElementById('production_entry_date'+ord_id).value;

			var production_entry_type 		= document.getElementById('production_entry_type'+ord_id).value;
			var production_entry_type_id 		= document.getElementById('production_entry_type_id'+ord_id).value;

			var table 				= document.getElementById('so_detail');

			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+production_entry_no+"</td><td>"+production_entry_date+"<input type='hidden'  name='pdo_entry_production_entry_id' id='pdo_entry_production_entry_id' value='"+production_entry_id+"'  class='dc_id'  /> <input type='hidden'  name='pdo_entry_type_id' id='pdo_entry_type_id' value='"+production_entry_type_id+"'  /></td><td>"+production_entry_type+"</td> </tr>");
				getTableHeader(production_entry_type_id);
			

		}

	}

}

function GetDetail(){

	var production_entry_id 	= document.getElementById('pdo_entry_production_entry_id').value;

	var m_id 			= getQuotationId();

	$.get('product-detail.php',

		{production_entry_id:production_entry_id,m_id:m_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

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
			var product_colour_name			= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
			var product_width_inches		= document.getElementById('product_width_inches'+ord_id).value;
			var product_width_mm			= document.getElementById('product_width_mm'+ord_id).value;
			var product_s_width_inches		= document.getElementById('product_s_width_inches'+ord_id).value;
			var product_s_width_mm			= document.getElementById('product_s_width_mm'+ord_id).value;
			var product_sl_feet				= document.getElementById('product_sl_feet'+ord_id).value;
			var product_sl_feet_in			= document.getElementById('product_sl_feet_in'+ord_id).value;
			var product_sl_feet_mm			= document.getElementById('product_sl_feet_mm'+ord_id).value;
			var product_sl_feet_met			= document.getElementById('product_sl_feet_met'+ord_id).value;

			var product_ext_feet			= document.getElementById('product_ext_feet'+ord_id).value;
			var product_ext_feet_in			= document.getElementById('product_ext_feet_in'+ord_id).value;
			var product_ext_feet_mm			= document.getElementById('product_ext_feet_mm'+ord_id).value;
			var product_ext_feet_met		= document.getElementById('product_ext_feet_met'+ord_id).value;
			
			var product_s_weight_inches		= document.getElementById('product_s_weight_inches'+ord_id).value;
			var product_s_weight_mm			= document.getElementById('product_s_weight_mm'+ord_id).value;
			var product_tot_feet			= document.getElementById('product_tot_feet'+ord_id).value;
			var product_tot_meter			= document.getElementById('product_tot_meter'+ord_id).value;
			var product_tot_length			= document.getElementById('product_tot_length'+ord_id).value;
			var product_qty					= document.getElementById('product_detail_qty'+ord_id).value;
			var product_type						= document.getElementById('product_type'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			var apnd = '';
			if(t_id == 1){
			 
			apnd	+= '<tr><td>'+product_code+'</td><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="pdo_entry_product_detail_product_id[]" id="pdo_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="pdo_entry_product_detail_product_type[]" id="pdo_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="pdo_entry_product_detail_production_detail_id[]" id="pdo_entry_product_detail_production_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="pdo_entry_product_detail_product_colour_id[]" id="pdo_entry_product_detail_product_colour_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="pdo_entry_product_detail_product_thick[]" id="pdo_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="pdo_entry_product_detail_width_inches[]" id="pdo_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="pdo_entry_product_detail_width_mm[]" id="pdo_entry_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="pdo_entry_product_detail_s_width_inches[]" id="pdo_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="pdo_entry_product_detail_s_width_mm[]" id="pdo_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td> <input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet[]" id="pdo_entry_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet_in[]" id="pdo_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'"  /></td><td><input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet_mm[]" id="pdo_entry_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="pdo_entry_product_detail_sl_feet_met[]" id="pdo_entry_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'"  /></td>';
			
			apnd	+= '<td> <input class="form-control" type="text"  name="pdo_entry_product_detail_ext_feet[]" id="pdo_entry_product_detail_ext_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet+'"  /></td> <td><input class="form-control" type="text"  name="pdo_entry_product_detail_ext_feet_in[]" id="pdo_entry_product_detail_ext_feet_in'+row_cnt+'" onblur="GetLcalFeet(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_ext_feet_in+'"  /></td><td><input class="form-control" type="text"  name="pdo_entry_product_detail_ext_feet_mm[]" id="pdo_entry_product_detail_ext_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="pdo_entry_product_detail_ext_feet_met[]" id="pdo_entry_product_detail_ext_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet_met+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="pdo_entry_product_detail_qty[]" id="pdo_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'"   /></td><td><input class="form-control" type="text"  name="pdo_entry_product_detail_tot_length[]" id="pdo_entry_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"   /></td></tr>';
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td>'+product_code+'</td><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="pdo_entry_product_detail_product_id[]" id="pdo_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="pdo_entry_product_detail_product_type[]" id="pdo_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="pdo_entry_product_detail_production_detail_id[]" id="pdo_entry_product_detail_production_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="pdo_entry_product_detail_product_colour_id[]" id="pdo_entry_product_detail_product_colour_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="pdo_entry_product_detail_product_thick[]" id="pdo_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="pdo_entry_product_detail_width_inches[]" id="pdo_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="pdo_entry_product_detail_width_mm[]" id="pdo_entry_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="pdo_entry_product_detail_s_weight_inches[]" id="pdo_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetLcalc(3,'+row_cnt+')"   value="'+product_s_weight_inches+'"   /></td> <td><input class="form-control" type="text"  name="pdo_entry_product_detail_s_weight_mm[]" id="pdo_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetLcalc(4,'+row_cnt+')"  value="'+product_s_weight_mm+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="pdo_entry_product_detail_s_weight_ton[]" id="pdo_entry_product_detail_s_weight_ton'+row_cnt+'"   value=""   /></td> <td><input class="form-control" type="text"  name="pdo_entry_product_detail_s_weight_kg[]" id="pdo_entry_product_detail_s_weight_kg'+row_cnt+'"   value=""   /></td>';
			
			apnd	+= '<td style="width:10%"><input class="form-control" type="text"  name="pdo_entry_product_detail_tot_feet[]" id="pdo_entry_product_detail_tot_feet'+row_cnt+'" onBlur="GetTotalFeet(1,'+row_cnt+')" value="'+product_tot_feet+'" /></td> <td style="width:10%"><input class="form-control" type="text"  name="pdo_entry_product_detail_tot_meter[]" id="pdo_entry_product_detail_tot_meter'+row_cnt+'"  onBlur="GetTotalFeet(4,'+row_cnt+')"value="'+product_tot_meter+'" /></td></tr>';
				
			}else if(t_id == 4){
			
			apnd	+= '<tr><td>'+product_code+'</td><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="pdo_entry_product_detail_product_id[]" id="pdo_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="pdo_entry_product_detail_product_type[]" id="pdo_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="pdo_entry_product_detail_production_detail_id[]" id="pdo_entry_product_detail_production_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td style="width:30%">'+product_uom+'<input type="hidden"  name="pdo_entry_product_detail_product_uom_id[]" id="pdo_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td style="width:40%"><input class="form-control" type="text"  name="pdo_entry_product_detail_qty[]" id="pdo_entry_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  /></td></tr>';
				
			}
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		$("#product_detail_display" ).append(apnd);
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

function GetRawDetail(){

	var m_id 			= getQuotationId();

	$.get('raw-product-detail.php',

		{m_id:m_id},

		function(data) { $('#raw_product_content').html( data ); }

	);	

}

function AddRawproductDetail(){

	for (var i = 0; i < document.getElementById('raw_product_list_form').elements.length; i++) {

		if (document.getElementById('raw_product_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('raw_product_list_form').elements[i].value;

			var raw_product_id 			= ord_id;

			var product_id 				= document.getElementById('product_id'+ord_id).value;

			var product_name 			= document.getElementById('product_name'+ord_id).value;

			var product_code 			= document.getElementById('product_code'+ord_id).value;

			var product_uom 			= document.getElementById('product_uom'+ord_id).value;

			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;

			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;

			var table 					= document.getElementById('raw_product_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	

			$( "#raw_product_detail_display" ).append( 

			"<tr><td>"+product_code+"</td><td>"+product_name+"<input type='hidden'  name='pdo_entry_raw_product_detail_raw_product_id[]' id='pdo_entry_raw_product_detail_raw_product_id' value='"+raw_product_id+"' /><input type='hidden'  name='pdo_entry_raw_product_detail_product_id[]' id='pdo_entry_raw_product_detail_product_id' value='"+product_id+"'  class='sd_id'  /><td><input class='form-control' type='text'  name='product_uom[]' id='product_uom"+row_cnt+"' value='"+product_uom+"'   /></td><td><input class='form-control' type='text'  name='product_colour_name[]' id='product_colour_name"+row_cnt+"' value='"+product_colour_name+"'   /></td><td><input class='form-control' type='text'  name='product_thick_ness[]' id='product_thick_ness"+row_cnt+"' value='"+product_thick_ness+"'   /></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_width_feet[]' id='pdo_entry_raw_product_detail_width_feet"+row_cnt+"' onblur='GetRcalc(1,"+row_cnt+")'   /></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_width_inches[]' id='pdo_entry_raw_product_detail_width_inches"+row_cnt+"' onblur='GetRcalc(2,"+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_width_mm[]' id='pdo_entry_raw_product_detail_width_mm"+row_cnt+"' onblur='GetRcalc(3,"+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_width_meter[]' id='pdo_entry_raw_product_detail_width_meter"+row_cnt+"'  onblur='GetRcalc(4,"+row_cnt+")' /></td></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_length_feet[]' id='pdo_entry_raw_product_detail_length_feet"+row_cnt+"' onblur='GetRLcalc(1,"+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_length_inches[]' id='pdo_entry_raw_product_detail_length_inches"+row_cnt+"'  onblur='GetRLcalc(2,"+row_cnt+")' /></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_length_mm[]' id='pdo_entry_raw_product_detail_length_mm"+row_cnt+"' onblur='GetRLcalc(3,"+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_length_meter[]' id='pdo_entry_raw_product_detail_length_meter"+row_cnt+"'  onblur='GetRLcalc(4,"+row_cnt+")'   /></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_ext_length_feet[]' id='pdo_entry_raw_product_detail_ext_length_feet"+row_cnt+"'  onblur='GetREcalc(1,"+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_ext_length_meter[]' id='pdo_entry_raw_product_detail_ext_length_meter"+row_cnt+"' onblur='GetREcalc(4,"+row_cnt+")'   /></td></td><td><input class='form-control' type='text'  name='pdo_entry_raw_product_detail_qty[]' id='pdo_entry_raw_product_detail_qty"+row_cnt+"' onblur='discountPerFind("+row_cnt+")'  /></td></tr>");

		}

	}

}	

function Getcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_width_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_width_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_width_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_width_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('pdo_entry_product_detail_width_feet'+id).value 		= data_t[0];

			document.getElementById('pdo_entry_product_detail_width_inches'+id).value 		= data_t[1];

			document.getElementById('pdo_entry_product_detail_width_mm'+id).value 			= data_t[2];

			document.getElementById('pdo_entry_product_detail_width_meter'+id).value 		= data_t[3];

		}

	);

}

function GetLcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_length_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_length_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_length_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('pdo_entry_product_detail_length_feet'+id).value 		= data_t[0];

			document.getElementById('pdo_entry_product_detail_length_inches'+id).value 		= data_t[1];

			document.getElementById('pdo_entry_product_detail_length_mm'+id).value 			= data_t[2];

			document.getElementById('pdo_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetEcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_ext_length_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('pdo_entry_product_detail_ext_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('pdo_entry_product_detail_ext_length_feet'+id).value 		= data_t[0];

			document.getElementById('pdo_entry_product_detail_ext_length_meter'+id).value 		= data_t[3];

		}

	);

}



// Raw Material

function GetRcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_width_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_width_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_width_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_width_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('pdo_entry_raw_product_detail_width_feet'+id).value 		= data_t[0];

			document.getElementById('pdo_entry_raw_product_detail_width_inches'+id).value 		= data_t[1];

			document.getElementById('pdo_entry_raw_product_detail_width_mm'+id).value 			= data_t[2];

			document.getElementById('pdo_entry_raw_product_detail_width_meter'+id).value 		= data_t[3];

		}

	);

}

function GetRLcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_length_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_length_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_length_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('pdo_entry_raw_product_detail_length_feet'+id).value 		= data_t[0];

			document.getElementById('pdo_entry_raw_product_detail_length_inches'+id).value 		= data_t[1];

			document.getElementById('pdo_entry_raw_product_detail_length_mm'+id).value 			= data_t[2];

			document.getElementById('pdo_entry_raw_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetREcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_ext_length_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('pdo_entry_raw_product_detail_ext_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('pdo_entry_raw_product_detail_ext_length_feet'+id).value 		= data_t[0];

			document.getElementById('pdo_entry_raw_product_detail_ext_length_meter'+id).value 		= data_t[3];

		}

	);

}



function GetcustomerDetail(){

	var cus_id 	= document.getElementById('pdo_entry_customer_id').value;	

	$.get('../ajax-file/customer-detail.php',

		{cus_id:cus_id},

		function(data) { 

			var s_data	= data.split('@');

			document.getElementById('pdo_entry_address').value 		= s_data[6];

			document.getElementById('pdo_entry_contact_no').value 	= s_data[7];

			

		}

	);	

}

