<style>
    .usergroup-btn.active{
               background-color: #5cb85c;
                border-color: #4cae4c;
    }
    </style>
	<link rel="stylesheet" type="text/css" href="http://docs.handsontable.com/pro/bower_components/handsontable-pro/dist/handsontable.full.min.css">

	<!--<link rel="stylesheet" type="text/css" href="http://handsontable.com/static/css/main.css">-->

	<script src="http://docs.handsontable.com/pro/bower_components/handsontable-pro/dist/handsontable.full.min.js"></script>
	
<div class="panel-body">

	<div  id="hot_container" ></div>
	<button name="" id="save_tracker" value="0" class="btn btn-primary btn-space">Save Tracker</button>
	
	
	<script>
		
	//URL for ajax call
	var study_id = '<?php echo $study_id; ?>';
	var script = '<?php echo base_url(); ?>'+'studies/populate_tracker_tab/' + study_id;
		
		
	//Create HOT placeholder table
	var placeholder = [
	  ["", "", "", "", "", "", "", ""],
	  ["", "", "", "", "", "", "", ""],
	  ["", "", "", "", "", "", "", ""],
	  ["", "", "", "", "", "", "", ""],
	  ["", "", "", "", "", "", "", ""],
	  ["", "", "", "", "", "", "", ""],
	  ["", "", "", "", "", "", "", ""],
	  ["", "", "", "", "", "", "", ""]
	]; 
	var container = document.getElementById('hot_container');
	var hot = new Handsontable(container, 
	{
        startRows: 8,
        startCols: 8,
		minRows: 8,
		minCols: 8,
		rowHeaders: true,
		colHeaders: true,
		renderAllRows: true,
		filters: true,
		dropdownMenu: true,
		persistentState : true,
		manualColumnResize: true,
		manualRowResize: true,
		manualColumnMove: true,
		manualRowMove: true,
		colHeaders: ["First Name", "Mi", "Last Name", "City"]
	});		
	
	//Replace placeholder with existing data if available
	loadContent(script);
	
	//Ajax call to retrieve table data from the database and load into HOT table
	function loadContent(script)
	{
		//alert("here!");
		
		$.ajax(
		{
			url: script,
			dataType: 'json',
			asynch: false,
			success: function(result)
			{
				
				//Set up empty array to hold table cell values later
				var table_array = [];	
				
				
				//These are all of the cell values in string form
				arr = result.split('],');
				
				
				//Convert cell string to multidimensional array
				var i = 0;
				$.each(arr, function( key, value ) 
				{
					//strip out brackets and quotes
					value = value.replace("[[", "");
					value = value.replace("[", "");
					value = value.replace("]]", "");
					value = value.replace("]", "");
					value = value.replace('"', "");

					//Cycle through each value and split at the comma to get subvalues
					//And then iterate through each subvalue and add to array
					table_array[i] = [];
					var v = value.split(",");
					$.each(v, function( key, value )
					{
						value = value.replace('"', '');
						value = value.replace("'", '');
						if(value == '"')
							value = null;
						
						table_array[i][key] = value;
					});
					
					//Increment counter
					i = i+1;
				});	
				
				//alert(table_array);
				hot.loadData(table_array);
			}
			
		});	
	}
		
	
	//When save button is clicked, save table changes
	$("#save_tracker").click(function()
	{		
		//URL for ajax call
		var script = '<?php echo base_url(); ?>'+'studies/update_tracker_tab/' + study_id +'/';				
		//Get existing content
		var data = hot.getData();
		
		
		//Ajax call to save data to database
		$.ajax(
		{
			type: 'POST',
			url: script,
			data: {table: JSON.stringify(data)},
			success: function(result){
				var response = result.response;
				//alert(result);
				//alert(response);
			}
		});	
	});
	
	</script>

	
	

</div>                       

