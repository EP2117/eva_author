checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('grn_entry_list_form').elements.length; i++) {

	  document.getElementById('grn_entry_list_form').elements[i].checked = checked;

	}

}
checked = false;

function GetCheck () {

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
	}
	
}



function GetSodetail(){
	var branch_id 		= document.getElementById('grn_entry_branch_id').value;
	var gin_type 		= '';
	$.get('sales-detail.php',
		{gin_type:gin_type,branch_id:branch_id},
		function(data) { $('#so_detail_content').html( data ); }
	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;

			var gin_entry_id 		= ord_id;

			var gin_entry_no 		= document.getElementById('gin_entry_no'+ord_id).value;

			var gin_entry_date 		= document.getElementById('gin_entry_date'+ord_id).value;

			var gin_entry_type 		= document.getElementById('gin_entry_type'+ord_id).value;
			
			var gin_entry_type_id 	= document.getElementById('gin_entry_type_id'+ord_id).value;
			
			var customer_name 		= document.getElementById('customer_name'+ord_id).value;
			
			var production_order_no = document.getElementById('production_order_no'+ord_id).value;

			var table 				= document.getElementById('so_detail');

			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+gin_entry_no+"</td><td>"+gin_entry_date+"<input type='hidden'  name='grn_entry_gin_entry_id' id='grn_entry_gin_entry_id' value='"+gin_entry_id+"'  class='dc_id'  /><input type='hidden'  name='grn_entry_type_id' id='grn_entry_type_id' value='"+gin_entry_type_id+"' /></td><td>"+gin_entry_type+"</td><td>"+production_order_no+"</td><td>"+customer_name+"</td> </tr>");

			
			getTableHeader(gin_entry_type_id);
		}

	}

}

