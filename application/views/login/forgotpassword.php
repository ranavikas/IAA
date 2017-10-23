<div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<?php  $attributes = array("class" => "form-vertical", "id" => "forgotpasswordform", "name" => "forgotpasswordform");
				echo form_open("/forgotpassword", $attributes);?>
				<div class="box">
					<div class="content-wrap">
						<h6>Forgot Password</h6>
						<?php 
							if($this->session->flashdata('flash_success')){
								echo SUCCESS_MSG_START.$this->session->flashdata('flash_success').MSG_END;
							}
							if($this->session->flashdata('flash_error')){
								echo ERROR_MSG_START.$this->session->flashdata('flash_error').MSG_END;
							}
						?>
						<?php echo form_input(array('id' => 'email', 'name' => 'email','class'=>"form-control",'placeholder' => 'Enter the email address','value' => set_value('email'))); ?>
						<span class="text-danger"><?php echo form_error('email'); ?></span>
						<div class="action">
							<?php echo form_submit(array('name' => 'submit','value'=>'Recover Password','class'=>'btn btn-primary signup')); ?>
						</div>                
					</div>
				</div>
				<div class="already">
					<p>You have an account?</p>
					<?php echo anchor(site_url(), 'Click here to login') ?>
				</div>
			</div>
		</div>
	</div>
</div>