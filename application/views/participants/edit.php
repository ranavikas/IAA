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
    
    


    @media (min-width: 768px) {
      .modal-dialog {
        width: 1180px !important;
        margin: 30px auto;
      }
      .modal-content {
        -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
                box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
      }
      .modal-sm {
        width: 300px;
      }
    }

    button.close {
        margin-top: 20px;
        margin-right: 20px;
    }

    @media (min-width: 768px){
        .col-sm-1-5 {
            width: 10.333333%;
            float: left;
        }
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
                <div class="panel-heading">
					<h5>
					<a href="<?php echo site_url("participants"); ?>" target="_blank" style="color:green;">Participant Database</a>  &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;  
					<a href="<?php echo site_url("participants/add"); ?>" target="_blank">New Participant</a>  &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
					<a href="" target="_blank" style="color:green;">Search Database</a>
					</h5>
				</div>

                           
				<div class="col-md-6">
					<h6><strong>Participant Profile:  <?php echo "$firstname $lastname";?></h6><strong>
					Total Payment: $<?php echo $total_payment;?>
				</div>
				
				<!-- Add To STudy Button -->
                                <a href="#myModal" data-toggle="modal" data-target="#myModal" id="selected_study"  class="btn btn-primary btn-sm editmodalLinkStudy" style="margin-right:30px; margin-top: 20px; float:right;">Add Selected to Study</a>  
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
                                    $attributes = array('class' => 'form-horizontal', 'id' => 'addeditparticipant' , 'enctype' => 'multipart/form-data');

                                    //form validation
                                    echo validation_errors();

                                    echo form_open('participants/update/'.$this->uri->segment(3).'', $attributes);
                            ?>             
                            <input type="hidden" name="participantId" id="participantId" value="<?php echo $this->uri->segment(3);?>">               
                            <div class="col-md-6"> <!--demographic-->
                               <fieldset class="scheduler-border">
                               <legend class="scheduler-border">Demographics</legend>
                                  <div class="panel-body">

                                       <div class="form-group">
                                         <label for="firstname" class="col-sm-2 control-label form-groupp required">First Name</label>
                                         <div class="col-sm-10">
                                             <input type="text" class="form-control" id="firstname" name="fname" value="<?php  echo $firstname; ?>" >                                                                
                                         </div>
                                       </div>
                                         <div class="form-group">
                                         <label for="middlename" class="col-sm-2 control-label">MI</label>
                                         <div class="col-sm-10">
                                             <input type="text" class="form-control" id="lastname" name="mname" value="<?php echo $middlename; ?>" maxlength="1" >                                                               
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="lastname" class="col-sm-2 control-label form-groupp required">Last Name</label>
                                         <div class="col-sm-10">
                                             <input type="text" class="form-control" id="lastname" name="lname" value="<?php  echo $lastname; ?>" >                                                                
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="dob" class="col-sm-2 control-label">DOB</label>
                                         <div class="col-sm-10">
                                             <div class="input-group date form_date" data-date="" data-date-format="mm/dd/yyyy" data-link-field="dob" data-link-format="mm/dd/yyyy">
                                                 <input class="form-control" name="dob"  id="dob"   type="text" value="<?php if($dob != '0000-00-00' && $dob != ''){ echo reversedateformat($dob);} ?>" >
                                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>                                                            
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="lastname" class="col-sm-2 control-label">Age</label>
                                         <div class="col-sm-6">
                                             <input type="text" class="form-control" id="age" name="age" value="<?php echo $age; ?>" >                                                               
                                         </div>
                                       </div>

                                       <div class="form-group ">
                                          <label for="gender" class="col-sm-2 control-label">Gender</label>
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
                                       </div>

                                         <div class="form-group">
                                        <label for="ethnicity" class="col-sm-2 control-label">Ethnicity</label>
                                         <div class="col-sm-6"> 
                                          <select name="ethnicity" id="ethnicity" class="form-control">
                                            <option value="" >Select Ethnicity</option>
                                            <?php         
                                                foreach($ethnicity_rec as $row) {
                                                     if ($row['ethnicity_id'] == $ethnicity)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';
                                            ?>
                                            <option value="<?php echo $row['ethnicity_id']; ?>" <?php echo $sel;?> ><?php echo $row['ethnicity']; ?></option>
                                            <?php }  ?>   
                                           </select>
                                         </div>
                                       </div>

                                         <div class="form-group ">
                                             <label for="role" class="col-sm-2 control-label">Education Level</label>
                                              <div class="col-sm-6">  
                                             <select name="edu_level" id="edulevel" class="form-control">
                                                   <option value="-1" >Select Education Level</option>
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
                                           </div>
                                           <div class="form-group " id="sublevel">
                                             <label for="role" class="col-sm-2 control-label">Education Sub Level</label>
                                              <div class="col-sm-6">  
                                               <select name="sublevel" id="sublevels" class="form-control">

                                               </select>
                                              </div>
                                           </div>

                                             <div class="form-group">
                                             <label for="role" class="col-sm-2 control-label">Occupation</label>
                                              <div class="col-sm-6"> 
						<input type="text" class="form-control" list="list" id="poccupation" name="poccupation" value="<?php echo $occupation; ?>" >
                                                <datalist id="list">
                                                <?php    
                                                
                                                 foreach($parti_occupation_rec as $row) {
                                                ?>
                                                  
                                                    <option value="<?php echo $row['parti_occupation']; ?>" ><?php echo $row['parti_occupation']; ?></option>

                                                <?php }  ?> 
                                                </datalist>
                                              
                                              </div>
                                           </div>
                                            <div class="form-group">
                                            <label for="role" class="col-sm-2 control-label">Employer</label>
                                            <div class="col-sm-6"> 
                                                <input type="text" class="form-control" list="elist" id="employer" name="employer" value="<?php echo $employer; ?>" >
                                                <datalist id="elist">
                                                <?php    
                                                
                                                 foreach($parti_employer_rec as $row) {
                                                ?>
                                                  
                                                    <option value="<?php echo $row['parti_employer']; ?>" ><?php echo $row['parti_employer']; ?></option>

                                                <?php }  ?> 
                                                </datalist>
                                            </div>
                                            </div>
                                           <div class="form-group">
                                               <label for="role" class="col-sm-2 control-label">User Group(s)/ Medical Conditions:</label>
                                               <div class="navbar  col-sm-10">
                                               <div class="navbar-inner panel-heading  col-sm-12">
                                                 <div class="container  col-sm-12 ">

                                                     <ul class="nav nav-pills ">
                                                             <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
                                                             <li><a href="#tab2" data-toggle="tab">Medical Conditions</a></li>
                                                             <li><a href="#tab3" data-toggle="tab">Occupations</a></li>
                                                     </ul>

                                                 </div>
                                               </div>

                                               <div class="tab-content">
                                                   <div class="tab-pane active " id="tab1"> 
                                                       <input type="text" class="form-control" id="myInput2" onkeyup="myFunction2()" placeholder="Search..." title="Type in a name">
                                                       <div id="" style="overflow-y: scroll; height:300px; border:1px solid;">
                                                       <table id="myTable2" class="table table-striped table-bordered" >
                                                            <?php         
                                                            foreach($user_groups_rec as $row) {
                                                           ?>
                                                           <tr>
                                                               <td><input type="checkbox" name="usergroup[]" value="<?php echo $row['id']; ?>" <?php if (!empty($usergroup_autosave)) {  if(in_array($row['id'] , $usergroup_autosave)){echo 'checked="checked"';}}?> > <?php echo $row['group_name']; ?></td>

                                                           </tr>
                                                            <?php }  ?>
                                                         </table>    
                                                       </div>
                                                   </div>
                                                   <div class="tab-pane" id="tab2"> 
                                                        <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search..." title="Type in a name">
                                                           <div id="" style="overflow-y: scroll; height:300px; border:1px solid;">
                                                           <table id="myTable" class="table table-striped table-bordered" >

                                                            <?php       
                                                                foreach($medical_condition_rec as $row) {
                                                            ?>   
                                                               <tr>
                                                                   <td><input type="checkbox" name="medical[]" value="<?php echo $row['id']; ?>" <?php if (!empty($medical_autosave)) { if(in_array($row['id'] , $medical_autosave)){echo 'checked="checked"';}}?>> <?php echo $row['medical_condition']; ?></td>

                                                               </tr>
                                                              <?php }  ?>    

                                                             </table>    
                                                           </div>


                                                   </div>
                                                   <div class="tab-pane " id="tab3"> 
                                                       <input type="text" class="form-control" id="myInput1" onkeyup="myFunction1()" placeholder="Search..." title="Type in a name">
                                                       <div id="" style="overflow-y: scroll; height:300px; border:1px solid;">
                                                       <table id="myTable1" class="table table-striped table-bordered" >
                                                           <?php         
                                                            foreach($occupation_rec as $row) {
                                                           ?>
                                                           <tr>
                                                               <td><input type="checkbox" name="occupatn[]" value="<?php echo $row['id']; ?>" <?php if (!empty($occupation_autosave)) { if(in_array($row['id'] , $occupation_autosave)){echo 'checked="checked"';}}?> > <?php echo $row['occupation']; ?></td>

                                                           </tr>
                                                           <?php }  ?>  
                                                         </table>    
                                                       </div>
                                                   </div>
                                               </div>

                                             </div>

                                           </div>


                                   </div>
                               </fieldset>
                           </div> <!--end of demographic--> 
                              
                            <div class="col-md-6"> <!--Contact Information and City-->
                                <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Contact Information and City</legend>
                                   <div class="panel-body">
                                               
                                        <div class="form-group">
                                            <label for="cell-phone" class="col-sm-2 control-label">Cell Phone</label>
                                            <div class="col-sm-1-5">
                                                <input type="text" class="form-control" id="phone1" name="phone1" value="<?php echo $phone1; ?>" style="width: 50px;" maxlength="3" >
                                            </div>
                                            <div class="col-sm-1-5">
                                                <input type="text" class="form-control" id="phone2" name="phone2" value="<?php echo $phone2; ?>" style="width: 50px;" maxlength="3" >
                                            </div>
                                            <div class="col-sm-1-5">
                                                <input type="text" class="form-control" id="phone3" name="phone3" value="<?php echo $phone3; ?>" maxlength="4" >
                                            </div>

                                            <div class="col-sm-3">
                                                 <label for="ext" class=" control-label" style="float: left; margin-right: 10px;">Ext</label>
                                                <input type="text" class="form-control" id="phone_ext" name="phone_ext" value="<?php echo $phone_ext; ?>" placeholder="EXT" style="width: 70px;" >                                                                
                                            </div>
                                            <div class="checkbox col-sm-3">
                                              <label>
                                                <input type="checkbox" name="phone_msg" value="1" class="" <?php if($phone_msg == 1){?> checked="checked"<?php } ?>> OK to receive text message
                                              </label>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                          <label for="phone2" class="col-sm-2 control-label">Phone 2</label>
                                          
                                            <div class="col-sm-1-5">
                                                <input type="text" class="form-control" id="alt_phone1" name="alt_phone1" value="<?php echo $alternate_phone1; ?>" style="width: 50px;" maxlength="3" >
                                            </div>
                                            <div class="col-sm-1-5">
                                                <input type="text" class="form-control" id="alt_phone2" name="alt_phone2" value="<?php echo $alternate_phone2; ?>" style="width: 50px;" maxlength="3" >
                                            </div>
                                            <div class="col-sm-1-5">
                                                <input type="text" class="form-control" id="alt_phone3" name="alt_phone3" value="<?php echo $alternate_phone3; ?>" maxlength="4" >
                                            </div> 
                                          
                                          
                                            <div class="col-sm-3">
                                              <label for="firstname" class=" control-label" style="float: left; margin-right: 10px;">Ext</label>
                                              <input type="text" class="form-control" id="alt_phone_ext" name="alt_phone_ext" value="<?php echo $alternate_phone_ext; ?>" style="width: 70px;" >                                                                 
                                          </div>
                                          
                                          <div class="checkbox col-sm-3">
                                              <label>
                                                <input type="checkbox" name="alt_phone_msg" value="1" class="" <?php if($alt_phone_msg == 1){?> checked="checked"<?php } ?>> OK to receive text message
                                              </label>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                          <label for="middlename" class="col-sm-2 control-label">Email</label>
                                          <div class="col-sm-10">
                                               <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" >                      
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="lastname" class="col-sm-2 control-label">Email 2</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" id="email" name="alt_email" value="<?php echo $alternate_email; ?>" >                                                                
                                          </div>
                                        </div>
                                       
                                       
                                        <!--<div class="form-group">
                                          <label for="middlename" class="col-sm-2 control-label">Address1</label>
                                          <div class="col-sm-10">
                                               <input type="text" class="form-control" id="address1" name="address1" value="<?php echo $address1; ?>" >                     
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="lastname" class="col-sm-2 control-label">Address2</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" id="address2" name="address2" value="<?php echo $address2; ?>" >                                                               
                                          </div>
                                        </div>-->
                                       
                                       
                                        <div class="form-group">
                                          <label for="middlename" class="col-sm-2 control-label">City</label>
                                          <div class="col-sm-10">
                                               <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>" >                     
                                          </div>
                                        </div>
                                        <div class="form-group ">
                                          <label for="gender" class="col-sm-2 control-label">State</label>
                                           <div class="col-sm-6"> 
                                          <select name="state" id="state" class="form-control">
                                            <option value="" >Select State</option>
                                            <?php       
                                            $stateArray = stateArray();
                                                foreach($stateArray as $key=>$val) {

                                                    if ($key == $state)
                                                         $sel = 'selected';
                                                     else
                                                         $sel = '';

                                            ?>
                                            <option value="<?php echo $key; ?>" <?php echo $sel;?>><?php echo $val; ?></option>
                                            <?php }  ?>   
                                           </select>
                                           </div>
                                       </div>
                                       <div class="form-group">
                                          <label for="lastname" class="col-sm-2 control-label">Zip</label>
                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $zip; ?>" >                                                            
                                          </div>
                                        </div>
                                       <div class="form-group">
                                          <label for="lastname" class="col-sm-2 control-label">Transportation</label>
                                          <div class="col-sm-10">
                                              <select name="transport" id="transport" class="form-control">
                                                  <option value="" >Select Transportation</option>
                                                    <option value="1" <?php if($transportation == 1){?> selected<?php } ?>>Own Car</option>
                                                        <option value="2" <?php if($transportation == 2){?> selected<?php } ?>>Public Transport</option>
                                                          <option value="3" <?php if($transportation == 3){?> selected<?php } ?>>Family Member/Friend</option>
                                                            <option value="4" <?php if($transportation == 4){?> selected<?php } ?>>Outreach</option>
                                                              <option value="5" <?php if($transportation == 5){?> selected<?php } ?>>No Transportation</option>
                                                                <option value="6" <?php if($transportation == 6){?> selected<?php } ?>>Car Service</option>
                                                </select>                                                             
                                          </div>
                                        </div>
                                        
                                          <div class="form-group">
                                          <label for="esl" class="col-sm-2 control-label">ESL</label>
                                          <div class="col-sm-10">
                                              <select name="esl" id="esl" class="form-control">
                                                  <option value="" >Select ESL</option>
                                                  <option value="1" <?php if($esl == "1"){?> selected<?php } ?>>No</option>  
                                                  <option value="2" <?php if($esl == "2"){?> selected<?php } ?>>Yes</option>
                                                        
                                                </select>                                                             
                                          </div>
                                        </div>
                                         <div class="form-group">
                                          <label for="lastname" class="col-sm-2 control-label">Needs wheelchair access</label>
                                          <div class="col-sm-10">
                                              <select name="need_wheelchair" id="need_wheelchair" class="form-control">
                                                    <option value="" >Select wheelchair access</option>
                                                    <option value="1" <?php if($need_wheelchair == "1"){?> selected<?php } ?>>No</option>
                                                    <option value="2" <?php if($need_wheelchair == "2"){?> selected<?php } ?>>Yes</option>
                                                    
                                                </select>                                                             
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <div class="col-sm-offset-2 col-sm-12">
                                            <div class="checkbox col-sm-4">
                                              <label>
                                                <input type="checkbox" name="do_not_call" value="1" class="" <?php if($do_not_call == 1){?> checked="checked"<?php } ?>> Do not call
                                              </label>
                                            </div>
                                               <div class="checkbox col-sm-4">
                                              <label>
                                                <input type="checkbox" name="do_not_email" value="1" class="" <?php if($do_not_email == 1){?> checked="checked"<?php } ?>> Do not email
                                              </label>
                                            </div>
                                               <div class="checkbox col-sm-4">
                                              <label>
                                                <input type="checkbox" name="decreased" value="1" class="" <?php if($decreased == 1){?> checked="checked"<?php } ?>> Deceased 
                                              </label>
                                            </div>
                                          </div>  
                                          
                                        </div>
                                        
                                    </div>
                                </fieldset>
                            </div> <!--End Contact Information and City-->
                            
                            
                             <div class="col-md-6"><!-- photolog notes and study-->    
                               <fieldset class="scheduler-border">
                               <legend class="scheduler-border">Photolog Notes and Study</legend>
                                  <div class="panel-body">

                                      
                                       
                                       <div class="form-group">
                                         <div class="col-sm-4">
                                             <?php if($photo != ''){?>
                                             <img id="blah" src="<?php echo WEBSITE_URL;?>/participant/<?php echo $photo;?>" alt="your image" width="100" height="100" />
                                              <input type="hidden" class="form-control" id="state"  maxlength="2" name="photo" value="<?php echo $photo;?>" >  
                                             
                                             <?php }else { ?>
                                               <img id="blah" src="<?php echo ASSET_PATH;?>images/no-image.png" alt="your image" width="100" height="100" /> 
                                            
                                              <?php } ?>
                                         </div>
                                         <div class="col-sm-6">
                                             <input type="file" name="userfile" id="imgInp" size="20" />                                                                
                                         </div>
                                       </div>
                                       <div class="form-group">
                                             <label for="role" class="col-sm-3 control-label">IAA Classification</label>
                                              <div class="col-sm-6"> 
                                                   <select name="participant_classfication" id="participant_classfication" class="form-control">
                                                        <option value="">Select Classification</option>    
                                                       <?php         
                                                                foreach($classification_rec as $row) {
                                                                     if ($row['classification_id'] == $classification)
                                                                         $sel = 'selected';
                                                                     else
                                                                         $sel = '';
                                                            ?>
                                                            <option value="<?php echo $row['classification_id']; ?>" <?php echo $sel;?> ><?php echo $row['classification']; ?></option>
                                                            <?php }  ?>   
                                                   </select>
                                                  
                                              </div>
                                           </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                 <legend></legend>                                                               
                                            </div>
                                       </div>
                                      
                                       <div class="form-group">
                                         <div class="col-sm-12">
                                                <div class="input_fields_wrap"> 
                                                   
                                                  <?php if (!empty($participant_notes)) { ?>


                                                  <?php  for($i = 0; $i<count($participant_notes) ; $i++) { ?>

                                                    <div class="row">
                                                          <div class="col-sm-3 " style="margin-top:15px;">
                                                              <label for="notes">Notes</label>
                                                              <input class="form-control" type="text" value="<?php echo $participant_notes[$i]['study_notes']?>" name="notes[]" readonly="readonly">
                                                           </div>
                                                        <div class=" col-sm-3" style="margin-top:15px;">
                                                              <label for="status">Status</label>
                                                                <input class="form-control" type="text" value="<?php echo $participant_notes[$i]['status']?>" name="status[]" readonly="readonly">
                                                        
                                                           </div>
                                                        <div class="  col-sm-3" style="margin-top:15px;" >
                                                              <label for="study">Study</label>
                                                              <input class="form-control" type="text" value ="<?php  echo $participant_notes[$i]['study_number'].':'.$participant_notes[$i]['client_name'].' '.$participant_notes[$i]['product_name'].' '.$participant_notes[$i]['study_type']; ?>" readonly="readonly" name="study[]">
                                                           </div>
                                                            <div class="  col-sm-3" style="margin-top:15px;">
                                                              <label for="date">Date</label>
                                                              
                                                              <?php 
                                                                     $created_date =  $participant_notes[$i]['created']; 
                                                                     $updated_date =  $participant_notes[$i]['noted_last_modified'];
                                                                     
                                                                     if($updated_date != '0000-00-00'){
                                                                        $noted_date = $updated_date;
                                                                     
                                                                     }else{
                                                                         
                                                                        $noted_date = $created_date; 
                                                                     }
                                                                      
                                                                     
                                                                     if($participant_notes[$i]['status'] == 'Scheduled'){
                                                                      ?>
                                                                    <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="datee" data-link-format="yyyy-mm-dd">
                                                                    <input class="form-control" name="datee[]"  id="datee"   type="text" value="<?php if($noted_date != '0000-00-00'){ echo $noted_date;} ?>" readonly >
                                                                    <span class="input-group-addon"  ><span class="glyphicon glyphicon-calendar" ></span></span>
                                                                    </div>  
                                                                     <?php } else { ?>
                                                                        <input class="form-control" name="datee[]"    type="text" value="<?php if($noted_date != '0000-00-00'){ echo $noted_date;} ?>" readonly >

                                                                  
                                                                     <?php } ?>
                                                          </div>

                                                    </div>


                                                  <?php } 

                                                  } ?>

                                                </div> <!--input_fields_wrap-->                                                              
                                         </div>
                                       </div>

                                      

                                   </div>
                               </fieldset>
                           </div><!-- photolog notes and study-->    
                           <legend></legend>  
                       
                        
                        <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-12">
                               <button type="reset" class="btn btn-primary btn-space" onclick="location.href='<?php echo site_url("participants"); ?>'">Cancel</button>			
                               <button type="submit" name="savebtn" value="0" class="btn btn-primary ">Submit to Database</button>
                                
                            </div>
                          </div>
                       <?php echo form_close(); ?>       
    
                                        
				</div>

  						
  			</div>
  	</div>
</div>
</div>
<!-- model -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content-study modal-lg">
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
    $(function () {
            $.post("<?php echo site_url('participants/update/'.$this->uri->segment(3)); ?>", function (data) {
                $("[name='fname']").val(data.fname);
                $("[name='lname']").val(data.lname);
                $("[name='userfile']").val(data.userfile);
            }, "json");
            setInterval(function () {
                $.post("<?php echo site_url('participants/update/'.$this->uri->segment(3)); ?>", $("form").serialize());
            }, 10000);
        });
        
        
 $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
           // $(wrapper).append('<div><input type="text" name="mytext[]"/><input type="text" name="mytext2[]"/>\n\
           //         <a href="#" class="remove_field">Remove</a></div>'); //add input box
           
           
           $(wrapper).append('<div class="row"><div class=" col-sm-3"  style="margin-top:15px;" ><input class="form-control" type="text" name="notes[]"></div> <div class=" col-sm-3" style="margin-top:15px;" ><select name="status[]" id="status" class="form-control"> <option value="">Select Status</option><option value="screened" >Screened</option><option value="scheduled">Scheduled</option></select></div><div class=" col-sm-3"  style="margin-top:15px;"><input class="form-control" type="text" name="study[]"></div><div class="col-sm-3"  style="margin-top:15px;"><div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="datee" data-link-format="yyyy-mm-dd"><input class="form-control" name="datee[]"  id="datee"   type="text" ><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div></div></div>');
           
           
           
        }
    });

       /* $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove();  x--;
        })*/
    });    
        
        
    $(document).ready(function() {
    //dob calculation
        $("#dob").change(function(){
            var today = new Date();
            var birthDate = new Date($('#dob').val());
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
           // alert(age);
           $("#age").val(age);
        });
        
        $("#age").change(function(){
            var agg = ($(this).val());
            var d = new Date();
            var pastYear = d.getFullYear() - agg;
            d.setFullYear(pastYear);
            //var testdate = Date();
            var caldob = $.datepicker.formatDate( "mm/dd/yy",new Date(d));
            
             $("#dob").val(caldob);
            
        });
        
        $("#sublevel").hide();
        //get education level on update page
         var edu_lvl = <?php if($edu_lvl == '') {echo '-1';}else {echo  $edu_lvl; }?>;
         var edu_sublvl = <?php echo $edu_sublvl;?>;
        if(edu_lvl!="-1"){
             var dataString = 'eduId='+ edu_lvl+'&edusubId='+edu_sublvl;
                //$("#"+loadType+"_loader").show();
                //$("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="image/loading.gif" />');
                $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('participants/loadDataupdate'); ?>",
                  data: dataString,
                  cache: false,
                  success: function(result){
                   if(result!= 0){
                        $("#sublevel").show();
                        //$("#"+loadType+"_loader").hide();
                        $("#sublevels").html("<option value='-1'>Select Education Sub Level</option>");
                        $("#sublevels").append(result);
                    }else{
                         $("#sublevel").hide();
                          $("#sublevels").html("<option value='-1' selected>Select Education Sub Level</option>");
                    }
                  }
               });
        }else{
            $("#sublevel").hide();
             $("#sublevels").html("<option value='-1' selected>Select Education Sub Level</option>");
        } 
        
        
        
        
    });
    // eduction
    $('#edulevel').on('change', function(){
      
        var edu_lvl = $(this).val();
        if(edu_lvl!="-1"){
             var dataString = 'eduId='+ edu_lvl;
                //$("#"+loadType+"_loader").show();
                //$("#"+loadType+"_loader").fadeIn(400).html('Please wait... <img src="image/loading.gif" />');
                $.ajax({
                  type: "POST",
                  url: "<?php echo site_url('participants/loadData'); ?>",
                  data: dataString,
                  cache: false,
                  success: function(result){
                   if(result!= 0){
                        $("#sublevel").show();
                        //$("#"+loadType+"_loader").hide();
                        $("#sublevels").html("<option value='-1'>Select Education Sub Level</option>");
                        $("#sublevels").append(result);
                    }else{
                         $("#sublevel").hide();
                          $("#sublevels").html("<option value='-1' selected>Select Education Sub Level</option>");
                    }
                  }
               });
        }else{
            $("#sublevel").hide();
             $("#sublevels").html("<option value='-1' selected>Select Education Sub Level</option>");
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
    
    function myFunction2() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable2");
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
    
    
    
     function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
    
 
    
</script>