function GetDetail(){

	var gin_entry_id 	= document.getElementById('grn_entry_gin_entry_id').value;

	var m_id 			= getQuotationId();

	$.get('product-detail.php',

		{gin_entry_id:gin_entry_id,m_id:m_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){

	var x		= document.getElementsByName("gin_entry_product_detail_id[]");
	for (var k = 0; k < x.length; k++) {
		if (x[k].checked ==true) {
			var ord_id						= x[k].value;		
			var detail_id 					= ord_id;
			var product_name 				= document.getElementById('product_name'+ord_id).value;
			var product_id 					= document.getElementById('product_id'+ord_id).value;
			var product_code 				= document.getElementById('product_code'+ord_id).value;
			var product_uom 				= document.getElementById('product_uom'+ord_id).value;
			var uom_id		 				= document.getElementById('uom_id'+ord_id).value;
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
			var product_type				= document.getElementById('product_type'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			var mother_child_type			= document.getElementById('mother_child_type'+ord_id).value;
			var apnd = '';
			if(t_id == 1){
			 
			apnd	+= '<tr><td><input type="hidden"  name="grn_entry_product_detail_mother_child_type[]" id="grn_entry_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="grn_entry_product_detail_product_id[]" id="grn_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="grn_entry_product_detail_product_type[]" id="grn_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="grn_entry_product_detail_gin_detail_id[]" id="grn_entry_product_detail_gin_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="grn_entry_product_detail_product_colour_id[]" id="grn_entry_product_detail_product_colour_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="grn_entry_product_detail_product_thick[]" id="grn_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="grn_entry_product_detail_width_inches[]" id="grn_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="grn_entry_product_detail_width_mm[]" id="grn_entry_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="grn_entry_product_detail_s_width_inches[]" id="grn_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="grn_entry_product_detail_s_width_mm[]" id="grn_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td> <input class="form-control" type="text"  name="grn_entry_product_detail_sl_feet[]" id="grn_entry_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="grn_entry_product_detail_sl_feet_in[]" id="grn_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'"  /></td><td><input class="form-control" type="text"  name="grn_entry_product_detail_sl_feet_mm[]" id="grn_entry_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="grn_entry_product_detail_sl_feet_met[]" id="grn_entry_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'"  /></td>';
			
			apnd	+= '<td> <input class="form-control" type="text"  name="grn_entry_product_detail_ext_feet[]" id="grn_entry_product_detail_ext_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet+'"  /></td> <td><input class="form-control" type="text"  name="grn_entry_product_detail_ext_feet_in[]" id="grn_entry_product_detail_ext_feet_in'+row_cnt+'" onblur="GetLcalFeet(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_ext_feet_in+'"  /></td><td><input class="form-control" type="text"  name="grn_entry_product_detail_ext_feet_mm[]" id="grn_entry_product_detail_ext_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="grn_entry_product_detail_ext_feet_met[]" id="grn_entry_product_detail_ext_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet_met+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="grn_entry_product_detail_qty[]" id="grn_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'"   /></td><td><input class="form-control" type="text"  name="grn_entry_product_detail_tot_length[]" id="grn_entry_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"   /></td></tr>';
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td><input type="hidden"  name="grn_entry_product_detail_mother_child_type[]" id="grn_entry_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="grn_entry_product_detail_product_id[]" id="grn_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="grn_entry_product_detail_product_type[]" id="grn_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="grn_entry_product_detail_gin_detail_id[]" id="grn_entry_product_detail_gin_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="grn_entry_product_detail_product_colour_id[]" id="grn_entry_product_detail_product_colour_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="grn_entry_product_detail_product_thick[]" id="grn_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="grn_entry_product_detail_width_inches[]" id="grn_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="grn_entry_product_detail_width_mm[]" id="grn_entry_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="grn_entry_product_detail_s_width_inches[]" id="grn_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="grn_entry_product_detail_s_width_mm[]" id="grn_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="grn_entry_product_detail_s_weight_inches[]" id="grn_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetLcalc(3,'+row_cnt+')"   value="'+product_s_weight_inches+'"   /></td> <td><input class="form-control" type="text"  name="grn_entry_product_detail_s_weight_mm[]" id="grn_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetLcalc(4,'+row_cnt+')"  value="'+product_s_weight_mm+'"   /></td>';
			
			
			apnd	+= '<td style="width:10%"><input class="form-control" type="text"  name="grn_entry_product_detail_tot_feet[]" id="grn_entry_product_detail_tot_feet'+row_cnt+'" onBlur="GetTotalFeet(1,'+row_cnt+')" value="'+product_tot_feet+'" /></td> <td style="width:10%"><input class="form-control" type="text"  name="grn_entry_product_detail_tot_meter[]" id="grn_entry_product_detail_tot_meter'+row_cnt+'"  onBlur="GetTotalFeet(4,'+row_cnt+')"value="'+product_tot_meter+'" /></td></tr>';
				
			}else if(t_id == 4){
			
			apnd	+= '<tr><td><input type="hidden"  name="grn_entry_product_detail_mother_child_type[]" id="grn_entry_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_code+'</td><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="grn_entry_product_detail_product_id[]" id="grn_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="grn_entry_product_detail_product_type[]" id="grn_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="grn_entry_product_detail_gin_detail_id[]" id="grn_entry_product_detail_gin_detail_id" value="'+detail_id+'" />';
			
			
			apnd	+= '<td style="width:30%">'+product_uom+'<input type="hidden"  name="grn_entry_product_detail_product_uom_id[]" id="grn_entry_product_detail_product_uom_id'+row_cnt+'" value="'+uom_id+'"   /></td>';
			
			apnd	+= '<td style="width:40%"><input class="form-control" type="text"  name="grn_entry_product_detail_qty[]" id="grn_entry_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')" value="'+product_qty+'" /></td></tr>';
				
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

	var m_id 			= document.getElementById('grn_entry_gin_entry_id').value;
	var rp_id 			= getRawProductId();

	$.get('raw-product-detail.php',
		{m_id:m_id,rp_id:rp_id},
		function(data)  { $('#raw_product_content').html( data ); }

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

	var p		= document.getElementsByName("gin_entry_raw_product_detail_id[]");
	//alert(p.length);
	for (var r = 0; r < p.length; r++) { // alert(r);
		if (p[r].checked ==true) { //alert(x[k].value);
			var ord_id						= p[r].value;
			var detail_id 					= ord_id;
			var product_name 				= document.getElementById('raw_product_name'+ord_id).value;
			var product_id 					= document.getElementById('raw_product_id'+ord_id).value;
			var mas_product_id 				= document.getElementById('raw_mas_product_id'+ord_id).value;
			var product_code 				= document.getElementById('raw_product_code'+ord_id).value;
			var product_uom 				= document.getElementById('raw_product_uom'+ord_id).value;
			var product_colour_name			= document.getElementById('raw_product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('raw_product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('raw_product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('raw_product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
			var product_width_inches		= document.getElementById('raw_product_width_inches'+ord_id).value;
			var product_width_mm			= document.getElementById('raw_product_width_mm'+ord_id).value;
			var product_sl_feet				= document.getElementById('raw_product_sl_feet'+ord_id).value;
			var product_sl_feet_mm			= document.getElementById('raw_product_sl_feet_mm'+ord_id).value;
			
			var product_tone				= document.getElementById('raw_product_ton'+ord_id).value;
			var product_kg					= document.getElementById('raw_product_kg'+ord_id).value;
			var mother_child_type			= document.getElementById('mother_child_type'+ord_id).value;
			var apnd						= '';
			 
			apnd	+= '<tr><td><input type="hidden"  name="grn_entry_raw_product_detail_mother_child_type[]" id="grn_entry_raw_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_brand_name+'</td><td>'+product_code+'</td><td>'+product_name+'<input type="hidden"  name="grn_entry_raw_product_detail_product_id[]" id="grn_entry_raw_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="grn_entry_raw_product_detail_mas_product_id[]" id="grn_entry_raw_product_detail_mas_product_id" value="'+mas_product_id+'" /><input type="hidden"  name="grn_entry_raw_product_detail_product_type[]" id="grn_entry_raw_product_detail_product_type" value="2" /><input type="hidden"  name="grn_entry_raw_product_detail_gin_detail_id[]" id="grn_entry_raw_product_detail_gin_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="grn_entry_raw_product_detail_product_colour_id[]" id="grn_entry_raw_product_detail_product_colour_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="grn_entry_raw_product_detail_product_thick[]" id="grn_entry_raw_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="grn_entry_raw_product_detail_width_inches[]" id="grn_entry_raw_product_detail_width_inches'+row_cnt+'"  onkeyup="GetRLcalc(2,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="grn_entry_raw_product_detail_width_mm[]" id="grn_entry_raw_product_detail_width_mm'+row_cnt+'"   onBlur="GetRTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="grn_entry_raw_product_detail_sl_feet[]" id="grn_entry_raw_product_detail_sl_feet'+row_cnt+'" onBlur="GetRLcalFeet(1,'+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="grn_entry_raw_product_detail_sl_feet_mm[]" id="grn_entry_raw_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetRLcalFeet(4,'+row_cnt+')"   value="'+product_sl_feet_mm+'"   /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="grn_entry_raw_product_detail_ton[]" id="grn_entry_raw_product_detail_ton'+row_cnt+'"  onBlur="GetRRWeightClc(1,'+row_cnt+')" value="'+product_tone+'"   /></td><td><input class="form-control" type="text"  name="grn_entry_raw_product_detail_kg[]" id="grn_entry_raw_product_detail_kg'+row_cnt+'" readonly  value="'+product_kg+'"  /></td></tr>';
			//alert(apnd);
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		//GetRLcalFeet(1,row_cnt);
		$("#raw_product_detail_display" ).append(apnd);
		
		//GetRLcalFeet(1,row_cnt);
		}
	}//alert(k);
	
}	
  function GetRRWeightClc(type,id){
	var prod_ton =$('#grn_entry_raw_product_detail_ton'+id).val();
	var prod_kg =$('#grn_entry_raw_product_detail_kg'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#grn_entry_raw_product_detail_kg'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#grn_entry_raw_product_detail_ton'+id).val(prod_val);
	}
	
	
 }

function GetRLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('grn_entry_raw_product_detail_width_inches'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('grn_entry_raw_product_detail_width_mm'+id).value 			= data_t[2];
			}
		}

	);

}
function GetRLcalFeet(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_sl_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_sl_feet_mm'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('grn_entry_raw_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]);


			document.getElementById('grn_entry_raw_product_detail_sl_feet_mm'+id).value 		= data_t[3];

			//document.getElementById('grn_entry_raw_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function Getcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_width_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_width_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_width_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_width_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('grn_entry_product_detail_width_feet'+id).value 		= data_t[0];

			document.getElementById('grn_entry_product_detail_width_inches'+id).value 		= data_t[1];

			document.getElementById('grn_entry_product_detail_width_mm'+id).value 			= data_t[2];

			document.getElementById('grn_entry_product_detail_width_meter'+id).value 		= data_t[3];

		}

	);

}

function GetLcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_length_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_length_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_length_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('grn_entry_product_detail_length_feet'+id).value 		= data_t[0];

			document.getElementById('grn_entry_product_detail_length_inches'+id).value 		= data_t[1];

			document.getElementById('grn_entry_product_detail_length_mm'+id).value 			= data_t[2];

			document.getElementById('grn_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetEcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_ext_length_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('grn_entry_product_detail_ext_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('grn_entry_product_detail_ext_length_feet'+id).value 		= data_t[0];

			document.getElementById('grn_entry_product_detail_ext_length_meter'+id).value 		= data_t[3];

		}

	);

}



