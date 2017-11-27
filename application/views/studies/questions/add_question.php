<div class="page-content">
    	<div class="row">
		  
		  <div class="col-md-12">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                           
                           <div class="panel-heading"><h3><?php echo ucfirst($this->uri->segment(2));?></h3></div>
				
  				<div class="panel-body">
				
                        <?php
                          //form data
                          $attributes = array('class' => 'form-horizontal', 'id' => 'addeditquestion' , 'enctype' => 'multipart/form-data');

                          //form validation
                          echo validation_errors();

                          echo form_open('questions/add_question', $attributes);
                          ?>
                            <input type="hidden" name="study_id" value="<?php echo $study_id;?>">             
                            <div class="col-md-12"> 
                                  <div class="panel-body">
                                 
                                        <div class="form-group ">
                                          <label for="question_type" class="col-sm-2 control-label">Format: </label>
                                           <div class="col-sm-3"> 
                                          <select name="question_type" id="question_type" class="form-control">
                                            <option value="1" >Single Choice</option>
                                             <option value="2" >Multiple Choice</option>
                                              <option value="3" >Free Text</option>
                                           </select>
                                           </div>
                                       </div>
                                        
                                       <div class="form-group">
                                         <label for="question" class="col-sm-2 control-label form-groupp required">Screener Question: </label>
                                         <div class="col-sm-6">
                                             <input type="text" class="form-control" id="question" name="question" value="<?php echo set_value('question'); ?>" >                                                               
                                         </div>
                                       </div>

                                        <div class="form-group ">
                                            <label for="question_option" class="col-sm-2 control-label">Question Options: </label>
                                           <div class="col-sm-6"> 
                                               <textarea class="form-control" name="question_option" id="question_option" placeholder="Textarea" rows="5" ><?php echo set_value('question_option'); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                             <label for="question_option" class="col-sm-2 control-label"></label>
                                           <div class="col-sm-6">
                                               <input type="checkbox" name="demographics"  <?php if(set_value('demographics') == 1){echo 'checked="checked"';} ?>> Use in demographics 
                                            </div>
                                        </div> 


                                   </div>
                       
                           </div> 
                                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                               <button type="reset" class="btn btn-primary btn-space" onclick="location.href='<?php echo site_url("studies/study/".$study_id); ?>'">Cancel</button>			
                               <button type="submit" name="savebtn" value="0" class="btn btn-primary">Save</button>
                                
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
 $(document).ready(function() {
	$('#question_type').change(function () {
            if ($('#question_type').val() == '3') {
               // $('#question_option').attr('readonly');
                $("#question_option").attr("readonly","readonly");
            }
            else {
               $('#question_option').removeAttr('readonly');
              
            }
        });

    });   // document ready function 
    
</script>