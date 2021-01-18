 
   checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('costing-forms').elements.length; i++) {
	  document.getElementById('costing-forms').elements[i].checked = checked;
	}
} 
 
 function add_row(id){
	
	 var count =$('#request_table >tbody >tr').length;
	 var count1=count+1;
	 get_currencyid(count);
	 get_Costingid(count);
	 //alert(count);alert(id);
	 if(count==id){
		 $('#request_table').append("<tr><td>"+count1+"</td> <td> <input type='hidden' name='cid[]' value=''><select name='costingname[]' id='costingname_"+count1+"' class='form-control select2' style='width:100%' onchange ='return currency_val(this.value,"+count1+",this);'><option value=''> - Select - </option></select></td> <td> <select name='currencyid[]' id='currencyid_"+count1+"' class='form-control select2' style='width:100%' onchange ='return currency_val(this.value,"+count1+",this);'><option value=''> - Select - </option></select></td> <td><input type='text' class='form-control t_rate' style='text-align:right;' name='rate[]' id='rate_"+count1+"'  onkeypress='return o_obj.Numeric(this,event);'  value='' ></td> <td><input type='text' class='form-control t_frgnrate' style='text-align:right;' name='frgnrate[]' id='frgnrate_"+count1+"'  onkeypress='return o_obj.Numeric(this,event);' value=''  ></td> <td><input type='text' class='form-control t_amount_cur' style='text-align:right;' name='amount_cur[]' id='amount_cur_"+count1+"'  onkeypress='return o_obj.Numeric(this,event);' value='' onChange='calulateAmnt_cur()'  ></td><td><input type='text' class='form-control t_amount' style='text-align:right;' name='amount[]' id='amount_"+count1+"'  onkeypress='return o_obj.Numeric(this,event);' value='' onChange='calulateAmnt()' ></td> <td><input type='text' class='form-control' name='remark[]' id='remark_"+count1+"'  onkeypress='return o_obj.Numeric(this,event);' value='' onBlur='add_row("+count1+");'><input type='hidden' id='payment_apnd' name='payment_count[]' value='"+count1+"'></td></tr>");
	$(".select2").select2();	
	
		}
 }
  function get_Costingid(id){//alert(id);
	$.get('get_costing.php',function(data){
		$('#costingname_'+id).html(data)
		});
 }

 function get_currencyid(id){//alert(id);
	$.get('get_curr.php',function(data){
		$('#currencyid_'+id).html(data)
		});
 }
 
/* function get_rate(id){alert();
	total=0;
	for(var i=1;i<=(id);i++){
		var rate=Number($('#amount_cur').val());
		total=parseFloat(total)+parseFloat(rate);
	}
	$('#cs_total_rate').val(total.toFixed(2));
 }
 
  function get_frate(id){
	total=0;
	for(var i=1;i<=(id);i++){
		var rate=Number($('#amount_'id).val());
		total=parseFloat(total)+parseFloat(rate);
	}
	$('#cs_total_frgnrate').val(total.toFixed(2));
 }*/
 
 function currency_val(val,sno,obj){
	var p_date=$('#costingdate').val();
	if(val!='' && p_date!=''){		
		
		$.get('getcurrency.php',{p_date:p_date,val:val},function(data){ 
																 
			$('#cur_rate_'+sno).val(data);
			$('#rate_'+sno).attr('readonly',true);
		});
	}else{
		$(obj).val("");
		$('#rate_'+sno).val('');
		$('#rate_'+sno).attr('readonly',false);
		alert('Please select date');
	}
 }
 
 function calulateAmnt(sno){
	 var frgnrate 	= $("#frgnrate_"+sno).val();
	 var rate 		= $('#rate_'+sno).val();
	 var cur_rate 		= $('#cur_rate_'+sno).val();
	 var cur_id 	= $("#currencyid_"+sno).val();
	 
	 if(cur_id==''){
	 	$("#amount_"+sno).val(rate);	
	 }
	 else{
		  $("#amount_cur_"+sno).val(frgnrate);
		 $("#amount_"+sno).val(frgnrate*Number(cur_rate));	
	 }
	 /*var rate 		= $("#amount_cur_"+sno).val();
	 rate 		= Number(rate);
		
			frgnrate = Number(frgnrate);
			
		if(frgnrate==''){
			var frgnrate = kyat_rate;
		}
		if(kyat_rate==''){
			var frgnrate = frgnrate;
		}
			
 	$("#amount_"+sno).val((rate*frgnrate));*/
	
	var t_rate=0;
	 	$(".t_amount").each(function (){
			if($(this).val()!=''){
				var amnt = $(this).val();	
				t_rate =Number(t_rate)+Number(amnt);
			}
		});
	$("#total_rate").val((t_rate));
	var t_rate=0;
	
	 	$(".t_amount_cur").each(function (){
			if($(this).val()!=''){
				var amnt = $(this).val();	
				t_rate =Number(t_rate)+Number(amnt);
			}
		});
	$("#total_frgnrate").val((t_rate));
	
	
	/*var t_frgnrate=0;
	 	$(".t_frgnrate").each(function (){
			if($(this).val()!=''){
				var amnt = $(this).val().replace(/,/g, '');	
				t_frgnrate =Number(t_frgnrate)+Number(amnt);
			}
		});
	$("#total_frgnrate").val(forNum(t_frgnrate));*/
 }
 
 function calulateAmnt_cur(){
	 
	 /*var rate = $("#rate_"+sno).val().replace(/,/g, '');
			rate = Number(rate);
		var frgnrate = $("#frgnrate_"+sno).val().replace(/,/g, '');
			frgnrate = Number(frgnrate);
 
 	$("#amount_"+sno).val(forNum(rate*frgnrate));*/
	
	var t_rate=0;
	calulateAmnt_cur();
	/*var t_frgnrate=0;
	 	$(".t_frgnrate").each(function (){
			if($(this).val()!=''){
				var amnt = $(this).val().replace(/,/g, '');	
				t_frgnrate =Number(t_frgnrate)+Number(amnt);
			}
		});
	$("#total_frgnrate").val(forNum(t_frgnrate));*/
 }