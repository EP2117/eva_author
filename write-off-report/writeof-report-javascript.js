 function requestPoFn(val){
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
			$("#po_date").val(josn[0]['pR_purchase_date']);
			
			var text=0;
			for(var i=0;i<josn.length;i++){
				text=Number(text)+Number(josn[i]['received_qty']);
				
				 var equal = Number(josn[i]['pRp_qty'])==Number(josn[i]['received_qty'])?'readonly':'';
				
				
				apnd += '<tr>';
				apnd += '<td><input type="hidden" name="pid_'+i+'" value=""><input type="hidden" name="productid_'+i+'"  value='+josn[i]['pRp_product_id']+'>'+josn[i]['product_name']+' </td>';
				apnd += '<td>'+josn[i]['product_code']+'</td>';
				apnd += '<td>'+josn[i]['product_uom_name']+'</td>';
				apnd += '<td><input type="text" class="form-control" name="po_qty_'+i+'" id="po_qty_'+i+'" value='+josn[i]['pRp_qty']+' readonly></td>';
				apnd += '<td><input type="text" class="form-control" name="received_qty_'+i+'" id="received_qty_'+i+'" value='+josn[i]['received_qty']+'  readonly></td>';
				apnd += '<td><input type="text" class="form-control" name="current_qty_'+i+'" id="current_qty_'+i+'" onchange="return product_count(this.value,this,'+i+');" '+equal+'></td>';
				apnd += '<td><input type="text" class="form-control" name="reject_qty_'+i+'" id="reject_qty_'+i+'" onchange="return product_count(this.value,this,'+i+');" '+equal+'></td>';
				apnd += '<td><input type="text" class="form-control" name="accept_qty_'+i+'" id="accept_qty_'+i+'" readonly></td>';
				apnd += '<td><input type="text" class="form-control" name="pending_qty_'+i+'" id="pending_qty_'+i+'" readonly></td>';

				apnd += '</tr>';
				
			}
			text =(text==0?'New':'Addition');
			$("#grn_type").val(text);
			$("#receipt_apnd").val(josn.length);
			$("#receipt_table >tbody").html(apnd);
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
 
 