<style>
    .clear-dev{
          height: 35px;
    }
    .clear-dev-field{
          height: 15px;
    }    
</style>

<div class="page-content">
<div class="row">
<div class="col-md-2">
      <?php $this->load->view('includes/leftbar'); ?>
</div>
<div class="col-md-10">

      <!--<div class="content-box-large">-->
      <div class="panel panel-default" id="headings">
          <div class="panel-heading"><h3>Search - Participants</h3></div>
             
              <!-- START Main Content -->
        <div class="panel-body">

            

                  <!--Search Section-->
                <?php //echo form_open('admin/orders/search', ' method="GET"'); 
                    //echo form_open('studies', ' method="GET"'); 
                ?>
                   
             <div class="col-md-6"> 
                                  <div class="panel-body">
                                      
                                      <input type="hidden" id="select_screen_question" class="form-control" value="" readonly>  
                                        
                                        
                                        <div class="form-group">
                                            <div class="col-sm-1">
                                             <a class="deleter" href="javascript:void(0);">x</a>                                                             
                                             </div>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" value="Medical Conditions" readonly>                                                                
                                            </div>
                                           <div class="col-sm-6"> 
                                               <select class="form-control multi-select" id="medical_condition" name="medical_condition[]" multiple="multiple">                                                           
                                                <?php         
                                                    foreach($medical_condition_rec as $row) {
                                                   ?>
                                                   <option value="<?php echo $row['id']; ?>"  ><?php echo $row['medical_condition']; ?></option>
                                                <?php }  ?>   
                                               </select>
                                           </div>
                                            <div class="clear-dev"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-1">
                                            <a class="deleter" href="javascript:void(0);">x</a>                                                             
                                             </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" value="General" readonly>                                                                
                                            </div>
                                           <div class="col-sm-6"> 
                                               <select class="form-control multi-select" id="general" name="general[]" multiple="multiple">                                                           
                                                <?php         
                                                    foreach($user_groups_rec as $row) {
                                                 ?>
                                                   <option value="<?php echo $row['id']; ?>"  ><?php echo $row['group_name']; ?></option>
                                                <?php }  ?>   
                                               </select>
                                           </div>
                                              <div class="clear-dev"></div>
                                        </div>
                                      
                                         <div class="form-group">
                                            <div class="col-sm-1">
                                             <a class="deleter" href="javascript:void(0);">x</a>                                                               
                                             </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" value="Occupations" readonly>                                                                
                                            </div>
                                           <div class="col-sm-6"> 
                                               <select class="form-control multi-select" id="occupation" name="occupation[]" multiple="multiple">                                                           
                                                <?php         
                                                    foreach($occupation_rec as $row) {
                                                ?>
                                                   <option value="<?php echo $row['id']; ?>"  ><?php echo $row['occupation']; ?></option>
                                                <?php }  ?>   
                                               </select>
                                           </div>
                                              <div class="clear-dev"></div>
                                        </div>
                                       
                                         <div class="form-group">
                                            <div class="col-sm-1">
                                             <a class="deleter" href="javascript:void(0);">x</a>                                                               
                                             </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" value="Gender" readonly>                                                                
                                            </div>
                                           <div class="col-sm-6"> 
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="" >Select Gender</option>
                                                    <?php         
                                                        foreach($gender_rec as $row) {

                                                             if ($row['gender_id'] == $gender)
                                                                 $sel = 'selected';
                                                             else
                                                                 $sel = '';

                                                    ?>
                                                    <option value="<?php echo $row['gender_id']; ?>" <?php echo $sel;?>><?php echo $row['gender']; ?></option>
                                                    <?php }  ?>   
                                               </select>
                                           </div>
                                             <div class="clear-dev"></div>
                                        </div>
                                        
                                         <div class="form-group">
                                            <div class="col-sm-1">
                                             <a class="deleter" href="javascript:void(0);">x</a>                                                                
                                             </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" value="Age Range" readonly>                                                                
                                            </div>
                                           <div class="col-sm-2"> 
                                               <input type="text" name="minage" id="minage" class="form-control" value="" placeholder="min" >  
                                           </div>
                                           <div class="col-sm-1"> 
                                               to 
                                           </div>
                                             <div class="col-sm-2"> 
                                                 <input type="text" name="maxage" id="maxage" class="form-control" value="" placeholder="max" >  
                                           </div>
                                              <div class="clear-dev"></div>
                                        </div>
                                        
                                       
                                         <div class="form-group">
                                            <div class="col-sm-1">
                                             <a class="deleter" href="javascript:void(0);">x</a>                                                               
                                             </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" value="Education" readonly>                                                                
                                            </div>
                                           <div class="col-sm-6"> 
                                               <select name="edu_level" id="edulevel" class="form-control">
                                                   <option value="" >Select Education Level</option>
                                                <?php         
                                                    foreach($edu_level_rec as $row) {
                                                        if ($row['id'] == $edu_lvl)
                                                             $sel = 'selected';
                                                         else
                                                             $sel = '';
                                                ?>
                                                <option value="<?php echo $row['id']; ?>" <?php echo $sel;?> ><?php echo $row['education_level']; ?></option>
                                                <?php }  ?>   
                                               </select>
                                           </div>
                                             <div class="clear-dev"></div>
                                        </div>
                                        
                                         <div class="form-group">
                                            <div class="col-sm-1">
                                            <!-- <a class="deleter" href="javascript:void(0);">x</a> -->                                                             
                                             </div>
                                            <div class="col-sm-5">
                                            <input type="text" class="form-control" value="Screener Question" readonly>                                                                
                                            </div>
                                           <div class="col-sm-6"> 
                                               <a href="javascript:void(0)"  onclick="document.getElementById('screenquestion').style.display='block';">Select Question </a>
                                           </div>
                                              <div class="clear-dev"></div>
                                        </div>
                                      
                                        <!--Additional FIeld-->
                                        <div class="ParticipantSearchField" ></div>
                                      
                                       
                                        <div class="clear-dev"></div>
                                         <div class="form-group">
                                            <div class="col-sm-1">
                                                                                                     
                                             </div>
                                            <div class="col-sm-3">
                                            
                                            <!--<a href="#myModal" data-toggle="modal" data-target="#myModal" id="" class="btn btn-primary addSearchFields">Add Field</a>-->
                                            <a href="javascript:void(0)" class="btn btn-primary" onclick="document.getElementById('searchfields').style.display='block';">Add Field</a>
                                            
                                            </div>
                                           <div class="col-sm-6"> 
                                                
                                           </div>
                                              <div class="clear-dev"></div>
                                        </div>
                                        
                                       
                                        <div class="clear-dev"></div>
                                         <div class="form-group">
                                            <div class="col-sm-1">
                                                                                                     
                                             </div>
                                            <div class="col-sm-5">
                                            <input type="button" class="form-control btn-primary" onclick="location.href='<?php echo site_url("participants/search"); ?>'"  value="Reset Fields">
                                           </div>
                                           <div class="col-sm-5"> 
                                                <input type="button" class="form-control btn-primary submit-search-data"  value="Submit Search">   
                                           </div>
                                        </div>

                                   </div>
                       
                           </div>

                <?php //echo form_close(); ?>
                <!--ENd Search Section-->
                
        </div>
