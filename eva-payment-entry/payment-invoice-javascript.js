 
   checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('payment_invoice_forms').elements.length; i++) {
	  document.getElementById('payment_invoice_forms').elements[i].checked = checked;
	}
} 
function getsupplier(id){

	$.getJSON('getsupplier.php?action=supplier&id='+id,function(json) {		
		apnd = '<option> --Select-- </option>';
			for(var i=0;i<json.length;i++){			
				apnd += '<option value="'+json[i]['supplier_id']+'">'+json[i]['supplier_name']+'</option>';
			}
		$("#supplier_name").html(apnd);
		
	});	
	
}

function addReqRow(){
	var last_val = $("#payment_apnd").val();
	var sno      = parseInt(last_val)+1;
	
	var apnd  = '<tr id="remove_req_'+sno+'">';
	
		apnd += '<td>'+sno+'</td>';
		apnd += '<td><input type="hidden" name="iid_'+sno+'" value=""><input type="hidden"  name="invoiceid_'+sno+'" id="invoiceid_'+sno+'" ><input type="text" class="form-control" name="invoiceid_no_'+sno+'" id="invoiceid_no_'+sno+'" onKeyUp="return get_invoice(this.value,this,'+sno+',1);"></td>';
		apnd += '<td><input type="text" class="form-control" name="purchaseamnt_'+sno+'" id="purchaseamnt_'+sno+'" ></td>';
		apnd += '<td><input type="text" class="form-control" name="advanceamnt_'+sno+'" id="advanceamnt_'+sno+'" ></td>';
		apnd += '<td><input type="text" class="form-control" name="paidamnt_'+sno+'" id="paidamnt_'+sno+'"></td>';
		apnd += '<td id="cur_dis_'+sno+'"></td>';
		apnd += '<td><input type="text" class="form-control" name="frgn_amount_'+sno+'" id="frgn_amount_'+sno+'" onChange="return balance_calculation(this.value,this,'+sno+');"><input type="hidden"  name="frgn_rate_'+sno+'" id="frgn_rate_'+sno+'" ></td>';
		apnd += '<td><input type="text" class="form-control" name="amount_'+sno+'" id="amount_'+sno+'" onChange="return balance_calculation(this.value,this,'+sno+');"></td>';
		apnd += '<td><input type="text" class="form-control" name="balanceamnt_'+sno+'" id="balanceamnt_'+sno+'"></td>';
		apnd += '<td><button class="glyphicon glyphicon-minus" title="Remove row"  type="button" onclick="removeRow('+sno+')"></button></td>';
		apnd += '</tr>';
		get_currncy_display(sno);
		$("#payment_apnd").val(sno);
		$("#payment_table >tbody").append(apnd);
 }
 	function get_currncy_display(sno){
		var filed_name	= 'pay_currency_id'+sno;
		$.get('../ajax-file/get-currency.php',
			{filed_name:filed_name,fld_cnt:sno},
			function(data) { $('#dynamic-content').html( data ); }
		);	
	}
 function get_invoice(val,obj,sno,type){
	 
	$.getJSON('invoice-details.php?action=get_invoice&val='+val,function(json) { 
		if(json.length>0){																						
			var productName = [];		
			for(var i=0;i<json.length;i++){	
				productName[i] = json[i]['invoiceNo'];
			}	
			$(obj).autocomplete({
				maxResults: 10,
				source: productName,
				select: function(event,ui) { 
					var idval = ui.item.value;
					get_productdetails(idval,obj,sno,type);
				}
			});		
		}else{
			alert("No data available");
			$(obj).val("");
		}
	});	
 }
 
 function get_productdetails(id,obj,sno,type){
	$.getJSON('invoice-details.php?action=invoice_details&id='+id,function(json) { 
			$("#purchaseamnt_"+sno).val(json[0]['pI_net_total']);
			$("#advanceamnt_"+sno).val(json[0]['pR_advanceAmnt']);
			$("#paidamnt_"+sno).val(json[0]['paidamount']);
			$("#invoiceid_"+sno).val(json[0]['invoiceId']);
	});	
 }
 
	
	function get_paymentterm(id){//alert(id);
		var paymentterm =id;
	        document.getElementById('d_bankname').style.display ="none";
			document.getElementById('d_acno').style.display ="none";
			document.getElementById('d_cash').style.display ="none";
		if(paymentterm==2){
			document.getElementById('d_bankname').style.display ="";
			document.getElementById('d_acno').style.display ="";
	
			
		}else{
		    document.getElementById('d_cash').style.display ="";
		
		}
	}
	
	function GetDetail(){

	var m_id 			= getQuotationId();
	var supplier_name 			= document.getElementById('supplier_name').value;
	$.get('invoice-detail.php',

		{m_id:m_id,supplier_name:supplier_name},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}
	
	function AddproductDetail(){

	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) {

		if (document.getElementById('product_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;
			
			var invoiceId 				= ord_id;

			var invoiceNo 				= document.getElementById('invoiceNo'+ord_id).value;

			var pI_invoice_mmk 			= document.getElementById('pI_invoice_mmk'+ord_id).value;
			var pI_invoice_frgn 			= document.getElementById('pI_invoice_frgn'+ord_id).value;
			var rcv_amount 				= document.getElementById('rcv_amount'+ord_id).value;
			var rcv_amount_cur			= document.getElementById('rcv_amount_cur'+ord_id).value;

			var pI_advance_mmk			= document.getElementById('pI_advance_mmk'+ord_id).value;
			var pI_advance_frgn			= document.getElementById('pI_advance_frgn'+ord_id).value;
			var pR_supplier_id			= document.getElementById('pR_supplier_id'+ord_id).value;
			var blan_name				= document.getElementById('blan_name'+ord_id).value;
			var invoice_type			= document.getElementById('invoice_type'+ord_id).value;
			
			
			var table 					= document.getElementById('payment_table');
			
			var row_cnt     			= parseFloat(table.rows.length);	

			$( "#payment_table" ).append("<tr><td><input type='hidden' name='iid_"+row_cnt+"' value=''><input type='hidden'  name='invoiceid_"+row_cnt+"' id='invoiceid_"+row_cnt+"' value='"+invoiceId+"' class='sd_id'/><input type='hidden'  name='supplier_id_"+row_cnt+"' id='supplier_id_"+row_cnt+"' value='"+pR_supplier_id+"' /> <input type='hidden'  name='payment_type_"+row_cnt+"' id='payment_type_"+row_cnt+"' value='"+invoice_type+"' /> <input type='text'  name='invoiceid_no_"+row_cnt+"' id='invoiceid_no_"+row_cnt+"' value='"+invoiceNo+"' class='form-control' readonly=''/> </td><td><input class='form-control' type='text'  name='purchaseamnt_cur_"+row_cnt+"' id='purchaseamnt_cur_"+row_cnt+"' value='"+pI_invoice_frgn+"' readonly=''  /></td><td><input class='form-control' type='text'  name='advanceamnt_cur_"+row_cnt+"' id='advanceamnt_cur_"+row_cnt+"'  value='"+pI_advance_frgn+"'  readonly=''/></td><td><input class='form-control' type='text'  name='purchaseamnt_"+row_cnt+"' id='purchaseamnt_"+row_cnt+"' value='"+pI_invoice_mmk+"' readonly=''  /></td><td><input class='form-control' type='text'  name='advanceamnt_"+row_cnt+"' id='advanceamnt_"+row_cnt+"'  value='"+pI_advance_mmk+"'  readonly=''/></td><td><input class='form-control' type='text'  name='paidamnt_cur_"+row_cnt+"' id='paidamnt_cur_"+row_cnt+"'  value='"+rcv_amount_cur+"'  readonly='' /></td><td><input class='form-control' type='text'  name='paidamnt_"+row_cnt+"' id='paidamnt_"+row_cnt+"'  value='"+rcv_amount+"'  readonly='' /></td><td><input class='form-control' type='text'  name='amount_"+row_cnt+"' id='amount_"+row_cnt+"' onkeypress='return o_obj.Alpha_Numeric(this,event);' onblur='return balance_calculation(this.value,this,"+row_cnt+",1);' /></td><td><input class='form-control' class='form-control' type='text' name='amount_cur_"+row_cnt+"' id='amount_cur_"+row_cnt+"'  onblur='return balance_calculation(this.value,this,"+row_cnt+",2);'/></td><td><input class='form-control' type='text'  name='balanceamnt_cur_"+row_cnt+"' id='balanceamnt_cur_"+row_cnt+"'  onkeypress='return o_obj.Alpha_Numeric(this,event);'readonly='' /></td><td><input class='form-control' type='text'  name='balanceamnt_"+row_cnt+"' id='balanceamnt_"+row_cnt+"'  onkeypress='return o_obj.Alpha_Numeric(this,event);' readonly=''/></td><td><input class='form-control' type='text'  name='pay_det_desc_per_"+row_cnt+"' id='pay_det_desc_per"+row_cnt+"' onChange='return discount_calculation(this.value,"+row_cnt+");' /></td><td><input class='form-control' type='text'  name='pay_det_desc_amount_"+row_cnt+"' id='pay_det_desc_amount_"+row_cnt+"' /></td></tr>");
		 //get_currncy_display(row_cnt);
		 $("#payment_apnd").val(row_cnt)
		}

	}

}
function balance_calculation_amt(val,obj,sno){
	var inv_type		=  Number($("#payment_type_"+sno).val());
	 var cur_rate		=  Number($("#payment_currency_rate").val());
	 var pur_amnt 		= 	Number($("#purchaseamnt_"+sno).val().replace(/,/g, ''));
	 var pur_amnt    	=	 Number(pur_amnt);
	 var advnc_amnt 	= 0;
	 var paid_amnt  	= Number($("#paidamnt_"+sno).val().replace(/,/g, ''));
	
	 var curnt_amnt 	= Number($("#amount_"+sno).val().replace(/,/g, ''));
	 curnt_amnt			= Number(curnt_amnt);
	
	var amnt =Number(advnc_amnt)+Number(paid_amnt)+curnt_amnt;

		
		if(pur_amnt<curnt_amnt){
			$(obj).val('');
		}
		
	 var curnt_amnt = Number($("#amount_"+sno).val().replace(/,/g, ''));
	 	 curnt_amnt = Number(curnt_amnt);
		var totamnt =Number(advnc_amnt)+Number(paid_amnt)+curnt_amnt;

		$("#balanceamnt_"+sno).val((pur_amnt-totamnt));
	
		if(inv_type==1){
			$("#balanceamnt_cur_"+sno).val((pur_amnt-totamnt));
	 		var curnt_amnt = $("#amount_"+sno).val().replace(/,/g, '');	
			$("#balanceamnt_"+sno).val(((pur_amnt-totamnt)*cur_rate));
			$("#amount_cur_"+sno).val(curnt_amnt*cur_rate);
	 	}
	}
function balance_calculation(amt,obj,sno,type){
	var inv_type		=  Number($("#payment_type_"+sno).val());
	 var pay_amt		=  Number($("#amount_"+sno).val());
	var  frgn_amt 		=  Number($("#amount_cur_"+sno).val());
	 var currency_rate	=  Number($("#payment_currency_rate").val());
	 if(type==1){
		 var frgn_amt		= 0;
		 if(currency_rate!='' && currency_rate>0){
			 var frgn_amt		=  eval(pay_amt)/eval(currency_rate);
		 }
		 $("#amount_cur_"+sno).val(frgn_amt);
	 }
	 if(type==2){
		var pay_amt1		= 0
	 	if(currency_rate!='' && currency_rate>0){
			var pay_amt1		= Number(currency_rate)*Number(frgn_amt);
			$("#amount_"+sno).val(pay_amt1)
		}
	 }
	 
		
	var purchase_amt		=  Number($("#purchaseamnt_"+sno).val());
	var purchase_ad_amt		=  Number($("#advanceamnt_"+sno).val());
	var purchase_pd_amt		=  Number($("#paidamnt_"+sno).val());
		
	
	var balance				= eval(purchase_amt)-(eval(purchase_ad_amt)+eval(pay_amt)+eval(purchase_pd_amt));
	$("#balanceamnt_"+sno).val(balance);
	var purchase_fg_amt		=  Number($("#purchaseamnt_cur_"+sno).val());
	var purchase_fg_ad_amt	=  Number($("#advanceamnt_cur_"+sno).val());
	var purchase_fg_pd_amt	=  Number($("#paidamnt_cur_"+sno).val());
	if(purchase_fg_pd_amt==''){
		purchase_fg_pd_amt	= 0;
	}
		if(purchase_fg_amt>0){
			
			var balance_frgn		= eval(purchase_fg_amt)-(eval(purchase_fg_ad_amt)+eval(frgn_amt)+eval(purchase_fg_pd_amt));
			$("#balanceamnt_cur_"+sno).val(balance_frgn);
		}
	}
 function discount_calculation(val,id){
	 var p_amt=Number($('#purchaseamnt_'+id).val());
	 var val_amt = (p_amt*val)/100;
	 $('#pay_det_desc_amount_'+id).val(val_amt)
 }
function GetcurRate(){
	
		var p_date=$('#paymentdate').val();
		var val=$('#payment_currency_id').val();
		$.get('../ajax-file/get-currency-rate.php',{p_date:p_date,val:val},function(data){ $('#payment_currency_rate').val(data)});
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
 