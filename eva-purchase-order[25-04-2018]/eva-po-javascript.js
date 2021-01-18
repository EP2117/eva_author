
  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('eva-po-form').elements.length; i++) {
	  document.getElementById('eva-po-form').elements[i].checked = checked;
	}
}
function currency_rate(val,obj){
	if(val!=''){
		$("#s_rate").show();
		var p_date=$('#purchase_date').val();
		$.get('getcurrency.php',{p_date:p_date,val:val},function(data){ $('#rate').val(data)});
	}else{
		$("#s_rate").hide();
		$("#rate").val("");
	}
}
function GetDetail(){
	var m_id 			= getQuotationId();
	var brand_id 	= document.getElementById('po_brand_id').value;
	$.get('popup-product-detail.php',
		{m_id:m_id,brand_id:brand_id},
		function(data) { $('#dynamic-content').html( data ); }
	);	
}



function getsupplier(id){

	$.getJSON('getsupplier.php?action=supplier&id='+id,function(json) {		
		apnd = '<option> --Select-- </option>';
			for(var i=0;i<json.length;i++){			
				apnd += '<option value="'+json[i]['supplier_id']+'">'+json[i]['supplier_name']+'</option>';
			}
		$("#supplier_name").html(apnd);
		
	});	
	
}

function AddproductDetail(){

	for (var i = 0; i < document.getElementById('product_list_form').elements.length; i++) {

		if (document.getElementById('product_list_form').elements[i].checked ==true) {

			var ord_id 	=  document.getElementById('product_list_form').elements[i].value;
			var product_id 				= document.getElementById('product_id'+ord_id).value;
			var product_name 			= document.getElementById('product_name'+ord_id).value;
			var product_code 			= document.getElementById('product_code'+ord_id).value;
			var product_uom 			= document.getElementById('product_uom'+ord_id).value;
			var product_colour_name		= document.getElementById('product_colour_name'+ord_id).value;
			var product_thick_ness		= document.getElementById('product_thick_ness'+ord_id).value;
			var product_inches			= document.getElementById('product_inches'+ord_id).value;
			var brand_name				= document.getElementById('brand_name'+ord_id).value;
			//var product_val				= product_id+'-'+product_name;
			var last_val = $("#product_apnd").val();
			
			var sno      = parseInt(last_val)+1;
			
			var apnd  = '<tr id="remove_req_'+sno+'">';
				apnd += '<td><input type="hidden" name="arr_count[]" value="'+sno+'"><input type="hidden" name="pid_'+sno+'" value=""><input type="text" class="form-control" name="prod_name[]" id="prod_name_'+sno+'" value="'+product_name+'"/><input type="hidden" name="prod_id_'+sno+'" value="'+product_id+'" class="sd_id"></td>';
				apnd += '<td id="prod_brand_'+sno+'" ><input type="text" class="form-control" name="prod_brand_'+sno+'" id="prod_brand_'+sno+'" value='+brand_name+' ></td>';
				apnd += '<td id="prod_uom_'+sno+'" ><input type="text" class="form-control" name="prod_uom_'+sno+'" id="prod_uom_'+sno+'"  value='+product_uom+' ></td>';
				apnd += '<td><input type="text" class="form-control" style="text-align:right;" name="rate_'+sno+'" id="rate_'+sno+'" onChange="return amnt_calulation(this.value,this,'+sno+',1);" ></td>';
				apnd += '<td><input type="text" class="form-control" style="text-align:right;" name="frignrate_'+sno+'" id="frignrate_'+sno+'" onChange="return amnt_calulation(this.value,this,'+sno+',2);" onkeyup="get_currency_amt('+sno+');"></td>';
				apnd += '<td><input type="text" class="form-control" name="qty_'+sno+'" id="qty_'+sno+'" onChange="return amnt_calulation_Qty(this.value,this,'+sno+',1);" onkeyup="get_currency_amt('+sno+');"></td>';
				apnd += '<td><input type="text" class="form-control" name="prod_ton_'+sno+'" id="prod_ton_'+sno+'" onChange="amnt_calulation_Qty(this.value,this,'+sno+',2);" onkeyup="get_currency_amt('+sno+');"></td>';				
				apnd += '<td><input type="text" class="form-control" name="prod_kg_'+sno+'" id="prod_kg_'+sno+'" onBlur="ton_calculation('+sno+',2);"></td>';
				apnd += '<td><input type="text" class="form-control unit_cur_amnt" style="text-align:right;" name="rate_by_currency_'+sno+'" id="rate_by_currency_'+sno+'" readonly></td>';
				apnd += '<td><input type="text" class="form-control unit_amnt" style="text-align:right;" name="unitprice_'+sno+'" id="unitprice_'+sno+'" readonly></td>';
				apnd += '<td><button class="glyphicon glyphicon-minus" title="Remove row"  type="button" onclick="removeRow('+sno+')"></button></td>';
				apnd += '</tr>';
				//var sno	= sno+1;
				$("#product_apnd").val(sno);
				$("#purcase_table >tbody").append(apnd);
		
		}

	}

}