<div id="searh-result"></div>
      </div>

</div>
    
 
    
</div>
</div>




<style>
.white_content {
    display: none;
    position: fixed;
    top: 20%;
    left: 40%;
    z-index: 1002;
  
}    

button.close {
    margin-top: 20px;
    margin-right: 20px;
}

.close1 {
   position: relative;
    top: -28px;
    left: 435px;
}


    
</style>
<!--add fields for search-->
<div class="col-md-4 white_content"  id="searchfields">    	
<div class="panel panel-default ">
          <div class="panel-heading"><h3>Select Search Fields</h3> 
              <a href="javascript:void(0)" class="close1" onclick="document.getElementById('searchfields').style.display='none';">X</a></div>
             
              <!-- START Main Content -->
        <div class="panel-body">

            

                  <!--Search Section-->
                <?php //echo form_open('admin/orders/search', ' method="GET"'); 
                    //echo form_open('studies', ' method="GET"'); 
                ?>
                   
             <div class="col-md-12"> 
                                  <div class="panel-body">
                                      
                                      
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="" value="1"> Ethnicity                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                         <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="" value="2"> Employer                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                         <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="" value="3"> City                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                       <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="" value="4"> Zip                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                       <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="" value="5"> Transportation                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                       <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="" value="6"> ESL                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                      <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="participant_id" value="7"> Need Wheelchair                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                      <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="participant_id" value="8"> Deceased                                                           
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                      <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="participant_id" value="9"> Do Not Call                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                      <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="participant_id" value="10"> Do Not Email                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                      <div class="form-group">
                                            <div class="col-sm-12">
                                             <input type="checkbox" name="participant_search[]" class="participnats" id="participant_id" value="11"> IAA Classification                                                            
                                             </div>
                                            <div class="clear-dev-field"></div>
                                        </div>
                                      
                                        <div class="clear-dev-field"></div>
                                         <div class="form-group">
                                            <div class="col-sm-1">
                                                                                                     
                                             </div>
                                            <div class="col-sm-5">
                                            <input type="button" class="form-control btn-primary add_field_btn"  value="Add">                                                                
                                            </div>
                                          
                                        </div>

                                   </div>
                       
                           </div>

                <?php //echo form_close(); ?>
                <!--ENd Search Section-->

        </div>

      </div> 
