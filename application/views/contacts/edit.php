<style>
fieldset.scheduler-border {
	border: 1px groove #ddd !important;
	padding: 0 1.4em 1.4em 1.4em !important;
	margin: 0 0 1.5em 0 !important;
	-webkit-box-shadow:  0px 0px 0px 0px #000;
	box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
	font-size: 1.2em !important;
	font-weight: bold !important;
	text-align: left !important;
	width:auto;
	padding:0 10px;
	border-bottom:none;
}


</style>

<div class="page-content">
	<div class="row">
		<div class="col-md-2">
			<?php $this->load->view('includes/leftbar'); ?>
		</div>
		<div class="col-md-10">

			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
				<div class="panel-heading"><h3><?php echo ucfirst($this->uri->segment(2));?></h3></div>
				<nav class="navbar navbar-dark stylish-color">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo site_url($this->uri->segment(1)); ?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>
						<li class="breadcrumb-item"><?php echo ucfirst($this->uri->segment(2));?></li>
						
					</ol>
				</nav>

				
				<div class="panel-body">

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
					$attributes = array('class' => 'form-horizontal', 'id' => 'addeditparticipant' , 'enctype' => 'multipart/form-data');

                                    //form validation
					echo validation_errors();

					echo form_open('contacts/do_update/', $attributes);
					?>             

					<div class="col-md-6"> <!--demographic-->
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Demographics</legend>
							<div class="panel-body">

								<div class="form-group">
									<label for="firstname" class="col-sm-3 control-label">First Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $locations['firstname'];?>" >                                                                
									</div>
								</div>
								<div class="form-group">
									<label for="firstname" class="col-sm-3 control-label">Last Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $locations['lastname'];?>" >                                                                
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Title</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="title" name="title" value="<?php echo $locations['title'];?>" >                                                                
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Email </label>
									<div class="col-sm-9">
										<input type="email" class="form-control" id="email" name="email" value="<?php echo $locations['email'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Email 2</label>
									<div class="col-sm-9">
										<input type="email" class="form-control" id="email2" name="email2" value="<?php echo $locations['email2'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Phone</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $locations['phone'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Phone Ext</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="phone_ext" name="phone_ext" value="<?php echo $locations['phone_ext'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Phone 2</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="phone2" name="phone2" value="<?php echo $locations['phone2'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Phone Ext 2</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="phone2_ext" name="phone2_ext" value="<?php echo $locations['phone2_ext'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Organization</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="organization" name="organization" value="<?php echo $locations['organization'];?>">                                                               
									</div>
								</div>

							</fieldset>
						</div> <!--end of demographic--> 

						<legend></legend>  

						<input type='hidden' name='contact_id' id="contact_id" value="<?php echo $contact_id;?>">
						<div class="form-group">
							<div class="col-sm-offset-5 col-sm-12">
								<button type="submit" name="savebtn" value="0" class="btn btn-primary">Save</button>
								<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("contacts"); ?>'">Cancel</button>			

							</div>
						</div>
						<?php echo form_close(); ?>       


					</div>


				</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
