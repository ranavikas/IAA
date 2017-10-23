<div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<?php  $attributes = array("class" => "form-vertical", "id" => "signupform", "name" => "signupform");
				echo form_open('/signup', $attributes);?>
				<?php 
					if($this->session->flashdata('flash_success')){
						echo SUCCESS_MSG_START.$this->session->flashdata('flash_success').MSG_END;
					}
					if($this->session->flashdata('flash_error')){
						echo ERROR_MSG_START.$this->session->flashdata('flash_error').MSG_END;
					}
				?>
				<div class="box">
					<div class="content-wrap">
						<h6>Sign Up</h6>
						<?php echo form_input(array('id' => 'first_name', 'name' => 'first_name','class'=>"form-control",'placeholder' => 'Enter the first name','autocomplete' => 'off')); ?>
						<span class="text-danger"><?php echo form_error('first_name'); ?></span>
						
						<?php echo form_input(array('id' => 'last_name', 'name' => 'last_name','class'=>"form-control",'placeholder' => 'Enter the last name','autocomplete' => 'off')); ?>
						<span class="text-danger"><?php echo form_error('last_name'); ?></span>
						
						<?php echo form_input(array('id' => 'username', 'name' => 'username','class'=>"form-control",'placeholder' => 'Enter the username','autocomplete' => 'off')); ?>
						<span class="text-danger"><?php echo form_error('username'); ?></span>
						
						<?php echo form_input(array('type'=>'text','id' => 'email', 'name' => 'email','class'=>"form-control",'placeholder' => 'Enter the email','autocomplete' => 'off')); ?>
						<span class="text-danger"><?php echo form_error('email'); ?></span>
						
						<?php echo form_input(array('type'=>'password','class'=>"form-control",'id' => 'password', 'name' => 'password','placeholder' =>'Enter the password')); ?>
						<span class="text-danger"><?php echo form_error('password'); ?></span>
						
						<?php echo form_input(array('type'=>'password','class'=>"form-control",'id' => 'confirmpassword', 'name' => 'password','placeholder' =>'Enter the password again')); ?>
						<span class="text-danger"><?php echo form_error('password'); ?></span>
						
						<div class="action">
							<?php echo form_submit(array('name' => 'submit','value'=>'Signup','class'=>'btn btn-primary signup')); ?>
						</div>                
					</div>
				</div>

				<div class="already">
					<p>Don't have an account yet?</p>
					<a href="<?php echo base_url();?>">Sign In</a>
				</div>
			</div>
		</div>
	</div>
</div>