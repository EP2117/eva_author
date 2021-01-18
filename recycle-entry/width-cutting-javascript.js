checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('recycle_entry_list_form').elements.length; i++) {

	  document.getElementById('recycle_entry_list_form').elements[i].checked = checked;

	}

}


function GetCuttingDisplay(){
	var id  = $('#recycle_entry_type').val();
	if(id ==1){
	$('.re_width').show(); $('.re_child').show(); 
	}else if(id==2){
	$('.re_width').hide(); $('.re_child').hide(); 
	}

}



function GetDetail(){

	var m_id 			= getQuotationId();

	$.get('product-detail.php',

		{m_id:m_id},

		function(data) { $('#dynamic-content').html( data ); }

	);	

}

function AddproductDetail(){

	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) {

		if (document.getElementById('product_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;

			var product_id 			= document.getElementById('product_id'+ord_id).value;

			var product_name 			= document.getElementById('product_name'+ord_id).value;

			var product_code 			= document.getElementById('product_code'+ord_id).value;
			var product_brand_id 		= document.getElementById('product_brand_id'+ord_id).value;
			var product_category_id		= document.getElementById('product_category_id'+ord_id).value;
			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_uom_id 			= document.getElementById('product_uom_id'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id		= document.getElementById('product_colour_id'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_val	= document.getElementById('product_thick_ness_val'+ord_id).value;
			var product_total			= document.getElementById('product_con_entry_child_product_detail_total'+ord_id).value;
			var product_width_mm		= document.getElementById('product_con_entry_child_product_detail_width_mm'+ord_id).value;
			var product_width_inches		= document.getElementById('product_con_entry_child_product_detail_width_inches'+ord_id).value;
			var product_length_mm		= document.getElementById('product_con_entry_child_product_detail_length_mm'+ord_id).value;
			var product_length_feet		= document.getElementById('product_con_entry_child_product_detail_length_feet'+ord_id).value;
			var osf_uom_ton				= document.getElementById('product_con_entry_child_product_detail_osf_uom_ton'+ord_id).value;

			var table 					= document.getElementById('product_detail');
			var row_cnt     			= parseFloat(table.rows.length)-1;	
			$( "#product_detail_display" ).append( 

			"<tr><td>"+product_code+"<input type='hidden'  name='recycle_entry_product_detail_product_brand_id' id='recycle_entry_product_detail_product_brand_id' value='"+product_brand_id+"' /><input type='hidden'  name='recycle_entry_product_detail_product_category_id' id='recycle_entry_product_detail_product_category_id' value='"+product_category_id+"' /><input type='hidden'  name='recycle_entry_product_detail_product_code' id='recycle_entry_product_detail_product_code' value='"+product_code+"' /></td><td>"+product_name+"<input type='hidden'  name='recycle_entry_product_detail_product_name' id='recycle_entry_product_detail_product_name' value='"+product_name+"' /><input type='hidden'  name='recycle_entry_product_detail_product_id' id='recycle_entry_product_detail_product_id' value='"+product_id+"' /><input type='hidden'  name='recycle_entry_product_detail_osf_uom_ton' id='recycle_entry_product_detail_osf_uom_ton' value='"+osf_uom_ton+"' /><td><input class='form-control' type='text'  name='recycle_entry_product_detail_product_uom' id='recycle_entry_product_detail_product_uom' value='"+product_uom+"'   /><input type='hidden'  name='recycle_entry_product_detail_product_uom_id' id='recycle_entry_product_detail_product_uom_id' value='"+product_uom_id+"' /></td><td><input class='form-control' type='text'  name='recycle_entry_product_detail_product_colour_name' id='recycle_entry_product_detail_product_colour_name' value='"+product_colour_name+"'   /><input type='hidden'  name='recycle_entry_product_detail_product_colour_id' id='recycle_entry_product_detail_product_colour_id' value='"+product_colour_id+"' /></td><td><input type='hidden'  name='recycle_entry_product_detail_product_thick_ness' id='recycle_entry_product_detail_product_thick_ness' value='"+product_thick_ness_val+"'   /><input class='form-control' type='text'  name='product_thick_ness' id='recycle_entry_product_detail_product_thick_ness_val' value='"+product_thick_ness+"'   /> </td><td><input class='form-control' type='text'  name='recycle_entry_product_detail_width_inches' id='recycle_entry_product_detail_width_inches' onblur='Getcalc(2)' value='"+product_width_inches+"'  /></td><td><input class='form-control' type='text'  name='recycle_entry_product_detail_width_mm' id='recycle_entry_product_detail_width_mm' onblur='Getcalc(3)' value='"+product_width_mm+"' /></td></td><td><input class='form-control' type='text'  name='recycle_entry_product_detail_length_feet' id='recycle_entry_product_detail_length_feet' onblur='GetLcalc(1)' value='"+product_length_feet+"'  /></td><td><input class='form-control' type='text'  name='recycle_entry_product_detail_length_mm' id='recycle_entry_product_detail_length_mm' onblur='GetLcalc(3)'  value='"+product_length_mm+"'  /></td></td><td><input class='form-control' type='text'  name='recycle_entry_product_detail_qty' id='recycle_entry_product_detail_qty' onblur='discountPerFind()' value='"+product_total+"'  /></td></tr>");

		}

	}

}

function getQuotationId(){
	var m_id = '';
	var x = $('.sd_id').map(function() { return this.value; }).get();
    //var x=document.getElementsByName("purchase_order_entry_id");
	for (var i = 0; i < x.length; i++) {
		if (m_id == '') {
			m_id = '"'+x[i]+'"';
			//m_id = document.getElementsByName("purchase_order_entry_id")[i].value;
		} else {
			m_id = m_id + ',"'+x[i]+'"';
		}

	}

	return m_id;

}	

function Getcalc(calculation_id){

 	if(calculation_id==2){
		var calc_amount 	= document.getElementById('recycle_entry_product_detail_width_inches').value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('recycle_entry_product_detail_width_mm').value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('recycle_entry_product_detail_width_inches').value 		= data_t[1];
			document.getElementById('recycle_entry_product_detail_width_mm').value 			= data_t[2];
		}
	);
}

function GetLcalc(calculation_id){
	if(calculation_id==1){
		var calc_amount 	= document.getElementById('recycle_entry_product_detail_length_feet').value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('recycle_entry_product_detail_length_mm').value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('recycle_entry_product_detail_length_feet').value 		= data_t[0];
			document.getElementById('recycle_entry_product_detail_length_mm').value 		= data_t[2];
		}

	);
}
function GetWidthDetail(){
			var table 					= document.getElementById('width_product_detail');
			var row_cnt     			= parseFloat(table.rows.length);	
			$( "#width_detail_display" ).append( 
			"<tr><td>"+row_cnt+"</td><td><input class='form-control' type='text'  name='recycle_entry_width_detail_name[]' id='recycle_entry_width_detail_name"+row_cnt+"' value='WIDTH"+row_cnt+"'   /></td><td><input class='form-control' type='text'  name='recycle_entry_width_detail_width_inches_one[]' id='recycle_entry_width_detail_width_inches_one"+row_cnt+"' onblur='GetWDcalc("+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='recycle_entry_width_detail_width_inches_two[]' id='recycle_entry_width_detail_width_inches_two"+row_cnt+"' onblur='GetWDcalc("+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='recycle_entry_width_detail_width_inches_three[]' id='recycle_entry_width_detail_width_inches_three"+row_cnt+"' onblur='GetWDcalc("+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='recycle_entry_width_detail_width_inches_four[]' id='recycle_entry_width_detail_width_inches_four"+row_cnt+"' onblur='GetWDcalc("+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='recycle_entry_width_detail_inches_qty[]' id='recycle_entry_width_detail_inches_qty"+row_cnt+"' readonly='' /></td><td><input class='form-control' type='text'  name='recycle_entry_width_detail_length[]' id='recycle_entry_width_detail_length"+row_cnt+"' onblur='GetWDLcalc(3,"+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='recycle_entry_width_detail_length_qty[]' id='recycle_entry_width_detail_length_qty"+row_cnt+"' onblur='GetChildDetail("+row_cnt+")'  /></td></tr>");
}

function GetWDcalc(id){
		var width_qty		= 0;
		var tot_inches		= 0;
		var inches_one 		= document.getElementById('recycle_entry_width_detail_width_inches_one'+id).value;	
		var inches_two 		= document.getElementById('recycle_entry_width_detail_width_inches_two'+id).value;	
		var inches_three 	= document.getElementById('recycle_entry_width_detail_width_inches_three'+id).value;	
		var inches_four 	= document.getElementById('recycle_entry_width_detail_width_inches_four'+id).value;	
		if(inches_one!=''){
			var width_qty	= width_qty+1;
			var tot_inches	= tot_inches+eval(inches_one);
			if(tot_inches>36){
				document.getElementById('recycle_entry_width_detail_width_inches_one'+id).value	= '';
			}
		}
		if(inches_two!=''){
			var width_qty	= width_qty+1;
			var tot_inches	= tot_inches+eval(inches_two);
			if(tot_inches>36){
				document.getElementById('recycle_entry_width_detail_width_inches_two'+id).value	= '';
			}
		}
		if(inches_three!=''){
			var width_qty	= width_qty+1;
			var tot_inches	= tot_inches+eval(inches_three);
			if(tot_inches>36){
				document.getElementById('recycle_entry_width_detail_width_inches_three'+id).value	= '';
			}
		}
		if(inches_four!=''){
			var width_qty	= width_qty+1;
			var tot_inches	= tot_inches+eval(inches_four);
			if(tot_inches>36){
				document.getElementById('recycle_entry_width_detail_width_inches_four'+id).value	= '';
			}
		}
		document.getElementById('recycle_entry_width_detail_inches_qty'+id).value	= width_qty;		
}

function GetChildDetail(id){
			var inches_qty				= document.getElementById('recycle_entry_width_detail_inches_qty'+id).value;
			var length_qty				= document.getElementById('recycle_entry_width_detail_length_qty'+id).value;
			var length_feet				= document.getElementById('recycle_entry_width_detail_length'+id).value;
			
			var table 					= document.getElementById('child_product_detail');
			var row_cnt     			= parseFloat(table.rows.length)-1;
			var product_code 			= document.getElementById('recycle_entry_product_detail_product_code').value;	
			var product_name 			= document.getElementById('recycle_entry_product_detail_product_name').value;	
			var product_id 				= document.getElementById('recycle_entry_product_detail_product_id').value;	
			var product_uom 			= document.getElementById('recycle_entry_product_detail_product_uom').value;	
			var product_uom_id 			= document.getElementById('recycle_entry_product_detail_product_uom_id').value;	
			var product_colour_name 	= document.getElementById('recycle_entry_product_detail_product_colour_name').value;	
			var product_colour_id 		= document.getElementById('recycle_entry_product_detail_product_colour_id').value;
			var product_thick_ness 		= document.getElementById('recycle_entry_product_detail_product_thick_ness').value;
			var product_thick_ness_val	= document.getElementById('recycle_entry_product_detail_product_thick_ness_val').value;
			var product_brand_id 		= document.getElementById('recycle_entry_product_detail_product_brand_id').value;
			var product_category_id		= document.getElementById('recycle_entry_product_detail_product_category_id').value;
			var osf_uom_ton				= document.getElementById('recycle_entry_product_detail_osf_uom_ton').value;
			
			for(var i=0; i<eval(inches_qty); i++){
				if(i==0){
					var width_qty 		= document.getElementById('recycle_entry_width_detail_width_inches_one'+id).value;	
				}
				if(i==1){
					var width_qty 		= document.getElementById('recycle_entry_width_detail_width_inches_two'+id).value;	
				}
				if(i==2){
					var width_qty 		= document.getElementById('recycle_entry_width_detail_width_inches_three'+id).value;	
				}
				if(i==3){
					var width_qty 		= document.getElementById('recycle_entry_width_detail_width_inches_four'+id).value;	
				}
				for(var k=0; k<eval(length_qty); k++){
					
					var child_ton				= eval(osf_uom_ton)*eval(length_feet);
					var child_kg				= eval(child_kg)*1000;
					
					var row 					= ''+row_cnt+'';
					var str 					= "00000";
					var n 						= row.length;
					var res 					= str.substr(n, 5);
					$( "#child_product_detail_display" ).append(
					"<tr><td><input type='hidden'  name='product_con_entry_child_product_detail_product_brand_id[]' id='product_con_entry_child_product_detail_product_brand_id' value='"+product_brand_id+"' /><input type='hidden'  name='product_con_entry_child_product_detail_product_category_id[]' id='product_con_entry_child_product_detail_product_category_id' value='"+product_category_id+"' /><input class='form-control' type='text'  name='product_con_entry_child_product_detail_code[]' id='product_con_entry_child_product_detail_code' value='C"+res+row_cnt+"'   /></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_name[]' id='product_con_entry_child_product_detail_name' value='"+product_name+"'   /><input type='hidden'  name='product_con_entry_child_product_detail_product_id[]' id='product_con_entry_child_product_detail_product_id' value='"+product_id+"' /><td><input class='form-control' type='text'  name='product_uom' id='product_uom' value='"+product_uom+"'   /><input type='hidden'  name='product_con_entry_child_product_detail_uom_id[]' id='product_con_entry_child_product_detail_uom_id' value='"+product_uom_id+"' /> </td><td><input class='form-control' type='text'  name='product_colour_name' id='product_colour_name' value='"+product_colour_name+"'   /><input type='hidden'  name='product_con_entry_child_product_detail_color_id[]' id='product_con_entry_child_product_detail_color_id' value='"+product_colour_id+"' /></td><td><input type='hidden'  name='product_con_entry_child_product_detail_thick_ness[]' id='product_con_entry_child_product_detail_thick_ness' value='"+product_thick_ness+"' /> <input  class='form-control' type='text'  name='product_con_entry_child_product_detail_thick_ness_val[]' id='product_con_entry_child_product_detail_thick_ness_val' value='"+product_thick_ness_val+"' /></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_width_inches[]' id='product_con_entry_child_product_detail_width_inches"+row_cnt+"' value='"+width_qty+"' onblur='GetCHcalc(2,"+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_width_mm[]' id='product_con_entry_child_product_detail_width_mm"+row_cnt+"' onblur='GetCHcalc(3,"+row_cnt+")'  /></td></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_length_feet[]' id='product_con_entry_child_product_detail_length_feet"+row_cnt+"' onblur='GetCHLcalc(1,"+row_cnt+")'value='"+length_feet+"'  /></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_length_mm[]' id='product_con_entry_child_product_detail_length_mm"+row_cnt+"' onblur='GetCHLcalc(4,"+row_cnt+")'  /></td></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_total[]' id='product_con_entry_child_product_detail_total"+row_cnt+"'  value='"+child_ton+"' /></td></tr>");
					GetCHcalc(2,row_cnt);
					GetCHLcalc(1,row_cnt);
					var row_cnt	= row_cnt+1;
				}
			}
}
function GetCHcalc(calculation_id,id){

 	if(calculation_id==2){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_width_inches'+id).value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_width_mm'+id).value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_child_product_detail_width_inches'+id).value 		= data_t[1];
			document.getElementById('product_con_entry_child_product_detail_width_mm'+id).value 			= data_t[2];
		}
	);
}
function GetCHLcalc(calculation_id,id){
	if(calculation_id==1){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_length_feet'+id).value;	
	}
	else if(calculation_id==4){
		var calc_amount 	= document.getElementById('product_con_entry_child_product_detail_length_mm'+id).value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('product_con_entry_child_product_detail_length_feet'+id).value 		= data_t[0];
			document.getElementById('product_con_entry_child_product_detail_length_mm'+id).value 		= data_t[3];
		}

	);
}
