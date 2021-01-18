checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('production_entry_list_form').elements.length; i++) {

	  document.getElementById('production_entry_list_form').elements[i].checked = checked;

	}

}

function GetDuedate(id){
	var frm_date	= document.getElementById('production_entry_work_detail_from_date'+id).value;
	var to_date		= document.getElementById('production_entry_work_detail_to_date'+id).value;
	$.get('check-code.php',
		{frm_date:frm_date,to_date:to_date},
		function(data) { document.getElementById('production_entry_work_detail_due'+id).value = data;  }
	);	
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

	var branch_id 		= document.getElementById('production_entry_branch_id').value;

	var gin_type 		= document.getElementById('production_entry_type').value;

	$.get('sales-detail.php',

		{gin_type:gin_type,branch_id:branch_id},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;

			var grn_entry_id 		= ord_id;

			var grn_entry_no 		= document.getElementById('grn_entry_no'+ord_id).value;

			var grn_entry_date 		= document.getElementById('grn_entry_date'+ord_id).value;

			var grn_entry_type 		= document.getElementById('grn_entry_type'+ord_id).value;
			
			var grn_entry_type_id 		= document.getElementById('grn_entry_type_id'+ord_id).value;
			
			var production_order_no       = document.getElementById('production_order_no'+ord_id).value;
			
			var customer_name		= document.getElementById('customer_name'+ord_id).value;

			var table 				= document.getElementById('so_detail');

			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

		"<tr><td>"+grn_entry_no+"</td><td>"+grn_entry_date+"<input type='hidden'  name='production_entry_grn_entry_id' id='production_entry_grn_entry_id' value='"+grn_entry_id+"'  class='dc_id'/><input type='hidden'  name='production_entry_type_id' id='production_entry_type_id' value='"+grn_entry_type_id+"'/></td><td>"+grn_entry_type+"</td><td>"+production_order_no+"</td><td>"+customer_name+"</td></tr>");

		getTableHeader(grn_entry_type_id);			

		}

	}

}

