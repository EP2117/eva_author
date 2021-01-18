function productList(){
	
	if($("#branchid").val()!=''){
		$("#showData").html('<img src="../images/ajax-loader-3.gif" />');
		$.ajax({
			url: 'product-detail.php',
			type: "POST",
			data: $("#stock-available").serialize(), 
			success: function(data)
			{
				$("#showData").html(data);											
			}
		});  
	}
}