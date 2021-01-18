var a_fields = {
	
	'user_branch_id':{'l':'Branch','r':true,'f':'notempty','t':'t_user_branch_id'}
 
},

o_config = {
	'to_disable' : ['Submit', 'Reset'],
	'alert' : 1
}

// validator constructor call
var reportValidation = new validator('search_form', a_fields, o_config);

function getCity(state_id){
	
		$.get('get-city.php',
			{state_id:state_id},
			function(data) { $('#cityDiv').html( data ); }
		);	
}