function GetDetail(){

	var grn_entry_id 	= document.getElementById('production_entry_grn_entry_id').value;

	var m_id 			= getQuotationId();

	$.get('product-detail.php',

		{grn_entry_id:grn_entry_id,m_id:m_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){ 

	var x		= document.getElementsByName("grn_entry_product_detail_id[]");
	for (var k = 0; k < x.length; k++) {
		if (x[k].checked ==true) {
			var ord_id 	=  x[k].value;

			var detail_id 					= ord_id;
			var grn_id 						= document.getElementById('grn_id'+ord_id).value;
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
			var mother_child_type						= document.getElementById('mother_child_type'+ord_id).value;
			
			var row_cnt     			= $('#product_detail >tbody >tr').length;	 
			var apnd = '';
			if(t_id == 1){ 
			 
			apnd	+= '<tr><td><input type="hidden"  name="production_entry_product_detail_mother_child_type[]" id="production_entry_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_code+'</td><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_entry_product_detail_product_id[]" id="production_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_entry_product_detail_product_type[]" id="production_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_entry_product_detail_grn_detail_id[]" id="production_entry_product_detail_grn_detail_id" value="'+detail_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="production_entry_product_detail_product_colour_id[]" id="production_entry_product_detail_product_colour_id'+row_cnt+'" value="'+product_colour_id+'" /> <input type="hidden"  name="production_entry_product_detail_grn_entry_id[]" id="production_entry_product_detail_grn_entry_id" value="'+grn_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="production_entry_product_detail_product_thick[]" id="production_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_product_detail_width_inches[]" id="production_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="production_entry_product_detail_width_mm[]" id="production_entry_product_detail_width_mm'+row_cnt+'"  onkeyup="GetLcalc(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_product_detail_s_width_inches[]" id="production_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="production_entry_product_detail_s_width_mm[]" id="production_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td> <input class="form-control" type="text"  name="production_entry_product_detail_sl_feet[]" id="production_entry_product_detail_sl_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="production_entry_product_detail_sl_feet_in[]" id="production_entry_product_detail_sl_feet_in'+row_cnt+'" onblur="GetLcalFeet(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_sl_feet_in+'"  /></td><td><input class="form-control" type="text"  name="production_entry_product_detail_sl_feet_mm[]" id="production_entry_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="production_entry_product_detail_sl_feet_met[]" id="production_entry_product_detail_sl_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_sl_feet_met+'"  /></td>';
			
			apnd	+= '<td> <input class="form-control" type="text"  name="production_entry_product_detail_ext_feet[]" id="production_entry_product_detail_ext_feet'+row_cnt+'" onblur="GetLcalFeet(1,'+row_cnt+')"  onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet+'"  /></td> <td><input class="form-control" type="text"  name="production_entry_product_detail_ext_feet_in[]" id="production_entry_product_detail_ext_feet_in'+row_cnt+'" onblur="GetLcalFeet(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  value="'+product_ext_feet_in+'"  /></td><td><input class="form-control" type="text"  name="production_entry_product_detail_ext_feet_mm[]" id="production_entry_product_detail_ext_feet_mm'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet_mm+'"  /></td><td><input class="form-control" type="text"  name="production_entry_product_detail_ext_feet_met[]" id="production_entry_product_detail_ext_feet_met'+row_cnt+'" onblur="GetLcalFeet(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_ext_feet_met+'"  /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_product_detail_qty[]" id="production_entry_product_detail_qty'+row_cnt+'"  value="'+product_qty+'"  onBlur="GetTotalLength('+row_cnt+'),discountPerFind('+row_cnt+');"  /></td><td><input class="form-control" type="text"  name="production_entry_product_detail_tot_length[]" id="production_entry_product_detail_tot_length'+row_cnt+'" readonly value="'+product_tot_length+'"   /></td></tr>';
			
			}else if(t_id == 2){
				
			apnd	+= '<tr><td><input type="hidden"  name="production_entry_product_detail_mother_child_type[]" id="production_entry_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_code+'</td><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_entry_product_detail_product_id[]" id="production_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_entry_product_detail_product_type[]" id="production_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_entry_product_detail_grn_detail_id[]" id="production_entry_product_detail_grn_detail_id" value="'+detail_id+'" /><input type="hidden"  name="production_entry_product_detail_grn_entry_id[]" id="production_entry_product_detail_grn_entry_id" value="'+grn_id+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="production_entry_product_detail_product_colour_id[]" id="production_entry_product_detail_product_colour_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="production_entry_product_detail_product_thick[]" id="production_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_product_detail_width_inches[]" id="production_entry_product_detail_width_inches'+row_cnt+'"  onkeyup="GetLcalc(2,'+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="production_entry_product_detail_width_mm[]" id="production_entry_product_detail_width_mm'+row_cnt+'"   onkeyup="GetLcalc(3,'+row_cnt+')" value="'+product_width_mm+'"  /></td>';
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_product_detail_s_width_inches[]" id="production_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_inches+'" /></td> <td><input class="form-control" type="text"  name="production_entry_product_detail_s_width_mm[]" id="production_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" value="'+product_s_width_mm+'" /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_product_detail_s_weight_inches[]" id="production_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetWeightPrd(1,'+row_cnt+')"   value="'+product_s_weight_inches+'"   /></td> <td><input class="form-control" type="text"  name="production_entry_product_detail_s_weight_mm[]" id="production_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetWeightPrd(2,'+row_cnt+')"  value="'+product_s_weight_mm+'"   /></td>';
			
			
			apnd	+= '<td style="width:10%"><input class="form-control" type="text"  name="production_entry_product_detail_tot_feet[]" id="production_entry_product_detail_tot_feet'+row_cnt+'" onBlur="GetTotalFeet(1,'+row_cnt+')" value="'+product_tot_feet+'" /></td> <td style="width:10%"><input class="form-control" type="text"  name="production_entry_product_detail_tot_meter[]" id="production_entry_product_detail_tot_meter'+row_cnt+'"  onBlur="GetTotalFeet(4,'+row_cnt+')"value="'+product_tot_meter+'" /></td></tr>';
				
			}else if(t_id == 4){
			
			apnd	+= '<tr><td><input type="hidden"  name="production_entry_product_detail_mother_child_type[]" id="production_entry_product_detail_mother_child_type" value="'+mother_child_type+'" />'+product_code+'</td><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_entry_product_detail_product_id[]" id="production_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_entry_product_detail_product_type[]" id="production_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="production_entry_product_detail_grn_detail_id[]" id="production_entry_product_detail_grn_detail_id" value="'+detail_id+'" /><input type="hidden"  name="production_entry_product_detail_grn_entry_id[]" id="production_entry_product_detail_grn_entry_id" value="'+grn_id+'" />';
			
			apnd	+= '<td style="width:30%">'+product_uom+'<input type="hidden"  name="production_entry_product_detail_product_uom_id[]" id="production_entry_product_detail_product_uom_id'+row_cnt+'" value="'+uom_id+'"   /><input type="hidden"  name="production_entry_product_detail_product_thick[]" id="production_entry_product_detail_product_thick'+row_cnt+'" value=""   /><input type="hidden"  name="production_entry_product_detail_tot_length[]" id="production_entry_product_detail_tot_length'+row_cnt+'" value=""   /><input type="hidden"  name="production_entry_product_detail_product_colour_id[]" id="production_entry_product_detail_product_colour_id'+row_cnt+'" value=""   /></td>';
			
			apnd	+= '<td style="width:40%"><input class="form-control" type="text"  name="production_entry_product_detail_qty[]" id="production_entry_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')" value="'+product_qty+'" /></td></tr>';
				
			}
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		$("#product_detail_display" ).append(apnd);
		}
	}

}
 function GetWeightPrd(type,id){
	var prod_ton =$('#production_entry_product_detail_s_weight_inches'+id).val();
	var prod_kg =$('#production_entry_product_detail_s_weight_mm'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#production_entry_product_detail_s_weight_mm'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#production_entry_product_detail_s_weight_inches'+id).val(prod_val);
	}
	
	
 }
 function GetTotalLength(id){
	var product_qty 	= document.getElementById('production_entry_product_detail_qty'+id).value;
	var sales_width 	= document.getElementById('production_entry_product_detail_s_width_inches'+id).value;
	var sales_length_f 	= document.getElementById('production_entry_product_detail_sl_feet'+id).value;
	var sales_length_i 	= document.getElementById('production_entry_product_detail_sl_feet_in'+id).value;
	var sales_length_ef 	= document.getElementById('production_entry_product_detail_ext_feet'+id).value;
	var sales_length_ei 	= document.getElementById('production_entry_product_detail_ext_feet_in'+id).value;
	
	var sales_length	= Number(sales_length_f)+Number(sales_length_i)+Number(sales_length_ef)+Number(sales_length_ei);
	var width 			= document.getElementById('production_entry_product_detail_width_inches'+id).value;
	
	var sales_width_val 		= (isNaN(parseFloat(sales_width))? 0.00 : parseFloat(sales_width));
	var sales_length_val 		= (isNaN(parseFloat(sales_length))? 0.00 : parseFloat(sales_length));
	var width_val 				= (isNaN(parseFloat(width))? 0.00 : parseFloat(width));
	var product_qty 			= (isNaN(parseFloat(product_qty))? 0.00 : parseFloat(product_qty));
	var total_length			= ((sales_width_val * sales_length_val ) / width_val)*product_qty;
	
	var total_length_val 		= (isNaN(parseFloat(total_length))? 0.00 : parseFloat(total_length));
	
	document.getElementById('production_entry_product_detail_tot_length'+id).value = (total_length_val).toFixed(2);
	//document.getElementById('production_entry_product_detail_inv_tot_length'+id).value = total_length_val.toFixed(2);
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

	var m_id 	= document.getElementById('production_entry_grn_entry_id').value;

	$.get('raw-product-detail.php', {m_id:m_id}, 
	function(data) { $('#raw_product_content').html( data ); } 
	);	
}

function AddRawproductDetail(){ 

	var x		= document.getElementsByName("grn_entry_raw_product_detail_id[]");
	
	for (var k = 0; k < x.length; k++) {
		if (x[k].checked ==true) {
			var ord_id 	=  x[k].value;
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
			
			var product_osf_ton				= document.getElementById('product_osf_ton'+ord_id).value;
			var product_tone				= document.getElementById('raw_product_ton'+ord_id).value;
			var product_kg					= document.getElementById('raw_product_kg'+ord_id).value; 
			var mother_child_type					= document.getElementById('mother_child_type'+ord_id).value; 
			//var product_sl_feet				= document.getElementById('production_entry_product_detail_tot_length0').value;
			var product_sl_feet				= 0;
			var u = document.getElementsByName("production_entry_product_detail_product_id"+ord_id);
			
			for(g=0;g<u.length;g++){
				var p_product_thick					= document.getElementById('production_entry_product_detail_product_thick'+g).value;
				
				var p_product_colour				= document.getElementById('production_entry_product_detail_product_colour_id'+g).value;
			
				//alert(p_product_thick);
				//alert(product_thick_ness_id);
				//alert(p_product_colour);
				//alert(product_colour_id);
				if((p_product_thick == product_thick_ness_id) && (p_product_colour == product_colour_id)){
					 product_sl_feet				= eval(product_sl_feet)+eval(document.getElementById('production_entry_product_detail_tot_length'+g).value);	
				}
			}
			
			
			var apnd		= '';
			
			var row_cnt     = $('#raw_product_detail >tbody >tr').length+1;	 
			
			//<td>'+product_code+'</td>
			apnd	+= '<tr><td><input type="hidden"  name="production_entry_raw_product_detail_mother_child_type[]" id="production_entry_raw_product_detail_mother_child_type'+row_cnt+'" value="'+mother_child_type+'" />'+product_brand_name+'</td><td>'+product_code+'</td><td>'+product_name+'<input type="hidden"  name="production_entry_raw_product_detail_product_id[]" id="production_entry_raw_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_entry_raw_product_detail_mas_product_id[]" id="production_entry_raw_product_detail_mas_product_id" value="'+mas_product_id+'" /><input type="hidden"  name="production_entry_raw_product_detail_product_type[]" id="production_entry_raw_product_detail_product_type" value="2" /><input type="hidden"  name="production_entry_raw_product_detail_grn_detail_id[]" id="production_entry_raw_product_detail_grn_detail_id" value="'+detail_id+'" /><input type="hidden"  name="production_entry_raw_product_detail_osf_ton[]" id="production_entry_raw_product_detail_osf_ton'+row_cnt+'" value="'+product_osf_ton+'" /></td>';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="production_entry_raw_product_detail_product_colour_id[]" id="production_entry_raw_product_detail_product_colour_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="production_entry_raw_product_detail_product_thick[]" id="production_entry_raw_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_raw_product_detail_width_inches[]" id="production_entry_raw_product_detail_width_inches'+row_cnt+'"  onkeyup="GetRLcalc(2,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')" value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="production_entry_raw_product_detail_width_mm[]" id="production_entry_raw_product_detail_width_mm'+row_cnt+'"   onBlur="GetRTotalLength('+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_raw_product_detail_sl_feet[]" id="production_entry_raw_product_detail_sl_feet'+row_cnt+'" onblur="GetRLcalFeet(1,'+row_cnt+')" value="'+product_sl_feet+'"  /></td> <td><input class="form-control" type="text"  name="production_entry_raw_product_detail_sl_feet_mm[]" id="production_entry_raw_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetRLcalFeet(4,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')"  value="'+product_sl_feet_mm+'"   /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_raw_product_detail_ton[]" id="production_entry_raw_product_detail_ton'+row_cnt+'"  onBlur="GetRRWeightClc(1,'+row_cnt+')" value="'+product_tone+'" readonly   /></td><td><input class="form-control" type="text"  name="production_entry_raw_product_detail_kg[]" id="production_entry_raw_product_detail_kg'+row_cnt+'" readonly  value="'+product_kg+'" readonly /></td></tr>';
			
			//discountPerFind(row_cnt);
		
		$("#raw_product_detail_display" ).append(apnd);
		GetRLcalFeet(1,row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		}
	}

}	
 function GetRRWeightClc(type,id){ 
	var prod_ton =$('#production_entry_raw_product_detail_ton'+id).val();
	var prod_kg =$('#production_entry_raw_product_detail_kg'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#production_entry_raw_product_detail_kg'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#production_entry_raw_product_detail_ton'+id).val(prod_val);
	}
 }

function GetRLcalS(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_s_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_s_width_mm'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('production_entry_raw_product_detail_s_width_inches'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('production_entry_raw_product_detail_s_width_mm'+id).value 			= data_t[2];
			}
		}

	);

}
function GetRLcalFeet(calculation_id,id){
	var osf_ton				= document.getElementById('production_entry_raw_product_detail_osf_ton'+id).value;

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_sl_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_sl_feet_mm'+id).value;	

	}


	$.get( "../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_entry_raw_product_detail_sl_feet'+id).value 	    = parseFloat(data_t[0]);


			document.getElementById('production_entry_raw_product_detail_sl_feet_mm'+id).value 		= data_t[3];
			
			document.getElementById('production_entry_raw_product_detail_ton'+id).value 			= eval(osf_ton)*eval(data_t[0]);

			//document.getElementById('production_entry_raw_product_detail_length_meter'+id).value 	= data_t[3];
			GetRRWeightClc(1,id);
		}

	);

}
function Getcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_entry_product_detail_width_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('production_entry_product_detail_width_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('production_entry_product_detail_width_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_entry_product_detail_width_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_entry_product_detail_width_feet'+id).value 		= data_t[0];

			document.getElementById('production_entry_product_detail_width_inches'+id).value 		= data_t[1];

			document.getElementById('production_entry_product_detail_width_mm'+id).value 			= data_t[2];

			document.getElementById('production_entry_product_detail_width_meter'+id).value 		= data_t[3];

		}

	);

}

function GetLcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_entry_product_detail_length_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('production_entry_product_detail_length_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('production_entry_product_detail_length_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_entry_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_entry_product_detail_length_feet'+id).value 		= data_t[0];

			document.getElementById('production_entry_product_detail_length_inches'+id).value 		= data_t[1];

			document.getElementById('production_entry_product_detail_length_mm'+id).value 			= data_t[2];

			document.getElementById('production_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetEcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_entry_product_detail_ext_length_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_entry_product_detail_ext_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_entry_product_detail_ext_length_feet'+id).value 		= data_t[0];

			document.getElementById('production_entry_product_detail_ext_length_meter'+id).value 		= data_t[3];

		}

	);

}



// Raw Material

function GetRcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_width_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_width_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_width_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_width_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_entry_raw_product_detail_width_feet'+id).value 		= data_t[0];

			document.getElementById('production_entry_raw_product_detail_width_inches'+id).value 		= data_t[1];

			document.getElementById('production_entry_raw_product_detail_width_mm'+id).value 			= data_t[2];

			document.getElementById('production_entry_raw_product_detail_width_meter'+id).value 		= data_t[3];

		}

	);

}

function GetRLcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_length_feet'+id).value;	

	}

	else if(calculation_id==2){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_length_inches'+id).value;	

	}

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_length_mm'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_entry_raw_product_detail_length_feet'+id).value 		= data_t[0];

			document.getElementById('production_entry_raw_product_detail_length_inches'+id).value 		= data_t[1];

			document.getElementById('production_entry_raw_product_detail_length_mm'+id).value 			= data_t[2];

			document.getElementById('production_entry_raw_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetREcalc(calculation_id,id){

	if(calculation_id==1){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_ext_length_feet'+id).value;	

	}

	else if(calculation_id==4){

		var calc_amount 	= document.getElementById('production_entry_raw_product_detail_ext_length_meter'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			document.getElementById('production_entry_raw_product_detail_ext_length_feet'+id).value 		= data_t[0];

			document.getElementById('production_entry_raw_product_detail_ext_length_meter'+id).value 		= data_t[3];

		}

	);

}



