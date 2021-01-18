checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('invoice_form').elements.length; i++) {
	  document.getElementById('invoice_form').elements[i].checked = checked;
	}
}

function GetDetail(){
	var m_id 			= getQuotationId();
	var po_id 			= document.getElementById('purchaseid').value;
	var product_type 	= document.getElementById('invoice_entry_product_type').value;
	$.get('popup-product-detail.php',
		{m_id:m_id,po_id:po_id,product_type:product_type},
		function(data) { $('#dynamic-content').html( data ); }
	);	
}

function AddproductDetail(){
	//var apnd	= '';
	//var i 		= $("#invoice_table >tbody >tr ").length;
	
	//var x		= document.getElementsByName("chk_product_id[]");
	var x						= document.getElementsByName("chk_product_id[]");
	for (var i = 0; i < x.length; i++) {
		if (x[i].checked ==true) {
			var ord_id 					=  x[i].value;
			var product_id 				= document.getElementById('product_id'+ord_id).value;
			var purOrdPorductId			= document.getElementById('purOrdPorductId'+ord_id).value;
			var product_name 			= document.getElementById('product_name'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;
			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_inches			= document.getElementById('product_inches'+ord_id).value;
			var brand_name				= document.getElementById('brand_name'+ord_id).value;
			var pRp_qty					= document.getElementById('pRp_qty'+ord_id).value;
			var pRp_rate				= document.getElementById('pRp_rate'+ord_id).value;
			var pRp_frignrate			= document.getElementById('pRp_frignrate'+ord_id).value;
			var pRp_ton					= document.getElementById('pRp_ton'+ord_id).value;
			var pRp_kg					= document.getElementById('pRp_kg'+ord_id).value;
			var pRp_unitprice			= document.getElementById('pRp_unitprice'+ord_id).value;
			var product_prd_type		= document.getElementById('product_prd_type'+ord_id).value;
			
			var total_amt					= document.getElementById('pRp_rate_by_currency'+ord_id).value;
			var rec_rate				= eval(pRp_frignrate)+eval(pRp_rate);
			if(product_prd_type==3){
				var text	= "hidden";
			}
			else{
				var text	= "text";
			}
			//var product_val				= product_id+'-'+product_name;
			var last_val = $("#invoice_apnd").val();
			
			var sno      = parseInt(last_val)+1;
			
				apnd = '<tr id="remove_req_'+sno+'">';
				apnd += '<td><input type="hidden" name="arr_count[]" value="'+sno+'"><input type="hidden" name="pid_'+sno+'" value=""> <input type="hidden" name="pid_'+sno+'" class="sd_id" value=""><input type="hidden" name="productid'+sno+'" id="productid_'+sno+'"  value='+product_id+' class="pd_id"><input type="hidden" name="po_detail_id_'+sno+'" id="po_detail_id_'+sno+'"  value='+purOrdPorductId+'>'+product_name+'-'+product_code+'</td>';
				apnd += '<td>'+product_uom+'</td>';
				apnd += '<td>'+brand_name+'</td>';
apnd += '<td><input type="text" class="form-control" name="po_qty_'+sno+'" id="po_qty_'+sno+'" value='+pRp_qty+' readonly></td>';
				apnd += '<td><input type="text" readonly class="form-control" style="text-align:right;" name="rate_'+sno+'" id="rate_'+sno+'" value='+pRp_rate+'></td>';
				apnd += '<td><input type="text" readonly class="form-control" style="text-align:right;"  name="frgn_rate_'+sno+'" id="frgn_rate_'+sno+'" value='+pRp_frignrate+' ></td>';				
				apnd += '<td><input type="text" readonly class="form-control" style="text-align:right;" name="prd_ton_'+sno+'" id="prd_ton_'+sno+'" value='+pRp_ton+'></td>';
				apnd += '<td><input type="text" readonly class="form-control" style="text-align:right;"  name="prd_kg_'+sno+'" id="prd_kg_'+sno+'" value='+pRp_kg+' ></td>';
				
				apnd += '<td><input type="text" class="form-control" style="text-align:right;" name="prd_loss_ton_'+sno+'" id="prd_loss_ton_'+sno+'" onBlur="ton_calculation('+sno+',1);GetLossamt('+sno+');" ></td>';
				apnd += '<td><input type="text"  class="form-control" style="text-align:right;"  name="prd_loss_kg_'+sno+'" id="prd_loss_kg_'+sno+'"  onBlur="ton_calculation('+sno+',2);" ></td>';
                apnd += '<td><input type="text"  class="form-control" style="text-align:right;" name="prd_total_ton_'+sno+'" id="prd_total_ton_'+sno+'"  readonly ></td>';
				apnd += '<td><input type="text"  class="form-control" style="text-align:right;"  name="prd_total_kg_'+sno+'" id="prd_total_kg_'+sno+'"  readonly ></td>';
				apnd += '<td><input type="text"  class="form-control" style="text-align:right;"  name="prd_loss_amount_'+sno+'" id="prd_loss_amount_'+sno+'"  ></td>';
				
				apnd += '<td><input type="text" class="form-control" style="text-align:right;" name="dispercent_'+sno+'" id="dispercent_'+sno+'" onkeyup="return discountcalulation('+sno+');"></td>';
				apnd += '<td><input type="text" class="form-control" style="text-align:right;" name="disamnt_'+sno+'" id="disamnt_'+sno+'" onChange="return discountcalulation(this.value,this,'+sno+',2);" readonly=""><input type="hidden" class="form-control discount_amt" style="text-align:right;" name="discount_'+sno+'" id="discount_'+sno+'"></td>';
				apnd += '<td><input type="text" class="form-control" style="text-align:right;" name="disamnt_cur_'+sno+'" id="disamnt_cur_'+sno+'" onChange="return discountcalulation(this.value,this,'+sno+',2);" readonly=""><input type="hidden" class="form-control discount_cur_amt" style="text-align:right;" name="discount_cur_'+sno+'" id="discount_cur_'+sno+'"></td>';
				apnd += '<td><input type="text" class="form-control unit_amount" style="text-align:right;" name="total_amt_'+sno+'" id="total_amt_'+sno+'"  readonly value="'+total_amt+'"></td>';
				apnd += '<td><input type="text" class="form-control unit_amnt" style="text-align:right;" name="total_'+sno+'" id="total_'+sno+'"  readonly value='+pRp_unitprice+'></td>';
				apnd += '<td><input type="'+text+'" class="form-control rec_qty" style="text-align:right;" name="receive_qty_'+sno+'" id="receive_qty_'+sno+'" onBlur="get_product_con_detail('+sno+','+rec_rate+')"></td>';
				
				
				
				apnd += '</tr>';
				
				
				$("#invoice_apnd").val(sno);
				$("#invoice_table >tbody").append(apnd);
				
		}

	}
			
			
		var total	= 0;
		
		$(".unit_amnt").each(function (){
		if($(this).val()!=''){
			var amnt = $(this).val().replace(/,/g, '');	
			total =Number(total)+Number(amnt);
			
		}
		});
	$("#invoicetotal").val(total);
	
		var tot_amt	= 0;
		$(".unit_amount").each(function (){
		if($(this).val()!=''){
			var amnts = $(this).val().replace(/,/g, '');	
			tot_amt =Number(tot_amt)+Number(amnts);
			
		}
		});
		$("#invoice_total_amt").val(tot_amt);
		net_amunt();
	}
	/*function get_currency(id){
		
		var rate =$('#frgn_rate_'+id).val();
		var ton =$('#prd_ton_'+id).val();
		
		total=parseFloat(rate)*parseFloat(ton);
		
		$('#total_amt_'+id).val(total.toFixed(2));
		
	}
*/

	function get_curr_mmk_amt(id){
		
		var ton=$('#product_con_entry_child_product_detail_ton_qty_'+id).val();
		var rate=$('#product_rate_'+id).val();
		var exc_rate = $('#purchase_exc_rate').val();
		
		total=parseFloat(ton)*parseFloat(rate);
		
		$('#product_con_entry_amount_by_currency_'+id).val(total.toFixed(3));
		total1=total*parseFloat(exc_rate);
		$('#product_con_entry_amount_by_mmk_'+id).val(total1.toFixed(3));
		
	}


 function ton_calculation(id,val){
	 
	var prod_ton =$('#prd_loss_ton_'+id).val();
	var prod_kg =$('#prd_loss_kg_'+id).val();
	if(val==1){
		var prod_val	= prod_ton*1000;
		$('#prd_loss_kg_'+id).val(prod_val)	;
	}
	if(val==2){
		var prod_val	= prod_kg*0.001;
		$('#prd_loss_ton_'+id).val(prod_val);
	}
	var prod_loss_ton =$('#prd_loss_ton_'+id).val();
	var prod_loss_kg =$('#prd_loss_kg_'+id).val();
	var prod_ton =$('#prd_ton_'+id).val();
	var prod_kg =$('#prd_kg_'+id).val();
	$('#prd_total_ton_'+id).val(prod_ton-prod_loss_ton);
	$('#prd_total_kg_'+id).val(prod_kg-prod_loss_kg);
 }

function getosf_amt(id,type){
		
		var osf_feet	= document.getElementById('product_con_entry_osf_length_feet_'+id).value;
		var c_feet		= document.getElementById('product_con_entry_child_product_detail_length_feet_'+id).value;
		var c_ton		= document.getElementById('product_con_entry_child_product_detail_ton_qty_'+id).value;
		
		var osf_ton		= (eval(osf_feet)/eval(c_feet))*c_ton;
		document.getElementById('product_con_entry_osf_uom_ton_'+id).value	= osf_ton;
		if(type==3){
		var prod_ton=document.getElementById('product_con_entry_osf_uom_ton_'+id).value;
		
		var prod_val	= prod_ton*1000;
		$('#product_con_entry_osf_uom_kg_'+id).val(prod_val)	;
		}
		
	/*	var prod_val	= prod_ton*1000;
		$('#prd_loss_kg_'+id).val(prod_val)	;*/
	
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
 function purchasedetails(val){
	 
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
			$("#po_date").val(josn[0]['pR_purchase_date']);
			$("#creditamnt").val(josn[0]['supplier_total_credit_limit']);
			$("#purchase_exc_rate").val(josn[0]['pR_rate']);
			$("#inv_advance").val(josn[0]['pR_advanceAmnt']);
			$("#inv_advance_amt").val(josn[0]['pR_advance_amount']);
			var exc_rate		= josn[0]['pR_rate'];
			var total =0;
				$("#invoicetotal").val(forNum(total));
			$("#net_total").val(forNum(total));
		}else{
			alert("No record found")
		}
		
	});
 }
 function get_product_con_detail(id,rate){//alert(rate);
	var rowCount = $('#child_product_detail >tbody >tr').length;
	var prod_id		= getPrd_Id(); 
	//var total_qty	= $("#receive_qty_"+id).val();
	var total_qty	= getQty_Id();
	
	$.get("product-coin-detail.php",
		{prod_id:prod_id,total_qty:total_qty,row_cnt:rowCount,rate:rate},
		function(data) {
			$("#child_product_detail_display").html(data);	
			$(".select2").select2();
		}

	);
 }
 
 function getQty_Id(){
	var m_id = '';
	var x = $('.rec_qty').map(function() { return this.value; }).get();
    //var x=document.getElementsByName("purchase_order_entry_id");
	for (var i = 0; i < x.length; i++) {
		if (m_id == '') {
			m_id = x[i];
			//m_id = document.getElementsByName("purchase_order_entry_id")[i].value;
		} else {
			m_id = m_id + ','+x[i];
			//m_id = m_id + ','+ document.getElementsByName("purchase_order_entry_id")[i].value ;
		}
	}
	return m_id;
}
function getPrd_Id(){
	var m_id = '';
	var x = $('.pd_id').map(function() { return this.value; }).get();
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
function GetWcalc(calculation_id,id){

	if(calculation_id==2){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_width_inches_'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_width_mm_'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_child_product_detail_width_inches_'+id).value 		= data_t[1];
			document.getElementById('product_con_entry_child_product_detail_width_mm_'+id).value 			= data_t[2];
			document.getElementById('product_con_entry_osf_width_inches_'+id).value 						= data_t[1];
			document.getElementById('product_con_entry_osf_width_mm_'+id).value 							= data_t[2];
		}

	);

}

