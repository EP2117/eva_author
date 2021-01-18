checked = false;

  function checkedAlls () {

	if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('state_form').elements.length; i++) {

	  document.getElementById('state_form').elements[i].checked = checked;

	}

  }
// form fields description structure

var a_fields = {

	'state_country_id': {

		'l': 'Country',  // label

		'r': false,    // required

		'f': 'alpha',  // format (see below)

		't': 't_state_country_id',// id of the element to highlight if input not validated

		

		'm': null,     // must match specified form field

		'mn': 2,       // minimum length

		'mx': 10       // maximum length

	},

	'state_country_id':{'l':'Country','r':true,'f':'notempty','t':'t_state_country_id'},

	'state_name':{'l':'State Name','r':true,'f':'notempty','t':'t_state_name'}

 

},



o_config = {

	'to_disable' : ['Submit', 'Reset'],

	'alert' : 1

}



// validator constructor call

var v = new validator('state_form', a_fields, o_config);


