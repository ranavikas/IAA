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
						<li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segment(2));?></li>
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
                          $attributes = array('class' => 'form-horizontal', 'id' => 'addeditquestion' , 'enctype' => 'multipart/form-data');

                          //form validation
                          echo validation_errors();
                          echo form_open('questions/update/'.$this->uri->segment(3).'', $attributes);
                         
                          ?>
                            <div class="col-md-12"> 
                                  <div class="panel-body">
                                 
                                        <div class="form-group ">
                                          <label for="question_type" class="col-sm-2 control-label">Format: </label>
                                           <div class="col-sm-3"> 
                                          <select name="question_type" id="question_type" class="form-control">
                                              <option value="1" <?php if($record[0]['question_type'] == 1) {?> selected="selected"  <?php } ?>>Single Choice</option>
                                             <option value="2" <?php if($record[0]['question_type'] == 2) {?> selected="selected"  <?php } ?>>Multiple Choice</option>
                                              <option value="3" <?php if($record[0]['question_type'] == 3) {?> selected="selected"  <?php } ?> >Free Text</option>
                                           </select>
                                           </div>
                                       </div>
                                        
                                       <div class="form-group">
                                         <label for="question" class="col-sm-2 control-label form-groupp required">Screener Question: </label>
                                         <div class="col-sm-6">
                                             <input type="text" class="form-control" id="question" name="question" value="<?php echo $record[0]['question']; ?>" >                                                               
                                         </div>
                                       </div>

                                        <div class="form-group ">
                                            <label for="question_option" class="col-sm-2 control-label">Question Options: </label>
                                           <div class="col-sm-6"> 
                                               <textarea class="form-control" name="question_option" id="question_option" placeholder="Textarea" rows="5" <?php if($record[0]['question_type'] == 3) {?> readonly  <?php } ?> ><?php echo $question_opt; ?></textarea>
                                            </div>
                                        </div>


                                   </div>
                       
                           </div> 
                                        
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                               <button type="reset" class="btn btn-primary btn-space" onclick="location.href='<?php echo site_url("questions"); ?>'">Cancel</button>			
                               <button type="submit" name="savebtn" value="0" class="btn btn-primary">Save</button>
                                 
                            </div>
                          </div>
                       <?php echo form_close(); ?>       
    
                                        
				</div>

  						
  			</div>
  	</div>
</div>
</div>

<script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript">        
 $(document).ready(function() {
	$('#question_type').change(function () {
            if ($('#question_type').val() == '3') {
               // $('#question_option').attr('readonly');
                $("#question_option").attr("readonly","readonly");
            }
            else {
               $('#question_option').removeAttr('readonly');
              
            }
        });

    });   // document ready function 
    
</script>