function GetWcalcation(id,calculation_id){
	if(calculation_id==5){
		var calc_amount 	= document.getElementById('product_con_entry_osf_width_inches_'+id).value;	
	}else if(calculation_id==6){
		var calc_amount 	= document.getElementById('product_con_entry_osf_width_mm_'+id).value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_osf_width_inches_'+id).value 		= data_t[1];
			document.getElementById('product_con_entry_osf_width_mm_'+id).value 			= data_t[2];
		}
	);

}

function GetCLcalc(calculation_id,id){

	if(calculation_id==1){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_length_feet_'+id).value;	
	}
	else if(calculation_id==4){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_length_mm_'+id).value;	
	}

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_child_product_detail_length_feet_'+id).value 		= parseFloat(data_t[0]);
			document.getElementById('product_con_entry_child_product_detail_length_mm_'+id).value 			= data_t[3];
		}
	);

}

function getcalculation(calculation_id,id){/*alert('prakash');*/

	if(calculation_id==1){
		var calc_amount 	= document.getElementById('product_con_entry_osf_length_feet_'+id).value;	
	}
	else if(calculation_id==4){
		var calc_amount 	= document.getElementById('product_con_entry_osf_length_m_'+id).value;	
	}
	

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_osf_length_feet_'+id).value 		= parseFloat(data_t[0]);
			document.getElementById('product_con_entry_osf_length_m_'+id).value 			= data_t[3];
		}
	);

}
 function get_product(val,obj,sno,type){
	
	$.getJSON('product-detail.php?action=get_prodname&val='+val,function(json) { 
		if(json.length>0){																						
			var productName = [];		
			for(var i=0;i<json.length;i++){			
				productName[i] = json[i]['product_id']+' - '+json[i]['product_name'];
			}	
			$(obj).autocomplete({
				maxResults: 10,
				source: productName,
				select: function(event,ui) { 
					var textval = ui.item.value;
					var item = textval.split(' - ');
					get_productdetails(item[0],obj,sno,type);
				}
			});		
		}else{
			alert("No data available");
		}
	});	
 }
 
 function get_productdetails(id,obj,sno,type){
	
	$.getJSON('product-detail.php?action=prod_details&id='+id,function(json) { 
		if(type==1){		
			$("#prod_code_"+sno).val(json[0]['product_code']);
			$("#prod_uom_"+sno).val(json[0]['product_uom_name']);
		}else if(type==2){
			$("#inprodcode_"+sno).val(json[0]['product_code']);
			$("#inproduom_"+sno).val(json[0]['product_uom_name']);
		}
	});	
	
																							
 }
 function GetLossamt(id){
		var t_qty = Number($("#prd_loss_ton_"+id).val());
		var rate = Number($("#rate_"+id).val());
		var frgn_rate = Number($("#frgn_rate_"+id).val());
		var e_rate = Number($("#purchase_exc_rate").val());
		if(rate>0){
			var loss_amt	= t_qty*rate;
			$("#prd_loss_amount_"+id).val(loss_amt.toFixed(2));	
		}
		else{
			var loss_amt	= t_qty*frgn_rate*e_rate;
			$("#prd_loss_amount_"+id).val(loss_amt.toFixed(2));	
		}
 
 }