function get_currency_amt(id){
	var rate = Number($('#rate_'+id).val());
	var frate = Number($('#frignrate_'+id).val());
	var qty = Number($('#qty_'+id).val());
	var ton = Number($('#prod_ton_'+id).val());
	var c_rate = Number($('#rate').val());
	
	total= (rate+frate) * (qty+ton);
	c_total= (c_rate) *(rate+frate)* (qty+ton);
	if(frate!='' && frate!=0){
	$('#rate_by_currency_'+id).val(total.toFixed(2));
	$('#unitprice_'+id).val(c_total.toFixed(2));
	}else{
		$('#rate_by_currency_'+id).val('');
	$('#unitprice_'+id).val(total.toFixed(2));
	}
	currency_mulit(id);
}

function currency_mulit(id){

var total_amt=0;
var	total_amt1=0;
var frate = Number($('#frignrate_'+id).val());
var id    = $('#product_apnd').val();
	for(var i=1;i<=(id);i++){
		var rate_by=$('#rate_by_currency_'+i).val();
		var rate_by1=$('#unitprice_'+i).val();
		total_amt = parseFloat(total_amt) + parseFloat(rate_by);
		total_amt1 = parseFloat(total_amt1) + parseFloat(rate_by1);
		}
		
		
		
	if(frate!='' && frate!=0){
	document.getElementById('tot_amount').value=total_amt.toFixed(2);
	net_amount();
	}else{
	document.getElementById('total_amnt').value=total_amt1.toFixed(2);
	get_net_amt();
	}
}

function net_amount(){
	var tot_amount =Number($('#tot_amount').val());	
	var advance_amount =Number($('#advance_amount').val());	
	var rate =Number($('#rate').val());		
	total = parseFloat(tot_amount) - parseFloat(advance_amount);
	$('#advance_amnt').val((advance_amount*rate).toFixed(2));
	$('#net_tot_amount').val(total.toFixed(2));
	
	//get_net_amt();
	
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

			//m_id = m_id + ','+ document.getElementsByName("purchase_order_entry_id")[i].value ;

		}

	}

	return m_id;

}	