// Raw Material

function GetRcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_width_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_width_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_width_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_width_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('grn_entry_raw_product_detail_width_feet'+id).value 		= data_t[0];

			document.getElementById('grn_entry_raw_product_detail_width_inches'+id).value 		= data_t[1];

			document.getElementById('grn_entry_raw_product_detail_width_mm'+id).value 			= data_t[2];

			document.getElementById('grn_entry_raw_product_detail_width_meter'+id).value 		= data_t[3];

		}

	);

}

function GetRLcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_length_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_length_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_length_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('grn_entry_raw_product_detail_length_feet'+id).value 		= data_t[0];

			document.getElementById('grn_entry_raw_product_detail_length_inches'+id).value 		= data_t[1];

			document.getElementById('grn_entry_raw_product_detail_length_mm'+id).value 			= data_t[2];

			document.getElementById('grn_entry_raw_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetREcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_ext_length_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('grn_entry_raw_product_detail_ext_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('grn_entry_raw_product_detail_ext_length_feet'+id).value 		= data_t[0];

			document.getElementById('grn_entry_raw_product_detail_ext_length_meter'+id).value 		= data_t[3];

		}

	);

}



function GetcustomerDetail(){

	var cus_id 	= document.getElementById('grn_entry_customer_id').value;	

	$.get('../ajax-file/customer-detail.php',

		{cus_id:cus_id},

		function(data) { 

			var s_data	= data.split('@');

			document.getElementById('grn_entry_address').value 		= s_data[6];

			document.getElementById('grn_entry_contact_no').value 	= s_data[7];

			

		}

	);	

}