function GetcustomerDetail(){

	var cus_id 	= document.getElementById('production_entry_customer_id').value;	

	$.get('../ajax-file/customer-detail.php',

		{cus_id:cus_id},

		function(data) { 

			var s_data	= data.split('@');

			document.getElementById('production_entry_address').value 		= s_data[6];

			document.getElementById('production_entry_contact_no').value 	= s_data[7];

			

		}

	);	

}





function GetDamDetail(){

	var m_id 	= document.getElementById('production_entry_grn_entry_id').value;

	$.get('dam-product-detail.php',

		{m_id:m_id},

		function(data) { $('#dam_product_content').html( data ); }

	);	

}

function AddDamproductDetail(){

	var x		= document.getElementsByName("dam_grn_entry_raw_product_detail_id[]");
	for (var k = 0; k < x.length; k++) {
		if (x[k].checked ==true) {
			var ord_id 	=  x[k].value;

			var detail_id 					= ord_id;
			var product_name 				= document.getElementById('dam_product_name'+ord_id).value;
			var product_id 					= document.getElementById('dam_product_id'+ord_id).value;
			var product_code 				= document.getElementById('dam_product_code'+ord_id).value;
			var product_uom 				= document.getElementById('dam_product_uom'+ord_id).value;
			var product_colour_name			= document.getElementById('dam_product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('dam_product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('dam_product_brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('dam_product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('dam_product_thick_ness_id'+ord_id).value;
			var product_osf_ton				= document.getElementById('product_osf_ton'+ord_id).value;


			var table 					= document.getElementById('dam_product_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	

			var apnd					= '';
			 
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="production_entry_dam_product_detail_product_id[]" id="production_entry_dam_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="production_entry_dam_product_detail_product_type[]" id="production_entry_dam_product_detail_product_type" value="2" /><input type="hidden"  name="production_entry_dam_product_detail_grn_detail_id[]" id="production_entry_dam_product_detail_grn_detail_id" value="'+detail_id+'" /><input type="hidden"  name="production_entry_dam_product_detail_grn_detail_id[]" id="production_entry_dam_product_detail_product_osf_ton'+row_cnt+'" value="'+product_osf_ton+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="production_entry_dam_product_detail_product_colour_id[]" id="production_entry_dam_product_detail_product_colour_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="production_entry_dam_product_detail_product_thick[]" id="production_entry_dam_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_dam_product_detail_width_inches[]" id="production_entry_dam_product_detail_width_inches'+row_cnt+'"  onblur="GetDcalc(2,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')" value=""  /></td> <td><input class="form-control" type="text"  name="production_entry_dam_product_detail_width_mm[]" id="production_entry_dam_product_detail_width_mm'+row_cnt+'"   onblur="GetDcalc(3,'+row_cnt+')" value=""  /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_dam_product_detail_sl_feet[]" id="production_entry_dam_product_detail_sl_feet'+row_cnt+'" onblur="GetDLcalc(1,'+row_cnt+')"  onBlur="GetRTotalLength('+row_cnt+')" value=""  /></td> <td><input class="form-control" type="text"  name="production_entry_dam_product_detail_sl_feet_mm[]" id="production_entry_dam_product_detail_sl_feet_mm'+row_cnt+'" onblur="GetDLcalc(3,'+row_cnt+')" onBlur="GetRTotalLength('+row_cnt+')"  value=""   /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="production_entry_dam_product_detail_ton[]" id="production_entry_dam_product_detail_ton'+row_cnt+'"  onBlur="GetWeightClc(1,'+row_cnt+')" value=""  readonly	  /></td><td><input class="form-control" type="text"  name="production_entry_dam_product_detail_kg[]" id="production_entry_dam_product_detail_kg'+row_cnt+'" readonly  value=""  /></td></tr>';
		var row_cnt	= eval(row_cnt)+1;
		$("#dam_product_detail_display" ).append(apnd);
		}

	}

}

// Dam Material

function GetDcalc(calculation_id,id){

	if(calculation_id==2){

		var calc_amount 	= document.getElementById('production_entry_dam_product_detail_width_inches'+id).value;	

	}

	

	else if(calculation_id==3){

		var calc_amount 	= document.getElementById('production_entry_dam_product_detail_width_mm'+id).value;	

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('production_entry_dam_product_detail_width_inches'+id).value 		= data_t[1];
			}
			else if(calculation_id==2){
			document.getElementById('production_entry_dam_product_detail_width_mm'+id).value 		= data_t[2];
			}
		}

	);

}

