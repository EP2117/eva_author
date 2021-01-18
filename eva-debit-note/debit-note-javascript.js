 

  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('debit-forms').elements.length; i++) {
	  document.getElementById('debit-forms').elements[i].checked = checked;
	}
} 
 
 function product_list(val){
	$.getJSON('product-detail.php?action=request_details&poid='+val,function(josn) {  
		if(0<josn.length){
			var apnd;
			if(josn[0]['supplier_location']==1){
				var location ="Local";
			}else if(josn[0]['supplier_location']==2){
				var location ="Oversea";
			}
			$("#supplier_name").val(josn[0]['supplier_name']);
			$("#supplier_location").val(location);
			$("#po_date").val(josn[0]['pI_invoice_date']);
			
			for(var i=0;i<josn.length;i++){
				alert(josn[i]['piP_rate']);
				apnd += '<tr>';
				apnd += '<td><input type="hidden" name="pid_'+i+'" value=""><input type="hidden" name="productid_'+i+'"  value='+josn[i]['invoiceProductId']+'>'+josn[i]['product_name']+'</td>';
				apnd += '<td>'+josn[i]['product_code']+'</td>';
				apnd += '<td>'+josn[i]['product_uom_name']+'</td>';
				apnd += '<td><input type="text" class="form-control"  name="poqty_'+i+'" id="poqty_'+i+'" value='+josn[i]['piP_po_qty']+' readonly></td>';
				apnd += '<td><input type="text" class="form-control"style="text-align:right;" name="rate_'+i+'"  id="rate_'+i+'" value='+josn[i]['piP_rate']+' readonly></td>';
				apnd += '<td><input type="text" class="form-control" name="qty_'+i+'" id="qty_'+i+'" onchange="return amntcalculate(this.value,this,'+i+');"></td>';
				apnd += '<td><input type="text" class="form-control"style="text-align:right;" name="amount_'+i+'" id="amount_'+i+'" readonly></td>';

				apnd += '</tr>';
				
			}
			$("#debit_apnd").val(josn.length);
			$("#debit_table >tbody").html(apnd);
		}else{
			alert("No record found")
		}
		
	});
	
	$.getJSON('product-detail.php?action=child_prod_details&poid='+val,function(data) {  
		if(0<data.length){ 
			var apnd='';
			
			var text=0;
			for(var i=0;i<data.length;i++){ 
				apnd += '<tr><td>'+data[i]['product_code']+'<input type="hidden" name="purchase_debit_note_child_product_product_id[]" id="purchase_debit_note_child_product_product_id_'+i+'" value="'+data[i]['product_id']+'"  /><input type="hidden" name="purchase_debit_note_child_product_code[]" id="purchase_debit_note_child_product_code_'+i+'" value="'+data[i]['product_code']+'"/><input type="hidden" name="purchase_debit_note_child_product_inv_detail_id[]" id="purchase_debit_note_child_product_inv_detail_id_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_id']+'"  /></td>';
				apnd += '<td>'+data[i]['product_name']+' <input type="hidden" name="purchase_debit_note_child_product_name[]" id="purchase_debit_note_child_product_name_'+i+'" value="'+data[i]['product_name']+'"/></td>';
				apnd += '<td><input type="hidden" name="purchase_debit_note_child_product_color_id[]" id="purchase_debit_note_child_product_color_id_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_color_id']+'"/> '+data[i]['product_colour_name']+' </td>'; 
				apnd += '<td><input type="hidden" name="purchase_debit_note_child_product_thick_ness[]" id="purchase_debit_note_child_product_thick_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_thick_ness']+'" class="form-control"  />'+data[i]['product_con_entry_child_product_detail_thick_ness']+'</td>';
				apnd += '<td><input type="hidden" name="purchase_debit_note_child_product_uom_id[]" id="purchase_debit_note_child_product_uom_id_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_uom_id']+'" class="form-control"  />'+data[i]['product_uom_name']+'</td>';
				apnd += '<td><input type="text" name="purchase_debit_note_child_product_width_inches[]" id="purchase_debit_note_child_product_width_inches_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_width_inches']+'" class="form-control" onblur="GetWcalc(2,'+i+');"/></td>'; 
				apnd += '<td><input type="text" name="purchase_debit_note_child_product_width_mm[]" id="purchase_debit_note_child_product_width_mm_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_width_mm']+'" class="form-control" onBlur="GetWcalc(3,'+i+');" /></td>';
				apnd += '<td><input type="text" name="purchase_debit_note_child_product_length_feet[]" id="purchase_debit_note_child_product_length_feet_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_length_feet']+'" class="form-control" onBlur="GetCLcalc(1,'+i+');" /></td>';
				apnd += '<td><input type="text" name="purchase_debit_note_child_product_length_mm[]" id="purchase_debit_note_child_product_length_mm_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_length_mm']+'"  class="form-control" onBlur="GetCLcalc(3,'+i+')" /></td>'; 
				apnd += '<td><input type="text" name="purchase_debit_note_child_product_ton_qty[]" id="purchase_debit_note_child_product_ton_qty_'+i+' " class="form-control" value="'+data[i]['product_con_entry_child_product_detail_ton_qty']+'"  /></td>';  
				apnd += '<td><input type="text" name="purchase_debit_note_child_product_kg_qty[]" id="purchase_debit_note_child_product_kg_qty_'+i+'" class="form-control" value="'+data[i]['product_con_entry_child_product_detail_kg_qty']+'"  /></td></tr>';
			}
			
			$("#child_receipt_table >tbody").html(apnd);
			
		}else{
			alert("No record found")
		}
		
	});

 }
function amntcalculate(val,obj,sno){
	
	var rate = $("#rate_"+sno).val().replace(/,/g, '');
	var qty = $("#qty_"+sno).val().replace(/,/g, '');
	$("#amount_"+sno).val(forNum(Number(rate)*Number(qty)));
}