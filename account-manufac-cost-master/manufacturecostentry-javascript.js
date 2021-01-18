function headsub_acount(val,obj,sno){
	$.get('account-details.php?action=head_account&id='+val,function(data) { 
		$("#sub_account_"+sno).html(data)
	});	
} 
