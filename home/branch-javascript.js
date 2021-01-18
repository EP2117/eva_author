function getState(country_id){
	$.get('../ajax-file/get-states.php',
		{country_id:country_id,filed_name:'branch_state_id'},
		function(data) { $('#stateDiv').html( data ); }
	);	
}

function getCity(state_id){
	$.get('../ajax-file/get-city.php',
		{state_id:state_id,filed_name:'branch_city_id'},
		function(data) { $('#cityDiv').html( data ); }
	);	
}
function checkCode(type){
	$.get(
		"check-code.php",
		{type:type},
		function(data) { $('#pro_id').html( data ); }
	);
}

