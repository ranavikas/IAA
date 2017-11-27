<div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php //$this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            
                            <div class="panel-heading"><h3>Select Screener Questions</h3></div>
				
		
				<!-- START Main Content -->
                        <div class="panel-body">
					
                         <?php
                          //form data
                          $attributes = array('class' => 'form-horizontal', 'id' => 'addquestions' , 'enctype' => 'multipart/form-data');

                          //form validation
                          echo validation_errors();

                          echo form_open('studies/screener_questions', $attributes);
                          ?>
                                        
                            <input type="hidden" name="study_id" value="<?php echo $study_id;?>">           
                        <table class="table table-striped table-bordered dataTable" id="screenerquestion" name="study">
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
                                <button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("studies/study/".$study_id); ?>'">Cancel</button>			
                                <button type="submit" name="savebtn" style="white-space: initial; width: 280px;" value="<?php echo $onegroup;?>" class="btn btn-primary">Add Selected Questions to Screener to <?php echo $group_name['0'];?> Screener only</button>
                                <button type="submit" name="savebtn" style="white-space: initial; width: 280px;"  value="<?php echo $allgroups;?>" class="btn btn-primary">Add Selected Questions to Screener for all Groups</button>                              
                                
                            </div>
                          </div>             
                            <?php echo form_close(); ?>                  
  				</div>
				
  			</div>

		  </div>
		</div>
    </div>
<script src="https://code.jquery.com/jquery.js"></script>
<script src="<?php echo ASSET_PATH;?>vendors/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSET_PATH;?>js/tables.js"></script>