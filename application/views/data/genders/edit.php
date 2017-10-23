<div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                           <div class="panel-heading"><h3>Genders</h3></div>
				<nav class="navbar navbar-dark stylish-color">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><?php echo ucfirst($this->uri->segment(1));?></li>
						<li class="breadcrumb-item"><a href="<?php echo site_url($this->uri->segment(1).'/'.$this->uri->segment(2)); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
						<li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segment(3));?></li>
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

					<div class="panel-body">
					<?php
						//form data
						$attributes = array('class' => '', 'id' => 'addeditgender' , 'enctype' => 'multipart/form-data');

						//form validation
						echo validation_errors();

						echo form_open('data/genders/update/'.$this->uri->segment(4).'', $attributes);
					?>
                                                    
						<fieldset>
							<div class="row">
                                                            <div class="form-group required control-label col-sm-4">
                                                              <label for="fname">First Name</label>
                                                              <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $record[0]['gender']; ?>" maxlength="25" >
                                                            </div>
                                                            <div class="form-group required control-label col-sm-4">
                                                              <label for="lname">Last Name</label>
                                                              <input type="text" class="form-control" id="gender_abbrv" name="gender_abbrv" value="<?php echo $record[0]['gender_abbreviation']; ?>" maxlength="2" >
                                                            </div>

                                                        </div> 
                                                    
							<button type="submit" name="savebtn" value="0" class="btn btn-primary">Save</button>
							<a  href="<?php echo site_url("data").'/'.$this->uri->segment(2); ?>/delete/<?php echo $this->uri->segment(4);?>" class="btn btn-primary delete" >Delete</a>
							<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("data/genders"); ?>'">Cancel</button>			
						</fieldset>
						
					<?php echo form_close(); ?>
				
					</div>
					
				</div>

  						
  			</div>
  	</div>
</div>
</div>