<?php $verification_code =  $this->uri->segment(2);?>
<div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<?php  $attributes = array("class" => "form-vertical", "id" => "resetpassword_form", "name" => "resetpassword_form");
				echo form_open("/reset-password/".$verification_code, $attributes);?>
				<div class="box">
					<div class="content-wrap">
						<h6>Reset Password</h6>
						<?php 
							if($this->session->flashdata('flash_success')){
								echo SUCCESS_MSG_START.$this->session->flashdata('flash_success').MSG_END;
							}
							if($this->session->flashdata('flash_error')){
								echo ERROR_MSG_START.$this->session->flashdata('flash_error').MSG_END;
							}
						?>
						<?php echo form_password(array('id' => 'newpassword', 'name' => 'newpassword','class'=>"form-control",'placeholder' => 'Enter new password')); ?>
						<span class="text-danger"><?php echo form_error('newpassword'); ?></span>
						
						<?php echo form_password(array('class'=>"form-control",'name'=>'confirmpassword','id' => 'confirmpassword', 'confirmpassword' => 'password','placeholder' =>'Enter the confirm password')); ?>
							<span class="text-danger"><?php echo form_error('confirmpassword'); ?></span>
						<div class="action">
							<?php echo form_submit(array('name' => 'submit','value'=>'Reset Password','class'=>'btn btn-primary signup')); ?>
						</div>	
					</div>
				</div>
				<div class="already">
					<p>You have an account?</p> 
					<?php echo anchor(site_url(), 'Sign In') ?>
				</div>
			</div>
		</div>
	</div>
</div>