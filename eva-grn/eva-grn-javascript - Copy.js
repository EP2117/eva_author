
  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('grn-form').elements.length; i++) {
	  document.getElementById('grn-form').elements[i].checked = checked;
	}
} 

function GetDetail(){
	var m_id 		= getQuotationId();
	var po_id 	= document.getElementById('purchaseid').value;
	$.get('popup-product-detail.php',
		{m_id:m_id,po_id:po_id},
		function(data) { $('#dynamic-content').html( data ); }
	);	
}

function AddproductDetail(){
	var apnd	= '';
	//var i 		= $("#invoice_table >tbody >tr ").length;
	var x		= document.getElementsByName("chk_product_id[]");
	for (var i = 1; i <= x.length; i++) {
		if (x[i].checked ==true) {
			var ord_id					= x[i].value;
			var product_id 				= document.getElementById('product_id'+ord_id).value;
			var product_name 			= document.getElementById('product_name'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;
			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_inches			= document.getElementById('product_inches'+ord_id).value;
			var brand_name				= document.getElementById('brand_name'+ord_id).value;
			var invoiceId				= document.getElementById('invoiceId'+ord_id).value;
			var received_qty			= document.getElementById('received_qty'+ord_id).value;
			var piP_po_qty				= document.getElementById('piP_po_qty'+ord_id).value;
			var invoiceProductId		= ord_id;					

			//var product_val				= product_id+'-'+product_name;
			apnd += '<tr>';
			apnd += '<td><input type="text" name="arr_count[]" value="'+i+'"><input type="hidden" name="pid_'+i+'" value=""><input type="hidden" name="productid_'+i+'"  value='+product_id+'>'+product_name+ ' </td>';
			apnd += '<td><input type="hidden" name="poid_'+i+'"  value='+invoiceId+'><input type="hidden" name="podetailsid_'+i+'"  value='+invoiceProductId+'>'+product_code+'</td>';
			apnd += '<td>'+product_uom+'</td>';
			apnd += '<td><input type="text" class="form-control" name="po_qty_'+i+'" id="po_qty_'+i+'" value='+piP_po_qty+' readonly></td>';
			apnd += '<td><input type="text" class="form-control" name="received_qty_'+i+'" id="received_qty_'+i+'" value="'+received_qty+'"  readonly></td>';
			apnd += '<td><input type="text" class="form-control" name="current_qty_'+i+'" id="current_qty_'+i+'" onchange="return product_count(this.value,this,'+i+');" ></td>';
			apnd += '<td><input type="text" class="form-control" name="reject_qty_'+i+'" id="reject_qty_'+i+'" onchange="return product_count(this.value,this,'+i+');" ></td>';
			apnd += '<td><input type="text" class="form-control" name="accept_qty_'+i+'" id="accept_qty_'+i+'" readonly></td>';
			apnd += '<td><input type="text" class="form-control" name="pending_qty_'+i+'" id="pending_qty_'+i+'" readonly></td>';
			apnd += '</tr>';
		}
	}
	var i = i;
	$("#receipt_table >tbody").append(apnd);
	$("#receipt_apnd").val(i);
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

function GetCDetail(){
	var m_id 		= getQuotationId();
	var po_id 		= document.getElementById('purchaseid').value;
	$.get('child-popup-product-detail.php',
		{m_id:m_id,po_id:po_id},
		function(data) { $('#child-dynamic-content').html( data ); }
	);	
}

function AddCproductDetail(){
	var apnd	= '';
	var i 		= $("#child_receipt_table >tbody >tr ").length;
	var x		= document.getElementsByName("chk_child_product_id[]");
	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) {
			var ord_id					= x[i].value;
			var product_id 				= document.getElementById('product_id'+ord_id).value;
			var product_name 			= document.getElementById('product_name'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;
			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_uom_id 			= document.getElementById('product_uom_id'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id		= document.getElementById('product_colour_id'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_id	= document.getElementById('product_thick_ness_id'+ord_id).value;
			var product_width_inches	= document.getElementById('product_width_inches'+ord_id).value;
			var product_width_mm		= document.getElementById('product_width_mm'+ord_id).value;
			var product_length_mm		= document.getElementById('product_length_mm'+ord_id).value;
			var product_length_feet		= document.getElementById('product_length_feet'+ord_id).value;
			var product_ton_qty			= document.getElementById('product_ton_qty'+ord_id).value;
			var product_kg_qty			= document.getElementById('product_kg_qty'+ord_id).value;
			var product_detail_id		= ord_id;	
			//var product_val				= product_id+'-'+product_name;
				apnd += '<tr><td >'+product_code+'<input type="hidden" name="grn_child_product_detail_product_id[]" id="grn_child_product_detail_product_id_'+i+'" value="'+product_id+'"  /><input type="hidden" name="grn_child_product_detail_id[]" id="grn_child_product_detail_id_'+i+'" /><input type="hidden" name="grn_child_product_detail_code[]" id="grn_child_product_detail_code_'+i+'" value="'+product_code+'"/><input type="hidden" name="grn_child_product_detail_inv_detail_id[]" id="grn_child_product_detail_inv_detail_id_'+i+'" value="'+product_detail_id+'"  /></td>';
				apnd += '<td>'+product_name+' <input type="hidden" name="grn_child_product_detail_name[]" id="grn_child_product_detail_name_'+i+'" value="'+product_name+'"/></td>';
				apnd += '<td><input type="hidden" name="grn_child_product_detail_color_id[]" id="grn_child_product_detail_color_id_'+i+'" value="'+product_colour_id+'"/> '+product_colour_name+' </td>'; 
				apnd += '<td><input type="hidden" name="grn_child_product_detail_thick_ness[]" id="grn_child_product_detail_thick_'+i+'" value="'+product_thick_ness_id+'" class="form-control"  />'+product_thick_ness+'</td>';
				apnd += '<td><input type="hidden" name="grn_child_product_detail_uom_id[]" id="grn_child_product_detail_uom_id_'+i+'" value="'+product_uom_id+'" class="form-control"  />'+product_uom+'</td>';
				apnd += '<td><input type="text" name="grn_child_product_detail_width_inches[]" id="grn_child_product_detail_width_inches_'+i+'" value="'+product_width_inches+'" class="form-control" onblur="GetWcalc(2,'+i+');"/></td>'; 
				apnd += '<td><input type="text" name="grn_child_product_detail_width_mm[]" id="grn_child_product_detail_width_mm_'+i+'" value="'+product_width_mm+'" class="form-control" onBlur="GetWcalc(3,'+i+');" /></td>';
				apnd += '<td><input type="text" name="grn_child_product_detail_length_feet[]" id="grn_child_product_detail_length_feet_'+i+'" value="'+product_length_feet+'" class="form-control" onBlur="GetCLcalc(1,'+i+');" /></td>';
				apnd += '<td><input type="text" name="grn_child_product_detail_length_mm[]" id="grn_child_product_detail_length_mm_'+i+'" value="'+product_length_mm+'"  class="form-control" onBlur="GetCLcalc(3,'+i+')" /></td>'; 
				apnd += '<td><input type="text" name="grn_child_product_detail_ton_qty[]" id="grn_child_product_detail_ton_qty_'+i+'" class="form-control" value="'+product_ton_qty+'"  /></td>';  
				apnd += '<td><input type="text" name="grn_child_product_detail_kg_qty[]" id="grn_child_product_detail_kg_qty_'+i+'" class="form-control" value="'+product_kg_qty+'"  /></td></tr>';
		}
	}
	$("#child_receipt_table >tbody").html(apnd);
}


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
			$("#po_date").val(josn[0]['pI_invoice_date']);
			
			/*var text=0;
			for(var i=0;i<josn.length;i++){
				text=Number(text)+Number(josn[i]['received_qty']);
				
				 var equal = Number(josn[i]['pRp_qty'])==Number(josn[i]['received_qty'])?'readonly':'';
				
				
				apnd += '<tr>';
				apnd += '<td><input type="hidden" name="pid_'+i+'" value=""><input type="hidden" name="productid_'+i+'"  value='+josn[i]['product_id']+'>'+josn[i]['product_name']+ ' </td>';
				apnd += '<td><input type="hidden" name="poid_'+i+'"  value='+josn[i]['invoiceId']+'> <input type="hidden" name="podetailsid_'+i+'"  value='+josn[i]['invoiceProductId']+'> '+josn[i]['product_code']+'</td>';
				apnd += '<td>'+josn[i]['product_uom_name']+'</td>';
				apnd += '<td><input type="text" class="form-control" name="po_qty_'+i+'" id="po_qty_'+i+'" value='+josn[i]['piP_po_qty']+' readonly></td>';
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
			$("#receipt_table >tbody").html(apnd);*/
		}else{
			alert("No record found")
		}
		
	});
	
	/*$.getJSON('product-detail.php?action=child_prod_details&poid='+val,function(data) {  
		if(0<data.length){ 
			var apnd='';
			
			var text=0;
			for(var i=0;i<data.length;i++){ 
				apnd += '<tr><td>'+data[i]['product_code']+'<input type="hidden" name="grn_child_product_detail_product_id[]" id="grn_child_product_detail_product_id_'+i+'" value="'+data[i]['product_id']+'"  /><input type="hidden" name="grn_child_product_detail_id[]" id="grn_child_product_detail_id_'+i+'" /><input type="hidden" name="grn_child_product_detail_code[]" id="grn_child_product_detail_code_'+i+'" value="'+data[i]['product_code']+'"/><input type="hidden" name="grn_child_product_detail_inv_detail_id[]" id="grn_child_product_detail_inv_detail_id_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_id']+'"  /></td>';
				apnd += '<td>'+data[i]['product_name']+' <input type="hidden" name="grn_child_product_detail_name[]" id="grn_child_product_detail_name_'+i+'" value="'+data[i]['product_name']+'"/></td>';
				apnd += '<td><input type="hidden" name="grn_child_product_detail_color_id[]" id="grn_child_product_detail_color_id_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_color_id']+'"/> '+data[i]['product_colour_name']+' </td>'; 
				apnd += '<td><input type="hidden" name="grn_child_product_detail_thick_ness[]" id="grn_child_product_detail_thick_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_thick_ness']+'" class="form-control"  />'+data[i]['product_con_entry_child_product_detail_thick_ness']+'</td>';
				apnd += '<td><input type="hidden" name="grn_child_product_detail_uom_id[]" id="grn_child_product_detail_uom_id_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_uom_id']+'" class="form-control"  />'+data[i]['product_uom_name']+'</td>';
				apnd += '<td><input type="text" name="grn_child_product_detail_width_inches[]" id="grn_child_product_detail_width_inches_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_width_inches']+'" class="form-control" onblur="GetWcalc(2,'+i+');"/></td>'; 
				apnd += '<td><input type="text" name="grn_child_product_detail_width_mm[]" id="grn_child_product_detail_width_mm_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_width_mm']+'" class="form-control" onBlur="GetWcalc(3,'+i+');" /></td>';
				apnd += '<td><input type="text" name="grn_child_product_detail_length_feet[]" id="grn_child_product_detail_length_feet_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_length_feet']+'" class="form-control" onBlur="GetCLcalc(1,'+i+');" /></td>';
				apnd += '<td><input type="text" name="grn_child_product_detail_length_mm[]" id="grn_child_product_detail_length_mm_'+i+'" value="'+data[i]['product_con_entry_child_product_detail_length_mm']+'"  class="form-control" onBlur="GetCLcalc(3,'+i+')" /></td>'; 
				apnd += '<td><input type="text" name="grn_child_product_detail_ton_qty[]" id="grn_child_product_detail_ton_qty_'+i+' " class="form-control" value="'+data[i]['product_con_entry_child_product_detail_ton_qty']+'"  /></td>';  
				apnd += '<td><input type="text" name="grn_child_product_detail_kg_qty[]" id="grn_child_product_detail_kg_qty_'+i+'" class="form-control" value="'+data[i]['product_con_entry_child_product_detail_kg_qty']+'"  /></td></tr>';
			}
			
			$("#child_receipt_table >tbody").html(apnd);
			
		}else{
			alert("No record found")
		}
		
	});*/
	
 }

