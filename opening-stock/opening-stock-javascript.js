function GetDetail(){
	
	$.getJSON('product-detail.php',function(json){ 
		
		var apnd;
		for(var i=0;i<json.length;i++){
			
			apnd += "<tr>";
			apnd += "<td><input class='form-control' type='text'  name='opening_stock_product_detail_product_code' id='opening_stock_product_detail_product_code' value='"+json[i]['product_code']+"'/></td>";
			apnd += "<td><input class='form-control' type='text'  name='opening_stock_product_detail_product_name' id='opening_stock_product_detail_product_name' value='"+json[i]['product_name']+"' /><input type='hidden'  name='opening_stock_product_detail_product_id[]' id='opening_stock_product_detail_product_id' value='"+json[i]['product_id']+"'  class='dc_id'  /></td>";
			apnd += "<td><input class='form-control' type='text'  name='opening_stock_product_detail_uom1[]' id='1"+i+"' value='"+json[i]['product_uom_name']+"'/></td>";
			apnd += "<td><input class='form-control' type='text'  name='opening_stock_product_detail_uom2[]' id='opening_stock_product_detail_uom2"+i+"' value='"+json[i]['product_uom_name']+"'/></td>";
			apnd += "<td><input class='form-control' type='text'  name='opening_stock_product_detail_qty1[]' id='opening_stock_product_detail_qty1"+i+"' value=''/></td>";
			apnd += "<td><input class='form-control' type='text'  name='opening_stock_product_detail_qty2[]' id='opening_stock_product_detail_qty2"+i+"' value='' /></td>";

			apnd += "</tr>";
			
			
		}
		$( "#product_detail_display" ).html(apnd)
	});	
}
function AddproductDetail(){
	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) {
		
		
	
	if (document.getElementById('product_list_form').elements[i].checked ==true) {
			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;
			var product_id 		= ord_id;
			var product_name 	= document.getElementById('product_name'+ord_id).value;
			var product_code 	= document.getElementById('product_code'+ord_id).value;
			var product_uom 	= document.getElementById('product_uom'+ord_id).value;
			var table 			= document.getElementById('product_detail');
			var row_cnt     	= parseFloat(table.rows.length)-1;	
			$( "#product_detail_display" ).append( 
			"<tr></tr>");
		}
	}
	
	
	//GetCustomers();
}
function GetCustomers(){
			var table 			= document.getElementById('product_detail');
			var row_cnt     	= parseFloat(table.rows.length)-1;	
			$.get('customer-list.php',
				{},
				function(data) {
					for (var i = 0; i < row_cnt; i++) {
						$('#customer_display'+i).html( data ); $(".select2").select2(); 
					}
				}
			);
}

function GetIndCustomers(id){
	var detail_mode 			= document.getElementById('opening_stock_product_detail_mode'+id).value;
			if(detail_mode==1){
				$.get('customer-list.php',
					{},
					function(data) {
							$('#customer_display'+id).html( data ); $(".select2").select2(); 
					}
				);
			}
			else{
				$.get('customer-list.php',
					{detail_mode:detail_mode},
					function(data) {
							$('#customer_display'+id).html( data ); $(".select2").select2(); 
					}
				);
			}
}

