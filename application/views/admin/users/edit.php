 <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                           <div class="panel-heading"><h3>Users</h3></div>
				<nav class="navbar navbar-dark stylish-color" style="margin-bottom :0px !important;">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
                                                    <a href="<?php echo site_url("admin"); ?>">
                                                     <?php echo ucfirst($this->uri->segment(1));?>
                                                    </a> 
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo site_url("admin/users"); ?>">
                                                     <?php echo ucfirst($this->uri->segment(2));?>
                                                    </a> 
                                                </li>
						<li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segment(3));?></li>
					</ol>
				</nav>
				
  				<div class="panel-body">
                                    <legend>
                                      <?php
                                        //flash messages
                                        if($this->session->flashdata('flash_message')){
                                          if($this->session->flashdata('flash_message') == 'updated')
                                          {
                                            echo '<div class="alert alert-success">';
                                              echo '<a class="close" data-dismiss="alert">×</a>';
                                              echo '<strong>Well done!</strong> User updated with success.';
                                            echo '</div>';       
                                          }else{
                                            echo '<div class="alert alert-error">';
                                              echo '<a class="close" data-dismiss="alert">×</a>';
                                              echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
                                            echo '</div>';          
                                          }
                                        }
                                        ?>
                                    </legend>
  					<div class="panel panel-default" id="forms">
						<div class="panel-heading">User
						</div>
						<div class="panel-body">
							<?php
                                                        //form data
                                                        $attributes = array('class' => '', 'id' => 'addedituser' , 'enctype' => 'multipart/form-data');

                                                        //form validation
                                                        echo validation_errors();

                                                        echo form_open('admin/users/update/'.$this->uri->segment(4).'', $attributes);
                                                        ?>
                                                    
							  <fieldset>
								<div class="row">
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="fname">First Name</label>
                                                                      <input type="text" class="form-control" id="firstname" name="fname" value="<?php echo $user[0]['first_name']; ?>" >
                                                                    </div>
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="lname">Last Name</label>
                                                                      <input type="text" class="form-control" id="lastname" name="lname" value="<?php echo $user[0]['last_name']; ?>" >
                                                                    </div>
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="uname">UserName</label>
                                                                      <input type="text" class="form-control" id="username" name="username" value="<?php echo $user[0]['username']; ?>" >
                                                                    </div>
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="form-group required control-label col-sm-4">
                                                                      <label for="email">Email</label>
                                                                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $user[0]['email']; ?>" >
                                                                    </div>
                                                                    
                                                                     <div class="form-group  col-sm-4">
                                                                      <label for="status">Status</label>			
                                                                        <select name="record_status" id="record_status" class="form-control" <?php if( $user[0]['user_id'] == 1) echo "readonly"; ?>>
										<option value="1"  <?php if($user[0]['active'] == 1) {?> selected="selected" <?php }?>>Active</option>
                                                                                <option value="2" <?php if($user[0]['active'] == 2) {?> selected="selected" <?php }?>>Inactive</option>
									</select>
                                                                    </div>	
																	
                                                                    	
                                                                </div>
                           							
								<div class="row">
                                                                   <div class="form-group col-sm-4">
                                                                      <label for="role">User Role</label>
                                                                      
                                                                     <div id="" style="overflow-y: scroll; height:200px; border:1px solid #ddd;">
                                                                            <table id="myTable" class="table table-striped table-bordered" >

                                                                             <?php       
                                                                                 foreach($rec_user_role as $row) {
                                                                             ?>   
                                                                                <tr>
                                                                                    <td><input type="checkbox" name="user_role[]" value="<?php echo $row['role_id']; ?>" <?php if (!empty($roles_edit)) { if(in_array($row['role_id'] , $roles_edit)){echo 'checked="checked"';}} ?>> <?php echo $row['role']; ?></td>

                                                                                </tr>
                                                                               <?php }  ?>    

                                                                              </table>    
                                                                        </div> 
                                                                    </div>	
                                                                </div>
									
								<button type="submit" class="btn btn-primary">Save</button>
								<button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("admin/users"); ?>'">Cancel</button>
								
							  </fieldset>
							<?php echo form_close(); ?>
				
						</div>
					</div> 
				</div>

  						
  			</div>
  		</div>
  		</div>

	</div>