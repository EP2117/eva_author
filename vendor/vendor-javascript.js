function getState(country_id){
	$.get('../ajax-file/get-states.php',
		{country_id:country_id,filed_name:'customer_state_id'},
		function(data) { $('#stateDiv').html( data ); }
	);	
}

function getCity(state_id){
	$.get('../ajax-file/get-city.php',
		{state_id:state_id,filed_name:'customer_city_id'},
		function(data) { $('#cityDiv').html( data ); }
	);	
}
function addRow() {
//	alert("hiihi");
	var table 			= document.getElementById('multi-contact');
	var count 			= parseFloat(table.rows.length)-1;	
	$("#multi-contact").append("<tr class='odd gradeX'> <td width='33%'> <input name='vendor_detail_contact_person[]' type='text' value=''  id='vendor_detail_contact_person[]' class='form-control'  /> </td> <td width='33%'> <input name='vendor_detail_designation[]' type='text' value='' class='form-control' id='vendor_detail_designation[]'  /> </td> <td width='34%'> <input name='vendor_detail_contact_no[]' type='number' value='' class='form-control' id='vendor_detail_contact_no[]'  /> </td>	</tr>");
						
} 

