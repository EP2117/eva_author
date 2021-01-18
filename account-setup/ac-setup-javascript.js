 function getAccountName(val,obj){
	 
		$.getJSON("account-details.php?action=accountList&val="+val, function( json ) {
			if(json.length>0){																						
				var accounlist = [];		
				for(var i=0;i<json.length;i++){			
					accounlist[i] = json[i]['account_sub_id']+' - '+json[i]['account_sub_name'];
				}		
				$(obj).autocomplete({
					maxResults: 10,
					source: accounlist,
					select: function(event,ui) { 
						var textval = ui.item.value;
						var item = textval.split(' - ');
					}
				});		
			}else{
				
				$(obj).val('');
			
			}
		});	
	 
 }