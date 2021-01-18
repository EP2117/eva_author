/*function productList(){alert();
	
	if($("#branchid").val()!=''){
		//$("#showData").html('<img src="../images/ajax-loader-3.gif" />');
		$.ajax({
			url: 'ajax-model.php',
			type: "POST",
			data: $("#openibngBalanc").serialize(), 
			success: function(data)
			{
				//$("#showData").html(data);											
			}
		});  
	}
}*/

function productList(){//alert();
//$('#opening_balinsertUpdate').click(function(){ 	
			
			$.post('ajax-madel.php', 
				$('#openibngBalanc').serialize(), 
				function(data){  
						//$('#openibngBalanc')[0].reset();
						location.reload();
						$('#vital_msg').html('Add Successful');
				}
			);
			
	  //  });	
}