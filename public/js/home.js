
	    window.operateEvents = {
	        'click .removeFromProduct': function (e, value, row) {
	        	var xhttp = new XMLHttpRequest();
	        	
	        	xhttp.onreadystatechange = function() {
	            	if (this.readyState == 4 && this.status == 200) {
	            		$('#productBacklogTable').bootstrapTable('removeByUniqueId', row.id);
	            	}
	        	};
	        	
	        	xhttp.open("DELETE", "/backlog/productBacklog.php?id=" + row.id, true);
	        	xhttp.send();	
	        },
	        'click .addToSprint': function (e, value, row) {
	        	var xhttp = new XMLHttpRequest();
	        	
	        	xhttp.onreadystatechange = function() {
	            	if (this.readyState == 4 && this.status == 200) {
	            		$('#productBacklogTable').bootstrapTable('removeByUniqueId', row.id);
	            		$('#sprintBacklogTable').bootstrapTable('refresh');
	                }
	        	};
	        	
	        	xhttp.open("POST", "/backlog/productBacklog.php/changeBacklog?backlog=SprintBacklog&id="+row.id, true);
	        	xhttp.send();	
	        },
	        'click .addBackToProduct': function (e, value, row) {
				var xhttp = new XMLHttpRequest();
	        	
	        	xhttp.onreadystatechange = function() {
	            	if (this.readyState == 4 && this.status == 200) {
	            		$('#sprintBacklogTable').bootstrapTable('removeByUniqueId', row.id);
	            		$('#productBacklogTable').bootstrapTable('insertRow',{index: row.id, row: row});
	                }
	        	};
	        	
	        	xhttp.open("POST", "/backlog/sprintBacklog.php/changeBacklog?backlog=ProductBacklog&id="+row.id, true);
	        	xhttp.send();	
	        },
	        'click .addToIncrement': function (e, value, row) {
				var xhttp = new XMLHttpRequest();
	        	
	        	xhttp.onreadystatechange = function() {
	            	if (this.readyState == 4 && this.status == 200) {
	            		$('#sprintBacklogTable').bootstrapTable('removeByUniqueId', row.id);
	            		$('#incrementBacklogTable').bootstrapTable('refresh');
	                }
	        	};
	        	
	        	xhttp.open("POST", "/backlog/sprintBacklog.php/changeBacklog?backlog=Increment&id="+row.id, true);
	        	xhttp.send();	
	        },
	        'click .removeFromIncrement': function (e, value, row) {
				var xhttp = new XMLHttpRequest();
	        	
	        	xhttp.onreadystatechange = function() {
	            	if (this.readyState == 4 && this.status == 200) {
	            		$('#incrementBacklogTable').bootstrapTable('removeByUniqueId', row.id);
	            	}
	        	};
	        	
	        	xhttp.open("DELETE", "/backlog/incrementBacklog.php?id=" + row.id, true);
	        	xhttp.send();	
	        }
	    };

	    function operateFormatterProductBacklog(value, row, index) {
	    	var returnedDate = formatDateUserStory(row.addedTimestamp);
	        return [
	            '<div class="pull-left">',
	            '<a href="#" target="_blank">' + value + '</a>',
	            returnedDate,
	            '</div>',
	            '<div class="pull-right">',
	            '<a class="removeFromProduct" href="javascript:void(0)" title="Delete">',
	            '<i class="glyphicon glyphicon-remove"></i>',
	            '</a>  ',
	            '<a class="addToSprint" href="javascript:void(0)" title="Add to Sprint Backlog">',
	            '<i class="glyphicon glyphicon-chevron-right"></i>',
	            '</a>',
	            '</div>'
	        ].join(''); 
	    }
	    
	    function operateFormatterSprintBacklog(value, row, index) {
	    	var returnedDate = formatDateUserStory(row.startTimestamp);
	        return [
	            '<div class="pull-left">',
	            '<a href="#" target="_blank">' + value + '</a>',
	            returnedDate,
	            '</div>',
	            '<div class="pull-right">',
	            '<a class="addBackToProduct" href="javascript:void(0)" title="Remove">',
	            '<i class="glyphicon glyphicon-remove"></i>',
	            '</a>  ',
	            '<a class="addToIncrement" href="javascript:void(0)" title="Complete">',
	            '<i class="glyphicon glyphicon-ok"></i>',
	            '</a>',
	            '</div>'
	        ].join(''); 
	    }
	
	    function operateFormatterIncrementBacklog(value, row, index) {
	    	var returnedDate = formatDateUserStory(row.stopTimestamp);
	        return [
	            '<div class="pull-left">',
	            '<a href="#" target="_blank">' + value + '</a>',
	            returnedDate,
	            '</div>',
	            '<div class="pull-right">',
	            '<a class="removeFromIncrement" href="javascript:void(0)" title="Remove">',
	            '<i class="glyphicon glyphicon-remove"></i>',
	            '</a>  ',
	            '</div>'
	        ].join(''); 
	    }
	    
	    function formatDateUserStory(dates){
	    	var add = new Date(dates);
	    	var current = new Date();
	    	var timeDiff = Math.abs(current.getTime() - add.getTime());
	    	var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
	    	
	    	if (diffDays == 1){
	    		var returnedDate = '<div class="text-muted"> '+ diffDays +' day ago </div>';
		    	return returnedDate;
	    	} else{
	    		if (diffDays <= 30){
		    		var returnedDate = '<div class="text-muted"> '+ diffDays +' days ago </div>';
			    	return returnedDate;
		    	} else{
		    		var month = diffDays % 30;
	    			var returnedDate = '<div class="text-muted"> '+ month +' month and ' + (diffDays-month*30) + " days ago </div>";
	    	    	return returnedDate;
		    	}
	    	}
	    }