</div>

<!--screen question-->

<div class="col-md-6 white_content"  id="screenquestion"> 
    <div class="panel panel-default" id="headings" >
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><a href="javascript:void(0)" onclick="document.getElementById('screenquestion').style.display='none';">×</a></span><span class="sr-only">Close</span></button>

                <div class="panel-heading"><h3>Select Screener Questions</h3></div>


                    <!-- START Main Content -->
            <div class="panel-body">

             


            <table class="table table-striped table-bordered dataTable" id="example2" name="study">
                <thead>
                        <tr>
                            <th></th>
                                <th>Question</th>

                        </tr>
                </thead>

                <tbody>
                <?php 	foreach ($records as $row)
                                {


                                        echo '<tr>';
                                        echo '<td><input type="checkbox" name="questions_ids[]" id="questions_ids" class="questions"  value="'.$row['id'].'" ></td>';
                                        echo '<td>'.$row['question'].'</td>';

                                    echo '</tr>';
                                }
                ?>
                </tbody>
            </table>

             <div class="form-group">
                <div class="col-sm-offset-1 col-sm-12">
                    <button type="reset" class="btn btn-primary" id="add_screener_question" >Add</button>			
                 
                </div>
              </div>             
                                
                    </div>

            </div>
</div>


<script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
    
    $(document).ready(function() {     
        $('#add_screener_question').click(function(){

            var checked = []
            $("input[name='questions_ids[]']:checked").each(function ()
            {
                 checked.push(parseInt($(this).val()));
            });

            $("#select_screen_question").val(checked);
            document.getElementById('screenquestion').style.display='none';
        });
        
        
        
        $(document).on('click','.submit-search-data',function(){

            var info = '';
                info += 'select_screen_question='+$('#select_screen_question').val();
                info += '&medical_condition='+$('#medical_condition').val();
                info += '&general='+$('#general').val();
                info += '&occupation='+$('#occupation').val();
                info += '&gender='+$('#gender').val();
                info += '&minage='+$('#minage').val();
                info += '&maxage='+$('#maxage').val();
                info += '&edulevel='+$('#edulevel').val();
                info += '&ethnicity='+$('#ethnicity').val();
                info += '&employer='+$('#employer').val();
                info += '&city='+$('#city').val();
                info += '&zip='+$('#zip').val();
                info += '&transport='+$('#transport').val();
                info += '&esl='+$('#esl').val();
                info += '&need_wheelchair='+$('#need_wheelchair').val();
                
                
                
                if($('#deceased').is(':checked'))
                info += '&deceased='+$('#deceased').val();
                else
                info += '&deceased='+'';   
            
                if($('#do_not_call').is(':checked'))
                info += '&do_not_call='+$('#do_not_call').val();
                else
                info += '&do_not_call='+''; 
                
                if($('#do_not_email').is(':checked'))
                info += '&do_not_email='+$('#do_not_email').val();
                else
                info += '&do_not_email='+''; 
                
               
                
                
                
                info += '&participant_classfication='+$('#participant_classfication').val();
            
              
            //alert(info);

                $.ajax({
                    type:'POST',
                    url:'<?php echo site_url('participants/search_record'); ?>',
                    data:info,
                    success:function(result){
                        $("#searh-result").html(result);
                }});
           
        });
        
  
    }); //end fo document.ready function  
    
    
   


</script>