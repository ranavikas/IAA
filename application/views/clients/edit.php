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
				<div class="panel-heading"><h3><?php echo ucfirst($this->uri->segment(3));?></h3></div>
				<nav class="navbar navbar-dark stylish-color">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo site_url('data/'.$this->uri->segment(2)); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
						<li class="breadcrumb-item"><?php echo ucfirst($this->uri->segment(3));?></li>
						
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

					echo form_open('data/clients/do_update/', $attributes);
					?>             

					<div class="col-md-6"> <!--demographic-->
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Demographics</legend>
							<div class="panel-body">

								<div class="form-group">
									<label for="firstname" class="col-sm-3 control-label form-groupp required">Client Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="client_name" name="client_name" value="<?php echo $clients['client_name'];?>" required>                                                                
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Default Location</label>
									<div class="col-sm-9">
										<select class='form-control' id="default_location" name='default_location'>
											<option value='0'></option>
											<?php foreach($locations_list as $locations) { ?>
											<option value='<?php echo $locations['location_id'];?>' <?php if ($clients['default_location'] == $locations['location_id']) { echo "selected"; } ?>>
												<?php echo $locations['location_name'];?>
											</option>
											<?php } ?>	                                                              
										</select> 
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Default Contact</label>
									<div class="col-sm-9">
										<select class='form-control' id="default_contact" name='default_contact'>
											<option value='0'></option>
											<?php foreach($contacts_list as $contacts) { ?>
											<option value='<?php echo $contacts['contact_id'];?>' <?php if ($clients['default_contact'] == $contacts['contact_id']) { echo "selected"; } ?>>
												<?php echo $contacts['firstname']." ".$contacts['lastname'];?>
											</option>
											<?php } ?>	                                                              
										</select> 
									</div>
								</div>
								<div class="form-group">
									<label for="firstname" class="col-sm-3 control-label">Shipping Carrier</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="shipping_carrier" name="shipping_carrier" value="<?php echo $clients['shipping_carrier'];?>" >                                                                
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-3 control-label">Shipping Account</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="shipping_account" name="shipping_account" value="<?php echo $clients['shipping_account'];?>" >                                                                
									</div>
								</div>

							</fieldset>
						</div> <!--end of demographic--> 

						<legend></legend>  

						<input type='hidden' name='client_id' id="client_id" value="<?php echo $client_id;?>">
						<div class="form-group">
							<div class="col-sm-offset-5 col-sm-12">
								<button type="submit" name="savebtn" value="0" class="btn btn-primary">Save</button>
								<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("data/clients"); ?>'">Cancel</button>			

							</div>
						</div>
						<?php echo form_close(); ?>       


					</div>


				</div>
			</div>
		</div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
	<script>
	$("#addeditparticipant").on("submit", function(event){ 

		event.preventDefault();

		var client_name = $("#client_name").val().trim();
		if ( client_name.length == '0' ) {

			alert('Please Enter Client Name');
			$("#client_name").focus();
		}else {
			$(this).submit();
		}

	});
	</script>