function addReqRow(){
 	
	var last_val = $("#product_apnd").val();
	var sno      = parseInt(last_val);
	
	var apnd  = '<tr id="remove_req_'+sno+'">';
		
		apnd += '<td><input type="hidden" name="pid_'+sno+'" value=""><div class="ui-widget"><input type="text" class="form-control" name="prod_name[]" id="prod_name_'+sno+'" onKeyUp="return get_product(this.value,this,'+sno+',1);"></div></td>';
		apnd += '<td id="prod_brand_'+sno+'" ><input type="hidden" class="form-control" name="prod_brand_'+sno+'" id="prod_brand_'+sno+'" ></td>';
		apnd += '<td id="prod_uom_'+sno+'" ><input type="hidden" class="form-control" name="prod_uom_'+sno+'" id="prod_uom_'+sno+'" ></td>';
		apnd += '<td><input type="text" class="form-control" style="text-align:right;" name="rate_'+sno+'" id="rate_'+sno+'" onChange="return amnt_calulation(this.value,this,'+sno+',1);" ></td>';
		apnd += '<td><input type="text" class="form-control" style="text-align:right;" name="frignrate_'+sno+'" id="frignrate_'+sno+'" onChange="return amnt_calulation(this.value,this,'+sno+',2);"></td>';
		apnd += '<td><input type="text" class="form-control" name="qty_'+sno+'" id="qty_'+sno+'" onChange="return amnt_calulation_Qty(this.value,this,'+sno+',3)amnt_calulation_Qty(this.value,this,'+sno+',1);"></td>';
		apnd += '<td><input type="text" class="form-control" name="prod_ton_'+sno+'" id="prod_ton_'+sno+'" onBlur="ton_calculation('+sno+',1),amnt_calulation_Qty(this.value,this,'+sno+',2);"></td>';
		apnd += '<td><input type="text" class="form-control" name="prod_kg_'+sno+'" id="prod_kg_'+sno+'" onBlur="ton_calculation('+sno+',2);"></td>';
		apnd += '<td><input type="text" class="form-control unit_amnt" style="text-align:right;" name="unitprice_'+sno+'" id="unitprice_'+sno+'" readonly></td>';
		apnd += '<td><button class="glyphicon glyphicon-minus" title="Remove row"  type="button" onclick="removeRow('+sno+')"></button></td>';
		apnd += '</tr>';
		
		$("#product_apnd").val(sno);
		$("#purcase_table >tbody").append(apnd);
 }
 
 function get_product(val,obj,sno){
	var brand_id	= $("#po_brand_id").val();
	$.getJSON('product-detail.php?action=get_prodname&val='+val+'&brand_id='+brand_id,function(json) { 
		if(json.length>0){																						
			var productName = [];		
			for(var i=0;i<json.length;i++){			
				productName[i] = json[i]['product_id']+' - '+json[i]['product_name'];
			}	
			$(obj).autocomplete({
				maxResults: 10,
				source: productName,
				select: function(event,ui) { 
					var textval = ui.item.value;
					var item = textval.split(' - ');
					get_productdetails(item[0],obj,sno);
				}
			});		
		}else{
			alert("No data available");
			$(obj).val("");
			$("#prod_code_"+sno,"#prod_uom_"+sno).html('');
		}
	});	
 }
 
 function get_productdetails(id,obj,sno){
	
	$.getJSON('product-detail.php?action=prod_details&id='+id,function(json) { 
			$("#prod_code_"+sno).html(json[0]['product_code']);
			$("#prod_uom_"+sno).html(json[0]['product_uom_name']);
			$("#prod_brand_"+sno).html(json[0]['brand_name']);
			$("#stock_"+sno).html('50000');
		
	});	
	
																							
 }
 function amnt_calulation(val,obj,sno,typ){
	var qty 		= Number($("#qty_"+sno).val());
	var crncy_rate 	= Number($("#rate").val());
	if(typ==1){
		$("#frignrate_"+sno).val("");
		$("#tot_amount").val("");
		$("#net_tot_amount").val("");
	}else if(typ==2){
		$("#rate_"+sno).val('');
		$("#total_amnt").val("");
		$("#net_total_amnt").val("");
	}
	/*var rate = $("#rate_"+sno).val().replace(/,/g, '');
		rate = Number(rate);
		
	var frgnrate = $("#frignrate_"+sno).val().replace(/,/g, '');
		frgnrate = Number(frgnrate)*crncy_rate;
		
		$("#unitprice_"+sno).val(forNum(qty*(frgnrate+rate)));
	var total=0;
	$(".unit_amnt").each(function (){
		if($(this).val()!=''){
			var amnt = $(this).val().replace(/,/g, '');	
			total =Number(total)+Number(amnt);
		}
	});
	$("#total_amnt").val(forNum(total));
	get_net_amt();*/
 }
 function amnt_calulation_Qty(val,obj,sno,typ){
	var qty 			= Number($("#qty_"+sno).val());
	var prod_ton 		= Number($("#prod_ton_"+sno).val());
	var frgn_rate 		= $("#frignrate_"+sno).val();	
	var crncy_rate 		= $("#rate").val();
	var e_qty			= $("#qty_"+sno).val();	
	var e_ton			= $("#prod_ton_"+sno).val();
	
	if(frgn_rate!=''){
		var p_rate		= $("#frignrate_"+sno).val();	
		var p_rate		= p_rate*crncy_rate;
	}else{
		var p_rate		= $("#rate_"+sno).val();
	}
	if(typ	== 1){
		var p_qty		= $("#qty_"+sno).val();	
		if(p_qty!='' && p_qty>0){
			$("#prod_ton_"+sno).val('');
		}
	}else{
		var p_qty		= $("#prod_ton_"+sno).val();
		if(p_qty!='' && p_qty>0){
			$("#qty_"+sno).val('');
			ton_calculation(sno,1);
		}
	}
	//alert(p_qty);
	//$("#unitprice_"+sno).val(p_qty*p_rate);
	var total=0;
	$(".unit_amnt").each(function (){
		if($(this).val()!=''){
			var amnt = $(this).val().replace(/,/g, '');	
			total =Number(total)+Number(amnt);
		}
	});
	$("#total_amnt").val(forNum(total));
	get_net_amt();
	
 }
 
 
 function get_net_amt(){
	 
	var gross =Number($('#total_amnt').val().replace(/,/g, ''));
	
	var advance =Number($('#advance_amnt').val());
	var advance =isNaN(advance)?0.00:parseFloat(advance).toFixed(2);
	total = parseFloat(gross) - parseFloat(advance);
	//alert(gross);
	total1 =isNaN(total)?0.00:parseFloat(total).toFixed(2);
	
	$('#net_total_amnt').val(total);
	 
	
	 
 }
 function ton_calculation(id,val){
	 
	var prod_ton =$('#prod_ton_'+id).val();
	var prod_kg =$('#prod_kg_'+id).val();
	if(val==1){
		var prod_val	= prod_ton*1000;
		$('#prod_kg_'+id).val(prod_val)	;
	}
	if(val==2){
		var prod_val	= prod_kg*0.001;
		$('#prod_ton_'+id).val(prod_val);
	}
	 
 }
 