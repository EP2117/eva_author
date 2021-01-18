
  checked = false;
function checkedall () {
if (checked == false){checked = true}else{checked = false}
	for (var i = 0; i < document.getElementById('advance').elements.length; i++) {
	  document.getElementById('advance').elements[i].checked = checked;
	}
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
							$("#ad_empid").val(item[0]);
						}
					}
				});		
			}else{
				
				//$(obj).val('');
				//$("#ad_empid").val("");
			}
		});	
	}else{
		$(obj).val('');$("#ot_empid").val("");
		alert("please select branch");
	}
 }