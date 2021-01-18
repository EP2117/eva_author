/*var a_fields = {
	
	'user_branch_id':{'l':'Branch','r':true,'f':'notempty','t':'t_user_branch_id'}
 
},

o_config = {
	'to_disable' : ['Submit', 'Reset'],
	'alert' : 1
}

// validator constructor call
var reportValidation = new validator('search_form', a_fields, o_config);
*/
function getCity(id,type){ //alert('prakash');
	
	if(type==1){
		$.get('get-city.php',
			{id:id,type:type},
			function(data) { $('#search_township_id').html( data ); }
		);	
	}else{
		$.get('get-city.php',
			{id:id,type:type},
			function(data) { $('#search_prodcut_id').html( data ); }
		);
	}
}

