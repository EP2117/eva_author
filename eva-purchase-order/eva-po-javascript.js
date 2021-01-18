
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
		function(data) { 
		$('#dynamic-content').html( data ); 
		//$('#myModal').modal('show'); 
		}
	);	
}



function getsupplier(id){

	$.getJSON('getsupplier.php?action=supplier&id='+id,function(json) {	
		// added value="" by AuthorsMM
		apnd = '<option value=""> --Select-- </option>';
			for(var i=0;i<json.length;i++){			
				apnd += '<option value="'+json[i]['supplier_id']+'">'+json[i]['supplier_name']+'</option>';
			}
		$("#supplier_name").html(apnd);
		
	});	
	
}

function AddproductDetail(){
	var rowCount = $('#purcase_table tbody tr').length;
	$("#product_apnd").val(rowCount);

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
				apnd += '<td><input type="hidden" name="arr_count[]" value="'+sno+'"><input type="hidden" name="pid_'+sno+'" value="" class="pid"><input type="text" class="form-control prod_name" name="prod_name[]" id="prod_name_'+sno+'" value="'+product_name+'" style="min-width:150px;" /><input type="hidden" name="prod_id_'+sno+'" value="'+product_id+'" class="sd_id"></td>';
				apnd += '<td id="prod_brand_'+sno+'" class="prod_brand_td"><input type="text" class="form-control prod_brand" name="prod_brand_'+sno+'" id="prod_brand_'+sno+'" value='+brand_name+' style="min-width:120px;"><input type="hidden" class="prod_uom" name="prod_uom_'+sno+'" id="prod_uom_'+sno+'"  value='+product_uom+'></td>';
				
				/* apnd += '<td id="prod_uom_'+sno+'" class="prod_uom_td"><input type="text" class="form-control prod_uom" name="prod_uom_'+sno+'" id="prod_uom_'+sno+'"  value='+product_uom+' style="min-width:60px;"></td>'; */
				
				apnd += '<td><input type="text" class="form-control rate" style="text-align:right;width:80px;" name="rate_'+sno+'" id="rate_'+sno+'" onChange="return amnt_calulation(this.value,this,'+sno+',1);"></td>';
				apnd += '<td><input type="text" class="form-control frignrate" style="text-align:right;width:90px;" name="frignrate_'+sno+'" id="frignrate_'+sno+'" onChange="return amnt_calulation(this.value,this,'+sno+',2);" onkeyup="get_currency_amt('+sno+');"></td>';
				apnd += '<td><input style="width:70px;" type="text" class="form-control qty" name="qty_'+sno+'" id="qty_'+sno+'" onChange="return amnt_calulation_Qty(this.value,this,'+sno+',1);" onkeyup="get_currency_amt('+sno+');"></td>';
				
				//Added by AuthorsMM
				apnd += '<td><b>Feet/Qty</b><input type="text" style="width:90px;" class="form-control feet normal-txtbox" name="feet_'+sno+'" id="feet_'+sno+'" onkeyup="get_total_feet('+sno+');">';
				apnd += '<b>Total Feet</b><input type="text" class="form-control total_feet normal-txtbox" name="total_feet_'+sno+'" id="total_feet_'+sno+'" readonly /></td>';
				//End
				
				apnd += '<td><input style="width:90px;" type="text" class="form-control prod_ton" name="prod_ton_'+sno+'" id="prod_ton_'+sno+'" onChange="amnt_calulation_Qty(this.value,this,'+sno+',2);" onkeyup="get_currency_amt('+sno+');"></td>';				
				apnd += '<td><input style="width:100px;" type="text" class="form-control prod_kg" name="prod_kg_'+sno+'" id="prod_kg_'+sno+'" onBlur="ton_calculation('+sno+',2);"></td>';
				apnd += '<td><input type="text" class="form-control unit_cur_amnt" style="text-align:right;width:120px;" name="rate_by_currency_'+sno+'" id="rate_by_currency_'+sno+'" readonly></td>';
				apnd += '<td><input type="text" class="form-control unit_amnt" style="text-align:right;width:130px;" name="unitprice_'+sno+'" id="unitprice_'+sno+'" readonly></td>';
				apnd += '<td><button class="glyphicon glyphicon-minus remove_prod" title="Remove row"  type="button" onclick="removeRow('+sno+')"></button></td>';
				apnd += '</tr>';
				//var sno	= sno+1;
				$("#product_apnd").val(sno);
				$("#purcase_table >tbody").append(apnd);
		
		}

	}

}