function GetWcalc(calculation_id,id){ 

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('grn_child_product_detail_width_inches_'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('grn_child_product_detail_width_mm_'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('grn_child_product_detail_width_inches_'+id).value 		= data_t[1];
			document.getElementById('grn_child_product_detail_width_mm_'+id).value 			= data_t[2];
		}

	);

}
function GetCLcalc(calculation_id,id){

	if(calculation_id==1){
		var calc_amount 	= document.getElementById('grn_child_product_detail_length_feet_'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('grn_child_product_detail_length_mm_'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) { 
			var data_t	= data.split('@'); 
			document.getElementById('grn_child_product_detail_length_feet_'+id).value 		= parseFloat(data_t[0]);
			document.getElementById('grn_child_product_detail_length_mm_'+id).value 		= data_t[2];
		}
	);

}

function product_count(val,obj,sno){
	
	var po_qty= Number($("#po_qty_"+sno).val());
	var received_qty= Number($("#received_qty_"+sno).val());
	var currentsply_qty= Number($("#current_qty_"+sno).val());
	var reject_qty= Number($("#reject_qty_"+sno).val());
	
	var qty =po_qty-received_qty;
	if(qty>=val){
	
		$("#accept_qty_"+sno).val(currentsply_qty);
		var accept_qty= Number($("#accept_qty_"+sno).val());

		var pending =(po_qty)-((received_qty+accept_qty)+reject_qty);
		$("#pending_qty_"+sno).val(pending);

	}else{
		alert("Please enter bellow PO qty");
		$(obj).val('');
		
		var po_qty= Number($("#po_qty_"+sno).val());
		var received_qty= Number($("#received_qty_"+sno).val());
		var currentsply_qty= Number($("#current_qty_"+sno).val());
		var reject_qty= Number($("#reject_qty_"+sno).val());
		$("#accept_qty_"+sno).val(currentsply_qty);
		var accept_qty= Number($("#accept_qty_"+sno).val());

		var pending =(po_qty)-((received_qty+accept_qty)+reject_qty);
		$("#pending_qty_"+sno).val(pending);

	}
}

 function GetWeightClc(id,type){
	// alert(id);
		var product_id			= $("#grn_child_product_detail_product_id_"+id).val();
		var prd_thick			= $("#grn_child_product_detail_thick_"+id).val();
		if(type==1){
			var prd_qty_val		=$("#grn_child_product_detail_ton_qty_"+id).val();
 		}else{
			var prd_qty_val		=$("#grn_child_product_detail_kg_qty_"+id).val();
		}
		$.get(
			"../ajax-file/product-weight-calc.php",
			{product_id:product_id,prd_thick:prd_thick,prd_type:type,prd_qty_val:prd_qty_val},
			function(data) {
				if(type==1){
					$("#grn_child_product_detail_kg_qty_"+id).val(data);
				}else{
					$("#grn_child_product_detail_ton_qty_"+id).val(data);
				}
			}
		);
 }
 
 function get_typ(val){
	if(val==1){
		$("#finishgoods").show();
		$("#rawgoods").hide();
	}else if(val ==2){
		$("#finishgoods").hide();
		$("#rawgoods").show();
	}
 }
 
 