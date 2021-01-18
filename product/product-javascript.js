

function addRow() {

	var table 			= document.getElementById('multi-contact');

	var count 			= parseFloat(table.rows.length);	
	var brand_id 		= $("#product_brand_id").val();
	$.get('product-detail.php',

		{count:count,brand_id:brand_id},

		function(data) { 

			//$("#multi-contact-display").append(data); 
			if(brand_id != "") {
				$("#multi-contact-display").html(data); 

				$(".select2").select2(); 
			} else {
					$("#multi-contact-display").html(''); 
			}

		}

	);

} 
function SecondDivRow(){

	var table 			= document.getElementById('multi-contacts');

	var count 			= parseFloat(table.rows.length);	

	$.get('product-detail1.php',

		{count:count},

		function(data) { 

			$("#multi-contact-displays").append(data); 

			$(".select2").select2(); 

		}

	);

}
function checkCode(type){

	$.get(

		"check-code.php",

		{type:type},

		function(data) { $('#pro_id').html( data ); }

	);

}



function Getcalc(calculation_id){

	var calc_amount 	= document.getElementById('product_feet_qty').value;

	$.get(

		"../ajax-file/product-calc.php",

		{calculation_id:calculation_id,calc_amount:calc_amount},

		function(data) {

			var data_t	= data.split('@'); 

			 /*alert(data_t[0]);

			 alert(data_t[1]);

			 alert(data_t[2]);

			 alert(data_t[3]);*/

			document.getElementById('product_feet_qty').value 		= data_t[0];

			document.getElementById('product_inches_qty').value 	= data_t[1];

			document.getElementById('product_mm_qty').value 		= data_t[2];

			document.getElementById('product_meter_qty').value 		= data_t[3];

		}

	);

}

function get_raw_detail(id){
		if(id=='3'){
		$('#multi_contacts').show();
		$('#multi_contact').show();
		$('#extra_div').show();
		}else{
		$('#multi_contacts').hide();
		$('#multi_contact').hide();		
		$('#extra_div').hide();
		}
		
		if(id == 2) {
			//$('#opp_div').show();
		} else {
			//$('#opp_div').hide();
		}
}

