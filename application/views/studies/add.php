<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
    
    .multiselect-selected-text{
        word-wrap: break-word;
        width: 150px;
        white-space: pre-wrap;
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
                           <div class="panel-heading"><h3>Add Study</h3></div>
				
  				<div class="panel-body">
				
					<!-- Flash Message -->
                                        <legend>
                                            <?php if($this->session->flashdata('success') === TRUE) { ?>
                                            <div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><?php echo $this->session->flashdata('msg');?></div>
                                            <?php } ?>

                                            <?php if($this->session->flashdata('success') === FALSE) { ?>
                                            <div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><?php echo $this->session->flashdata('msg');?></div>
                                            <?php } ?>
                                        </legend>
                                        
                                 
                        <?php
                          //form data
                          $attributes = array('class' => 'form-horizontal', 'id' => 'addeditstudy' , 'enctype' => 'multipart/form-data' ,'onkeypress'=> 'return event.keyCode != 13;');

                          //form validation
                          echo validation_errors();

                          echo form_open('studies/add', $attributes);
                          ?>
                            <div class="col-md-6"> 
                                  <div class="panel-body">
                                      <div class="form-group ">
                                          <label for="gender" class="col-sm-4 control-label">Study No</label>
                                           <div class="col-sm-4"> 
                                          <?php  
                                               $study_number_default  =  date("Y").$max_study_id;
                                          ?>
                                             <?php if($study_number_manual == '') { $study_number_manual = set_value('study_number_manual');} ?>  
                                               
                                             <input type="text" class="form-control" value="<?php echo $study_number_manual; ?>" name="study_number_manual" id="study_number_manual"> 
                                            <input type="hidden" class="form-control" value="<?php echo $study_number_default;?>" name="study_number_default" id="study_number_default"> 
                                            <input type="hidden" value="<?php echo $max_study_id;?>" name="study_number" id="study_number">
                                           </div>
                                       </div>
                                         <div class="form-group ">
                                          <label for="gender" class="col-sm-4 control-label form-groupp required">Client</label>
                                           <div class="col-sm-7"> 
                                          <select name="client_id" id="client_id" class="form-control ">
                                              <option value="">Select Client</option>
                                            <?php         
                                                foreach($clients_rec as $row) {

                                                     if ($row['client_id'] == $client_id)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                                
                                            ?>
                                            <option value="<?php echo $row['client_id']; ?>" <?php echo $sel;?>><?php echo $row['client_name']; ?></option>
                                            <?php  }  ?> 
                                                <option value="other">Other</option>
                                           </select>
                                               <br>
                                               <div id="additional_client" style="display:none;">
                                                  
                                                    <input type="text" class="form-control" placeholder="Enter client name..." value="<?php echo set_value('client_id_other'); ?>" id="client_id_other" name="client_id_other" >
                                            </div> 
                                           </div>
                                       </div>

                                         <div class="form-group">
                                         <label for="middlename" class="col-sm-4 control-label form-groupp required">Product Name</label>
                                         <div class="col-sm-7">
                                             <select name="product_name" id="product_name" class="form-control">
                                                <?php         
                                                    foreach($products_rec as $row) {

                                                         if ($row['product_id'] == $product_name)
                                                             $sel = 'selected';
                                                         else
                                                             $sel = '';

                                                ?>
                                            <option value="<?php echo $row['product_id']; ?>" <?php echo $sel;?>><?php echo $row['product_name']; ?></option>
                                            <?php  }  ?>
                                             <option value="other">Other</option>
                                           </select> 
                                             <br>
                                             <div id="additional_product" style="display:none;" >
                                                    <input type="text" class="form-control" placeholder="Enter product name..." value="<?php echo set_value('product_name_other'); ?>" id="product_name_other" name="product_name_other" >
                                            </div> 
                                         </div>
                                       </div>
                                      
                                        <div class="form-group ">
                                          <label for="gender" class="col-sm-4 control-label">Product Type</label>
                                           <div class="col-sm-6"> 
                                          <select name="product_type" id="product_type" class="form-control">
                                            <?php         
                                                foreach($products_type_rec as $row) {

                                                     if ($row['id'] == $product_type)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                                
                                            ?>
                                            <option value="<?php echo $row['id']; ?>" <?php echo $sel;?>><?php echo $row['product_type']; ?></option>
                                            <?php  }  ?> 
                                            <option value="other">Other</option>
                                           </select>
                                            <br>
                                            <div id="additional_product_type" style="display:none;">
                                                  
                                                    <input type="text" class="form-control" placeholder="Enter product Type..." value="<?php echo set_value('product_type_other'); ?>" id="product_type_other" name="product_type_other" >
                                            </div> 
                                           </div>
                                       </div>

                                        <div class="form-group ">
                                          <label for="study_type" class="col-sm-4 control-label">Study Type</label>
                                           <div class="col-sm-6"> 
                                          <select name="study_type" id="study_type" class="form-control">
                                            <?php         
                                                foreach($study_type_rec as $row) {
                                                
                                                     if ($row['id'] == $study_type)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                                
                                            ?>
                                            <option value="<?php echo $row['id']; ?>" <?php echo $sel;?>><?php echo $row['study_type']; ?></option>
                                            <?php  }  ?>   
                                           </select>
                                           </div>
                                       </div>
                                        
                                       <div class="form-group">
                                         <label for="lastname" class="col-sm-4 control-label">Number of User Groups</label>
                                         <div class="col-sm-3">
                                            <input type="number" class="form-control" id="current_user_group_no" name="user_group_no" value="<?php echo $number_of_usergroups; ?>" min="1"> 
                                              <input type="hidden" class="form-control" id="previous_user_group_no" name="temp_user_group_no" value="<?php echo $number_of_usergroups; ?>">                                                             
                                         </div>
                                       </div>

                                    


                                   </div>
                       
                           </div> 
                           
                            <div class="col-md-6"> 
                                  <div class="panel-body">
                                         <div class="form-group ">
                                          <label for="status" class="col-sm-4 control-label">Status</label>
                                           <div class="col-sm-4"> 
                                          <select name="study_status" id="status" class="form-control">
                                            <?php         
                                                foreach($study_status_rec as $row) {

                                                     if ($row['id'] == $study_status)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                                
                                            ?>
                                            <option value="<?php echo $row['id']; ?>" <?php echo $sel;?>><?php echo $row['status_name']; ?></option>
                                            <?php  }  ?>   
                                           </select>
                                           </div>
                                       </div>
                                      <div class="form-group ">
                                          <label for="focus_vision" class="col-sm-4 control-label">Focus Vision</label>
                                           <div class="col-sm-4"> 
                                          <select name="focus_vision" id="focus_vision" class="form-control">
                                              <option value="" selected>Select Focus Vision</option>
                                            <?php 
                                            
                                                $focus_rec = array('2'=>'Yes' , '1'=>'No');
                                                foreach($focus_rec as $key=>$val) {

                                                     if ($key == $focus_vision)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                                
                                            ?>
                                            <option value="<?php echo $key; ?>" <?php echo $sel;?>><?php echo $val; ?></option>
                                            <?php  }  ?>   
                                           </select>
                                           </div>
                                       </div>

                                      
                                        <div class="form-group ">
                                          <label for="recruiter" class="col-sm-4 control-label">Recruiter</label>
                                           <div class="col-sm-6"> 
                                          <select name="recruiter" id="recruiter" class="form-control">
                                            <option value="" selected>Select Recruiter </option>
                                            <?php         
                                                foreach($recruiter_rec as $row) {

                                                     if ($row['user_id'] == $recruiter)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                                
                                            ?>
                                            <option value="<?php echo $row['user_id']; ?>" <?php echo $sel;?>><?php echo $row['first_name']. ' '.$row['last_name'] ; ?></option>
                                            <?php  }  ?>   
                                           </select>
                                           </div>
                                       </div>
                                      <div class="form-group ">
                                          <label for="gender" class="col-sm-4 control-label">Lead</label>
                                           <div class="col-sm-6"> 
                                          <select name="lead" id="lead" class="form-control">
                                              <option value="" selected>Select lead </option>
                                            <?php         
                                                foreach($lead_rec as $row) {

                                                     if ($row['user_id'] == $lead)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                               
                                            ?>
                                            <option value="<?php echo $row['user_id']; ?>" <?php echo $sel;?>><?php echo $row['first_name']. ' '.$row['last_name'] ; ?></option>
                                            <?php  }  ?>   
                                           </select>
                                           </div>
                                       </div>
                                      <div class="form-group ">
                                          <label for="gender" class="col-sm-4 control-label">Datalogger</label>
                                           <div class="col-sm-6"> 
                                          <select name="datalogger" id="datalogger" class="form-control">
                                               <option value="" selected>Select Datalogger </option>
                                            <?php         
                                                foreach($datalogger_rec as $row) {

                                                     if ($row['user_id'] == $datalogger)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                                
                                            ?>
                                            <option value="<?php echo $row['user_id']; ?>" <?php echo $sel;?>><?php echo $row['first_name']. ' '.$row['last_name'] ; ?></option>
                                            <?php  }  ?>   
                                           </select>
                                           </div>
                                       </div>
                                      <div class="form-group ">
                                          <label for="av" class="col-sm-4 control-label">AV</label>
                                           <div class="col-sm-6"> 
                                          <select name="av" id="av" class="form-control">
                                               <option value="" selected>Select AV </option>
                                            <?php         
                                               foreach($av_rec as $row) {

                                                      if ($row['user_id'] == $av)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                                
                                            ?>
                                            <option value="<?php echo $row['user_id']; ?>" <?php echo $sel;?>><?php echo $row['first_name']. ' '.$row['last_name'] ; ?></option>
                                            <?php  }  ?>   
                                           </select>
                                           </div>
                                       </div>
                                       

                                   </div>
                       
                           </div> 
                                        
                            <div class="col-md-12">  
                                  <div class="panel-body">
                                       <div class="form-group">
                                          <div class="input_fields_wrap"> 
                                               <?php $total_participant = 0; 
                                               
                                               //echo '<pre>';
                                               //print_r($user_groups_autosave);
                                               
                                               
                                               if (!empty($user_groups_autosave)) { 
                                                   $j =1; 
                                                    
                                                 for($i = 0; $i<count($user_groups_autosave) ; $i++) { 
                                                      
                                                      $total_participant += $user_groups_autosave[$i]['number_of_participants'];
                                                      
                                                      ?>
                                              
                                              
                                              
                                                    <div class="row">
                                                           <div class="form-group ugroupp" id="usergroupp<?php echo $user_groups_autosave[$i]['id']; ?>">
                                                                <label for="focus_vision" class="col-sm-2 control-label">User Group <?php echo $j; ?></label>
                                                                 <div class="col-sm-2" style="width:150px;">
                                                                 <input type="hidden" name="user_group_id[]" id="user_group_id_<?php echo $j; ?>" value="<?php echo $user_groups_autosave[$i]['id']; ?>">
                                                                 <select name="user_group[]" id="user_group" class="form-control user_group_select">
                                                                
                                                                  <?php  
                                                               
                                                                      foreach($user_group_rec as $row) {
                                                                        
                                                                          if ($row['id'] == $user_groups_autosave[$i]['user_group'])
                                                                              $sel = 'selected';
                                                                          else
                                                                              $sel = '';
                                                                          
                                                                  ?>
                                                                  <option value="<?php echo $row['id']; ?>" <?php echo $sel;?>><?php echo $row['group_name']; ?></option>
                                                                  <?php  }  ?>   
                                                                 </select>
                                                                 </div>
                                                                <div class="col-sm-1">
                                                                    <input type="text" class="form-control participant_no" id="participant_no" name="participant_no[]" value="<?php echo $user_groups_autosave[$i]['number_of_participants'];?>" >                                                               
                                                               </div>
                                                                <div class="col-sm-1">
                                                                    <span style="float: left; margin-right: 5px; margin-top: 7px;">$</span>
                                                                    <input type="text" class="form-control" id="payment_amount" name="payment_amount[]" placeholder="0" style="width: 50px;" value="<?php echo $user_groups_autosave[$i]['payment_amount'];?>" >                                                               
                                                               </div>
                                                                 
                                                                <div class="col-sm-2" style="width:150px;"> 
                                                                   <select name="training[]" id="status" class="form-control">
                                                                       <option value="1" <?php if($user_groups_autosave[$i]['training'] == '1'){?> selected<?php } ?>>Trained</option>
                                                                        <option value="2" <?php if($user_groups_autosave[$i]['training'] == '2'){?> selected<?php } ?> >Untrained</option>
                                                                            <option value="3" <?php if($user_groups_autosave[$i]['training'] == '3'){?> selected<?php } ?>>N/A</option>
                                                                  </select> 
                                                                 </div>
                                                                
                                                                <div class="col-sm-2" style="width:150px;"> 
                                                                <select name="session_order[]" id="session_order" class="form-control session_orders">
                                                                    <option value="1_<?php echo $j;?>" <?php if($user_groups_autosave[$i]['number_of_sessions'].'_'.$j== '1_'.$j){?> selected<?php } ?>>1 Session</option>
                                                                        <option value="2_<?php echo $j;?>" <?php if($user_groups_autosave[$i]['number_of_sessions'].'_'.$j == '2_'.$j){?> selected<?php } ?>>2 Sessions</option>
                                                                            <option value="3_<?php echo $j;?>" <?php if($user_groups_autosave[$i]['number_of_sessions'].'_'.$j == '3_'.$j){?> selected<?php } ?>>3 Sessions</option>
                                                                             <option value="4_<?php echo $j;?>" <?php if($user_groups_autosave[$i]['number_of_sessions'].'_'.$j == '4_'.$j){?> selected<?php } ?>>4 Sessions</option>
                                                                  </select>
                                                                 </div>
                                                                 <div class="session_time_wrap<?php echo $j;?>">
                                                                    
                                                                    <?php 
                                                                    $sess_order =  $user_groups_autosave[$i]['session_order'];
                                                                    $sess_time =  $user_groups_autosave[$i]['session_time'];
                                                                    
                                                                    $sess_val = explode(',', $sess_time);
                                                                    for($k = 0; $k<count($sess_val);$k++)
                                                                    {
                                                                    ?>
                                                                     <div class="col-sm-1" style="width: 80px;" >
                                                                         <input type="text" class="form-control" id="session_time" name="sessiontime_<?php echo $sess_order.'_'.$j;?>[]" value="<?php echo $sess_val[$k];?>" placeholder="min" >                                                               
                                                                      </div>  
                                                                     
                                                                    <?php } ?>
                                                               </div>
                                                                
                                                                 <a class="delete_class_old" data-id="<?php echo $user_groups_autosave[$i]['id']; ?>" ><span class="fa fa-remove"></span></a>
                                                            </div>
                                                    </div> 
                                              
                                              <?php  $j++; } 

                                                  } else {?>
                                              
                                               <div class="row">
                                                           <div class="form-group ugroupp" id="usergroupp1">
                                                                <label for="focus_vision" class="col-sm-2 control-label">User Group 1</label>
                                                                 <div class="col-sm-2" style="width:150px;"> 
                                                                 <input type="hidden" name="user_group_id[]" id="user_group_id_1" value="0000">  
                                                                <select name="user_group[]" id="user_group" class="form-control">
                                                                  <?php         
                                                                      foreach($user_group_rec as $row) {
                                                                  ?>
                                                                  <option value="<?php echo $row['id']; ?>"><?php echo $row['group_name']; ?></option>
                                                                  <?php  }  ?>   
                                                                 </select>
                                                                 </div>
                                                                <div class="col-sm-1">
                                                                    <input type="text" class="form-control participant_no" id="participant_no" name="participant_no[]" value="0" >                                                               
                                                               </div>
                                                                
                                                                <div class="col-sm-1">
                                                                    <span style="float: left; margin-right: 5px; margin-top: 7px;">$</span>
                                                                    <input type="text" class="form-control" id="payment_amount" name="payment_amount[]" placeholder="0" value="0" style="width: 50px;">                                                               
                                                               </div>
                                                                 
                                                                <div class="col-sm-2" style="width:150px;"> 
                                                                   <select name="training[]" id="status" class="form-control">
                                                                       <option value="1">Trained</option>
                                                                        <option value="2" >Untrained</option>
                                                                        <option value="3" selected="selected">N/A</option>
                                                                  </select> 
                                                                 </div>
                                                                
                                                                <div class="col-sm-2" style="width:150px;"> 
                                                                <select name="session_order[]" id="session_order" class="form-control session_orders">
                                                                       <option value="1_1">1 Session</option>
                                                                        <option value="2_1" >2 Sessions</option>
                                                                            <option value="3_1">3 Sessions</option>
                                                                             <option value="4_1">4 Sessions</option>
                                                                  </select>
                                                                 </div>
                                                                 <div class="session_time_wrap1">
                                                                    <div class="col-sm-1">
                                                                        <input type="text" class="form-control" id="session_time" name="sessiontime_1_1[]" value="0" placeholder="min">                                                               
                                                                   </div>                                                              
                                                               </div>
                                                                <a class="delete_class_new" data-id="1"><span class="fa fa-remove"></span></a>
                                                                
                                                            </div>
                                                    </div> 
                                              
                                                  <?php }?>
                                          </div>
                                           
                                                    <div class="row">
                                                          <div class="form-group ">
                                                                <label for="" class="col-sm-2 control-label">Total Participants</label>
                                                                 <div class="col-sm-1">
                                                                 </div>
                                                                    <div class="col-sm-1">
                                                                        <h4><strong> <span class="total_participant" style="float: right; margin-right: 5px;"><?php echo $total_participant;?></span></strong></h4>                                                          
                                                                   </div>
                                                            </div>
                                                    </div>  
                                           
                                                    <div class="row">
                                                          <div class="form-group ">
                                                                <label for="focus_vision" class="col-sm-2 control-label">Study Dates</label>
                                                               <div class="col-sm-3"> 
                                                               
                                                                 <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="start_date" data-link-format="yyyy-mm-dd">
                                                                        <input class="form-control" name="start_date"  id="start_date"   type="text" value="<?php if($start_date != '0000-00-00'){ echo ($start_date);} ?>" readonly>
                                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                   </div>  
                                                                 </div>
                                                                
                                                                <div class="col-sm-3"> 
                                                                    <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="end_date" data-link-format="yyyy-mm-dd">
                                                                        <input class="form-control" name="end_date"  id="end_date"   type="text" value="<?php if($end_date != '0000-00-00'){ echo ($end_date);} ?>" readonly>
                                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                    </div> 
                                                                 </div>
                                                                
                                                                
                                                            </div>
                                                    </div> 
                                                     <div class="row">
                                                          <div class="form-group ">
                                                                <label for="focus_vision" class="col-sm-2 control-label">Select Location</label>
                                                               <div class="col-sm-3">
                                                                     <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Search.." title="Type in a name">                                                 
                                                                    
                                                                  <div id="" style="overflow-y: scroll; height:200px; border:1px solid #ddd;">
                                                                        <table id="myTable1" class="table table-striped table-bordered" >

                                                                         <?php       
                                                                             foreach($location_rec as $row) {
                                                                         ?>   
                                                                            <tr>
                                                                                <td><input type="checkbox" name="location[]" value="<?php echo $row['location_id']; ?>" <?php if (!empty($location_autosave)) { if(in_array($row['location_id'] , $location_autosave)){echo 'checked="checked"';}} ?>> <?php echo $row['location_name']; ?></td>

                                                                            </tr>
                                                                           <?php }  ?>    

                                                                          </table>    
                                                                        </div>  
                                                                 </div>
                                                                
                                                            </div>
                                                    </div> 
                                                        <div class="row">
                                                            <div class="form-group ">
                                                                <label for="focus_vision" class="col-sm-2 control-label">DNQ</label>
                                                               <div class="col-sm-3"> 
                                                                   <textarea class="form-control" name="study_dnq_notes" placeholder="Textarea" rows="12"><?php echo $study_dnq_notes; ?></textarea>
                                                                </div>
                                                               
                                                                <label for="focus_vision" class="col-sm-2 control-label">Select DNQ Studies</label>
                                                                 <div class="col-sm-3">
                                                                      <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search.." title="Type in a name">                                                 
                                                                    <div id="" style="overflow-y: scroll; height:200px; border:1px solid #ddd;">
                                                                        <table id="myTable" class="table table-striped table-bordered" >

                                                                         <?php       
                                                                             foreach($dnq_study_rec as $row) {
                                                                         ?>   
                                                                            <tr>
                                                                                <td><input type="checkbox" name="dnq_study[]" value="<?php echo $row['study_id']; ?>" <?php if (!empty($study_dnq_autosave)) { if(in_array($row['study_id'] , $study_dnq_autosave)){echo 'checked="checked"';}} ?>> <?php echo $row['study_id'].'-'.$row['client_name'].'-'.$row['product_name'].'-'.$row['study_type']; ?></td>

                                                                            </tr>
                                                                           <?php }  ?>    

                                                                          </table>    
                                                                    </div>  
                                                                 </div>
                                                            </div>
                                                        </div> 
                                                        <div class="row">
                                                            <div class="form-group ">
                                                                <label for="focus_vision" class="col-sm-2 control-label">Study Notes</label>
                                                               <div class="col-sm-8"> 
                                                                 <textarea class="form-control" name="study_notes" placeholder="Textarea" rows="3"><?php echo $study_notes;?></textarea>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="row">
                                                            <div class="form-group ">
                                                                <label for="focus_vision" class="col-sm-2 control-label">Client Contact Info</label>
                                                               <div class="col-sm-8"> 
                                                                   <textarea class="form-control" id="contactinfo" name="contactinfo" placeholder="Textarea" rows="6" readonly  style="white-space: pre-line;" wrap="hard"><?php echo $client_contact_info;?></textarea>
                                                                </div>
                                                            </div>
                                                        </div> 
                                           
                                       </div>

                                      

                                   </div>
                            
                           </div>              
                                        
                                        
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-12">
                               <button type="submit" name="savebtn" value="0" class="btn btn-primary btn-space">Create Study</button>
                                <button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("studies/"); ?>'">Cancel</button>			

                            </div>
                          </div>
                       <?php echo form_close(); ?>       
    
                                        
				</div>

  						
  			</div>
  	</div>
</div>
</div>
 <script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript">

    $(function () {
        setInterval(function () {
            $.post('<?php echo site_url('studies/autosave/'); ?>', $('#addeditstudy').serialize(), function (data) {

                    if(data !== ''){
                        var dataa = $.parseJSON(data);
                        $.each( dataa, function( key, vale ) {
                        //console.log(key + ":" + vale);
                        $('#user_group_id_'+key).val(vale);
                        });
                    }
                
                   
                
                
            });
         }, 10000);

        return false;
    });    
        
        
    $(document).on('input',  '.participant_no', function(){ 
                calculateTotal();
         });
        
    function calculateTotal() {
        var sum = 0;
        $('.participant_no').each(function() {
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
        });

        $(".total_participant").html(sum);
    }   
        
    //$(".delete_class").on("click", function(){ 
        $(document).on('click',  '.delete_class_new', function(){

               var group_id = $(this).attr('data-id');
               var sure = confirm("Are you sure to Delete New?");

               if ( sure ) {
                   $("#usergroupp"+group_id).remove();
                   calculateTotal();
                   var group_num = $( ".ugroupp" ).length;     
                   $("#current_user_group_no").val(group_num);
                   $("#previous_user_group_no").val(group_num);

               }
       });

        //send ajax request to backend server to remove usergroup from db also 
        $(document).on('click',  '.delete_class_old', function(){

               var group_id = $(this).attr('data-id');
               var sure = confirm("Are you sure to Delete?");

               if ( sure ) {
                   $("#usergroupp"+group_id).remove();
                   calculateTotal();
                   var group_num = $( ".ugroupp" ).length;     
                   $("#current_user_group_no").val(group_num);
                   $("#previous_user_group_no").val(group_num);

                       $.post('<?php echo site_url('studies/user_group_autosave_delete/'); ?>', {groupId:group_id}, function(){ 

                               //location.reload();
                       });
               }
       });   
 
    function myFunction() {
       var input, filter, table, tr, td, i;
       input = document.getElementById("myInput");
       filter = input.value.toUpperCase();
       table = document.getElementById("myTable");
       tr = table.getElementsByTagName("tr");
       for (i = 0; i < tr.length; i++) {
         td = tr[i].getElementsByTagName("td")[0];
         if (td) {
           if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
             tr[i].style.display = "";
           } else {
             tr[i].style.display = "none";
           }
         }       
       }
    }
    
    function myFunction1() {
       var input, filter, table, tr, td, i;
       input = document.getElementById("myInput1");
       filter = input.value.toUpperCase();
       table = document.getElementById("myTable1");
       tr = table.getElementsByTagName("tr");
       for (i = 0; i < tr.length; i++) {
         td = tr[i].getElementsByTagName("td")[0];
         if (td) {
           if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
             tr[i].style.display = "";
           } else {
             tr[i].style.display = "none";
           }
         }       
       }
    }
        
 $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    calculateTotal();
    var user_groupp_numm = $( ".ugroupp" ).length; 
    $("#previous_user_group_no").val(user_groupp_numm);
    $("#current_user_group_no").val(user_groupp_numm);
    
    $('#current_user_group_no').on('change',function(e){
      
     e.preventDefault();
     //$(wrapper).empty();
    //$('#user_group_no').keyup(function() {
            var previous_group_val = parseInt($('#previous_user_group_no').val(), 10) || 0;
            var current_group_val  = $(this).val();
           
            if(current_group_val > previous_group_val)
            {
                 if(current_group_val < max_fields){ 
                    $("#previous_user_group_no").val(current_group_val);
                 }
                
                var group_val = current_group_val-previous_group_val;
                if(group_val < max_fields){ //max input box allowed
                  for (i = 1; i <= group_val; i++) { 
                       var group_row = $( ".ugroupp" ).length; 
                      
                       var group_row_num = group_row+1;
                        //alert(group_row_num);
                        $(wrapper).append('<div class="row"><div class="form-group ugroupp" id="usergroupp'+group_row_num+'"><label for="focus_vision" class="col-sm-2 control-label">User Group '+group_row_num+'</label><div class="col-sm-2" style="width:150px;"><input type="hidden" name="user_group_id[]" id="user_group_id_'+group_row_num+'" value="0000"><select name="user_group[]" id="user_group" class="form-control user_group_select"><?php foreach($user_group_rec as $row) { ?><option value="<?php echo $row['id']; ?>"><?php echo $row['group_name']; ?></option><?php  }  ?></select></div><div class="col-sm-1"><input type="text" class="form-control participant_no" id="participant_no" name="participant_no[]" value="0" ></div><div class="col-sm-1"><span style="float: left; margin-right: 5px; margin-top: 7px;">$</span><input type="text" class="form-control" id="payment_amount" name="payment_amount[]" value="0" placeholder="0"  style="width: 50px;" ></div><div class="col-sm-2" style="width:150px;"><select name="training[]" id="status" class="form-control"><option value="1">Trained</option><option value="2" >Untrained</option><option value="3" selected="selected">N/A</option></select></div><div class="col-sm-2" style="width:150px;"><select name="session_order[]" id="session_order" class="form-control session_orders"><option value="1_'+group_row_num+'">1 Session</option><option value="2_'+group_row_num+'" >2 Sessions</option><option value="3_'+group_row_num+'">3 Sessions</option><option value="4_'+group_row_num+'">4 Sessions</option></select></div><div class="session_time_wrap'+group_row_num+'"><div class="col-sm-1" style="width: 80px;"><input type="text" class="form-control" id="session_time" name="sessiontime_1_'+group_row_num+'[]" value="0" placeholder="min" ></div></div> <a class="delete_class_new" data-id="'+group_row_num+'" ><span class="fa fa-remove"></span></a></div></div>');
                  
                    $('.user_group_select').multiselect({
                              enableFiltering: true,
                              includeSelectAllOption: true,
                              enableCaseInsensitiveFiltering: true,
                              maxHeight: 400,
                              dropUp: false
                    });
                  }
                } 
            }else{
                 $("#current_user_group_no").val(previous_group_val);
                 alert("Enter group value must be greater then current group value");
            }    
            
           
        });

     //sessiontime_1_4[] in which (1) is session_no  and (4) group_no
     
     
     
     $(document).on('input',  '.session_orders', function(){
     
        var max_fields      = 5; //maximum input boxes allowed
       //var time_wrapper = $(".session_time_wrap0"); //Fields wrapper
       var sessval = $(this).val();
       var  sess_arr = sessval.split('_');
       var session_order_val = sess_arr[0];
       var group_no = sess_arr[1];
        var time_wrapper = $(".session_time_wrap"+group_no); //Fields wrapper
         time_wrapper.delay( 800 ).empty();
             if(session_order_val < max_fields){ //max input box allowed
                 for (i = 1; i <= session_order_val; i++) { 
                       $(time_wrapper).append(' <div class="col-sm-1" style="width: 80px;"><input type="text" class="form-control" id="session_time" name="sessiontime_'+session_order_val+'_'+group_no+'[]" value="0" placeholder="min" ></div>');
                 }
             }

         });
        
        
       $(document).on('change',  '#start_date', function(){
       
       var study_number_manual = $("#study_number_manual").val();
        var study_number = $("#study_number").val();
        var dateval = $(this).val();
        
        if(study_number_manual == ''){
            var dval = dateval.split('-');
            var overide_snumber = dval[0]+study_number;
             $("#study_number_manual").val(overide_snumber);
        }
        
        
        
       });
       
       
       

        //get clint contact info
         $("#client_id").change(function(){

            if($('#client_id').val() != '')
            {
                var dataString = 'clientId='+ $('#client_id').val();
                $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('studies/clientContactinfo'); ?>",
                  data: dataString,
                  cache: false,
                  success: function(result){
                        $("#contactinfo").empty().append(result);

                  }
                });
            }
         });    


        $('#additional_product').hide();
	$('#product_name').change(function () {
            if ($('#product_name').val() == 'other') {
                $('#additional_product').show();               
            }
            else {
                $('#additional_product').hide();
              
            }
        });
        
        $('#additional_product_type').hide();
	$('#product_type').change(function () {
            if ($('#product_type').val() == 'other') {
                $('#additional_product_type').show();               
            }
            else {
                $('#additional_product_type').hide();
              
            }
        });
        
        
        $('#additional_client').hide();
	$('#client_id').change(function () {
            if ($('#client_id').val() == 'other') {
                $('#additional_client').show();               
            }
            else {
                $('#additional_client').hide();
              
            }
        });
        
        

    });   // document ready function 
    
</script>

