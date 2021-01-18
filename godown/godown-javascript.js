function getState(country_id){
	$.get('../ajax-file/get-states.php',
		{country_id:country_id,filed_name:'godown_state_id'},
		function(data) { $('#stateDiv').html( data ); }
	);	
}

function getCity(state_id){
	$.get('../ajax-file/get-city.php',
		{state_id:state_id,filed_name:'godown_city_id'},
		function(data) { $('#cityDiv').html( data ); }
	);	
}
function addRow() {
	var table 			= document.getElementById('multi-contact');
	var count 			= parseFloat(table.rows.length)-1;	
	$("#multi-contact").append("<tr class='odd gradeX'><td><select name='godown_multi_contact_title[]' id='godown_multi_contact_title[]' class='form-control select2'> <option value=''> - Select - </option><option value='Mr.'>Mr.</option>  <option value='Mrs.'>Mrs.</option>  <option value='Miss.'>Miss.</option>  </select></td><td ><input name='godown_multi_contact_name[]' type='text' value=''  id='godown_multi_contact_name[]' class='form-control'  /> </td><td ><input name='godown_multi_contact_department[]' type='text' value='' class='form-control' id='godown_multi_contact_department[]'  /></td><td><input name='godown_multi_contact_mobile_no[]' type='number' value='' class='form-control' id='godown_multi_contact_mobile_no[]'  /></td> <td><input name='godown_multi_contact_email[]' type='email' value='' class='form-control' id='godown_multi_contact_email[]'/></td><td><input name='godown_multi_contact_extn_no[]' type='text' value='' class='form-control' id='godown_multi_contact_extn_no[]' /></td>	</tr>");
} 
function checkCode(type){
	$.get(
		"check-code.php",
		{type:type},
		function(data) { $('#pro_id').html( data ); }
	);
}
