function getEmployeesName(val){	
	
	var branch = $('#lv_branchid').val();
	 
	if(branch !=''){
		$.getJSON("empdetails_ajaxfile.php?action=employeeList&val="+val+"&branch="+branch, function( json ) {
			if(json.length>0){																						
				var applicantName = [];		
				for(var i=0;i<json.length;i++){			
					applicantName[i] = json[i]['employee_id']+' - '+json[i]['employee_name'];
				}		
				$('#lv_employee').autocomplete({
					maxResults: 10,
					source: applicantName,
					select: function(event,ui) { 
						var textval = ui.item.value;
						var item = textval.split(' - ');
						$('#lv_empid').val(item[0]).attr('readonly',true);
					}
				});		
			}else{
				
				$('#lv_employee,#lv_empid').val('').attr('readonly',false);
			
			}
		});	
	}else{
		alert("please select branch");
		$('#lv_employee,#lv_empid').val('').attr('readonly',false);
	}
		
 }
 
 function checkedAll(obj){
	var check =$(obj).prop('checked');
	
	if(check==true)
		$('.check').prop('checked',true);
	else
		$('.check').prop('checked',false);
	
}
 
 