function GetDLcalc(calculation_id,id){
	var product_osf_ton 	= document.getElementById('production_entry_dam_product_detail_product_osf_ton'+id).value;
	if(calculation_id==1){
		var calc_amount 	= document.getElementById('production_entry_dam_product_detail_sl_feet'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('production_entry_dam_product_detail_sl_feet_mm'+id).value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			//alert(data_t)
			document.getElementById('production_entry_dam_product_detail_sl_feet'+id).value 		= data_t[0];
			document.getElementById('production_entry_dam_product_detail_sl_feet_mm'+id).value 		= data_t[2];
			document.getElementById('production_entry_dam_product_detail_ton'+id).value 		= (eval(data_t[0])*eval(product_osf_ton));
			GetWeightClc(1,id)
		}

	);

}

 function GetWeightClc(type,id){
	var prod_ton =$('#production_entry_dam_product_detail_ton'+id).val();
	var prod_kg =$('#production_entry_dam_product_detail_kg'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#production_entry_dam_product_detail_kg'+id).val(prod_val).toFixed(2)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#production_entry_dam_product_detail_ton'+id).val(prod_val).toFixed(2);
	}
	
	
 }


function GetMachine(id){

	var section_id 	= document.getElementById('production_entry_work_detail_production_section_id'+id).value;	

	$.get('machine-detail.php',

		{section_id:section_id,id:id},

		function(data) { $('#machine_content'+id).html( data ); $(".select2").select2(); }

	);	

}

function vendorFn(val,obj){
	if(val==1){
		$("#vendr_id").hide();
	}else{
		$("#vendr_id").show();
	}
}


