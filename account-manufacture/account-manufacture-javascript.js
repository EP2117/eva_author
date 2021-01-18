function headsub_acount(val,obj){
	$.get('account-details.php?action=head_account&id='+val,function(data) { 
		$("#sub_account").html(data)
	});	
} 
