function pay_mode(val){
	$("#ref_details,#acR_chequeno,#acR_chequedate").val('');
	if(val==1){
		$(".chqdate").hide();
		$("#ref,#r_chq,#r_date").hide();
	}else if(val==2){
		$("#ref,#r_chq,#r_date").show();
	}
}
function getEmployeesName(val,obj){	
	
	var branch = $('#branchid').val();
	 
	if(branch !=''){
		$.getJSON("empdetails_ajaxfile.php?action=employeeList&val="+val+"&branch="+branch, function( json ) {
			if(json.length>0){																						
				var applicantName = [];		
				for(var i=0;i<json.length;i++){			
					applicantName[i] = json[i]['employee_id']+' - '+json[i]['employee_name'];
				}		
				$(obj).autocomplete({
					maxResults: 10,
					source: applicantName,
					select: function(event,ui) { 
						var textval = ui.item.value;
						var item = textval.split(' - ');
					}
				});		
			}else{
				
				$(obj).val('');
			
			}
		});	
	}else{
		$(obj).val('');
		alert("please select branch");
	}
		
 }
  function getAccountName(val,obj,type){
	 
		$.getJSON("empdetails_ajaxfile.php?action=accountList&val="+val, function( json ) {
			if(json.length>0){																						
				var accounlist = [];		
				for(var i=0;i<json.length;i++){			
					accounlist[i] = json[i]['account_sub_id']+' - '+json[i]['account_sub_name']+' - '+json[i]['account_sub_currency_id'] ;
				}		
				$(obj).autocomplete({
					maxResults: 10,
					source: accounlist,
					select: function(event,ui) { 
						var textval = ui.item.value;
						var item = textval.split(' - ');
						var textval_v 	= textval.split(' - ');
						if(type=="credit"){
							$("#credit_cur_id").val(textval_v[2]);
						}
						else{
							$("#debit_cur_id").val(textval_v[2]);
						}
					}
				});		
			}else{
				
				$(obj).val('');
			
			}
		});	
	 
 }
 function checkedAll(obj){
	var check =$(obj).prop('checked');
	
	if(check==true)
		$('.check').prop('checked',true);
	else
		$('.check').prop('checked',false);
	
}
  function GetCurrecy_amt(){
	 var cur_id	= $("#credit_cur_id").val();
	 var cur_amt	= $("#amount").val();
	 var cur_date	= $("#rec_date").val();
 	$.get("currency-amt.php",
		  {cur_id:cur_id,cur_amt:cur_amt,c_date:cur_date},
		  function(data){
			  var data_v 	= data.split('@');
			  	$("#t_amount_mmk").html(data_v[1]);
				$("#amount_mmk").val(data_v[0]);
				GetDebCur_amt();
		 }
	);
 }

  function GetDebCur_amt(){
	var cur_id		= $("#debit_cur_id").val();
	var cur_amt		= $("#amount_mmk").val();
	var cur_date	= $("#rec_date").val();
 	$.get("currency-amt.php",
		  {cur_id:cur_id,cur_amt:cur_amt,c_date:cur_date,type:"debit"},
		  function(data){
				$("#amount_debit_frgn").val(data)
		 }
	);	
 }

