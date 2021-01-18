
  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('attendance-form').elements.length; i++) {
	  document.getElementById('attendance-form').elements[i].checked = checked;
	}
}  
 function getEmployeesName(val){	
	
	var branch = $('#atnc_branchid').val();
	 
	if(branch !=''){
		$.getJSON("empdetails_ajaxfile.php?action=employeeList&val="+val+"&branch="+branch, function( json ) {
			if(json.length>0){																						
				var applicantName = [];		
				for(var i=0;i<json.length;i++){			
					applicantName[i] = json[i]['employee_id']+' - '+json[i]['employee_name'];
				}		
				$('#atnc_employee').autocomplete({
					maxResults: 10,
					source: applicantName,
					select: function(event,ui) { 
						var textval = ui.item.value;
						var item = textval.split(' - ');
						$('#atnc_empid').val(item[0]).attr('readonly',true);
					}
				});		
			}else{
				
				$('#atnc_employee,#atnc_empid').val('').attr('readonly',false);
			
			}
		});	
	}else{
		alert("please select branch");
		$('#atnc_employee,#atnc_empid').val('').attr('readonly',false);
	}
		
		
 }
 
 
 
 
 
 