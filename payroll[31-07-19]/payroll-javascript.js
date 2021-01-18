// form fields description structure
var a_fields = {
	'payroll_mm_yyyy': {
		'l': 'Month / Year',  // label
		'r': false,    // required
		'f': 'alpha',  // format (see below)
		't': 't_payroll_mm_yyyy',// id of the element to highlight if input not validated
		
		'm': null,     // must match specified form field
		'mn': 2,       // minimum length
		'mx': 10       // maximum length
	},
	
 	'payroll_mm_yyyy':{'l':'Month / Year','r':true,'f':'notempty','t':'t_payroll_mm_yyyy'},
	'payroll_upto':{'l':'Up To','r':true,'f':'notempty','t':'t_payroll_upto'},
	'payroll_branch_id':{'l':'Branch','r':true,'f':'notempty','t':'t_payroll_branch_id'}
	
	
	
},

o_config = {
	'to_disable' : ['Submit', 'Reset'],
	'alert' : 1
}

// validator constructor call
var v = new validator('generate_payslip_form', a_fields, o_config);



jQuery(document).ready(function() {
	jQuery("#payroll_mm_yyyy").monthpicker({
		showOn:     "both",
		buttonImage: "../images/calendar-icon.png",
		buttonImageOnly: true
	});
	jQuery("#month2").monthpicker({
		monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin', 'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
		monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jui', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
		showOn:     "both",
		buttonImage: "../images/calendar-icon.png",
		buttonImageOnly: true,
		changeYear: false,
		yearRange: 'c-2:c+2',
		dateFormat: 'MM y'
	});
	jQuery("#date1").datepicker({
		showOn:     "both",
		buttonImage: "../images/calendar-icon.png",
		buttonImageOnly: true
	});
});



function getEmployeeList(mm_yyyy){
	$.get(
		"get-employee-list.php",
		{mm_yyyy:mm_yyyy},
		function(data) { $('#sub_code').html(data); }
	);
}

function getLastDate(){
	var mm_yyyy = document.getElementById('payroll_mm_yyyy').value; 
	if(mm_yyyy != '') {
		$.get(
			"get-last-date.php",
			{mm_yyyy:mm_yyyy},
			function(data) { 
				
				document.getElementById('payroll_upto').value = data ; 
			}
		);		
	}
}