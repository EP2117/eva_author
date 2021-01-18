checked = false;

function checkedAll () {

if (checked == false){checked = true}else{checked = false}

	for (var i = 0; i < document.getElementById('width_cutting_list_form').elements.length; i++) {

	  document.getElementById('width_cutting_list_form').elements[i].checked = checked;

	}

}


function GetLcalS(calculation_id,id,type){//alert();

	if(type==1){
		var calc_amount 	= document.getElementById('width_cutting_width_detail_width_inches_one'+id).value;	
	}else if(type==2){
		var calc_amount 	= document.getElementById('width_cutting_width_detail_width_inches_two'+id).value;		
	}
	else if(type==3){
		var calc_amount 	= document.getElementById('width_cutting_width_detail_width_inches_three'+id).value;	
	}
	else if(type==4){
		var calc_amount 	= document.getElementById('width_cutting_width_detail_width_inches_four'+id).value;	
	}
	

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			
			if(type==1){
				document.getElementById('width_cutting_width_detail_width_mm_one'+id).value 			= data_t[2];
			}else if(type==2){
				document.getElementById('width_cutting_width_detail_width_mm_two'+id).value 			= data_t[2];		
			}
			else if(type==3){
				document.getElementById('width_cutting_width_detail_width_mm_three'+id).value 			= data_t[2];	
			}
			else if(type==4){
				document.getElementById('width_cutting_width_detail_width_mm_four'+id).value 			= data_t[2];	
			}
			
			
		}

	);

}


function GetDetail(){

	var m_id 			= getQuotationId();
	var godown_id 			= document.getElementById('width_cutting_godown_id').value;
	var brand_id 			= document.getElementById('width_cutting_brand_id').value;
	
	if(parseInt(godown_id) > 0) {

		$.get('product-detail.php',
	
			{m_id:m_id, godown_id:godown_id,brand_id:brand_id},
	
			function(data) { $('#dynamic-content').html( data ); }
	
		);	
	} else {
		alert('Please Select Warehouse');	
	}

}

