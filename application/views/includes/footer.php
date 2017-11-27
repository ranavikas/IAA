  <!--<footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2014 <a href='#'>Website</a>
            </div>
            
         </div>
     </footer>-->
     <link href="<?php echo ASSET_PATH;?>vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
     <!-- jQuery UI -->
     <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/jquery-ui.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
     
     <script src="<?php echo ASSET_PATH;?>vendors/datatables/js/jquery.dataTables.min.js"></script>

     <script src="<?php echo ASSET_PATH;?>vendors/datatables/dataTables.bootstrap.js"></script>
     

     <script src="<?php echo ASSET_PATH;?>js/tables.js"></script>
     
        <script src="<?php echo ASSET_PATH;?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo ASSET_PATH;?>bootstrap/js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo ASSET_PATH;?>bootstrap/js/bootstrap-select.min.js"></script>
       <!-- <script src="<?php echo ASSET_PATH;?>bootstrap/js/bootstrap-select.js"></script>-->
        
        

     <script src="<?php echo ASSET_PATH;?>js/custom.js"></script>
     <script src="<?php echo ASSET_PATH;?>js/jquery.validate.js"></script>
     <script src="<?php echo ASSET_PATH;?>js/validation.js"></script>
     
     <script src="<?php echo ASSET_PATH;?>js/jquery.callback.js"></script>
     <script src="<?php echo ASSET_PATH;?>js/ExportHTMLTable.js"></script>
    
     
     <!--for scroll table-->
     
     
     <script type="text/javascript">
  
     $(document).ready(function(){
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
        
        
        
        $(".usergroup-btn").click( function(){
            $(".usergroup-btn.active").removeClass("active");

            $(this).addClass("active");
        });
        
    });

     $('.form_datetime').datetimepicker({
        //language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
     $('.form_date').datetimepicker({
     	language:  'en',
     	weekStart: 1,
     	todayBtn:  1,
     	autoclose: 1,
     	todayHighlight: 1,
     	startView: 2,
     	minView: 2,
     	forceParse: 0
     });
     $('.form_time').datetimepicker({
     	language:  'en',
     	weekStart: 1,
     	todayBtn:  1,
     	autoclose: 1,
     	todayHighlight: 1,
     	startView: 1,
     	minView: 0,
     	maxView: 1,
     	forceParse: 0
     });
     
     
     
     
     
     $(document).ready(function() {
     	$('table.display').DataTable();
     	
     	$('#additional_lead').hide();
		//alert("!");
		$('#lead_source').change(function () {
			if ($('#lead_source').val() == 'other') {
				$('#additional_lead').show();
                //$('#lead_source').hide();
            }
            else {
            	$('#additional_lead').hide();
                //$('#lead_source').show();
            }
        });

        //when page load by default load one select box
            var filtter = 1;
            $.ajax({url:"<?php echo BASE_URL?>/studies/filter_select?filterId="+filtter,cache:false,success:function(result){
                $(".filterSelect").html(result);
            }});

            $("#filter_by").change(function () {

                 var filter = $("#filter_by").val();

                $.ajax({url:"<?php echo BASE_URL?>/studies/filter_select?filterId="+filter,cache:false,success:function(result){
                    $(".filterSelect").html(result);
                }});  
            });

	}); //end of document ready
        
        
        $('#savebtnfilter').click(function(){
  	
                 var filter_type = '';
                filter_type = $("#filter_by").val();
                
                //if filter type is year
                if(filter_type === '1'){
                    var  filterValue = $("#study_year").val();
                }
                else 
                if(filter_type === '2')
                {
                    var filterValue = $('#client-select').val();
                }
                else 
                if(filter_type === '3')
                {
                    var filterValue = $('#product-select').val();
                }
                else 
                if(filter_type === '4')
                {
                    var filterValue = $('#product-type').val();
                }
                else 
                if(filter_type === '5')
                {
                    var filterValue = $('#study_status').val();
                }
                else 
                if(filter_type === '6')
                {
                    var filterValue = $('#study_location').val();
                }
                
                $.ajax({url:"<?php echo BASE_URL?>/studies/studyList?filterVal="+filterValue+"&filterType="+filter_type,cache:false,success:function(result){
                        $(".filter-list-area").html(result);
                   }}); 

           });
        
     
     
     $('.add_field_btn').click(function(){
  
  	var checked = []
  	$("input[name='participant_search[]']:checked").each(function ()
  	{
             checked.push(parseInt($(this).val()));
  	});
   
    	$.ajax({url:"<?php echo BASE_URL?>/participants/participant_filter_select?AddFieldIds="+checked,cache:false,success:function(result){
            $(".ParticipantSearchField").html(result);
            document.getElementById('searchfields').style.display='none';
    	}});

   });
     
     
     $(document).ready(function() {
     	
     	$('.user_group_select').multiselect({
     		enableFiltering: true,
                includeSelectAllOption: true,
                enableCaseInsensitiveFiltering: true,

     		maxHeight: 400,
     		dropUp: false
     	});
        
        $('.multi-select').multiselect({
     		enableFiltering: true,
     		includeSelectAllOption: true,
     		maxHeight: 400,
     		dropUp: false
     	});
        
        $('.deleter').on('click', function(){
            $(this).closest('div.form-group').remove();
          })
        
        
        
     	
     	
     	$('.participnats').click(function() {
     		var checked = []
     		$("input[name='participnat_ids[]']:checked").each(function ()
     		{
     			checked.push(parseInt($(this).val()));
     		});
     		
     		
     		if (checked != '') {
            //alert('select one');    
            $('#selected_study').removeAttr('disabled');
            $('#new_participant').removeAttr('disabled');
        } else {
            //  alert('not select any one');  
            $('#selected_study').attr('disabled', 'disabled');
            $('#new_participant').removeAttr('disabled');
        }
    });
    
     	$('.participnats').click(function() {
     		var checked = []
     		$("input[name='participnat_ids[]']:checked").each(function ()
     		{
     			checked.push(parseInt($(this).val()));
     		});
     		
     		
     		if (checked != '') {
            //alert('select one');    
            $('#selected_study').removeAttr('disabled');
        } else {
            //  alert('not select any one');  
            $('#selected_study').attr('disabled', 'disabled');
        }
    });
    
    
    $('.study_ids').click(function() {
     		var checked = []
     		$("input[name='studies_id[]']:checked").each(function ()
     		{
     			checked.push(parseInt($(this).val()));
     		});
     		
     		
     		if (checked != '') {
            //alert('select one');    
            $('#copy_study').removeAttr('disabled');
        } else {
            //  alert('not select any one');  
            $('#copy_study').attr('disabled', 'disabled');
        }
    });
    
    
    
     	
     	
     	$('.studies').click(function() {
          // var checked = [];
          var study_val;
          $('.usergroop').attr('disabled', 'disabled');
          $("input[name='studies_ids[]']:checked").each(function ()
          {
          	study_val =   parseInt($(this).val());
          	$('#study_user_group'+study_val).removeAttr('disabled');
          	
          });
      });
     	
     	
     	$('#myModal').on('hidden.bs.modal', function () {
     		location.reload();
     	});
        

     }); //end fo document.ready function
  
  
   $('.tableprint').click(function(){
        $('body').css('visibility', 'hidden');
        $('#usergroup_scheduled_table').css('visibility', 'visible');
        window.print();
    });
  
  $('.modalLinkStudy').click(function(){
  	
  	var checked = []
  	$("input[name='participnat_ids[]']:checked").each(function ()
  	{
  		checked.push(parseInt($(this).val()));
  	});

       // alert(checked);

       $.ajax({url:"<?php echo BASE_URL?>/studies/selected_study?participantIds="+checked,cache:false,success:function(result){
       	
       	$(".modal-content-study").html(result);
       }});

   });
   
   
   $('.updateGroup').click(function(){
  	
  	var checked = []
  	$("input[name='participant_idss[]']:checked").each(function ()
  	{
  		checked.push(parseInt($(this).val()));
  	});
       // alert(checked);
        var studyId = '';
    	studyId = $("#studyid").text();
       // alert(studyId);
       $.ajax({url:"<?php echo BASE_URL?>/studies/change_user_group?participantIds="+checked+"&study_id="+studyId,cache:false,success:function(result){
       	
      
       	$(".modal-content-study").html(result);
       }});

   });
  
  $('.editmodalLinkStudy').click(function(){
  	
  	var participantId = '';
  	participantId = $("#participantId").val();
  	
  	
  	$.ajax({url:"<?php echo BASE_URL?>/studies/selected_study?participantIds="+participantId,cache:false,success:function(result){

  		$(".modal-content-study").html(result);
  	}});

  });
  
  $('.addSearchFields').click(function(){
  	
  	var participantId = '';
  	participantId = $("#participantId").val();
  	
  	
  	$.ajax({url:"<?php echo BASE_URL?>/studies/selected_study?participantIds="+participantId,cache:false,success:function(result){

  		$(".modal-content-study").html(result);
  	}});

  });
  
   
    $('.copy_study').click(function(){
  
  	var checked = []
  	$("input[name='studies_id[]']:checked").each(function ()
  	{
             checked.push(parseInt($(this).val()));
  	});

    	
    	$.ajax({url:"<?php echo BASE_URL?>/studies/copy_study?studyIds="+checked,cache:false,success:function(){

    		location.reload();
    	}});

   });
   
     $('.remove_selected_screener').click(function(){
  
  	var checked = []
  	$("input[name='participant_idss[]']:checked").each(function ()
  	{
             checked.push(parseInt($(this).val()));
  	});

        var groupId = '';
    	groupId = $("#groupid").text();
    	var studyId = '';
    	studyId = $("#studyid").text();
    	
    	$.ajax({url:"<?php echo BASE_URL?>/studies/remove_selected_participant?participantIds="+checked+"&onegroup="+groupId+"&study_id="+studyId,cache:false,success:function(result){

    		location.reload();
    	}});

    });
   
     $('.move_scheduled').click(function(){
  
  	var checked = []
  	$("input[name='participant_idss[]']:checked").each(function ()
  	{
             checked.push(parseInt($(this).val()));
  	});

        var groupId = '';
    	groupId = $("#groupid").text();
    	var studyId = '';
    	studyId = $("#studyid").text();
    	
    	$.ajax({url:"<?php echo BASE_URL?>/studies/move_scheduled?participantIds="+checked+"&onegroup="+groupId+"&study_id="+studyId,cache:false,success:function(){

    		location.reload();
    	}});

   });
   
    $('.move_potential').click(function(){
  
  	var checked = []
  	$("input[name='participant_idss[]']:checked").each(function ()
  	{
             checked.push(parseInt($(this).val()));
  	});

        var groupId = '';
    	groupId = $("#sgroupid").text();
    	var studyId = '';
    	studyId = $("#sstudyid").text();
        
    	
    	$.ajax({url:"<?php echo BASE_URL?>/studies/move_potential?participantIds="+checked+"&onegroup="+groupId+"&study_id="+studyId,cache:false,success:function(){

    		location.reload();
    	}});

   });
   
    $('.move_potential_dnq').click(function(){
  
  	var checked = []
  	$("input[name='participant_idss[]']:checked").each(function ()
  	{
             checked.push(parseInt($(this).val()));
  	});

        var groupId = '';
    	groupId = $("#dgroupid").text();
    	var studyId = '';
    	studyId = $("#dstudyid").text();
        
    	
    	$.ajax({url:"<?php echo BASE_URL?>/studies/move_potential?participantIds="+checked+"&onegroup="+groupId+"&study_id="+studyId,cache:false,success:function(){

    		location.reload();
    	}});

   });
   
 //for potential tab
  $('.usergroup').click(function(){
  	
  	var usergroupId =$(this).attr('data-id');
  	var groupname =$(this).attr('data-group');
  	var groupparticipnat =$(this).attr('data-participant');
  	var screenparticipant =$(this).attr('data-screen');
  	
  	$("#groupname").html(groupname);
  	$("#groupid").html(usergroupId);
  	$("#groupparti").html(groupparticipnat);
        $(".screen").html(screenparticipant);

  	$.ajax({url:"<?php echo BASE_URL?>/studies/usergroup_participant?usergroupp="+usergroupId,cache:false,success:function(result){
  		
  		$("#usergroup_participants_table").html(result);
  	}});

  });  
  
  
  
  $(document).ready(function() {

  	var usergroupId =$(".usergroup").first().attr('data-id');
  	var groupname =$(".usergroup").first().attr('data-group');
  	var groupparticipnat =$(".usergroup").first().attr('data-participant');
        var screenparticipant =$(".usergroup").first().attr('data-screen');

  	$("#groupname").html(groupname);
  	$("#groupparti").html(groupparticipnat);
  	$("#groupid").html(usergroupId);
         $(".screen").html(screenparticipant);
        
  	$.ajax({url:"<?php echo BASE_URL?>/studies/usergroup_participant?usergroupp="+usergroupId,cache:false,success:function(result){

  		$("#usergroup_participants_table").html(result);
  	}});
  	
  	
  });
  //end for potential tab
  
  //for scheduled tab
   $('.usergroupschedual').click(function(){
  	
  	var usergroupId =$(this).attr('data-id');
  	var groupname =$(this).attr('data-group');
  	var groupparticipnat =$(this).attr('data-participant');
  	var screenparticipant =$(this).attr('data-screen');
  	
  	$("#sgroupname").html(groupname);
  	$("#sgroupid").html(usergroupId);
  	$("#sgroupparti").html(groupparticipnat);
         $(".screen").html(screenparticipant);

  	$.ajax({url:"<?php echo BASE_URL?>/studies/usergroup_scheduled?usergroupp="+usergroupId,cache:false,success:function(result){
  		
  		$("#usergroup_scheduled_table").html(result);
  	}});

  });  
  
  
  
  $(document).ready(function() {

  	var usergroupId =$(".usergroupschedual").first().attr('data-id');
  	var groupname =$(".usergroupschedual").first().attr('data-group');
  	var groupparticipnat =$(".usergroupschedual").first().attr('data-participant');
        var screenparticipant =$(".usergroupschedual").first().attr('data-screen');

  	$("#sgroupname").html(groupname);
  	$("#sgroupparti").html(groupparticipnat);
  	$("#sgroupid").html(usergroupId);
        $(".screen").html(screenparticipant);
  	$.ajax({url:"<?php echo BASE_URL?>/studies/usergroup_scheduled?usergroupp="+usergroupId,cache:false,success:function(result){

  		$("#usergroup_scheduled_table").html(result);
  	}});
  	
  	
  });  
//end of scheduled tab

 //for demographic tab
 
   $('.usergroupdemographic').click(function(){
  	
  	var usergroupId =$(this).attr('data-id');
  	var groupname =$(this).attr('data-group');
  	var groupparticipnat =$(this).attr('data-participant');
  	var screenparticipant =$(this).attr('data-screen');
  	
  	$("#dgroupname").html(groupname);
  	$("#dgroupid").html(usergroupId);
  	$("#dgroupparti").html(groupparticipnat);
         $(".screen").html(screenparticipant);

  	$.ajax({url:"<?php echo BASE_URL?>/studies/usergroup_demographic?usergroupp="+usergroupId,cache:false,success:function(result){
  		
  		$("#usergroup_demographic_table").html(result);
  	}});

  });  
  
  
  
  $(document).ready(function() {

  	var usergroupId =$(".usergroupdemographic").first().attr('data-id');
  	var groupname =$(".usergroupdemographic").first().attr('data-group');
  	var groupparticipnat =$(".usergroupdemographic").first().attr('data-participant');
        var screenparticipant =$(".usergroupdemographic").first().attr('data-screen');

  	$("#dgroupname").html(groupname);
  	$("#dgroupparti").html(groupparticipnat);
  	$("#dgroupid").html(usergroupId);
        $(".screen").html(screenparticipant);
  	$.ajax({url:"<?php echo BASE_URL?>/studies/usergroup_demographic?usergroupp="+usergroupId,cache:false,success:function(result){

  		$("#usergroup_demographic_table").html(result);
  	}});
  	
  	
  });  
//end of scheduled tab



//for DNQ tab
   $('.usergroupdnq').click(function(){
  	
  	var usergroupId =$(this).attr('data-id');
  	var groupname =$(this).attr('data-group');
  	var groupparticipnat =$(this).attr('data-participant');
  	var screenparticipant =$(this).attr('data-screen');
  	
  	$("#dgroupname").html(groupname);
  	$("#dgroupid").html(usergroupId);
  	$("#dgroupparti").html(groupparticipnat);
         $(".screen").html(screenparticipant);

  	$.ajax({url:"<?php echo BASE_URL?>/studies/usergroup_dnq?usergroupp="+usergroupId,cache:false,success:function(result){
  		
  		$("#usergroup_dnq_table").html(result);
  	}});

  });  
  
  
  
  $(document).ready(function() {

  	var usergroupId =$(".usergroupdnq").first().attr('data-id');
  	var groupname =$(".usergroupdnq").first().attr('data-group');
  	var groupparticipnat =$(".usergroupdnq").first().attr('data-participant');
        var screenparticipant =$(".usergroupdnq").first().attr('data-screen');

  	$("#dgroupname").html(groupname);
  	$("#dgroupparti").html(groupparticipnat);
  	$("#dgroupid").html(usergroupId);
        $(".screen").html(screenparticipant);
  	$.ajax({url:"<?php echo BASE_URL?>/studies/usergroup_dnq?usergroupp="+usergroupId,cache:false,success:function(result){

  		$("#usergroup_dnq_table").html(result);
  	}});
  	
  	
  });  
//end of DNQ tab

//for schedule on iaa schedule  tab
   $('.iaa_schedule').click(function(){
  	
  	var studyId =$(this).attr('data-id');
  
  	$.ajax({url:"<?php echo BASE_URL?>/studies/iaa_schedules?studyId="+studyId,cache:false,success:function(result){
  		$("#schedual_table").html(result);
  	}});

  }); 
  
  //on page load  schedule on iaa schedule  tab
 $(document).ready(function() {
  	
  	var studyId =$(".iaa_schedule").attr('data-id');
  
  	$.ajax({url:"<?php echo BASE_URL?>/studies/iaa_schedules?studyId="+studyId,cache:false,success:function(result){
  		$("#schedual_table").html(result);
  	}});

  }); 


//for schedule on partcipant tracker tab
   $('.participant_tracker').click(function(){
  	
  	var studyId =$(this).attr('data-id');
  
  	$.ajax({url:"<?php echo BASE_URL?>/studies/partcipant_tracker?studyId="+studyId,cache:false,success:function(result){
  		$("#schedual_table").html(result);
  	}});

  });


    //model for add screen question in user group
    $('#add_screen_question').click(function(){
    	var allgroupIds = []
    	$(".usergroup").each(function ()
    	{
    		allgroupIds.push(parseInt($(this).attr('data-id')));
    	});
    	
    	var groupId = '';
    	groupId = $("#groupid").text();
    	var studyId = '';
    	studyId = $("#studyid").text();
    	
    	$.ajax({url:"<?php echo BASE_URL?>/studies/screener_questions?allgroups="+allgroupIds+"&onegroup="+groupId+"&study_id="+studyId,cache:false,success:function(result){

    		$(".modal-content-study").html(result);
    	}});
    });

   //model for remove screen question in specific user group
    $('#remove_screen_question').click(function(){
    	var groupId = '';
    	groupId = $("#groupid").text();
    	var studyId = '';
    	studyId = $("#studyid").text();
    	
    	$.ajax({url:"<?php echo BASE_URL?>/studies/remove_screener_questions?onegroup="+groupId+"&study_id="+studyId,cache:false,success:function(result){

    		$(".modal-content-study").html(result);
    	}});
    });
 //model for create screen question
 $('#create_screen_question').click(function(){
 	var studyId = '';
 	studyId = $("#studyid").text();
 	
 	$.ajax({url:"<?php echo BASE_URL?>/questions/add_question?study_id="+studyId,cache:false,success:function(result){

 		$(".modal-content-study").html(result);
 	}});
 });
 
    //model for create new participant
    $('#new_participant').click(function(){
    
        var groupId = '';
    	groupId = $("#groupid").text();
    	var studyId = '';
    	studyId = $("#studyid").text();
       
    	$.ajax({url:"<?php echo BASE_URL?>/participants/add_participant?study_id="+studyId+"&onegroup="+groupId,cache:false,success:function(result){

    		$(".modal-content-study").html(result);
    	}});
    });


    function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
        var b = document.getElementById(elementId).innerHTML;
        window.frames["print_frame"].document.title = document.title;
        window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }



   /* $(document).ready(function() {
  $("#btnExport").click(function(e) {
    e.preventDefault();

    //getting data from our table
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById('table_wrapper');
    var table_html = table_div.outerHTML.replace(/ /g, '%20');

    var a = document.createElement('a');
    a.href = data_type + ', ' + table_html;
    a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
    a.click();
  });
});*/

    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        // CSV file
        csvFile = new Blob([csv], {type: "text/csv"});

        // Download link
        downloadLink = document.createElement("a");

        // File name
        downloadLink.download = filename;

        // Create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);

        // Hide download link
        downloadLink.style.display = "none";

        // Add the link to DOM
        document.body.appendChild(downloadLink);

        // Click download link
        downloadLink.click();
    }

    function exportTableToCSV(filename) {
        $(".statuss").css("display" , "block");
         $(".particpnatt").css("display" , "block");
        
        var csv = [];
        var rows = document.getElementById("exportprintDiv").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) 
                row.push(cols[j].innerText);

            csv.push(row.join(","));        
        }
        $(".statuss").css("display" , "none");
        $(".particpnatt").css("display" , "none");
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }

    function exportTableToCSVDNQ(filename) {
        $(".statuss").css("display" , "block");
         $(".particpnatt").css("display" , "block");
        
        var csv = [];
        var rows = document.getElementById("exportprintDnq").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) 
                row.push(cols[j].innerText);

            csv.push(row.join(","));        
        }
        $(".statuss").css("display" , "none");
        $(".particpnatt").css("display" , "none");
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }

     function exportScheduleTableToCSV(filename) {
        $(".schedule-export").css("display" , "block");
        // $(".particpnatt").css("display" , "block");
        
        var csv = [];
        var rows = document.getElementById("scheduleexportprintDiv").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) 
                row.push(cols[j].innerText);

            csv.push(row.join(","));        
        }
       // $(".statuss").css("display" , "none");
       // $(".particpnatt").css("display" , "none");
        $(".schedule-export").css("display" , "none");
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    
    function exportDemographicTableToCSV(filename) {
        //$(".schedule-export").css("display" , "block");
        // $(".particpnatt").css("display" , "block");
        
        var csv = [];
        var rows = document.getElementById("demographicexportprintDiv").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++) 
                row.push(cols[j].innerText);

            csv.push(row.join(","));        
        }
       // $(".statuss").css("display" , "none");
       // $(".particpnatt").css("display" , "none");
       // $(".schedule-export").css("display" , "none");
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    
    
    function exportParticipantTableToCSV(filename) {
       //$(".schedule-export").css("display" , "block");
       // $(".particpnatt").css("display" , "block");

       var csv = [];
       var rows = document.getElementById("participantcsvDiv").querySelectorAll("table tr");

       for (var i = 0; i < rows.length; i++) {
           var row = [], cols = rows[i].querySelectorAll("td, th");

           for (var j = 0; j < cols.length; j++) 
               row.push(cols[j].innerText);

           csv.push(row.join(","));        
       }
      // $(".statuss").css("display" , "none");
      // $(".particpnatt").css("display" , "none");
       //$(".schedule-export").css("display" , "none");
       // Download CSV file
       downloadCSV(csv.join("\n"), filename);
    } 
    
    function exportContactsTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("contactstable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete')
                row.push(cols[j].innerText);
                
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    
    function exportClientsTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("clientstable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete')
                row.push(cols[j].innerText);
                
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    
    function exportEthnicityTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("ethnicitytable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete')
                row.push(cols[j].innerText);
                
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    
    
    function exportGenderTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("gendertable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete')
                row.push(cols[j].innerText);
                
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    
    
    function exportLocationTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("locationtable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete'){
                    
                    var str=cols[j].innerText;
                    var str2=   str.replace(",", "");
                    row.push(str2);
                
                }
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    
    function exportMedicalTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("medicaltable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete'){
                    
                    var str=cols[j].innerText;
                    var str2=   str.replace(",", "");
                    row.push(str2);
                
                }
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    
    function exportOccupationTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("occupationtable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete'){
                    
                    var str=cols[j].innerText;
                    var str2=   str.replace(",", "");
                    row.push(str2);
                
                }
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }
    function exportClassificationTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("classificationtable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete'){
                    
                    var str=cols[j].innerText;
                    var str2=   str.replace(",", "");
                    row.push(str2);
                
                }
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    
    
    function exportProductTypeTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("producttypetable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete'){
                    
                    var str=cols[j].innerText;
                    var str2=   str.replace(",", "");
                    row.push(str2);
                
                }
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    }
    
    function exportStudyTypeTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("studytypetable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete'){
                    
                    var str=cols[j].innerText;
                    var str2=   str.replace(",", "");
                    row.push(str2);
                
                }
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    function exportQuestionTableToCSV(filename) 
    {
        var csv = [];
        var rows = document.getElementById("quesiontable").querySelectorAll("table tr");

        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");

            for (var j = 0; j < cols.length; j++)
            {
                if(cols[j].innerText != 'Edit' && cols[j].innerText != 'Delete'){
                    
                    var str=cols[j].innerText;
                    var str2=   str.replace(",", "");
                    row.push(str2);
                
                }
            }        
            csv.push(row.join(","));        
        }
        // Download CSV file
        downloadCSV(csv.join("\n"), filename);
    } 
    </script>
    
</body>
</html>