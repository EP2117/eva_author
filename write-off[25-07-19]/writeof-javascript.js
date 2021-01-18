

  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('writeof-form').elements.length; i++) {
	  document.getElementById('writeof-form').elements[i].checked = checked;
	}
}
function requestPoFn(val){
	$.getJSON('product-detail.php?action=request_details&poid='+val,function(json) {  
		var type_id		= json[0]['damage_entry_type_id'];
		document.getElementById('write_off_type_id').value  = type_id;
		getTableHeader(type_id);
	});
 }
 function getTableHeader(id){
	//$('#product_detail >tbody >tr').remove();
	if(id ==2){
	$('.rls').show(); $('.as').hide(); 
	}else if(id==3){
	$('.rls').show(); $('.as').hide(); 
	}else if(id==1){
	$('.as').show();  $('.rls').hide(); ;
	}else{
		$('.rls').hide();
		$('.as').hide();
	}
	
}

function GetDetail(){
	var dmgmsg_Scrp_id 	= document.getElementById('dmgmsg_Scrp_id').value;
	$.get('product-detail-popup.php',
		{dmgmsg_Scrp_id:dmgmsg_Scrp_id},
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
			var product_type				= document.getElementById('product_type'+ord_id).value;
			var t_id						= document.getElementById('product_type_id'+ord_id).value;
			if(t_id!=1){ 
			var product_width_inches	= document.getElementById('product_width_inches'+ord_id).value;
			var product_width_mm		= document.getElementById('product_width_mm'+ord_id).value;
			var product_length_feet		= document.getElementById('product_length_feet'+ord_id).value;
			var product_length_mm		= document.getElementById('product_length_mm'+ord_id).value;
			var product_tone			= document.getElementById('product_tone'+ord_id).value;
			var product_kg				= document.getElementById('product_kg'+ord_id).value;
			var osf_uom_ton				= document.getElementById('osf_uom_ton'+ord_id).value;
			var product_colour_name			= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id			= document.getElementById('product_colour_id'+ord_id).value;
			var product_brand_name			= document.getElementById('brand_name'+ord_id).value;
			var product_thick_ness			= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_id		= document.getElementById('product_thick_ness_id'+ord_id).value;
			}
			var table 					= document.getElementById('product_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	
			var apnd = '';
			if(t_id!=1){ 
			apnd	+= '<tr><td>'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="writeoff_entry_product_detail_product_id[]" id="writeoff_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="writeoff_entry_product_detail_product_type[]" id="writeoff_entry_product_detail_product_type" value="2" /><input type="hidden"  name="writeoff_entry_product_detail_dm_detail_id[]" id="writeoff_entry_product_detail_dm_detail_id" value="'+ord_id+'" /><input type="hidden"  name="writeoff_entry_product_detail_osf_uom_ton[]" id="writeoff_entry_product_detail_osf_uom_ton" value="'+osf_uom_ton+'" />';
			
			apnd	+= '<td>'+product_colour_name+'<input type="hidden"  name="writeoff_entry_product_detail_product_color_id[]" id="writeoff_entry_product_detail_product_color_id" value="'+product_colour_id+'" /></td>';
			
			apnd	+= '<td>'+product_thick_ness+'<input type="hidden"  name="writeoff_entry_product_detail_product_thick[]" id="writeoff_entry_product_detail_product_thick'+row_cnt+'" value="'+product_thick_ness_id+'"   /></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="writeoff_entry_product_detail_width_inches[]" id="writeoff_entry_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')"value="'+product_width_inches+'"  /></td> <td><input class="form-control" type="text"  name="writeoff_entry_product_detail_width_mm[]" id="writeoff_entry_product_detail_width_mm'+row_cnt+'"   onBlur="GetWcalc(3,'+row_cnt+')" value="'+product_width_mm	+'"  /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="writeoff_entry_product_detail_length_feet[]" id="writeoff_entry_product_detail_length_feet'+row_cnt+'"  value="'+product_length_feet+'" onBlur="GetLcalFeet(1,'+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="writeoff_entry_product_detail_length_mm[]" id="writeoff_entry_product_detail_length_mm'+row_cnt+'" value="'+product_length_mm+'" onBlur="GetLcalFeet(3,'+row_cnt+')"    /></td>';
			
			
			apnd	+= '<td><input class="form-control" type="text"  name="writeoff_entry_product_detail_weight_tone[]" id="writeoff_entry_product_detail_weight_tone'+row_cnt+'"  onBlur="GetWeightClc(1,'+row_cnt+')" value="'+product_tone+'"   /></td><td><input class="form-control" type="text"  name="writeoff_entry_product_detail_weight_kg[]" id="writeoff_entry_product_detail_weight_kg'+row_cnt+'" readonly  value="'+product_kg+'"  onBlur="GetWeightClc(2,'+row_cnt+')" /></td></tr>';
			}else{ 
			
			apnd	+= '<tr><td style="width:30%">'+product_name+'<input type="hidden"  name="writeoff_entry_product_detail_product_id[]" id="writeoff_entry_product_detail_product_id" value="'+product_id+'" /><input type="hidden"  name="writeoff_entry_product_detail_product_type[]" id="writeoff_entry_product_detail_product_type"  value="'+product_type+'" /></td>';
			
			apnd	+= '<td style="width:30%">'+product_uom+'</td>';
			
			apnd	+= '<td style="width:40%"><input class="form-control" type="text"  name="writeoff_entry_product_detail_qty[]" id="writeoff_entry_product_detail_qty'+row_cnt+'"  onBlur="AccdiscountPerFind('+row_cnt+')"  /></td></tr>';
			
			}
			//discountPerFind(row_cnt);
		var row_cnt	= eval(row_cnt)+1;
		$("#product_detail_display" ).append(apnd);
		}
	}

}
 
 