function AddproductDetail(){

	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) {

		if (document.getElementById('product_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;

			var product_id 			= document.getElementById('product_id'+ord_id).value;

			var product_name 		= document.getElementById('product_name'+ord_id).value;
			var product_brand_id 	= document.getElementById('product_brand_id'+ord_id).value;
			var product_category_id	= document.getElementById('product_category_id'+ord_id).value;
			var brand_name 			= document.getElementById('brand_name'+ord_id).value;
			var osf_uom_ton 			= document.getElementById('product_con_entry_osf_uom_ton'+ord_id).value;
			var osf_uom_kg 				= document.getElementById('product_con_entry_osf_uom_kg'+ord_id).value;
			var osf_length_feet			= document.getElementById('product_con_entry_osf_length_feet'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;
			var product_type 			= document.getElementById('product_type'+ord_id).value;
			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_uom_id 			= document.getElementById('product_uom_id'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_colour_id		= document.getElementById('product_colour_id'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_thick_ness_val	= document.getElementById('product_thick_ness_val'+ord_id).value;
			var product_total			= document.getElementById('product_con_entry_child_product_detail_total'+ord_id).value;
			var product_width_mm		= document.getElementById('product_con_entry_child_product_detail_width_mm'+ord_id).value;
			var product_width_inches	= document.getElementById('product_con_entry_child_product_detail_width_inches'+ord_id).value;
			var product_length_mm		= document.getElementById('product_con_entry_child_product_detail_length_mm'+ord_id).value;
			var product_length_feet		= document.getElementById('product_con_entry_child_product_detail_length_feet'+ord_id).value;
			

			var table 					= document.getElementById('product_detail');
			var row_cnt     			= parseFloat(table.rows.length)-1;	
			$( "#product_detail_display" ).append( 

			"<tr><td>"+brand_name+"<input type='hidden'  name='width_cutting_product_detail_brand_name' id='width_cutting_product_detail_brand_name' value='"+brand_name+"'   /> <input type='hidden'  name='width_cutting_product_detail_osf_uom_ton' id='width_cutting_product_detail_osf_uom_ton' value='"+osf_uom_ton+"'   /><input type='hidden'  name='width_cutting_product_detail_osf_uom_kg' id='width_cutting_product_detail_osf_uom_kg' value='"+osf_uom_kg+"'   /><input type='hidden'  name='width_cutting_product_detail_osf_length_feet' id='width_cutting_product_detail_osf_length_feet' value='"+osf_length_feet+"'   /><input type='hidden'  name='width_cutting_product_detail_product_brand_id' id='width_cutting_product_detail_product_brand_id' value='"+product_brand_id+"' /><input type='hidden'  name='width_cutting_product_detail_product_category_id' id='width_cutting_product_detail_product_category_id' value='"+product_category_id+"' /> </td><td>"+product_code+"<input type='hidden'  name='width_cutting_product_detail_product_code' id='width_cutting_product_detail_product_code' value='"+product_code+"' /></td><td>"+product_name+"<input type='hidden'  name='width_cutting_product_detail_product_name' id='width_cutting_product_detail_product_name' value='"+product_name+"' /><input type='hidden'  name='width_cutting_product_detail_product_id' id='width_cutting_product_detail_product_id' value='"+product_id+"' /></td><td><input class='form-control' type='text'  name='width_cutting_product_detail_product_uom' id='width_cutting_product_detail_product_uom' value='"+product_uom+"'   /><input type='hidden'  name='width_cutting_product_detail_product_uom_id' id='width_cutting_product_detail_product_uom_id' value='"+product_uom_id+"' /></td><td><input class='form-control' type='text'  name='width_cutting_product_detail_product_colour_name' id='width_cutting_product_detail_product_colour_name' value='"+product_colour_name+"'   /><input type='hidden'  name='width_cutting_product_detail_product_colour_id' id='width_cutting_product_detail_product_colour_id' value='"+product_colour_id+"' /></td><td><input type='hidden'  name='product_thick_ness' id='width_cutting_product_detail_product_thick_ness' value='"+product_thick_ness_val+"'   /><input class='form-control' type='text'  name='width_cutting_product_detail_product_thick_ness_val' id='width_cutting_product_detail_product_thick_ness_val' value='"+product_thick_ness+"'   /> </td><td><input class='form-control' type='text'  name='width_cutting_product_detail_width_inches' id='width_cutting_product_detail_width_inches' onblur='Getcalc(2)' value='"+product_width_inches+"'  /></td><td><input class='form-control' type='text'  name='width_cutting_product_detail_width_mm' id='width_cutting_product_detail_width_mm' onblur='Getcalc(3)' value='"+product_width_mm+"' /></td></td><td><input class='form-control' type='text'  name='width_cutting_product_detail_length_feet' id='width_cutting_product_detail_length_feet' onblur='GetLcalc(1)' value='"+product_length_feet+"'  /></td><td><input class='form-control' type='text'  name='width_cutting_product_detail_length_mm' id='width_cutting_product_detail_length_mm' onblur='GetLcalc(3)'  value='"+product_length_mm+"'  /></td></td><td><input class='form-control' type='text'  name='width_cutting_product_detail_qty' id='width_cutting_product_detail_qty' onblur='discountPerFind()' value='"+product_total+"'  /></td></tr>");

		}

	}

}
function GetLcalSM(calculation_id,id,type){//alert();

	if(type==1){
		var calc_amount 	= document.getElementById('width_cutting_width_detail_width_mm_one'+id).value;
	}else if(type==2){
		var calc_amount 	= document.getElementById('width_cutting_width_detail_width_mm_two'+id).value ;		
	}
	else if(type==3){
		var calc_amount 	= document.getElementById('width_cutting_width_detail_width_mm_three'+id).value;	
	}
	else if(type==4){
		var calc_amount 	= document.getElementById('width_cutting_width_detail_width_mm_four'+id).value ;	
	}
	

	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			
			
			if(type==1){
				 document.getElementById('width_cutting_width_detail_width_inches_one'+id).value 			= data_t[1];	
			}else if(type==2){
				 document.getElementById('width_cutting_width_detail_width_inches_two'+id).value 			= data_t[1];		
			}
			else if(type==3){
				document.getElementById('width_cutting_width_detail_width_inches_three'+id).value 			= data_t[1];	
			}
			else if(type==4){
				document.getElementById('width_cutting_width_detail_width_inches_four'+id).value 			= data_t[1];	
			}
	
			
		}

	);

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
		var calc_amount 	= document.getElementById('width_cutting_product_detail_width_inches').value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('width_cutting_product_detail_width_mm').value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('width_cutting_product_detail_width_inches').value 		= data_t[1];
			document.getElementById('width_cutting_product_detail_width_mm').value 			= data_t[2];
		}
	);
}

