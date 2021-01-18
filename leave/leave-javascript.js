
  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('leave-form').elements.length; i++) {
	  document.getElementById('leave-form').elements[i].checked = checked;
	}
}


function getCalc(id){//alert(id);
	var emp_id=$('#lv_empid').val();
	var type=$('#lv_leave').val();
	var no_days=$('#lv_leaveno').val();
	
	var checkedVals = $('.salary_type:checkbox:checked').map(function() {
    return this.value;
}).get();
//alert(checkedVals.join(","));
	
	$.get('get_amount.php',{emp_id:emp_id,id:id,checkedVals:checkedVals.join(","),type:type,no_days:no_days},function(data){//alert(data);
				$('#lv_paymentid').val(data);	  
				 });	
	
	
}


function getEmployeesName(val,obj,typ){	
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
						if(typ==1){
							$("#lv_empid").val(item[0]);
						}
					}
				});		
			}else{
				
				$(obj).val('');
				$("#lv_empid").val("");
			}
		});	
	}else{
		$(obj).val('');$("#lv_empid").val("");
		alert("please select branch");
	}
 }
 
 
