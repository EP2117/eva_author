
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
	var i 		= $("#receipt_table >tbody >tr ").length;
	//var x		= document.getElementsByName("chk_product_id[]");
	var x						= document.getElementsByName("chk_product_id[]");
	for (var k = 0; k < x.length; k++) {
		if (x[k].checked ==true) {
			var ord_id 						=  x[k].value;
			var product_id 				= document.getElementById('product_id'+ord_id).value;
			var product_name 			= document.getElementById('product_name'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;
			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_inches			= document.getElementById('product_inches'+ord_id).value;
			var brand_name				= document.getElementById('brand_name'+ord_id).value;
			var invoiceId				= document.getElementById('invoiceId'+ord_id).value;
		
			var piP_po_qty				= document.getElementById('piP_po_qty'+ord_id).value;
			var piP_rate				= document.getElementById('piP_rate'+ord_id).value;
			var pR_rate					= document.getElementById('pR_rate'+ord_id).value;
			var piP_frgn_rate					= document.getElementById('piP_frgn_rate'+ord_id).value;
			var invoiceProductId		= ord_id;					
	
			//var product_val				= product_id+'-'+product_name;
			if(!document.getElementById('invoice_id_'+ord_id)) {
				apnd += '<tr>';
				apnd += '<td><input type="hidden" id="invoice_id_'+ord_id+'" name ="invoice_id_'+ord_id+'" value="" /> <input type="hidden" name="dn_entry_product_detail_id_'+i+'" value=""><input type="hidden" name="productid_'+i+'"  value='+product_id+'>'+product_name+ ' </td>';
				apnd += '<td><input type="hidden" name="invoiceId_'+i+'"  value='+invoiceId+'><input type="hidden" name="invoicedetailId_'+i+'"  value='+invoiceProductId+'>'+product_code+'</td>';
				apnd += '<td>'+product_uom+'</td>';
				apnd += '<td><input type="text" class="form-control" name="po_qty_'+i+'" id="po_qty_'+i+'" value='+piP_po_qty+' readonly></td>';
				apnd += '<td><input type="text" class="form-control" name="rate_'+i+'" id="rate_'+i+'" value="'+piP_rate+'"  readonly></td>';
				apnd += '<td><input type="text" class="form-control" name="f_rate_'+i+'" id="f_rate_'+i+'" value="'+piP_frgn_rate+'"  readonly></td>';
				apnd += '<td><input type="text" class="form-control" name="qty_'+i+'" id="qty_'+i+'" value="" onkeyup="get_dne_amt('+i+');"></td>';
				//Added by AuthorsMM
				apnd += '<td><input type="text" class="form-control" name="feet_'+i+'" id="feet_'+i+'" value="'+document.getElementById('piP_feet_per_qty'+ord_id).value+'" onkeyup="total_feet('+i+');" readonly /></td>';
				apnd += '<td><input type="text" class="form-control" name="total_feet_'+i+'" id="total_feet_'+i+'" value=""  readonly /></td>';
				//End
				apnd += '<td><input type="text" class="form-control" name="tot_amount_cur_'+i+'" id="tot_amount_cur_'+i+'" ></td>';
				apnd += '<td><input type="text" class="form-control" name="tot_amount_'+i+'" id="tot_amount_'+i+'" ></td>';
				
				
				apnd += '</tr>';
			}
			var i	= i+1;
		
		}
	}
	$("#receipt_apnd").val(i);
	//var i = i-1;
		
	$("#receipt_table").append(apnd);
	//$("#receipt_table >tbody").html(apnd);
	//$("#receipt_apnd").val($("#receipt_table >tbody >tr ").length);
	
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
function get_dne_amt(id){
	var qty=Number($('#qty_'+id).val());
	var rate=Number($('#rate_'+id).val());
	var frgn_rate=Number($('#f_rate_'+id).val());
	
	var f_rate =$('#dne_frgn_rate').val();
	if(frgn_rate>0){
		$('#tot_amount_cur_'+id).val(qty*frgn_rate);
		$('#tot_amount_'+id).val(qty*frgn_rate*f_rate);
	}
	else{
		$('#tot_amount_'+id).val(qty*rate);
	}
	//var total=qty*rate;
	
	//var tot_amount =$('#tot_amount_'+id).val(total.toFixed(2));
	
	if(document.getElementById("feet_"+id).value == ""){
		var feet = 0;
	} else {
		var feet = document.getElementById("feet_"+id).value;
	}
	qty = qty==''?0:qty;
	document.getElementById("total_feet_"+id).value = qty * parseFloat(feet);
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
	for (var k = 0; k < x.length; k++) {
		if (x[k].checked ==true) {
			var ord_id					= x[k].value;
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
			
			var product_rate			= document.getElementById('product_rate'+ord_id).value;
			var product_frgn_rate		= document.getElementById('product_frgn_rate'+ord_id).value;
			
			var product_detail_id		= ord_id;	
			//var product_val				= product_id+'-'+product_name;
			if(!document.getElementById('c_invoice_id_'+ord_id)) {
				apnd += '<tr><td>'+product_code+'<input type="hidden" id="c_invoice_id_'+ord_id+'" name ="c_invoice_id_'+ord_id+'" value="" /> <input type="hidden" name="dne_child_detail_product_id[]" id="dne_child_detail_product_id_'+i+'" value="'+product_id+'"  /><input type="hidden" name="dne_child_detail_id[]" id="dne_child_detail_id_'+i+'" /><input type="hidden" name="dne_child_detail_code[]" id="dne_child_detail_code_'+i+'" value="'+product_code+'"/><input type="hidden" name="dne_child_detail_pro_dteial_id[]" id="dne_child_detail_pro_dteial_id_'+i+'" value="'+product_detail_id+'"  /></td>';
				apnd += '<td>'+product_name+' <input type="hidden" name="dne_child_detail_name[]" id="dne_child_detail_name_'+i+'" value="'+product_name+'"/></td>';
				apnd += '<td><input type="hidden" name="dne_child_detail_color_id[]" id="dne_dne_child_detail_color_id_'+i+'" value="'+product_colour_id+'"/> '+product_colour_name+' </td>'; 
				apnd += '<td><input type="hidden" name="dne_child_detail_thick[]" id="dne_child_detail_thick_'+i+'" value="'+product_thick_ness_id+'" class="form-control"  />'+product_thick_ness+'</td>';
				
				apnd += '<td><b>Inches</b><input type="text" name="dne_child_detail_width_inches[]" id="dne_child_detail_width_inches_'+i+'" value="'+product_width_inches+'" class="form-control normal-txtbox" onblur="GetWcalc(2,'+i+');" readonly />'; 
				apnd += '<b>MM</b><input type="text" name="dne_child_detail_width_mm[]" id="dne_child_detail_width_mm_'+i+'" value="'+product_width_mm+'" class="form-control normal-txtbox" onBlur="GetWcalc(3,'+i+');" readonly /></td>';
				apnd += '<td><b>Feet</b><input type="text" name="dne_child_detail_length_feet[]" id="dne_child_detail_length_feet_'+i+'" value="'+product_length_feet+'" class="form-control normal-txtbox" onBlur="GetCLcalc(1,'+i+');" readonly />';
				apnd += '<b>METER</b><input type="text" name="dne_child_detail_length_mm[]" id="dne_child_detail_length_mm_'+i+'" value="'+product_length_mm+'"  class="form-control normal-txtbox" onBlur="GetCLcalc(3,'+i+')" readonly /></td>'; 
				apnd += '<td><input type="hidden" name="dne_child_detail_uom_id[]" id="dne_child_detail_uom_id_'+i+'" value="'+product_uom_id+'" class="form-control"  />'+product_uom+'</td>';
				apnd += '<td><b>Ton</b><input type="text" name="dne_child_detail_ton_qty[]" id="dne_child_detail_ton_qty_'+i+'" class="form-control normal-txtbox" value="'+product_ton_qty+'"  readonly />';  
				apnd += '<b>KG</b><input type="text" name="dne_child_detail_kg_qty[]" id="dne_child_detail_kg_qty_'+i+'" class="form-control normal-txtbox" value="'+product_kg_qty+'"  readonly /></td>';
				apnd += '<td><input type="text" name="dne_child_detail_rate[]" id="dne_child_detail_rate_'+i+'" class="form-control normal-txtbox" value="'+product_rate+'" style="margin-top:20px;" readonly /></td>';  
				apnd += '<td><input type="text" name="dne_child_detail_frg_rate[]" id="dne_child_detail_frg_rate_'+i+'" class="form-control normal-txtbox" value="'+product_frgn_rate+'"  style="margin-top:20px;" readonly /></td>';
				apnd += '<td><b>Inches</b><input type="text" name="dne_child_detail_dw_inches[]" id="dne_child_detail_dw_inches_'+i+'" class="form-control normal-txtbox" onBlur="GetLcalD(2,'+i+'),GetWeightClc(1,'+i+')"   />';
				apnd += '<b>MM</b><input type="text" name="dne_child_detail_dw_mm[]" id="dne_child_detail_dw_mm_'+i+'" class="form-control normal-txtbox" onBlur="GetLcalD(3,'+i+'),GetWeightClc(1,'+i+')"   /></td>';  
				apnd += '<td><b>Feet</b><input type="text" name="dne_child_detail_dnl_feet[]" id="dne_child_detail_dnl_feet_'+i+'" class="form-control normal-txtbox" value="" onBlur="GetDFeet(1,'+i+'),GetWeightClc(1,'+i+')" />';
				//apnd += '<b>Feet.In</b><input type="text" name="dne_child_detail_dnl_feet_ing[]" id="dne_child_detail_dnl_feet_ing_'+i+'" class="form-control normal-txtbox" value="" onBlur="GetDFeet(1,'+i+'),GetWeightClc(1,'+i+')" />';
				apnd += '<b>Feet.In</b><input type="hidden" name="dne_child_detail_dnl_feet_ing[]" id="dne_child_detail_dnl_feet_ing_'+i+'" class="form-control normal-txtbox" value="" onBlur="GetDFeet(1,'+i+'),GetWeightClc(1,'+i+')" />';
				apnd += '<b>METER</b><input type="text" name="dne_child_detail_dnl_m[]" id="dne_child_detail_dnl_m_'+i+'" class="form-control normal-txtbox" value=""  /></td>';
				apnd += '<td><b>KG</b><input type="text" name="dne_child_detail_dw_kg[]" id="dne_child_detail_dw_kg_'+i+'" class="form-control normal-txtbox" value="" readonly=""/>';
				apnd += '<b>Ton</b><input type="text" name="dne_child_detail_dnl_dw_ton[]" id="dne_child_detail_dnl_dw_ton_'+i+'" class="form-control normal-txtbox" value="" readonly="" /></td>';
				apnd += '<td><input type="text" name="dne_child_detail_amount_cur[]" id="dne_child_detail_amount_cur_'+i+'" class="form-control normal-txtbox" value="" style="margin-top:20px;" /></td>';
				apnd += '<td><input type="text" name="dne_child_detail_amount[]" id="dne_child_detail_amount_'+i+'" class="form-control normal-txtbox" value=""  style="margin-top:20px;" /></td></tr>';
			}
			var i	= i+1;
		}
	}
	//$("#child_receipt_table >tbody").html(apnd);
	$("#child_receipt_table >tbody").append(apnd);
}
  function GetWeightClc(type,id){
	  //alert("uben");
	  
	var dw_inches =$('#dne_child_detail_dw_inches_'+id).val();
	var dnl_feet =$('#dne_child_detail_dnl_feet_'+id).val();
	
	var width_inches 	=	$('#dne_child_detail_width_inches_'+id).val();
	var length_feet 	=	$('#dne_child_detail_length_feet_'+id).val();
	var ton_qty 		=	$('#dne_child_detail_ton_qty_'+id).val();
	
	var dw_ton			= ((dw_inches*dnl_feet)/(width_inches*length_feet))*ton_qty;
	$('#dne_child_detail_dnl_dw_ton_'+id).val(dw_ton)  
	var prod_ton =dw_ton;
	var type		= 1;
	var prod_kg =$('#dne_child_detail_dw_kg_'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#dne_child_detail_dw_kg_'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#dne_child_detail_dnl_dw_ton_'+id).val(prod_val);
	}
	//var prod_ton =$('#dne_child_detail_dnl_dw_ton_'+id).val();
		GetAmountrate(prod_ton,id);
	
 }
 function GetAmountrate(prod_ton,id){
 	var frg_rate =$('#dne_child_detail_frg_rate_'+id).val();
 	var rate =$('#dne_child_detail_rate_'+id).val();
	var f_rate =$('#dne_frgn_rate').val();
	if(frg_rate>0){
		$('#dne_child_detail_amount_cur_'+id).val(prod_ton*frg_rate);
		$('#dne_child_detail_amount_'+id).val(prod_ton*frg_rate*f_rate);
	}
	else{
		$('#dne_child_detail_amount_'+id).val(prod_ton*rate);
	}
	
 }
function GetDFeet(calculation_id,id){
	if(calculation_id==1){

		var calc_amount_feet 	= document.getElementById('dne_child_detail_dnl_feet_'+id).value;	
		//var calc_amount_inch 	= document.getElementById('dne_child_detail_dnl_feet_ing_'+id).value;
		
		//var calc_amount			= Number(calc_amount_feet)+Number(calc_amount_inch);
		var calc_amount = calc_amount_feet;

	}

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 
			//added condition by AuthorsMM
			if(calculation_id!=3) {
				document.getElementById('dne_child_detail_dnl_m_'+id).value 		= data_t[3];
			}
			//document.getElementById('quotation_entry_product_detail_length_meter'+id).value 		= data_t[3];

		}

	);

}

