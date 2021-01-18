
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
	var typ 	= document.getElementById('typ').value;
	$.get('popup-product-detail.php',
		{m_id:m_id,po_id:po_id,typ:typ},
		function(data) { $
			('#dynamic-content').html( data ); 
		}
	);	
}

function AddproductDetail(){
	//var apnd	= '';
	//var i 		= $("#invoice_table >tbody >tr ").length;
	//var x		= document.getElementsByName("chk_product_id[]");
	var x						= document.getElementsByName("chk_product_id[]");
	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) {
			var ord_id 						=  x[i].value;
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
			var product_mother_child_type   = document.getElementById('product_mother_child_type'+ord_id).value;
			//alert(product_mother_child_type);
			var invoiceProductId		= ord_id;					

			var last_val = $("#receipt_apnd").val();
			
			var sno      = parseInt(last_val)+1;
			apnd = '<tr id="remove_req_'+sno+'"><input type="hidden" name="grn_mother_child_type'+sno+'" value="'+product_mother_child_type+'">';
			apnd += '<td><input type="hidden" name="arr_count[]" value="'+sno+'"><input type="hidden" name="pid_'+i+'" value=""><input type="hidden" name="productid_'+sno+'"  value='+product_id+'>'+product_name+ ' </td>';
			apnd += '<td><input type="hidden" name="poid_'+sno+'"  value='+invoiceId+'><input type="hidden" name="podetailsid_'+sno+'"  value='+invoiceProductId+'>'+product_code+'</td>';
			apnd += '<td>'+product_uom+'</td>';
			apnd += '<td><input type="text" class="form-control" name="po_qty_'+sno+'" id="po_qty_'+sno+'" value='+piP_po_qty+' readonly></td>';
			apnd += '<td><input type="text" class="form-control" name="received_qty_'+sno+'" id="received_qty_'+sno+'" value="'+received_qty+'"  readonly></td>';
			apnd += '<td><input type="text" class="form-control" name="current_qty_'+sno+'" id="current_qty_'+sno+'" onchange="return product_count(this.value,this,'+sno+');" ></td>';
			apnd += '<td><input type="text" class="form-control" name="reject_qty_'+sno+'" id="reject_qty_'+sno+'" onchange="return product_count(this.value,this,'+sno+');" ></td>';
			apnd += '<td><input type="text" class="form-control" name="accept_qty_'+sno+'" id="accept_qty_'+sno+'" readonly></td>';
			apnd += '<td><input type="text" class="form-control" name="pending_qty_'+sno+'" id="pending_qty_'+sno+'" readonly></td>';
			//Added by AuthorsMM
			apnd += '<td class="feet_td"><b>Feet/Qty</b><input type="text" class="form-control normal-txtbox" name="feet_'+sno+'" id="feet_'+sno+'" value='+document.getElementById('piP_feet_per_qty'+ord_id).value+' readonly />';
			apnd += '<b>Total Feet</b><input type="text" class="form-control normal-txtbox" name="total_feet_'+sno+'" id="total_feet_'+sno+'" readonly></td>';
			//End
			apnd += '</tr>';
			
		$("#receipt_apnd").val(sno);	
	$("#receipt_table >tbody").append(apnd);
	
		}
		
	}
	
	
}

