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

					echo form_open('data/locations/do_update/', $attributes);
					?>             

					<div class="col-md-6"> <!--demographic-->
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Demographics</legend>
							<div class="panel-body">

								<div class="form-group">
									<label for="firstname" class="col-sm-2 control-label form-groupp required">Locaion Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="location_name" name="location_name" value="<?php echo $locations['location_name'];?>" required>                                                                
									</div>
								</div>
								<div class="form-group">
									<label for="firstname" class="col-sm-2 control-label">Address 1</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="address1" name="address1" value="<?php echo $locations['address1'];?>" >                                                                
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-2 control-label">Address 2</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="address2" name="address2" value="<?php echo $locations['address2'];?>" >                                                                
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-2 control-label">City</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="city" name="city" value="<?php echo $locations['city'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-2 control-label">State</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="state" name="state" value="<?php echo $locations['state'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-2 control-label">Zip</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="zip" name="zip" value="<?php echo $locations['zip'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-2 control-label">Email</label>
									<div class="col-sm-10">
										<input type="email" class="form-control" id="zip" name="email" value="<?php echo $locations['email'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-2 control-label">Phone</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $locations['phone'];?>">                                                               
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-sm-2 control-label">Location Type</label>
									<div class="col-sm-10">
										<select class='form-control' id="location_type" name='location_type'>
											<?php foreach($location_type as $type) { ?>
											<option value='<?php echo $type['id'];?>' <?php if ($locations['location_type'] == $type['id']) { echo "selected"; } ?>>
												<?php echo $type['location_type'];?>
											</option>
											<?php } ?>	                                                              
										</select> 
									</div>
								</div>

							</fieldset>
						</div> <!--end of demographic--> 

						<legend></legend>  

						<input type='hidden' name='location_id' id="location_id" value="<?php echo $location_id;?>">
						<div class="form-group">
							<div class="col-sm-offset-5 col-sm-12">
								<button type="submit" name="savebtn" value="0" class="btn btn-primary">Save</button>
								<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("data/locations"); ?>'">Cancel</button>			

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

		var location_name = $("#location_name").val().trim();
		if ( location_name.length == '0' ) {

			alert('Please Enter Location Name');
			$("#location_name").focus();
		}else {
			$(this).submit();
		}

	});
	</script>
