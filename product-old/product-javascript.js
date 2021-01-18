
function addRow() {
	var table 			= document.getElementById('multi-contact');
	var count 			= parseFloat(table.rows.length)-1;	
	$.get('product-detail.php',
		{count:count},
		function(data) { $("#multi-contact-display").append(data); }
	);
} 
function checkCode(type){
	$.get(
		"check-code.php",
		{type:type},
		function(data) { $('#pro_id').html( data ); }
	);
}