function removeRow(id){

	if(id>0){
		$('#remove_req_'+id).remove();
		//getTotal();
	}
	//re-order ids
	var i = 0;
	$('#purcase_table tbody tr').each(function() {
		i++;
		$(this).attr('id','remove_req_'+i);
		$(this).find('td').each (function() {
			$(this).find('input.pid').attr("name","pid_"+i);
			$(this).find('input.arr_count').attr("value",i);
			$(this).find('input.prod_name').attr("id","prod_name_"+i);
			$(this).find('input.prod_name').attr("name","prod_name_"+i);
			$(this).find('input.sd_id').attr("name","prod_id_"+i);
			$(this).attr("id","prod_brand_"+i);
			$(this).find('input.prod_brand').attr("id","prod_brand_"+i);
			$(this).find('input.prod_brand').attr("name","prod_brand_"+i);
			$(this).attr("id","prod_uom_"+i);
			$(this).find('input.prod_uom').attr("id","prod_uom_"+i);
			$(this).find('input.prod_uom').attr("name","prod_uom_"+i);
			$(this).find('input.rate').attr("id","rate_"+i);
			$(this).find('input.rate').attr("name","rate_"+i);
			$(this).find('input.rate').attr("onChange","return amnt_calulation(this.value,this,"+i+",1);");
			$(this).find('input.frignrate').attr("id","frignrate_"+i);
			$(this).find('input.frignrate').attr("name","frignrate_"+i);
			$(this).find('input.frignrate').attr("onChange","return amnt_calulation(this.value,this,"+i+",2);");
			$(this).find('input.frignrate').attr("onkeyup","get_currency_amt("+i+");");
			$(this).find('input.qty').attr("id","qty_"+i);
			$(this).find('input.qty').attr("name","qty_"+i);
			$(this).find('input.qty').attr("onChange","return amnt_calulation_Qty(this.value,this,"+i+",1);");
			$(this).find('input.qty').attr("onkeyup","get_currency_amt("+i+");");
			$(this).find('input.prod_ton').attr("id","prod_ton_"+i);
			$(this).find('input.prod_ton').attr("name","prod_ton_"+i);
			$(this).find('input.prod_ton').attr("onChange","return amnt_calulation_Qty(this.value,this,"+i+",2);");
			$(this).find('input.prod_ton').attr("onkeyup","get_currency_amt("+i+");");
			$(this).find('input.prod_kg').attr("id","prod_kg_"+i);
			$(this).find('input.prod_kg').attr("name","prod_kg_"+i);
			$(this).find('input.prod_kg').attr("onBlur","ton_calculation("+i+",2);");
			$(this).find('input.unit_cur_amnt').attr("id","rate_by_currency_"+i);
			$(this).find('input.unit_cur_amnt').attr("name","rate_by_currency_"+i);
			$(this).find('input.unit_amnt').attr("id","unitprice_"+i);
			$(this).find('input.unit_amnt').attr("name","unitprice_"+i);
			$(this).find('button.remove_prod').attr("onclick","removeRow("+i+");");
		});
	});

}

function get_currency_amt(id){
	if($('#rate_'+id).val()!='') {
		var rate = parseFloat($('#rate_'+id).val().replace(/[^\d.]/g,''));
	} else {
		var rate = 0;
	}
	
	if($('#frignrate_'+id).val()!='') {
		var frate = parseFloat($('#frignrate_'+id).val().replace(/[^\d.]/g,''));
	} else {
		var frate = 0;
	}
	var qty = Number($('#qty_'+id).val());
	var ton = Number($('#prod_ton_'+id).val());
	var c_rate = parseFloat($('#rate').val().replace(/[^\d.]/g,''));
	total= (rate+frate) * (qty+ton);
	c_total= (c_rate) *(rate+frate)* (qty+ton);
	if(total == ""){
		total = 0;
	}
	if(c_total == ""){
		c_total = 0;
	}
	
	if(frate!='' && frate!=0){
	$('#rate_by_currency_'+id).val(number_format(total, 2, '.', ','));
	$('#unitprice_'+id).val(number_format(c_total, 0, '.', ','));
	}else{
		$('#rate_by_currency_'+id).val('');
		$('#unitprice_'+id).val(number_format(total, 0, '.', ','));
	}
	if(document.getElementById("feet_"+id).value == ""){
		var feet = 0;
	} else {
		var feet = document.getElementById("feet_"+id).value;
	}
	qty = qty==''?0:qty;
	document.getElementById("total_feet_"+id).value = qty * parseFloat(feet);
	currency_mulit(id);
}

function get_total_feet(id) {
	var qty = Number($('#qty_'+id).val());
	if(document.getElementById("feet_"+id).value == ""){
		var feet = 0;
	} else {
		var feet = document.getElementById("feet_"+id).value;
	}
	qty = qty==''?0:qty;
	document.getElementById("total_feet_"+id).value = qty * parseFloat(feet);
}

