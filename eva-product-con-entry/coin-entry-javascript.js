function GetSodetail(){
	var branch_id 		= document.getElementById('product_con_entry_branch_id').value;
	$.get('invoice-detail.php',
		{branch_id:branch_id},
		function(data) { alert(data); $('#so_detail_content').html( data ); }
	);	
}

 
 
 
 