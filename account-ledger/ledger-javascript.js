/*function headsub_acount(val,obj){
	$.get('account-details.php?action=head_account&id='+val,function(data) { 
		$("#sub_account").html(data)
	});	
} 
*/
function getAccount()
{
	$('#account_sub_name').autocomplete({source:'account-details.php?action=account', minLength:1,
	select:function(evt, ui) 
	{ //alert(ui.item.id);
			document.getElementById('account_sub_id').value = ui.item.id;
			//document.getElementById('product_brand_name').value = ui.item.type;
	}
	});
}
