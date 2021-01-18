checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('prn_entry_list_form').elements.length; i++) {

	  document.getElementById('prn_entry_list_form').elements[i].checked = checked;

	}

}

function getTableHeader(id){
	//$('#product_detail >tbody >tr').remove();
	if(id ==1){
	$('.rls').show(); $('.rws').hide(); $('.ccs').hide(); $('.as').hide();
	}else if(id==2){
	$('.rws').show(); $('.rls').hide(); $('.ccs').hide(); $('.as').hide();
	}else if(id==3){
	$('.ccs').show(); $('.rws').hide(); $('.rls').hide(); $('.as').hide();
	}else{
		$('.rls').hide();
		$('.rws').hide();
		$('.ccs').hide();
	}
	
}


function GetSodetail(){

	var branch_id 		= document.getElementById('prn_entry_branch_id').value;

	$.get('sales-detail.php',

		{branch_id:branch_id},

		function(data) { $('#so_detail_content').html( data ); }

	);	

}

function AddSodetail(){

	for (var i = 0; i < document.getElementById('so_list_form').elements.length; i++) {

		if (document.getElementById('so_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('so_list_form').elements[i].value;

			var production_entry_id 		= ord_id;

			var production_entry_no 		= document.getElementById('production_entry_no'+ord_id).value;

			var production_entry_date 		= document.getElementById('production_entry_date'+ord_id).value;

			var production_entry_type 		= document.getElementById('production_entry_type'+ord_id).value;
			var production_entry_type_id 		= document.getElementById('production_entry_type_id'+ord_id).value;
			var table 				= document.getElementById('so_detail');

			var row_cnt     		= parseFloat(table.rows.length)-1;	

				$( "#so_detail_display" ).append( 

				"<tr><td>"+production_entry_no+"</td><td>"+production_entry_date+"<input type='hidden'  name='prn_entry_production_entry_id' id='prn_entry_production_entry_id' value='"+production_entry_id+"'  class='dc_id'  /><input type='hidden'  name='prn_entry_type_id' id='prn_entry_type_id' value='"+production_entry_type_id+"'  /></td><td>"+production_entry_type+"</td> </tr>");
			getTableHeader(production_entry_type_id);
			GetRawDetail();

			GetDetail();

		}

	}

}

function GetDetail(){

	var production_entry_id 	= document.getElementById('prn_entry_production_entry_id').value;

	$.get('product-detail.php',

		{production_entry_id:production_entry_id},

		function(data) { $('#product_detail_display').html( data ); }

	);	

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

function GetRawDetail(){

	var production_entry_id 	= document.getElementById('prn_entry_production_entry_id').value;

	$.get('raw-product-detail.php',

		{production_entry_id:production_entry_id},

		function(data) {  $('#raw_product_detail_display').html( data ); }

	);	

}

