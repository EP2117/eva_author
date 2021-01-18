 function requestPoFn(val){
	$.getJSON('product-detail.php?action=request_details&gatepassid='+val,function(josn) {  
		if(0<josn.length){
			
			var apnd;
			
			$("#cust_name").val(josn[0]['customer_name']);
			$("#vechile_no").val(josn[0]['pdo_entry_vehicle_no']);
			$("#driver_name").val(josn[0]['pdo_entry_driver_name']);
			$("#deliver_by").val(josn[0]['pdo_entry_delivery_type']);
			
			var text=0;
			for(var i=0;i<josn.length;i++){
				
				
				apnd += '<tr>';
				apnd += '<td><input type="hidden" name="pid_'+i+'" value=""><input type="hidden" name="pdo_entryid_'+i+'"  value='+josn[i]['pdo_entry_id']+'><input type="hidden" name="productid_'+i+'"  value='+josn[i]['pdo_entry_product_detail_product_id']+'>'+josn[i]['product_name']+' </td>';
				apnd += '<td>'+josn[i]['product_code']+'</td>';
				apnd += '<td>'+josn[i]['product_colour_name']+'</td>';
				apnd += '<td>'+josn[i]['product_thick_ness']+'</td>';
				apnd += '<td>'+josn[i]['pdo_entry_product_detail_width_inches']+'</td>';
				apnd += '<td>'+josn[i]['pdo_entry_product_detail_width_mm']+'</td>';
				apnd += '<td>'+josn[i]['pdo_entry_product_detail_width_inches']+'</td>';
				apnd += '<td>'+josn[i]['pdo_entry_product_detail_length_feet']+'</td>';
				apnd += '<td>'+josn[i]['product_uom_name']+'</td>';
				apnd += '<td><input type="text" class="form-control" name="qty_'+i+'" id="qty_'+i+'"  value='+josn[i]['pdo_entry_product_detail_qty']+' ></td>';

				apnd += '</tr>';
				
			}
			$("#prod_apnd").val(josn.length);
			$("#product_table >tbody").html(apnd);
		}else{
			alert("No record found")
		}
		
	});
 }

function product_count(val,obj,sno){
	
	var po_qty= Number($("#po_qty_"+sno).val());
	var received_qty= Number($("#received_qty_"+sno).val());
	var currentsply_qty= Number($("#current_qty_"+sno).val());
	var reject_qty= Number($("#reject_qty_"+sno).val());
	
	var qty =po_qty-received_qty;
	if(qty>=val){
	
		$("#accept_qty_"+sno).val(currentsply_qty-reject_qty);
		var accept_qty= Number($("#accept_qty_"+sno).val());

		var pending =(po_qty)-(received_qty+accept_qty);
		$("#pending_qty_"+sno).val(pending);

	}else{
		alert("Please enter bellow PO qty");
		$(obj).val('');
		
		var po_qty= Number($("#po_qty_"+sno).val());
		var received_qty= Number($("#received_qty_"+sno).val());
		var currentsply_qty= Number($("#current_qty_"+sno).val());
		var reject_qty= Number($("#reject_qty_"+sno).val());
		$("#accept_qty_"+sno).val(currentsply_qty-reject_qty);
		var accept_qty= Number($("#accept_qty_"+sno).val());

		var pending =(po_qty)-(received_qty+accept_qty);
		$("#pending_qty_"+sno).val(pending);

	}
}
 function checkedAll(obj){
	var check =$(obj).prop('checked');
	
	if(check==true)
		$('.check').prop('checked',true);
	else
		$('.check').prop('checked',false);
	
}

 