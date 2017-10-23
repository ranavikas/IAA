 <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('admin/includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                           <div class="panel-heading"><h3>Change Password</h3></div>
				<nav class="navbar navbar-dark stylish-color" style="margin-bottom :0px !important;">
					<ol class="breadcrumb">
					<li class="breadcrumb-item">Profile</li>
					<li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segment(3));?></li>
					</ol>
				</nav>
				
  				<div class="panel-body">

				<legend>
				<?php if(!isset($flash_message)) { ?>
					<div class="alert alert-info"><a class="close" data-dismiss="alert">×</a>Once your password has been successfully changed, you will be automatically logged out and must log in again.</div>
				<?php } ?>
				
				<?php if(isset($flash_message) && $flash_message == TRUE) { ?>
					<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Password updated successfully.  You must login again.</div>
					<script>setTimeout(function(){window.location.href='<?php echo site_url("logout"); ?>'},3000);</script>
				<?php } ?>
				
				<?php if(isset($flash_message) && $flash_message != TRUE) { ?>
					<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Your password could not be updated.</div>
				<?php } ?>

                </legend>
  					<div class="panel panel-default" id="forms">
						<div class="panel-heading">Change Password
						</div>
						<div class="panel-body">
							<?php
                                                        //form data
                                                        $attributes = array('class' => '', 'id' => 'changepassword' , 'enctype' => 'multipart/form-data');

                                                        //form validation
                                                        echo validation_errors();

                                                        echo form_open('admin/profile/changepassword', $attributes);
                                                        ?>
                                                    
							  <fieldset>
								
                                                                <div class="row">
                                                                    <div class="form-group col-sm-12">
                                                                     <label for="user">User</label>
                                                                     <input type="user" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly="readonly" >
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
								<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("dashboard"); ?>'">Cancel</button>
								
							  </fieldset>
							<?php echo form_close(); ?>
				
						</div>
					</div> 
				</div>

  						
  			</div>
  		</div>
  		</div>

	</div>
