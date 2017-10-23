<div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php //$this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            
                            <div class="panel-heading"><h3>Select Studies</h3></div>
				
		
				<!-- START Main Content -->
                        <div class="panel-body">
					<!-- table -->
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
                          $attributes = array('class' => 'form-horizontal', 'id' => 'addeditstudy' , 'enctype' => 'multipart/form-data');

                          //form validation
                          echo validation_errors();

                          echo form_open('studies/selected_study', $attributes);
                          ?>
                                        
                        <input type="hidden" name="participantIds" value="<?php echo $participantIds;?>">              
                        <table class="table table-striped table-bordered" id="example1" name="study">
                            <thead>
                                    <tr>
                                        <th></th>
                                            <th>Study</th>
                                            <th>User Group</th>
                                    </tr>
                            </thead>

                            <tbody>
                            <?php 	foreach ($records as $row)
                                            {
                                                   $usergroup =  $this->Studies_model->get_study_usergroup($row['study_id']);
                                                   
                                                    echo '<tr>';
                                                    echo '<td><input type="checkbox" name="studies_ids[]" id="study_ids" class="studies"  value="'.$row['study_id'].'" ></td>';
                                                    echo '<td>'.$row['study_number'].':'.$row['client_name'].' '.$row['product_name'].' '.$row['study_type'].'</td>';
                                                    ?>
                                                    <td>
                                                        <select name="study_user_group[]" id="study_user_group<?php echo $row['study_id']; ?>" class="form-control usergroop" disabled>
                                                             <option value="">Select User Group</option>
                                                            <?php  foreach($usergroup as $grow) { ?>
                                                                <option value="<?php echo $grow['id'].'-'.$row['study_id']; ?>" ><?php echo $grow['group_name']; ?></option>
                                                            <?php  }  ?>

                                                       </select> 
                                                    </td>
                                                    <?php
                                                echo '</tr>';
                                            }
                            ?>
                            </tbody>
                        </table>
                                        
                         <div class="form-group">
                            <div class="col-sm-offset-5 col-sm-12">
                               <button type="submit" name="savebtn" value="0" class="btn btn-primary">Save</button>
                                <button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("participants"); ?>'">Cancel</button>			

                            </div>
                          </div>             
                            <?php echo form_close(); ?>                  
  				</div>
				
  			</div>

		  </div>
		</div>
    </div>

   