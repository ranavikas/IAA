 <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                           <div class="panel-heading"><h3>User Roles</h3></div>
				<nav class="navbar navbar-dark stylish-color" style="margin-bottom :0px !important;">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
                                                    <a href="<?php echo site_url("admin"); ?>">
                                                     <?php echo ucfirst($this->uri->segment(1));?>
                                                    </a> 
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo site_url("admin/roles"); ?>">
                                                     <?php echo ucfirst($this->uri->segment(2));?>
                                                    </a> 
                                                </li>
						<li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segment(3));?></li>
					</ol>
				</nav>
				
  				<div class="panel-body">
                                    <legend>
                                  
                                        
                                        
                                        <?php
                                        //flash messages
                                        if($this->session->flashdata('flash_message')){
                                          if($this->session->flashdata('flash_message') == 'updated')
                                          {
                                            echo '<div class="alert alert-success">';
                                              echo '<a class="close" data-dismiss="alert">×</a>';
                                              echo '<strong>Well done!</strong> Role updated with success.';
                                            echo '</div>';       
                                          }else{
                                            echo '<div class="alert alert-error">';
                                              echo '<a class="close" data-dismiss="alert">×</a>';
                                              echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                                            echo '</div>';          
                                          }
                                        }
                                        ?>
                                    </legend>
  					<div class="panel panel-default" id="forms">
						<div class="panel-heading">Update Roles
						</div>
						<div class="panel-body">
							<?php
                                                        //form data
                                                        $attributes = array('class' => '', 'id' => '' , 'enctype' => 'multipart/form-data');

                                                        //form validation
                                                        echo validation_errors();

                                                        echo form_open('admin/roles/update/'.$this->uri->segment(4).'', $attributes);
                                                        ?>
                                                    
							  <fieldset>
								
								<div class="form-group required control-label">
								  <label for="role">Role</label>
								  <input type="text" class="form-control" id="" name="role" value="<?php echo $role[0]['role']; ?>" >
								</div>
								<div class="form-group">
								  <label for="description">Description</label>
								  <input type="text" class="form-control" id="" name="desc" value="<?php echo $role[0]['description']; ?>" >
								</div>
								<div class="form-group">
								  <label for="Color">Color</label>
								  
                                                                  <?php
                                                                  $color=array(
                                                                    "red" => 'Red',
                                                                    "green" => 'Green',
                                                                    "blue" => 'Blue', 
                                                                    "orange" => 'Orange',
                                                                    "violet" => 'Violet',
                                                                    "thistle" => 'Thistle',
                                                                    "cyan" => 'Cyan', 
                                                                    "goldenrod" => 'Goldenrod',
                                                                    "indigo" => 'Indigo'
                                                                     );
                                                                  ?>
                                                                  
                                                                  
								  <select name="color" id="color" class="form-control">
                                                                    <?php         
                                                                        foreach($color as $code => $name) {
                                                                    ?>
                                                                        <option value="<?php echo $code; ?>"  <?php if ($role[0]['color'] == $code){?>  selected="selected" <?php }?>><?php echo $name; ?></option>
                                                                        <?php }  ?>    

                                                                    </select>
								</div>
								
								<div class="form-group">
								  <label for="status">Status</label>
								  								
									<select name="record_status" id="record_status" class="form-control" <?php if($role[0]['role_id'] == 1) { echo "readonly"; } ?>>
										<option value="1" <?php if($role[0]['record_status'] == 1) {?> selected="selected" <?php }?>>Active</option>
										<option value="2" <?php if($role[0]['record_status'] == 2) {?> selected="selected" <?php }?>>Inactive</option>
									</select>
								</div>
								
								
								
								
								<button type="submit" class="btn btn-primary">Update</button>
								<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("admin/roles"); ?>'">Cancel</button>
								
                                                                <a  href="<?php echo site_url("admin") ?>/roles/delete/<?php echo$role[0]['role_id'] ?>" class="btn btn-primary delete">Delete</a>
							  </fieldset>
							<?php echo form_close(); ?>
				
						</div>
					</div> 
				</div>

  						
  			</div>
  		</div>
  		</div>

	</div>