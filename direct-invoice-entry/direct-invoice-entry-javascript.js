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
			
			var product_extra_length 	= table.$("#product_extra_length"+ord_id).val();
			var product_detail_raw_product_id1 	= table.$("#product_detail_raw_product_id1"+ord_id).val();
			
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
			var product_is_opp = table.$("#product_is_opp"+ord_id).val();
			var product_opp_feet_per_qty = table.$("#product_opp_feet_per_qty"+ord_id).val();
			
			var product_category_id  = table.$("#product_category_id"+ord_id).val();
			
			var row_cnt_rls     			= $('#product_detail_rls >tbody >tr').length;	
			var row_cnt_rws     			= $('#product_detail_rws >tbody >tr').length;	
			var row_cnt_as     			= $('#product_detail_as >tbody >tr').length;	
			var row_cnt					= eval(row_cnt_rls)+eval(row_cnt_rws)+eval(row_cnt_as)+1;
			var count_product_id 	     = table.$("#count_product_id"+ord_id).val(); 
			for(var kk=1;kk<=count_product_id;kk++){
				var apnd					='';
				if(t_id == 1){
				 
				apnd	+= '<tr><td><input type="hidden"  name="invoice_entry_product_category_id[]" id="invoice_entry_product_category_id" value="'+product_category_id+'" /><input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id" value="" /><input type="hidden"  name="invoice_entry_product_is_opp[]" id="invoice_entry_product_is_opp'+row_cnt+'" value="0" /><input type="hidden"  name="invoice_entry_product_opp_feet_per_qty[]" id="invoice_entry_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input type="hidden"  name="invoice_entry_product_detail_sale_by[]" id="invoice_entry_product_detail_sale_by'+row_cnt+'" value="" /><input type="hidden"  name="invoice_entry_product_extra_length[]" id="invoice_entry_product_extra_length'+row_cnt+'" value="'+product_extra_length+'" /><input type="hidden"  name="invoice_entry_product_detail_raw_product_id1[]" id="invoice_entry_product_detail_raw_product_id1'+row_cnt+'" value="'+product_detail_raw_product_id1+'" /><input type="hidden"  name="invoice_entry_product_detail_mother_child_type[]" id="invoice_entry_product_detail_mother_child_type'+row_cnt+'" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id'+row_cnt+'" value="'+product_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_brand_id[]" id="invoice_entry_product_detail_product_brand_id'+row_cnt+'" value="'+product_brand_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type" value="1" /></td>';
				
			apnd	+= '<td><select  name="invoice_entry_product_detail_product_color_id[]" id="invoice_entry_product_detail_product_color_id'+row_cnt+'" onfocus="get_color('+row_cnt+',1);"><option value=""> --Select-- </option></select><input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td><select  name="invoice_entry_product_detail_product_thick[]" id="invoice_entry_product_detail_product_thick'+row_cnt+'" onfocus="get_color('+row_cnt+',2);"><option value=""> --Select-- </option></select></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches'+row_cnt+'"   onBlur="GetTotalLength('+row_cnt+'),GetWcalc(2,'+row_cnt+')" value="36"  style="width:70px;" /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm'+row_cnt+'"  onBlur="GetTotalLength('+row_cnt+'),GetWcalc(3,'+row_cnt+')" value="'+product_inches_mm+'"  /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" style="width:70px;" /></td>';
			/* apnd += '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" style="width:70px;" /></td>'; */
			
			apnd += '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" style="width:70px;" readonly /></td>';
				
				/* apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches'+row_cnt+'"   onBlur="GetTotalLength('+row_cnt+'),GetWcalc(2,'+row_cnt+')" value="36"  /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm'+row_cnt+'"  onBlur="GetTotalLength('+row_cnt+'),GetWcalc(3,'+row_cnt+')" value="'+product_inches_mm+'"  /><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>'; */
				
				//added by AuthorsMM
				apnd += '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_sale_length[]" id="invoice_entry_product_detail_sale_length'+row_cnt+'" onkeyup="" onBlur="changeSaleLength('+row_cnt+')"  style="width:90px;" />'; // Removed </td> by EP for sale length hiding
				//END
				
				//sale length textboxes
				/*apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet'+row_cnt+'"  style="width:80px;" readonly /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in'+row_cnt+'" style="width:70px;" readonly /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm'+row_cnt+'" style="width:80px;" readonly /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_sl_feet_met[]" id="invoice_entry_product_detail_sl_feet_met'+row_cnt+'" style="width:80px;" readonly />';*/
				//end sale length textboxes
				
				//sale length hidden boxes
				apnd	+= '<input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet'+row_cnt+'"  style="width:80px;"  /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in'+row_cnt+'" style="width:70px;" /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm'+row_cnt+'" style="width:80px;" /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_met[]" id="invoice_entry_product_detail_sl_feet_met'+row_cnt+'" style="width:80px;" />';
				//end sale length hidden boxes
				
				apnd += '<input type="hidden"  name="invoice_entry_product_detail_s_weight_inches[]" id="invoice_entry_product_detail_s_weight_inches'+row_cnt+'" /><input type="hidden"  name="invoice_entry_product_detail_s_weight_mm[]" id="invoice_entry_product_detail_s_weight_mm'+row_cnt+'"  /></td>';
				
				apnd	+= '<td><input class="form-control" type="text"  style="width:60px;" name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'" onBlur="GetTotalLength('+row_cnt+')"  onBlur="GetTotalLength(3,'+row_cnt+'),discountPerFind('+row_cnt+');"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_tot_length[]" id="invoice_entry_product_detail_tot_length'+row_cnt+'" style="width:90px;" readonly  /> <input type="hidden"  name="invoice_entry_product_detail_inv_tot_length[]" id="invoice_entry_product_detail_inv_tot_length'+row_cnt+'" readonly  /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate'+row_cnt+'"   onBlur="discountPerFind('+row_cnt+')" style="width:90px;"/></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total'+row_cnt+'" style="width:100px;"  readonly /></td></tr>';
			$("#product_detail_rls_display").append(apnd);	
				get_color(row_cnt,1);
				get_color(row_cnt,2);
				GetWcalc(2,row_cnt);
				
				}else if(t_id == 2){
					
				apnd	+= '<tr><td><input type="hidden"  name="invoice_entry_product_category_id[]" id="invoice_entry_product_category_id" value="'+product_category_id+'" /><input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id" value="" /><input type="hidden"  name="invoice_entry_product_is_opp[]" id="invoice_entry_product_is_opp'+row_cnt+'" value="0" /><input type="hidden"  name="invoice_entry_product_opp_feet_per_qty[]" id="invoice_entry_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><input type="hidden"  name="invoice_entry_product_detail_sale_by[]" id="invoice_entry_product_detail_sale_by'+row_cnt+'" value="" /><input type="hidden"  name="invoice_entry_product_extra_length[]" id="invoice_entry_product_extra_length'+row_cnt+'" value="'+product_extra_length+'" /><input type="hidden"  name="invoice_entry_product_detail_raw_product_id1[]" id="invoice_entry_product_detail_raw_product_id1'+row_cnt+'" value="'+product_detail_raw_product_id1+'" /><input type="hidden"  name="invoice_entry_product_detail_mother_child_type[]" id="invoice_entry_product_detail_mother_child_type'+row_cnt+'" value="'+product_mother_child_type+'" />'+product_brand_name+'</td><td>'+product_name+'<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id'+row_cnt+'" value="'+product_id+'" /><input type="hidden"  name="invoice_entry_product_detail_mas_product_id[]" id="invoice_entry_product_detail_mas_product_id'+row_cnt+'" value="'+mas_product_id+'" /> <input type="hidden"  name="invoice_entry_product_detail_product_brand_id[]" id="invoice_entry_product_detail_product_brand_id'+row_cnt+'" value="'+product_brand_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type" value="'+product_type+'" /><input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type" value="2" /></td>';
				
			apnd	+= '<td><select  name="invoice_entry_product_detail_product_color_id[]" id="invoice_entry_product_detail_product_color_id'+row_cnt+'" onfocus="get_color('+row_cnt+',1);"><option value=""> --Select-- </option></select><input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
			
			apnd	+= '<td><select  name="invoice_entry_product_detail_product_thick[]" id="invoice_entry_product_detail_product_thick'+row_cnt+'" onfocus="get_color('+row_cnt+',2);"><option value=""> --Select-- </option></select></td>';
			
			apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value="36"  /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm'+row_cnt+'"   onBlur="GetWcalc(3,'+row_cnt+')" value="'+product_inches_mm+'"  /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>';
			/* apnd += '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')"  /></td>'; */
			
			apnd += '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" readonly /></td>';
				
				/* apnd	+= '<td><input class="form-control" type="hidden"  name="invoice_entry_product_detail_width_inches[]" id="invoice_entry_product_detail_width_inches'+row_cnt+'"  onBlur="GetWcalc(2,'+row_cnt+')" value="36"  /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_width_mm[]" id="invoice_entry_product_detail_width_mm'+row_cnt+'"   onBlur="GetWcalc(3,'+row_cnt+')" value="'+product_inches_mm+'"  /><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_inches[]" id="invoice_entry_product_detail_s_width_inches'+row_cnt+'"   onkeyup="GetLcalS(2,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_width_mm[]" id="invoice_entry_product_detail_s_width_mm'+row_cnt+'" onkeyup="GetLcalS(3,'+row_cnt+')" onBlur="GetTotalLength('+row_cnt+')" /></td>'; */
				
				apnd	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_inches[]" id="invoice_entry_product_detail_s_weight_inches'+row_cnt+'"  onblur="GetWeightClc(1,'+row_cnt+');RawdiscountPerFind('+row_cnt+');GetLcalFeet(9,'+row_cnt+')"  /></td> <td><input class="form-control" type="text"  name="invoice_entry_product_detail_s_weight_mm[]" id="invoice_entry_product_detail_s_weight_mm'+row_cnt+'"  onblur="GetWeightClc(2,'+row_cnt+')" /><input type="hidden"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'"   /></td><td><input type="text" class="form-control" name="invoice_entry_product_detail_s_weight_met[]" id="invoice_entry_product_detail_s_weight_met'+row_cnt+'"/></td>';
				
				apnd	+= '</td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate'+row_cnt+'" onBlur="RawdiscountPerFind('+row_cnt+')"   /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total'+row_cnt+'"  /> <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_mm[]" id="invoice_entry_product_detail_sl_feet_mm'+row_cnt+'"  /><input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_met[]" id="invoice_entry_product_detail_sl_feet_met'+row_cnt+'"  /> <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet[]" id="invoice_entry_product_detail_sl_feet'+row_cnt+'"  /> <input class="form-control" type="hidden"  name="invoice_entry_product_detail_sl_feet_in[]" id="invoice_entry_product_detail_sl_feet_in'+row_cnt+'" /></td></tr>';	
					
			$("#product_detail_rws_display").append(apnd);
				get_color(row_cnt,1);
				get_color(row_cnt,2);
				GetWcalc(2,row_cnt);
				}else{ 
				
				apnd	+= '<tr><td><input type="hidden"  name="invoice_entry_product_category_id[]" id="invoice_entry_product_category_id" value="'+product_category_id+'" /><input type="hidden"  name="invoice_entry_product_detail_id[]" id="invoice_entry_product_detail_id" value="" /><input type="hidden"  name="invoice_entry_product_extra_length[]" id="invoice_entry_product_extra_length'+row_cnt+'" value="'+product_extra_length+'" /><input type="hidden"  name="invoice_entry_product_detail_raw_product_id1[]" id="invoice_entry_product_detail_raw_product_id1'+row_cnt+'" value="'+product_detail_raw_product_id1+'" /><input type="hidden"  name="invoice_entry_product_detail_mother_child_type[]" id="invoice_entry_product_detail_mother_child_type'+row_cnt+'" value="'+product_mother_child_type+'" />'+product_name+'<input type="hidden"  name="invoice_entry_product_detail_product_id[]" id="invoice_entry_product_detail_product_id'+row_cnt+'" value="'+product_id+'" /><input type="hidden"  name="invoice_entry_product_detail_product_type[]" id="invoice_entry_product_detail_product_type"  value="'+product_type+'" /><input type="hidden"  name="invoice_entry_product_detail_entry_type[]" id="invoice_entry_product_detail_entry_type" value="4" /></td>';
				
				apnd	+= '<td>'+product_uom_name+'<input type="hidden"  name="invoice_entry_product_detail_product_uom_id[]" id="invoice_entry_product_detail_product_uom_id'+row_cnt+'" value="'+product_uom_id+'"   /></td>';
				
				if(product_is_opp == '1') {
					apnd	+= '<td><input type="hidden"  name="invoice_entry_product_is_opp[]" id="invoice_entry_product_is_opp'+row_cnt+'" value="'+product_is_opp+'" /><input type="hidden"  name="invoice_entry_product_opp_feet_per_qty[]" id="invoice_entry_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><select  name="invoice_entry_product_detail_sale_by[]" id="invoice_entry_product_detail_sale_by'+row_cnt+'" class="form-control" style="width:30%;display:inline-block" ><option value="qty">QTY</option><option value="feet">FEET</option></select>&nbsp;&nbsp;&nbsp;<input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'" style="width:60%;display:inline-block" onBlur="AccdiscountPerFind('+row_cnt+')"  /></td>';
				} else {
					apnd	+= '<td><input type="hidden"  name="invoice_entry_product_is_opp[]" id="invoice_entry_product_is_opp'+row_cnt+'" value="0" /><input type="hidden"  name="invoice_entry_product_opp_feet_per_qty[]" id="invoice_entry_product_opp_feet_per_qty'+row_cnt+'" value="'+product_opp_feet_per_qty+'" /><select  name="invoice_entry_product_detail_sale_by[]" id="invoice_entry_product_detail_sale_by'+row_cnt+'" class="form-control" style="width:30%;display:inline-block" ><option value="qty">QTY</option></select>&nbsp;&nbsp;&nbsp;<input class="form-control" type="text"  name="invoice_entry_product_detail_qty[]" id="invoice_entry_product_detail_qty'+row_cnt+'" style="width:60%;display:inline-block" onBlur="AccdiscountPerFind('+row_cnt+')"  /></td>';
				}
				
				
				apnd 	+= '<td><input class="form-control" type="text"  name="invoice_entry_product_detail_rate[]" id="invoice_entry_product_detail_rate'+row_cnt+'" onBlur="AccdiscountPerFind('+row_cnt+')"   /></td><td><input class="form-control" type="text"  name="invoice_entry_product_detail_total[]" id="invoice_entry_product_detail_total'+row_cnt+'"   /></td></tr>';
			$("#product_detail_as_display").append(apnd);	
				}
				
			
			row_cnt=Number(row_cnt)+1;	
			}	
			
				
		

	}); 

}
function get_color(id,type){
	if(type==1){
		//added condition by AuthorsMM
		if(document.getElementById('invoice_entry_product_detail_product_color_id'+id).value == "") {
			$.get('get_color.php',{type:type},function(data){$('#invoice_entry_product_detail_product_color_id'+id).html(data)});
		}
	}else{
		//added condition by AuthorsMM
		if(document.getElementById('invoice_entry_product_detail_product_color_id'+id).value == "") {
			$.get('get_color.php',{type:type},function(data){$('#invoice_entry_product_detail_product_thick'+id).html(data)});
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
	/* if($("#invoice_entry_product_detail_sale_by"+id).val() == 'qty') {
		var product_qty 		= document.getElementById('invoice_entry_product_detail_qty'+id).value;
	} else {
		var product_qty 		= document.getElementById('invoice_entry_product_detail_qty'+id).value/document.getElementById('invoice_entry_product_opp_feet_per_qty'+id).value;
	} */

	var product_qty 		= document.getElementById('invoice_entry_product_detail_qty'+id).value;
	var product_price		= document.getElementById('invoice_entry_product_detail_rate'+id).value;
	if(product_qty == '' || product_qty == ' ') {
		product_qty = 0;
	}
	var product_qty 		= (isNaN(product_qty)? 0.00 : parseFloat(product_qty));
	var product_price 		= (isNaN(product_price)? 0.00 : parseFloat(product_price));
	var product_amount  	= parseFloat(product_qty) * parseFloat(product_price);
	var product_amount 		= (isNaN(product_amount)? 0.00 :parseFloat(product_amount).toFixed(0));
	document.getElementById('invoice_entry_product_detail_total'+id).value =  parseFloat(product_amount).toFixed(0);

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
	document.getElementById('invoice_entry_product_detail_total'+id).value =  parseFloat(product_amount).toFixed(0);

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

	//document.getElementById('invoice_entry_gross_amount').value 	= parseFloat(gross_amount).toFixed(0);
	document.getElementById('invoice_entry_gross_amount').value 	= number_format(gross_amount, 0, '.', ',')
	var dis_per					= Number(document.getElementById('invoice_entry_dis_per').value);
	if(dis_per!='' && dis_per>0){
		var dis_amount				= (dis_per*gross_amount)/100;
		document.getElementById('invoice_entry_dis_amount').value 	= dis_amount.toFixed(0);
	}
	else{
		var dis_amount				= document.getElementById('invoice_entry_dis_amount').value;
	}
	
	if(dis_amount == "" || dis_amount <= 0) {
		dis_amount = 0;
	}

	if(document.getElementById('invoice_entry_transport_amount').value!='' && document.getElementById('invoice_entry_transport_amount').value>0){
		var transport_amount		= document.getElementById('invoice_entry_transport_amount').value;
	} else {
			var transport_amount = 0;
	}

	var tax_per					= document.getElementById('invoice_entry_tax_per').value;
	
	if(document.getElementById('invoice_entry_advance_amount').value!='' && document.getElementById('invoice_entry_advance_amount').value>0){

		var advance_amount			= document.getElementById('invoice_entry_advance_amount').value;
	} else {
		var advance_amount = 0;
	}



	var transport_amount 		= Number(transport_amount);

	var tax_per 				= Number(tax_per);

	var advance_amount 			= Number(advance_amount);

	//var tax_amount				= (tax_per*gross_amount)/100;
	
	//var tax_amount				= (gross_amount/tax_per);
	if(document.getElementById('invoice_entry_tax_amount').value!='' && document.getElementById('invoice_entry_tax_amount').value>0){
	
			var tax_amount = document.getElementById('invoice_entry_tax_amount').value;
	}else {
		var tax_amount = 0;
	}
	var tax_amount 				= Number(tax_amount);

	 //document.getElementById('invoice_entry_tax_amount').value	= tax_amount.toFixed(0);
	// document.getElementById('invoice_entry_tax_amount').value	= number_format(tax_amount, 0, '.', ',');

	//var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount);
	
	
	
	//var net_amount				= parseFloat(transport_amount)+parseFloat(gross_amount)+parseFloat(tax_amount);
	//var total_amount			= (parseFloat(tax_amount)+parseFloat(transport_amount)+parseFloat(gross_amount))-parseFloat(dis_amount);
	//remove tax calculation in total amount by ep
	var total_amount			= (parseFloat(transport_amount)+parseFloat(gross_amount))-parseFloat(dis_amount);
	
	//document.getElementById('invoice_entry_total_amount').value	=Math.round(total_amount);
	document.getElementById('invoice_entry_total_amount').value	=number_format(total_amount, 0, '.', ',');
	
	//alert(parseFloat(advance_amount)+parseFloat(dis_amount));
	var net_amount				= parseFloat(total_amount)-(parseFloat(advance_amount));

	

	//document.getElementById('invoice_entry_net_amount').value 	= net_amount.toFixed(0);
	document.getElementById('invoice_entry_net_amount').value 	= number_format(net_amount, 0, '.', ',');

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

function changeSaleLength(id) {
	var sale_length = document.getElementById('invoice_entry_product_detail_sale_length'+id).value;
	var mm_patt = /^\d+\.?\d*?mm$/i;
	var m_patt = /^\d+\.?\d*?m$/i;
	var ftin_patt = /^\d+\'\d+\"$/i;
	var ft_patt = /^\d+\'$/i;
	var in_patt = /^\d+\"$/i;
	/* var mm_patt = /^\d+\.?\d+?mm$/i;
	var m_patt = /^\d+\.?\d+?m$/i;
	var ftin_patt = /^\d+\.?\d+?\'\d+\.?\d+?\"$/i;
	var ft_patt = /^\d+\.?\d+?'$/i;
	var in_patt = /^\d+\.?\d+?"$/i; */
	//remove space from value
	sale_length = sale_length.replace(/\s/g, '');
	sale_length = sale_length.replace('"','\"');
	sale_length = sale_length.replace("'","\'");
	if(sale_length.match(mm_patt) && sale_length.match(mm_patt).length == 1) {
		//Length in MM 
		sale_length_val = sale_length.toLowerCase();
		sale_length_val = sale_length_val.replace('mm','');
		val_arr = sale_length_val.split('.');
		if(val_arr.length <= 1){
		sale_length_val = val_arr[0];	
				
		}
		document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value = sale_length_val;
		GetSLCal_length(3,id);
	}
	else if(sale_length.match(m_patt) && sale_length.match(m_patt).length == 1) {
		//Length in M
		sale_length_val = sale_length.toLowerCase();
		sale_length_val = sale_length_val.replace('m','');
		val_arr = sale_length_val.split('.');
		if(val_arr.length > 1 && val_arr[1] == ""){
			sale_length_val = val_arr[0];	
				
		}
		document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value = sale_length_val;
		GetSLCal_length(4,id);
	}
	else if(sale_length.match(ftin_patt) && sale_length.match(ftin_patt).length == 1) {
		//Length in Feet & inches
		sale_length = sale_length.split("\'");
		sale_length_ft_val = sale_length[0];
		sale_length_in = sale_length[1].split('\"');
		sale_length_in_val = sale_length_in[0];
		document.getElementById('invoice_entry_product_detail_sl_feet'+id).value = sale_length_ft_val;
		document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value = sale_length_in_val;
		GetSLCal_length(10,id);
	}
	else if(sale_length.match(ft_patt) && sale_length.match(ft_patt).length == 1) {
		//Length in Feet
		sale_length_val = sale_length.replace("\'",'');
		document.getElementById('invoice_entry_product_detail_sl_feet'+id).value = sale_length_val;
		document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value = "";
		GetSLCal_length(10,id);
	}
	else if(sale_length.match(in_patt) && sale_length.match(in_patt).length == 1) {
		//Length in inches
		sale_length_val = sale_length.replace('\"','');
		//document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value = sale_length_val;
		document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value = "";
		//calculate feet
		$feet_val = sale_length_val/12;
		document.getElementById('invoice_entry_product_detail_sl_feet'+id).value = $feet_val.toFixed(2);
		GetSLCal_length(10,id);
	}
	else {
		if(sale_length != "") {
			alert("Length value is Invalid!");
		}
	}
}

function GetSLCal_length(calculation_id,id){
	
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
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[2]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= parseFloat(data_t[3]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_s_weight_inches'+id).value 	= parseFloat(data_t[4]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_s_weight_mm'+id).value 		= parseFloat(data_t[5]).toFixed(0);
				//calculate total length
				var feet = document.getElementById('invoice_entry_product_detail_sl_feet'+id).value==""?0:document.getElementById('invoice_entry_product_detail_sl_feet'+id).value;
				var inches = document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value==""?0:document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value;
				qty = document.getElementById('invoice_entry_product_detail_qty'+id).value==""?0:document.getElementById('invoice_entry_product_detail_qty'+id).value;
				if(inches != 0) {
					total_length = ((parseFloat(feet) + parseFloat(inches))/12 ) * parseFloat(qty);
					document.getElementById('invoice_entry_product_detail_tot_length'+id).value = parseFloat(total_length).toFixed(2);
				} else {
						total_length = parseFloat(feet) * parseFloat(qty);
						document.getElementById('invoice_entry_product_detail_tot_length'+id).value = parseFloat(total_length).toFixed(2);
				}
			}
			else if(calculation_id==3){
				
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]).toFixed(2);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= parseFloat(data_t[3]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value		= '';
				//GetLcalFeet(10,1);
				//calculate total length
				qty = document.getElementById('invoice_entry_product_detail_qty'+id).value==""?0:document.getElementById('invoice_entry_product_detail_qty'+id).value;
				total_length = parseFloat(qty) * parseFloat(document.getElementById('invoice_entry_product_detail_sl_feet'+id).value);
				document.getElementById('invoice_entry_product_detail_tot_length'+id).value = parseFloat(total_length).toFixed(2);
				
			}
			else if(calculation_id==4){
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]).toFixed(2);
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[2]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value		= '';
				//calculate total length
				qty = document.getElementById('invoice_entry_product_detail_qty'+id).value==""?0:document.getElementById('invoice_entry_product_detail_qty'+id).value;
				total_length = parseFloat(qty) * parseFloat(document.getElementById('invoice_entry_product_detail_sl_feet'+id).value);
				document.getElementById('invoice_entry_product_detail_tot_length'+id).value = parseFloat(total_length).toFixed(2);
			}
			else if(calculation_id==9){ 
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 		= parseFloat(data_t[2]).toFixed(2);
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value 		= parseFloat(data_t[3]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[4]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= parseFloat(data_t[5]).toFixed(3);
			}
			else {}

			//document.getElementById('invoice_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);


}