function get_po(branch_id){
		//alert('test');
		$.get("product-detail.php",{branch_id:branch_id,action:'po'},function(data){
							 
							 $("#purchaseid").html(data);
							 
							 });
	
	
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
	var ft_total 	= 0;
	var m_total		= 0;
	var kg_total 	= 0;
	var ton_total	= 0;
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
			var product_width_inches	= parseFloat(document.getElementById('product_width_inches'+ord_id).value).toFixed(0);
			var product_width_mm		= parseFloat(document.getElementById('product_width_mm'+ord_id).value).toFixed(0);
			var product_length_mm		= document.getElementById('product_length_mm'+ord_id).value;
			var product_length_feet		= document.getElementById('product_length_feet'+ord_id).value;
			var product_ton_qty			= document.getElementById('product_ton_qty'+ord_id).value;
			var product_kg_qty			= document.getElementById('product_kg_qty'+ord_id).value;
			var product_mother_child_type			= document.getElementById('product_mother_child_type'+ord_id).value;
			
			ft_total = parseFloat(ft_total) + parseFloat(product_length_feet);
			m_total = parseFloat(m_total) + parseFloat(product_length_mm);
			kg_total = parseFloat(kg_total) + parseFloat(product_kg_qty);
			ton_total = parseFloat(ton_total) + parseFloat(product_ton_qty);
			
			var product_detail_id		= ord_id;	
			//var product_val				= product_id+'-'+product_name;
				apnd += '<tr><td ><input type="hidden" name="grn_child_mother_child_type[]" value="'+product_mother_child_type+'">'+product_code+'<input type="hidden" name="grn_child_product_detail_product_id[]" id="grn_child_product_detail_product_id_'+i+'" value="'+product_id+'"  /><input type="hidden" name="grn_child_product_detail_id[]" id="grn_child_product_detail_id_'+i+'" /><input type="hidden" name="grn_child_product_detail_code[]" id="grn_child_product_detail_code_'+i+'" value="'+product_code+'"/><input type="hidden" name="grn_child_product_detail_inv_detail_id[]" id="grn_child_product_detail_inv_detail_id_'+i+'" value="'+product_detail_id+'"  /></td>';
				apnd += '<td>'+product_name+' <input type="hidden" name="grn_child_product_detail_name[]" id="grn_child_product_detail_name_'+i+'" value="'+product_name+'"/></td>';
				apnd += '<td><input type="hidden" name="grn_child_product_detail_color_id[]" id="grn_child_product_detail_color_id_'+i+'" value="'+product_colour_id+'"/> '+product_colour_name+' </td>'; 
				apnd += '<td><input type="hidden" name="grn_child_product_detail_thick_ness[]" id="grn_child_product_detail_thick_'+i+'" value="'+product_thick_ness_id+'" class="form-control"  />'+product_thick_ness+'</td>';
				apnd += '<td><input type="hidden" name="grn_child_product_detail_uom_id[]" id="grn_child_product_detail_uom_id_'+i+'" value="'+product_uom_id+'" class="form-control"  />'+product_uom+'</td>';
				apnd += '<td><input type="text" name="grn_child_product_detail_width_inches[]" id="grn_child_product_detail_width_inches_'+i+'" value="'+product_width_inches+'" class="form-control" onblur="GetWcalc(2,'+i+');" readonly=""/></td>'; 
				apnd += '<td><input type="text" name="grn_child_product_detail_width_mm[]" id="grn_child_product_detail_width_mm_'+i+'" value="'+product_width_mm+'" class="form-control" onBlur="GetWcalc(3,'+i+');" readonly=""/></td>';
				apnd += '<td><input type="text" name="grn_child_product_detail_length_feet[]" id="grn_child_product_detail_length_feet_'+i+'" value="'+product_length_feet+'" class="form-control" onBlur="GetCLcalc(1,'+i+');" readonly=""/></td>';
				apnd += '<td><input type="text" name="grn_child_product_detail_length_mm[]" id="grn_child_product_detail_length_mm_'+i+'" value="'+product_length_mm+'"  class="form-control" onBlur="GetCLcalc(3,'+i+')" readonly=""/></td>'; 
				apnd += '<td><input type="text" name="grn_child_product_detail_ton_qty[]" id="grn_child_product_detail_ton_qty_'+i+'" class="form-control" value="'+product_ton_qty+'"  readonly/></td>';  
				apnd += '<td><input type="text" name="grn_child_product_detail_kg_qty[]" id="grn_child_product_detail_kg_qty_'+i+'" class="form-control" value="'+product_kg_qty+'" readonly=""  /></td></tr>';
		}
	}
	$("#child_receipt_table >tbody").html(apnd);
	
	//Added By AuthorsMM for Total values
	var total = '<tr style="border:solid 1px #ddd;"><th colspan="7" class="text-right"><b>Total</b></th>';
	total += '<th class="ft_total text-right">'+ft_total+'</th>';
	total += '<th class="m_total text-right">'+parseFloat(m_total).toFixed(2)+'</th>';
	total += '<th class="ton_total text-right">'+ton_total+'</th>';
	total += '<th class="kg_total text-right">'+kg_total+'</th></tr>';
	$("#child_receipt_table >tfoot").html(total);
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

		}else{
			alert("No record found")
		}
		
	});
	
	
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
			document.getElementById('grn_child_product_detail_width_inches_'+id).value 		= parseFloat(data_t[1]).toFixed(0);
			document.getElementById('grn_child_product_detail_width_mm_'+id).value 			= parseFloat(data_t[2]).toFixed(0);
		}

	);

}
function GetCLcalc(calculation_id,id) {

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
		
		//added by AuthorsMM
		var feet = $("#feet_"+sno).val() == ""?0:$("#feet_"+sno).val();
		var qty  = $("#accept_qty_"+sno).val() == ""?0:$("#accept_qty_"+sno).val();
		var total_feet = parseFloat(qty) * parseFloat(feet);
		$("#total_feet_"+sno).val(total_feet);
		//end

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
		
		//added by AuthorsMM
		var feet = $("#feet_"+sno).val() == ""?0:$("#feet_"+sno).val();
		var qty  = $("#accept_qty_"+sno).val() == ""?0:$("#accept_qty_"+sno).val();
		var total_feet = parseFloat(qty) * parseFloat(feet);
		$("#total_feet_"+sno).val(total_feet);
		//end

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
	if(val==1 || val==3){
		$("#finishgoods").show();
		if(val == 1){
			$("#feet_th").show();
			$(".feet_td").show();
		} else {
			$("#feet_th").hide();
			$(".feet_td").hide();
		}
		$("#rawgoods").hide();
	}else if(val ==2){
		$("#finishgoods").hide();
		$("#rawgoods").show();
	}
 }
 
 