function GetLcalc(calculation_id){
	if(calculation_id==1){
		var calc_amount 	= document.getElementById('width_cutting_product_detail_length_feet').value;	
	}
	else if(calculation_id==3){
		var calc_amount 	= document.getElementById('width_cutting_product_detail_length_mm').value;	
	}
	$.get(
		"../ajax-file/product-calc.php",
		{calculation_id:calculation_id,calc_amount:calc_amount},
		function(data) {
			var data_t	= data.split('@'); 
			document.getElementById('width_cutting_product_detail_length_feet').value 		= data_t[0];
			document.getElementById('width_cutting_product_detail_length_mm').value 		= data_t[2];
		}

	);
}
function GetWidthDetail(){
	var product_id		= document.getElementById('width_cutting_product_detail_product_id').value; 
	var product_code	= document.getElementById('width_cutting_product_detail_product_code').value;
			var table 					= document.getElementById('width_product_detail');
			var row_cnt     			= parseFloat(table.rows.length);	
			$( "#width_detail_display" ).append( 
			"<tr><td>"+row_cnt+"</td><td><input class='form-control' type='text'  name='width_cutting_width_detail_name[]' id='width_cutting_width_detail_name"+row_cnt+"' value='WIDTH"+row_cnt+"'   /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_width_inches_one[]' id='width_cutting_width_detail_width_inches_one"+row_cnt+"' onblur='GetWDcalc("+row_cnt+"); GetLcalS(2,"+row_cnt+",1);'  /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_width_mm_one[]' id='width_cutting_width_detail_width_mm_one"+row_cnt+"' onblur='GetLcalSM(3,"+row_cnt+",1),GetWDcalc("+row_cnt+");'  /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_width_inches_two[]' id='width_cutting_width_detail_width_inches_two"+row_cnt+"' onblur='GetWDcalc("+row_cnt+"); GetLcalS(2,"+row_cnt+",2);'  /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_width_mm_two[]' id='width_cutting_width_detail_width_mm_two"+row_cnt+"' onblur='GetLcalSM(3,"+row_cnt+",2),GetWDcalc("+row_cnt+") ;'  /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_width_inches_three[]' id='width_cutting_width_detail_width_inches_three"+row_cnt+"' onblur='GetWDcalc("+row_cnt+");GetLcalS(2,"+row_cnt+",3);'  /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_width_mm_three[]' id='width_cutting_width_detail_width_mm_three"+row_cnt+"' onblur='GetLcalSM(3,"+row_cnt+",3),GetWDcalc("+row_cnt+");'  /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_width_inches_four[]' id='width_cutting_width_detail_width_inches_four"+row_cnt+"' onblur='GetWDcalc("+row_cnt+");GetLcalS(2,"+row_cnt+",4);'  /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_width_mm_four[]' id='width_cutting_width_detail_width_mm_four"+row_cnt+"' onblur='GetLcalSM(3,"+row_cnt+",4),GetWDcalc("+row_cnt+");'  /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_inches_qty[]' id='width_cutting_width_detail_inches_qty"+row_cnt+"' readonly='' /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_length[]' id='width_cutting_width_detail_length"+row_cnt+"' onblur='GetWDcalc(3,"+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='width_cutting_width_detail_length_qty[]' id='width_cutting_width_detail_length_qty"+row_cnt+"' onblur='GetChildDetail("+row_cnt+")'  /></td></tr>");
}

function GetWDcalc(id){
		var width_qty		= 0;
		var tot_inches		= 0;
		var inches_one 		= Number(document.getElementById('width_cutting_width_detail_width_inches_one'+id).value);	
		var inches_two 		= Number(document.getElementById('width_cutting_width_detail_width_inches_two'+id).value);	
		var inches_three 	= Number(document.getElementById('width_cutting_width_detail_width_inches_three'+id).value);	
		var inches_four 	= Number(document.getElementById('width_cutting_width_detail_width_inches_four'+id).value);	
		if(inches_one!='' && inches_one!=0){
			var width_qty	= width_qty+1;
			var tot_inches	= tot_inches+eval(inches_one);
			if(tot_inches>100){
				document.getElementById('width_cutting_width_detail_width_inches_one'+id).value	= '';
			}
		}
		if(inches_two!='' && inches_two!=0){
			var width_qty	= width_qty+1;
			var tot_inches	= tot_inches+eval(inches_two);
			if(tot_inches>100){
				document.getElementById('width_cutting_width_detail_width_inches_two'+id).value	= '';
			}
		}
		if(inches_three!='' && inches_three!=0){
			var width_qty	= width_qty+1;
			var tot_inches	= tot_inches+eval(inches_three);
			if(tot_inches>100){
				document.getElementById('width_cutting_width_detail_width_inches_three'+id).value	= '';
			}
		}
		if(inches_four!='' && inches_four!=0){
			var width_qty	= width_qty+1;
			var tot_inches	= tot_inches+eval(inches_four);
			if(tot_inches>100){
				document.getElementById('width_cutting_width_detail_width_inches_four'+id).value	= '';
			}
		}
		document.getElementById('width_cutting_width_detail_inches_qty'+id).value	= width_qty;		
}

function GetChildDetail(id){ 
    var product_id		= document.getElementById('width_cutting_product_detail_product_id').value;//alert(product_id); 
	var product_code	= document.getElementById('width_cutting_product_detail_product_code').value;
	var row_count='';
	
	$.get( "action.php",
		{product_id:product_id},
		function(data) {
		row_count=data;
		});
	         
			var inches_qty				= document.getElementById('width_cutting_width_detail_inches_qty'+id).value;
			var length_qty				= document.getElementById('width_cutting_width_detail_length_qty'+id).value;
			var length_feet				= document.getElementById('width_cutting_width_detail_length'+id).value;  
			
			var table 					= document.getElementById('child_product_detail');
			var row_cnt     			= parseFloat(table.rows.length)-1;
			var product_code 			= document.getElementById('width_cutting_product_detail_product_code').value;	
			var product_name 			= document.getElementById('width_cutting_product_detail_product_name').value;	
			var product_id 				= document.getElementById('width_cutting_product_detail_product_id').value;	
			var osf_uom_ton 			= document.getElementById('width_cutting_product_detail_osf_uom_ton').value;	
			var brand_name 				= document.getElementById('width_cutting_product_detail_brand_name').value;	
			var product_brand_id 		= document.getElementById('width_cutting_product_detail_product_brand_id').value;
			var product_category_id		= document.getElementById('width_cutting_product_detail_product_category_id').value;
			var product_uom 			= document.getElementById('width_cutting_product_detail_product_uom').value;	
			var product_uom_id 			= document.getElementById('width_cutting_product_detail_product_uom_id').value;	
			var product_colour_name 	= document.getElementById('width_cutting_product_detail_product_colour_name').value;	
			var product_colour_id 		= document.getElementById('width_cutting_product_detail_product_colour_id').value;
			var product_thick_ness 		= document.getElementById('width_cutting_product_detail_product_thick_ness').value;
			var product_thick_ness_val	= document.getElementById('width_cutting_product_detail_product_thick_ness_val').value;
			
			for(var i=0; i<eval(inches_qty); i++){
				 
				var prdWidthInches	= Number(document.getElementById('width_cutting_product_detail_width_inches').value); 
				var inchPer = 0;
				if(i==0){
					var width_qty 		= document.getElementById('width_cutting_width_detail_width_inches_one'+id).value;	
					    inchPer 		= (width_qty/prdWidthInches)*100;
					
				}
				if(i==1){
					var width_qty 		= document.getElementById('width_cutting_width_detail_width_inches_two'+id).value;	
						inchPer 		= (width_qty/prdWidthInches)*100;
				}
				if(i==2){
					var width_qty 		= document.getElementById('width_cutting_width_detail_width_inches_three'+id).value;
						inchPer 		= (width_qty/prdWidthInches)*100;	
				}
				if(i==3){
					var width_qty 		= document.getElementById('width_cutting_width_detail_width_inches_four'+id).value;	
						inchPer 		= (width_qty/prdWidthInches)*100;
				}
				//alert(inchPer);
				for(var k=0; k<eval(length_qty); k++){
					var row 					= ''+row_cnt+'';
					var str 					= "00000";
					var n 						= row.length;
					var res 					= str.substr(n, 1);
					
					var code 					= product_code.slice( 0, -5);
					var child_ton				= ((parseFloat(osf_uom_ton)*eval(length_feet)) * inchPer)/100; 
					//alert(child_ton);
					var child_kg				= eval(child_kg)*1000;
					var code_id					= row_count+k+1;
					//alert(code);
					
					$( "#child_product_detail_display" ).append(
					"<tr><td>"+brand_name+"<input type='hidden'  name='product_con_entry_child_product_detail_product_brand_id[]' id='product_con_entry_child_product_detail_product_brand_id' value='"+product_brand_id+"' /><input type='hidden'  name='product_con_entry_child_product_detail_product_category_id[]' id='product_con_entry_child_product_detail_product_category_id' value='"+product_category_id+"' /></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_code[]' id='product_con_entry_child_product_detail_code' value='"+product_code+"-"+code_id+row_cnt+"'   /></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_name[]' id='product_con_entry_child_product_detail_name' value='"+product_name+"'   /><input type='hidden'  name='product_con_entry_child_product_detail_product_id[]' id='product_con_entry_child_product_detail_product_id' value='"+product_id+"' /><td><input class='form-control' type='text'  name='product_uom' id='product_uom' value='"+product_uom+"'   /><input type='hidden'  name='product_con_entry_child_product_detail_uom_id[]' id='product_con_entry_child_product_detail_uom_id' value='"+product_uom_id+"' /> </td><td><input class='form-control' type='text'  name='product_colour_name' id='product_colour_name' value='"+product_colour_name+"'   /><input type='hidden'  name='product_con_entry_child_product_detail_color_id[]' id='product_con_entry_child_product_detail_color_id' value='"+product_colour_id+"' /></td><td><input type='hidden'  name='product_con_entry_child_product_detail_thick_ness[]' id='product_con_entry_child_product_detail_thick_ness' value='"+product_thick_ness+"' /> <input  class='form-control' type='text'  name='product_con_entry_child_product_detail_thick_ness_val[]' id='product_con_entry_child_product_detail_thick_ness_val' value='"+product_thick_ness_val+"' /></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_width_inches[]' id='product_con_entry_child_product_detail_width_inches"+row_cnt+"' value='"+width_qty+"' onblur='GetCHcalc(2,"+row_cnt+")'  /></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_width_mm[]' id='product_con_entry_child_product_detail_width_mm"+row_cnt+"' onblur='GetCHcalc(3,"+row_cnt+")'  /></td></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_length_feet[]' id='product_con_entry_child_product_detail_length_feet"+row_cnt+"' onblur='GetCHLcalc(1,"+row_cnt+")' value='"+length_feet+"'  /></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_length_mm[]' id='product_con_entry_child_product_detail_length_mm"+row_cnt+"' onblur='GetCHLcalc(4,"+row_cnt+")'  /></td></td><td><input class='form-control' type='text'  name='product_con_entry_child_product_detail_total[]' id='product_con_entry_child_product_detail_total"+row_cnt+"' value='"+child_ton+"' readonly   /><input class='form-control' type='hidden'  name='product_con_entry_child_product_detail_total_kg[]' id='product_con_entry_child_product_detail_total_kg"+row_cnt+"' value='"+child_kg+"' readonly  /></td></tr>");
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
			var data_t	= data.split('@'); //alert(data_t[3]);
			document.getElementById('product_con_entry_child_product_detail_length_feet'+id).value 		= data_t[0];
			document.getElementById('product_con_entry_child_product_detail_length_mm'+id).value 		= data_t[3];
			
		}

	);
}

function removeTableDetails(){
	
	$('#product_detail_display tr').remove();
	$('#width_detail_display tr').remove();
	$('#child_product_detail_display tr').remove();
	
}