function GetSLCal(calculation_id,id){
	
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
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[2]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= parseFloat(data_t[3]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_s_weight_inches'+id).value 	= parseFloat(data_t[4]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_s_weight_mm'+id).value 		= parseFloat(data_t[5]).toFixed(0);
				//calculate total length
				var feet = document.getElementById('invoice_entry_product_detail_sl_feet'+id).value==""?0:document.getElementById('invoice_entry_product_detail_sl_feet'+id).value;
				var inches = document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value==""?0:document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value;
				qty = document.getElementById('invoice_entry_product_detail_qty'+id).value==""?0:document.getElementById('invoice_entry_product_detail_qty'+id).value;
				if(inches != 0) {
					total_length = ((parseFloat(feet) + parseFloat(inches))/12 ) * parseFloat(qty);
					document.getElementById('invoice_entry_product_detail_tot_length'+id).value = parseFloat(total_length).toFixed(2);
				} else {
						total_length = parseFloat(feet) * parseFloat(qty);
						document.getElementById('invoice_entry_product_detail_tot_length'+id).value = parseFloat(total_length).toFixed(2);
				}
			}
			else if(calculation_id==3){
				
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= parseFloat(data_t[3]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value		= '';
				//GetLcalFeet(10,1);
				//calculate total length
				qty = document.getElementById('invoice_entry_product_detail_qty'+id).value==""?0:document.getElementById('invoice_entry_product_detail_qty'+id).value;
				total_length = parseFloat(qty) * parseFloat(document.getElementById('invoice_entry_product_detail_sl_feet'+id).value);
				document.getElementById('invoice_entry_product_detail_tot_length'+id).value = parseFloat(total_length).toFixed(2);
				
			}
			else if(calculation_id==4){
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[2]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value		= '';
				//calculate total length
				qty = document.getElementById('invoice_entry_product_detail_qty'+id).value==""?0:document.getElementById('invoice_entry_product_detail_qty'+id).value;
				total_length = parseFloat(qty) * parseFloat(document.getElementById('invoice_entry_product_detail_sl_feet'+id).value);
				document.getElementById('invoice_entry_product_detail_tot_length'+id).value = parseFloat(total_length).toFixed(2);
			}
			else if(calculation_id==9){ 
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 		= parseFloat(data_t[2]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value 		= parseFloat(data_t[3]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[4]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= parseFloat(data_t[5]).toFixed(3);
			}
			else {}

			//document.getElementById('invoice_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);


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
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[2]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= parseFloat(data_t[3]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_s_weight_inches'+id).value 	= parseFloat(data_t[4]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_s_weight_mm'+id).value 		= parseFloat(data_t[5]).toFixed(0);
			}
			else if(calculation_id==3){
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= parseFloat(data_t[3]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value		= '';
				//GetLcalFeet(10,1);
			}
			else if(calculation_id==4){
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 			= parseFloat(data_t[0]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[2]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value		= '';
			}
			else if(calculation_id==9){ 
				document.getElementById('invoice_entry_product_detail_sl_feet'+id).value 		= parseFloat(data_t[2]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_in'+id).value 		= parseFloat(data_t[3]).toFixed(3);
				document.getElementById('invoice_entry_product_detail_sl_feet_mm'+id).value 		= parseFloat(data_t[4]).toFixed(0);
				document.getElementById('invoice_entry_product_detail_sl_feet_met'+id).value 		= parseFloat(data_t[5]).toFixed(3);
			}
			else {}

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
			document.getElementById('invoice_entry_product_detail_width_inches'+id).value 		= parseFloat(data_t[1]).toFixed(3);
			document.getElementById('invoice_entry_product_detail_width_mm'+id).value 			= parseFloat(data_t[2]).toFixed(0);
			document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value 		= parseFloat(data_t[1]).toFixed(3);
			document.getElementById('invoice_entry_product_detail_s_width_mm'+id).value 			= parseFloat(data_t[2]).toFixed(0);
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
			document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value 		= parseFloat(data_t[1]).toFixed(3);
			document.getElementById('invoice_entry_product_detail_s_width_mm'+id).value 			= parseFloat(data_t[2]).toFixed(0);
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
			document.getElementById('invoice_entry_product_detail_s_width_inches'+id).value 		= parseFloat(data_t[1]).toFixed(3);
			}
			if(calculation_id==2){
			document.getElementById('invoice_entry_product_detail_s_width_mm'+id).value 			= parseFloat(data_t[2]).toFixed(0);
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
		$('#invoice_entry_product_detail_s_weight_mm'+id).val(prod_val.toFixed(0))	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#invoice_entry_product_detail_s_weight_inches'+id).val(prod_val.toFixed(3));
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

function number_format(number, decimals, dec_point, thousands_point) {

    /* if (number == null || !isFinite(number)) {
        throw new TypeError("number is not valid");
    } */
	if(number != null && isFinite(number)) {
		if (!decimals) {
			var len = number.toString().split('.').length;
			decimals = len > 1 ? len : 0;
		}

		if (!dec_point) {
			dec_point = '.';
		}

		if (!thousands_point) {
			thousands_point = ',';
		}

		number = parseFloat(number).toFixed(decimals);

		number = number.replace(".", dec_point);

		var splitNum = number.split(dec_point);
		splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
		number = splitNum.join(dec_point);

		return number;
	} else {
		return 0;
	}
}