function GetLcalD(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('dne_child_detail_dw_inches_'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('dne_child_detail_dw_mm_'+id).value;	
	}
	
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			if(calculation_id==3){
			document.getElementById('dne_child_detail_dw_inches_'+id).value 		= data_t[1];
			}
			if(calculation_id==2){
			document.getElementById('dne_child_detail_dw_mm_'+id).value 			= data_t[2];
			}
		}

	);

}

function requestPoFn(val){
	//Added by AuthorsMM
	$("#receipt_table >tbody").html('');
	$("#child_receipt_table >tbody").html('');
	
	$.getJSON('product-detail.php?action=request_details&poid='+val,function(josn) { 
		if(0<josn.length){
			var apnd;
			if(josn[0]['supplier_location']==1){
				var location ="Local";
			}else if(josn[0]['supplier_location']==2){
				var location ="Oversea";
			}
			$("#supplier_name").val(josn[0]['supplier_name']);
			$("#supplier_id").val(josn[0]['supplier_id']);
			$("#supplier_location").val(location);
			$("#po_date").val(josn[0]['pI_invoice_date']);
			$("#dne_frgn_rate").val(josn[0]['pR_rate']);
			
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
function GetDisplayPrdt(){
	var type_one	= document.getElementById('dn_entry_type_one_id').value;
	document.getElementById('product_detail_panel').style.display ='none';
	document.getElementById('child_product_detail_panel').style.display ='none';
	if(type_one==2){
		document.getElementById('product_detail_panel').style.display ='';
	}
	else if(type_one==1){
		document.getElementById('child_product_detail_panel').style.display ='';
	}
}

function total_feet(id) {
	var po_qty= Number($("#po_qty_"+id).val());
	var qty=Number($('#qty_'+id).val());
	if(document.getElementById("feet_"+id).value == ""){
		var feet = 0;
	} else {
		var feet = document.getElementById("feet_"+id).value;
	}
	po_qty = po_qty==''?0:po_qty;
	qty = qty==''?0:qty;
	if(qty > po_qty) {
		alert("Please enter valid quantity!");
		$('#qty_'+id).val('');
		$('#total_feet_'+id).val('');
		
		$('#tot_amount_cur_'+id).val('');
		$('#tot_amount_'+id).val('');
		return false;
	} else {
		document.getElementById("total_feet_"+id).value = qty * parseFloat(feet);
	}
	
	var rate=Number($('#rate_'+id).val());
	var frgn_rate=Number($('#f_rate_'+id).val());
	
	var f_rate =$('#dne_frgn_rate').val();
	if(frgn_rate>0){
		$('#tot_amount_cur_'+id).val(qty*frgn_rate);
		$('#tot_amount_'+id).val(qty*frgn_rate*f_rate);
	}
	else{
		$('#tot_amount_'+id).val(qty*rate);
	}
	
}

function product_count(val,obj,sno){
	
	var po_qty= Number($("#po_qty_"+sno).val());
	/*var received_qty= Number($("#received_qty_"+sno).val());
	var currentsply_qty= Number($("#current_qty_"+sno).val());
	var reject_qty= Number($("#reject_qty_"+sno).val());
	
	var qty =po_qty-received_qty;
	if(qty>=val){
	
		$("#accept_qty_"+sno).val(currentsply_qty-reject_qty);
		var accept_qty= Number($("#accept_qty_"+sno).val());

		var pending =(po_qty)-(received_qty+accept_qty);
		$("#pending_qty_"+sno).val(pending);

	}else{
		alert("Please enter below PO qty");
		$(obj).val('');
		
		var po_qty= Number($("#po_qty_"+sno).val());
		var received_qty= Number($("#received_qty_"+sno).val());
		var currentsply_qty= Number($("#current_qty_"+sno).val());
		var reject_qty= Number($("#reject_qty_"+sno).val());
		$("#accept_qty_"+sno).val(currentsply_qty-reject_qty);
		var accept_qty= Number($("#accept_qty_"+sno).val());

		var pending =(po_qty)-(received_qty+accept_qty);
		$("#pending_qty_"+sno).val(pending);

	}*/
	
	var qty=Number($('#qty_'+sno).val());
	if(document.getElementById("feet_"+sno).value == ""){
		var feet = 0;
	} else {
		var feet = document.getElementById("feet_"+sno).value;
	}
	po_qty = po_qty==''?0:po_qty;
	qty = qty==''?0:qty;
	if(qty > po_qty) {
		alert("Please enter valid quantity!");
		$('#qty_'+sno).val('');
		$('#total_feet_'+sno).val('');
		
		$('#tot_amount_cur_'+sno).val('');
		$('#tot_amount_'+sno).val('');
		
		return false;
		
	} else {
		document.getElementById("total_feet_"+sno).value = qty * parseFloat(feet);
	}
	
	var id = sno;
	var rate=Number($('#rate_'+id).val());
	var frgn_rate=Number($('#f_rate_'+id).val());
	
	var f_rate =$('#dne_frgn_rate').val();
	if(frgn_rate>0){
		$('#tot_amount_cur_'+id).val(qty*frgn_rate);
		$('#tot_amount_'+id).val(qty*frgn_rate*f_rate);
	}
	else{
		$('#tot_amount_'+id).val(qty*rate);
	}
	
}

 
 