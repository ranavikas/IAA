<div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<?php  $attributes = array("class" => "form-vertical", "id" => "loginform", "name" => "loginform");
				echo form_open('/', $attributes);?>
				<div class="box">
					<div class="content-wrap">
						<h6>Sign In</h6>
						<?php 
							if($this->session->flashdata('flash_success')){
								echo SUCCESS_MSG_START.$this->session->flashdata('flash_success').MSG_END;
							}
							if($this->session->flashdata('flash_error')){
								echo ERROR_MSG_START.$this->session->flashdata('flash_error').MSG_END;
							}
						?>
						<?php echo form_input(array('id' => 'username', 'name' => 'username','class'=>"form-control",'placeholder' => 'Enter the username','value' => set_value('username'))); ?>
						<span class="text-danger"><?php echo form_error('username'); ?></span>
						<?php echo form_input(array('type'=>'password','class'=>"form-control",'id' => 'password', 'name' => 'password','placeholder' =>'Enter the password')); ?>
						<span class="text-danger"><?php echo form_error('password'); ?></span>
						<div class="action">
							<?php echo form_submit(array('name' => 'submit','value'=>'Login','class'=>'btn btn-primary signup')); ?>
						</div>	
					</div>
				</div>
				<div class="already">
					 <p>Do not have password?</p> 
					 <?php echo anchor(site_url('forgotpassword'), 'Forgot Password') ?><br><br>
				  <!--  <p>Don't have an account yet?</p>
					<a href="<?php //echo WEBSITE_URL;?>signup">Sign Up</a>-->
				</div>
			</div>
		</div>
	</div>
</div>