function currency_mulit(id){

var total_amt=0;
var	total_amt1=0;
if($('#frignrate_'+id).val() != "") {
	var frate = parseFloat($('#frignrate_'+id).val().replace(/[^\d.]/g,''));
}

var id    = $('#product_apnd').val();
	for(var i=1;i<=(id);i++){
		if($('#rate_by_currency_'+i).val() != "") {
			var rate_by=parseFloat($('#rate_by_currency_'+i).val().replace(/[^\d.]/g,''));
		} else {
			var rate_by = 0;
		}
		if($('#unitprice_'+i).val() != "") {
		} else {
				var rate_by1=parseFloat($('#unitprice_'+i).val().replace(/[^\d.]/g,''));
		}
		
		total_amt = parseFloat(total_amt) + parseFloat(rate_by);
		total_amt1 = parseFloat(total_amt1) + parseFloat(rate_by1);
		}
		
		
		
	if(frate!='' && frate!=0){
	document.getElementById('tot_amount').value=number_format(total_amt, 2, '.', ',');
	net_amount();
	}else{
	document.getElementById('total_amnt').value=number_format(total_amt1, 0, '.', ',');
	get_net_amt();
	}
}

function net_amount(){
	if($('#tot_amount').val() != ""){
		var tot_amount =parseFloat($('#tot_amount').val().replace(/[^\d.]/g,''));
	} else {
		var tot_amount = 0;
	}
	if($('#advance_amount').val() != ""){
		var advance_amount =parseFloat($('#advance_amount').val().replace(/[^\d.]/g,''));
	} else {
		var advance_amount = 0;
	}
	if($('#advance_amount').val() != ""){
		var rate =parseFloat($('#rate').val().replace(/[^\d.]/g,''));
	} else {
		var rate = 0;
	}
	total = parseFloat(tot_amount) - parseFloat(advance_amount);
	$('#advance_amnt').val(number_format((advance_amount*rate), 0, '.', ','));
	$('#net_tot_amount').val(number_format(total, 2, '.', ','));
	
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
 	
	var rowCount = $('#purcase_table tbody tr').length;
	$("#product_apnd").val(rowCount);
	var last_val = $("#product_apnd").val();
	var sno      = parseInt(last_val);
	
	var apnd  = '<tr id="remove_req_'+sno+'">';
		
		apnd += '<td><input type="hidden" name="arr_count[]" value="'+sno+'" class="arr_count"><input type="hidden" name="pid_'+sno+'" value="" class="pid"><div class="ui-widget"><input type="text" class="form-control" name="prod_name[]" id="prod_name_'+sno+'" onKeyUp="return get_product(this.value,this,'+sno+',1);"></div></td>';
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
	var crncy_rate 	= parseFloat($("#rate").val().replace(/[^\d.]/g,''));
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
	var frgn_rate 		= parseFloat($("#frignrate_"+sno).val().replace(/[^\d.]/g,''));	
	var crncy_rate 		= parseFloat($("#rate").val().replace(/[^\d.]/g,''));
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
			var amnt = parseFloat($(this).val().replace(/[^\d.]/g,''));	
			total =parseFloat(total)+parseFloat(amnt);
		}
	});
	//$("#total_amnt").val(forNum(total));
	$("#total_amnt").val(number_format(total, 0, '.', ','));
	get_net_amt();
	
 }
 
 
 function get_net_amt(){
	/* var gross =Number($('#total_amnt').val().replace(/,/g, ''));
	
	var advance =Number($('#advance_amnt').val());
	var advance =isNaN(advance)?0.00:parseFloat(advance).toFixed(2);
	total = parseFloat(gross) - parseFloat(advance);
	//alert(gross);
	total1 =isNaN(total)?0.00:parseFloat(total).toFixed(2);
	
	$('#net_total_amnt').val(total); */
	 
	var gross = parseFloat($('#total_amnt').val().replace(/[^\d.]/g,''));
	var advance =parseFloat($('#advance_amnt').val().replace(/[^\d.]/g,''));
	var advance =isNaN(advance)?0.00:parseFloat(advance).toFixed(2);
	total = parseFloat(gross) - parseFloat(advance);
	//alert(gross);
	total1 =isNaN(total)?0.00:parseFloat(total);
	
	$('#net_total_amnt').val(number_format(total, 0, '.', ','));
	 
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
 
 function number_format(number, decimals, dec_point, thousands_point) {

    /* if (number == null || !isFinite(number)) {
        throw new TypeError("number is not valid");
    } */
	if(number != null && isFinite(number)) {
		if (!decimals) {
			var len = number.toString().split('.').length;
			decimals = len > 1 ? len : 0;
		}

		if (!dec_point) {
			dec_point = '.';
		}

		if (!thousands_point) {
			thousands_point = ',';
		}

		number = parseFloat(number).toFixed(decimals);

		number = number.replace(".", dec_point);

		var splitNum = number.split(dec_point);
		splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
		number = splitNum.join(dec_point);

		return number;
	} else {
		return 0;
	}
}
 