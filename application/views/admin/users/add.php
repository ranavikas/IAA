 <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                           <div class="panel-heading"><h3>Users</h3></div>
				<nav class="navbar navbar-dark stylish-color" style="margin-bottom :0px !important;">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
                                                    <a href="<?php echo site_url("admin"); ?>">
                                                     <?php echo ucfirst($this->uri->segment(1));?>
                                                    </a> 
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo site_url("admin/users"); ?>">
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
                                              echo '<strong>Well done!</strong> New User created/updated with success.';
                                            echo '</div>';       
                                          }else{
                                            echo '<div class="alert alert-error">';
                                              echo '<a class="close" data-dismiss="alert">×</a>';
                                              echo '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
                                            echo '</div>';          
                                          }
                                        }
                                        ?>
                                    </legend>
  					<div class="panel panel-default" id="forms">
						<div class="panel-heading">User
						</div>
						<div class="panel-body">
							<?php
                                                        //form data
                                                        $attributes = array('class' => '', 'id' => 'addedituser' , 'enctype' => 'multipart/form-data');

                                                        //form validation
                                                        echo validation_errors();

                                                        echo form_open('admin/users/add', $attributes);
                                                        ?>
                                                    
							  <fieldset>
								<div class="row">
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="fname">First Name</label>
                                                                      <input type="text" class="form-control" id="firstname" name="fname" value="<?php echo set_value('fname'); ?>" >
                                                                    </div>
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="lname">Last Name</label>
                                                                      <input type="text" class="form-control" id="lastname" name="lname" value="<?php echo set_value('lname'); ?>" >
                                                                    </div>
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="uname">UserName</label>
                                                                      <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>" >
                                                                    </div>
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="email">Email</label>
                                                                      <input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" >
                                                                    </div>
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="pass">Password</label>
                                                                      <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" >
                                                                    </div>
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="cpass">Conf Password</label>
                                                                      <input type="password" class="form-control" id="confirm_password" name="cpassword" value="<?php echo set_value('cpassword'); ?>" >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-sm-4">
                                                                      <label for="role">User Role</label>
                                                                      
                                                                        <div id="" style="overflow-y: scroll; height:200px; border:1px solid #ddd;">
                                                                            <table id="myTable" class="table table-striped table-bordered" >

                                                                             <?php       
                                                                                 foreach($rec_user_role as $row) {
                                                                             ?>   
                                                                                <tr>
                                                                                    <td><input type="checkbox" name="user_role[]" value="<?php echo $row['role_id']; ?>" <?php //if (!empty($location_autosave)) { if(in_array($row['location_id'] , $location_autosave)){echo 'checked="checked"';}} ?>> <?php echo $row['role']; ?></td>

                                                                                </tr>
                                                                               <?php }  ?>    

                                                                              </table>    
                                                                        </div>  
                                                                      
                                                                    </div>
                                                                    <div class="form-group col-sm-4">
                                                                      <label for="status">Status</label>			
                                                                        <select name="record_status" id="record_status" class="form-control">
										<option value="1" selected="selected">Active</option>
                                                                                <option value="2">Inactive</option>
									</select>
                                                                    </div>
                                                                   						
                                                                </div>
                                                            
								<button type="submit" class="btn btn-primary">Save</button>
								<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("admin/users"); ?>'">Cancel</button>
								
							  </fieldset>
							<?php echo form_close(); ?>
				
						</div>
					</div> 
				</div>

  						
  			</div>
  		</div>
  		</div>

	</div>