function discountcalulation(id){
		
		var rate = Number($("#rate_"+id).val());
		var frgn_rate = Number($("#frgn_rate_"+id).val());
		var p_qty = Number($("#po_qty_"+id).val());
		var t_qty = Number($("#prd_ton_"+id).val());
		if(p_qty>0 && p_qty!=''){
			var qty	= p_qty;	
		}
		else{
			var qty	= t_qty;	
		}
		var e_rate = Number($("#purchase_exc_rate").val());
		//var dispercent = Number($('#dispercent'+sno).val());
		var dispercent = Number($("#dispercent_"+id).val());
		var total1_cur	= 0;
		var total_rate_cur	= 0;
		if(rate!='' || rate!='0.00'){
			var total = parseFloat(qty) * parseFloat(rate);
			var total1=total * parseFloat(dispercent) /100;
			var total_rate =  parseFloat(total)-total1;
			/*var tot =parseFloat(frgn_rate) * parseFloat(t_qty);
			var tot1=tot * parseFloat(dispercent) /100;
			var tot2=parseFloat(tot)-tot1;*/
		}else{
			var total = parseFloat(qty) * (parseFloat(frgn_rate)*parseFloat(e_rate));
			var total1=total * parseFloat(dispercent) /100;
			var total_rate =  parseFloat(total)-total1;
			
			var total_cur = parseFloat(qty) * (parseFloat(frgn_rate));
			var total1_cur=total_cur * parseFloat(dispercent) /100;
			var total_rate_cur =  parseFloat(total_cur)-total1_cur;
		}
		$("#disamnt_"+id).val(total1.toFixed(2));	
		$("#disamnt_cur_"+id).val(total1_cur.toFixed(2));
		
		$("#total_"+id).val(total_rate.toFixed(2));	
		$("#total_amt_"+id).val(total_rate_cur.toFixed(2));	
		var total		= 0;
		$(".unit_amnt").each(function (){
		if($(this).val()!=''){
			var amnt = $(this).val().replace(/,/g, '');	
			total =Number(total)+Number(amnt);
		}
		});
		$("#invoicetotal").val(total);
		if(frgn_rate>0){
			var tot_cut	= 0;
			$(".unit_amount").each(function (){
			if($(this).val()!=''){
				var amnt = $(this).val().replace(/,/g, '');	
				tot_cut =Number(tot_cut)+Number(amnt);
			}
			});
			$("#invoice_total_amt").val(tot_cut);
		}
		
		get_dis_amt(id);
 }
 
 /*function discountcalulation(id){
		
		var rate = Number($("#rate_"+id).val());
		var frgn_rate = Number($("#frgn_rate_"+id).val());
		var p_qty = Number($("#po_qty_"+id).val());
		var t_qty = Number($("#prd_ton_"+id).val());
		if(p_qty>0 && p_qty!=''){
			var qty	= p_qty;	
		}
		else{
			var qty	= t_qty;	
		}
		var e_rate = Number($("#purchase_exc_rate").val());
		var dispercent = Number($("#dispercent_"+id).val());
		if(rate!='' || rate!='0.00'){
			var total = parseFloat(qty) * parseFloat(rate);
			var total1=total * parseFloat(dispercent) /100;
			var total_rate =  parseFloat(total)-total1;
		}else{
			var total = parseFloat(qty) * (parseFloat(frgn_rate)*parseFloat(e_rate));
			var total1=total * parseFloat(dispercent) /100;
			var total_rate =  parseFloat(total)-total1;
		}
		$("#disamnt_"+id).val(total1.toFixed(2));	
		
		$("#total_"+id).val(total_rate.toFixed(2));	
		var total	= 0;
		$(".unit_amnt").each(function (){
		if($(this).val()!=''){
			var amnt = $(this).val().replace(/,/g, '');	
			total =Number(total)+Number(amnt);
		}
		});
		$("#invoicetotal").val(total);
		get_dis_amt(id);
 }*/
 
 function get_dis_amt(id){
	
	 var total=0;
	 
	 var rate_total = 0;
	 var frate_total = 0;
	 
	 for(var i=1;i<=parseInt(id);i++){
		var dis_amt		= Number($("#disamnt_"+i).val());
		//var rate_tol	= Number($("#total_"+i).val());
		
		total			= total + parseFloat(dis_amt);
		//rate_total		= rate_total + parseFloat(rate_tol);
		
	 }
	 $("#cashdiscount").val(total.toFixed(2));
	 /*var total	= 0;
	 for(var i=1;i<=parseInt(id);i++){
		var dis_amt		= Number($("#disamnt_cur_"+i).val());
		//var rate_tol	= Number($("#total_"+i).val());
		
		total			= total + parseFloat(dis_amt);
		//rate_total		= rate_total + parseFloat(rate_tol);
		
	 }
	 $("#cashdiscount_amt").val(total.toFixed(2));*/
	 
	 
	// $("#invoicetotal").val(rate_total.toFixed(2));
	 
	 net_amunt();
 }
 
 function net_amunt(){
		var rate_tol=Number($("#invoicetotal").val());
		var dis_amt=Number($("#cashdiscount").val());
		var adv_amt=Number($("#inv_advance").val());
		if(dis_amt==''){
			dis_amt	= 0;
		}
		var rate_tol1=Number($("#invoice_total_amt").val());
		var adv_amt1=Number($("#inv_advance_amt").val());
		
		total = parseFloat(rate_tol) - (parseFloat(adv_amt));
		total1 = parseFloat(rate_tol1) - (parseFloat(adv_amt1));
		
		$("#net_total").val(total.toFixed(2));
		$("#net_total_amt").val(total1.toFixed(2));
 } 
 function GetWeightClc(id,type){
		/*var product_id		=$("#product_con_entry_child_product_detail_product_id_"+id).val();
		var prd_thick		=$("#product_con_entry_child_product_detail_thick_"+id).val();
		if(type==1){
			var prd_qty_val		=$("#product_con_entry_child_product_detail_ton_qty_"+id).val();
 		}else{
			var prd_qty_val		=$("#product_con_entry_child_product_detail_kg_qty_"+id).val();
		}
		
		$.get(
			"../ajax-file/product-weight-calc.php",
			{product_id:product_id,prd_thick:prd_thick,prd_type:type,prd_qty_val:prd_qty_val},
			function(data) {
				if(type==1){
					$("#product_con_entry_child_product_detail_kg_qty_"+id).val(data);
				}else{
					$("#product_con_entry_child_product_detail_ton_qty_"+id).val(data);
				}
			}
		);*/
	var prod_ton =$('#product_con_entry_child_product_detail_ton_qty_'+id).val();
	var prod_kg =$('#product_con_entry_child_product_detail_kg_qty_'+id).val();
	if(type==1){
		var prod_val	= prod_ton*1000;
		$('#product_con_entry_child_product_detail_kg_qty_'+id).val(prod_val)	;
	}
	if(type==2){
		var prod_val	= prod_kg*0.001;
		$('#product_con_entry_child_product_detail_ton_qty_'+id).val(prod_val);
	}
	
	
 }