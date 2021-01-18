checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('collection_entry_list_form').elements.length; i++) {

	  document.getElementById('collection_entry_list_form').elements[i].checked = checked;

	}

}

function GetSodetail(){

	

	var branch_id 		= document.getElementById('collection_entry_branch_id').value;
	var customer_id 		= document.getElementById('collection_entry_customer_id').value;
	var m_id 			= getInvoiceId();

	$.get('invoice-detail.php',

		{branch_id:branch_id,m_id:m_id,customer_id:customer_id},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 					=  document.getElementById('so_list_form').elements[i].value;

			var invoice_entry_id 		= ord_id;
			var invoice_entry_no 		= document.getElementById('invoice_entry_no'+ord_id).value;
			var invoice_entry_date 		= document.getElementById('invoice_entry_date'+ord_id).value;
			var product_net_amount 		= document.getElementById('invoice_entry_net_amount'+ord_id).value;
			var received_amt			= document.getElementById('received_amt'+ord_id).value;
			var customer_id				= document.getElementById('invoice_entry_customer_id'+ord_id).value;
			var table 					= document.getElementById('so_detail');

			var row_cnt     			= parseFloat(table.rows.length)-1;	

			$( "#so_detail_display" ).append( 

			"<tr><td>"+invoice_entry_no+"</td><td><input class='form-control' type='text'  name='collection_entry_detail_invoice_amount[]' id='collection_entry_detail_invoice_amount"+row_cnt+"' value='"+product_net_amount+"'  /><input type='hidden'  name='collection_entry_detail_customer_id[]' id='collection_entry_detail_customer_id"+row_cnt+"' value='"+customer_id+"'  class='dc_id'  /> <input type='hidden'  name='collection_entry_detail_invoice_entry_id[]' id='collection_entry_detail_invoice_entry_id"+row_cnt+"' value='"+invoice_entry_id+"'  class='dc_id'  /></td><td><input class='form-control' type='text'  name='collection_entry_detail_paid_amount[]' id='collection_entry_detail_paid_amount"+row_cnt+"' value='"+received_amt+"' /><td><input class='form-control' type='text'  name='collection_entry_detail_amount[]' id='collection_entry_detail_amount"+row_cnt+"' onkeyup='get_coll_amt("+row_cnt+");get_colldis("+row_cnt+");'  /></td><td><input class='form-control' type='text'  name='collection_entry_detail_disc_amount[]' id='collection_entry_detail_disc_amount"+row_cnt+"' onkeyup='get_colldis("+row_cnt+");' /></td><td><input class='form-control' type='text'  name='collection_entry_detail_balance_amount[]' id='collection_entry_detail_balance_amount"+row_cnt+"'   /></td><td><select class='form-control' name='collection_entry_detail_payment_mode[]' id='collection_entry_detail_payment_mode"+row_cnt+"' onchange='placeBank(this.value,"+row_cnt+");'><option value='1'>Cash</option><option value='2'>Bank</option></select></td><td><select class='form-control' name='collection_entry_detail_bank_id[]' id='collection_entry_detail_bank_id"+row_cnt+"'><option value=''>--Select--</option></select></td><td><textarea class='form-control' name='collection_entry_detail_remarks[]' id='collection_entry_detail_remarks"+row_cnt+"' ></textarea></td></tr>");
		}

	}

}

function getInvoiceId(){
	var m_id = '';
	var x = $('.dc_id').map(function() { return this.value; }).get();
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

function placeBank(bank_id,id){
	
	
	
if(bank_id==2){
	
	//alert(id);
	
	$.get('get_bank.php',

		{},

		function(data) { $('#collection_entry_detail_bank_id'+id).html( data ); }

	);
	
}else{//alert('fdag');
	
	$('collection_entry_detail_bank_id'+id).val()='';
	
}
	
}

function get_colldis(id){
	//alert(id);
	
	var inv=$('#collection_entry_detail_invoice_amount'+id).val();
	var pad=$('#collection_entry_detail_paid_amount'+id).val();
	var col=$('#collection_entry_detail_amount'+id).val();
	var dis=$('#collection_entry_detail_disc_amount'+id).val();
	
	if(col==''){
		col1=0;
	}else{
		col1= col;
	}
	
	if(dis==''){
		dis1=0;
	}else{
		dis1= dis;
	}
	
	total = parseFloat(inv) - (parseFloat(col1) + parseFloat(dis1) + parseFloat(pad));
	document.getElementById('collection_entry_detail_balance_amount'+id).value= (isNaN(total)?0.00:parseFloat(total).toFixed(2));
}

function get_coll_amt(id)

{	

	var table 				= document.getElementById('so_detail_display');

	var total_row     		= parseFloat(table.rows.length);			
//alert(total_row);
	var sum_val = 0;

	for(var i=0; i< parseInt(total_row); i++) {

		var total_detail_amt = document.getElementById('collection_entry_detail_amount'+i).value;

		

		if(total_detail_amt != '') {	

		var toal_amount 	 = (isNaN(total_detail_amt)?0.00:parseFloat(total_detail_amt));

		sum_val = parseFloat(sum_val)+parseFloat(toal_amount);

		}

	}

	var gross_amount 		= (isNaN(sum_val)? 0.00 : parseFloat(sum_val));

	document.getElementById('collection_entry_total_amount').value 	= (isNaN(gross_amount)?0.00:parseFloat(gross_amount).toFixed(2));

}