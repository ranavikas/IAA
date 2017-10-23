<div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                           <div class="panel-heading"><h3>Contacts</h3></div>
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
						$attributes = array('class' => '', 'id' => 'addeditcontact' , 'enctype' => 'multipart/form-data');

						//form validation
						echo validation_errors();

						echo form_open('data/contacts/update/'.$this->uri->segment(4).'', $attributes);
					?>
                                                    
						<fieldset>
							<div class="row">
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="fname">First Name</label>
                                                                      <input type="text" class="form-control" id="firstname" name="fname" value="<?php echo $record[0]['firstname']; ?>" >
                                                                    </div>
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="lname">Last Name</label>
                                                                      <input type="text" class="form-control" id="lastname" name="lname" value="<?php echo $record[0]['lastname']; ?>" >
                                                                    </div>
                                                                    
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="fname">Title</label>
                                                                      <input type="text" class="form-control" id="title" name="title" value="<?php echo $record[0]['title']; ?>" >
                                                                    </div>
                                                                    <div class="form-group  control-label col-sm-4">
                                                                      <label for="lname">Organization</label>
                                                                      <input type="text" class="form-control" id="organization" name="organization" value="<?php echo $record[0]['organization']; ?>" >
                                                                    </div>
                                                                    
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="email">Email</label>
                                                                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $record[0]['email']; ?>" >
                                                                    </div>
                                                                    <div class="form-group col-sm-4">
                                                                      <label for="email">Alternate Email</label>
                                                                      <input type="text" class="form-control" id="email" name="alt_email" value="<?php echo $record[0]['email2']; ?>" >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group required control-label col-sm-3">
                                                                      <label for="email">Phone</label>
                                                                      <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $record[0]['phone']; ?>" >
                                                                    </div>
                                                                    <div class="form-group col-sm-1">
                                                                      <label for="email">Ext</label>
                                                                      <input type="text" class="form-control" id="phone_ext" name="phone_ext" value="<?php echo $record[0]['phone_ext']; ?>" maxlength="3">
                                                                    </div>
                                                                    <div class="form-group col-sm-3">
                                                                      <label for="pass">Alternate Phone</label>
                                                                      <input type="text" class="form-control" id="alt_phone" name="alt_phone" value="<?php echo $record[0]['phone2']; ?>" >
                                                                    </div>
                                                                    <div class="form-group col-sm-1">
                                                                      <label for="cpass">Ext</label>
                                                                      <input type="text" class="form-control" id="alt_phone_ext" name="alt_phone_ext" value="<?php echo $record[0]['phone2_ext']; ?>" maxlength="3" >
                                                                    </div>
                                                                </div>
                                                                
                                                             						  
							<button type="submit" name="savebtn" value="0" class="btn btn-primary">Save</button>
							<a  href="<?php echo site_url("data").'/'.$this->uri->segment(2); ?>/delete/<?php echo $this->uri->segment(4);?>" class="btn btn-primary delete" >Delete</a>
							<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("data/contacts"); ?>'">Cancel</button>			
						</fieldset>
						
					<?php echo form_close(); ?>
				
					</div>
					
				</div>

  						
  			</div>
  	</div>
</div>
</div>