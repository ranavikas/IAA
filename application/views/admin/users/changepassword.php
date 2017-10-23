 <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                           <div class="panel-heading"><h3>Password Administration</h3></div>
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
                                        if($this->session->flashdata('flash_message')){
                                          if($this->session->flashdata('flash_message') == 'updated')
                                          {
                                            echo '<div class="alert alert-success">';
                                              echo '<a class="close" data-dismiss="alert">×</a>';
                                              echo '<strong>Well done!</strong> Password Changed with success.';
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
						<div class="panel-heading">Password Administration
						</div>
						<div class="panel-body">
							<?php
                                                        //form data
                                                        $attributes = array('class' => '', 'id' => 'changepassword' , 'enctype' => 'multipart/form-data');

                                                        //form validation
                                                        echo validation_errors();

                                                        echo form_open('admin/users/changepassword', $attributes);
                                                        ?>
                                                    
							  <fieldset>
								
                                                                <div class="row">
                                                                    <div class="form-group col-sm-12">
                                                                     <label for="user">User</label>
                                                                    
                                                                    <select name="user_id" id="user_id" class="form-control">
                                                                        <?php         
                                                                            foreach($get_user as $row) {
                                                                                
                                                                                 if ($row['user_id'] == $user_id)
                                                                                        $sel = 'selected';
                                                                                     else
                                                                                         $sel = ''; 
                                                                        ?>
                                                                        <option value="<?php echo $row['user_id']; ?>" <?php echo $sel;?>><?php echo $row['uname']; ?></option>
                                                                        <?php }  ?>   
                                                                    </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12">
                                                                      <label for="pass">New Password</label>
                                                                      <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>" >
                                                                    </div>
                                                                    <div class="form-group col-sm-12">
                                                                      <label for="cpass">Confirm New Password</label>
                                                                      <input type="password" class="form-control" id="confirm_password" name="cpassword" value="<?php echo set_value('cpassword'); ?>" >
                                                                    </div>
                                                                </div>
								<button type="submit" class="btn btn-primary">Change Password</button>
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
