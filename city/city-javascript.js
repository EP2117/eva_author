
 checked = false;
  function checkedAll () {
	if (checked == false){checked = true}else{checked = false}
for (var i = 0; i < document.getElementById('city_list_form').elements.length; i++) {
  document.getElementById('city_list_form').elements[i].checked = checked;
}
  }
  
  
function getState(country_id){
	$.get('../ajax-file/get-states.php',
		{country_id:country_id,filed_name:'city_state_id'},
		function(data) { $('#stateDiv').html( data ); }
	);	
}
  