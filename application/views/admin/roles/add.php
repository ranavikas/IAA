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
                                        if(isset($flash_message)){
                                          if($flash_message == TRUE)
                                          {
                                            echo '<div class="alert alert-success">';
                                              echo '<a class="close" data-dismiss="alert">×</a>';
                                              echo '<strong>Well done!</strong> new Umrah created with success.';
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
						<div class="panel-heading">Add Roles
						</div>
						<div class="panel-body">
							<?php
                                                        //form data
                                                        $attributes = array('class' => '', 'id' => '' , 'enctype' => 'multipart/form-data');

                                                        //form validation
                                                        echo validation_errors();

                                                        echo form_open('admin/roles/add', $attributes);
                                                        ?>
                                                    
							  <fieldset>
								
								<div class="form-group required control-label">
								  <label for="role">Role</label>
								  <input type="text" class="form-control" id="" name="role" value="<?php echo set_value('role'); ?>" >
								</div>
								<div class="form-group">
								  <label for="description">Description</label>
								  <input type="text" class="form-control" id="" name="desc" value="<?php echo set_value('desc'); ?>" >
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
                                                                        <option value="<?php echo $code; ?>" ><?php echo $name; ?></option>
                                                                        <?php }  ?>   
                                                                    </select>

								</div>
								
								<div class="form-group">
								  <label for="status">Status</label>
								  								
								  <select name="record_status" id="record_status" class="form-control">
										<option value="1" selected="selected">Active</option>
                                                                                <option value="2">Delete</option>
									</select>
								</div>
								
								
								
								
								<button type="submit" class="btn btn-primary">Save</button>
								<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("admin/roles"); ?>'">Cancel</button>
								
							  </fieldset>
							<?php echo form_close(); ?>
				
						</div>
					</div> 
				</div>

  						
  			</div>
  		</div>
  		</div>

	</div>