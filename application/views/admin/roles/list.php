   <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                            <div class="panel-heading"><h3>User Roles</h3></div>
				<nav class="navbar navbar-dark stylish-color">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
                                                    <a href="<?php echo site_url("admin"); ?>">
                                                        <?php echo ucfirst($this->uri->segment(1));?>
                                                    </a> 
                                                </li>
						<li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segment(2));?></li>
					</ol>
				</nav>
				
             <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-primary btn-sm" style="margin-left:15px;">Add User Role</a>
  				<div class="panel-body">
                                    <legend>
                                      <?php
                                        //flash messages
                                        if(isset($flash_message)){
                                          if($flash_message == TRUE)
                                          {
                                            echo '<div class="alert alert-success">';
                                              echo '<a class="close" data-dismiss="alert">×</a>';
                                              echo '<strong>Well done!</strong> new Umrah created with success.';
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

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                              <tr>
                                                <th>User Roles</th>
                                                <th>Description</th>
                                                <th>Color</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              
                                              <?php
                                                $num = 1;
                                                foreach($roles as $row)
                                                {
												  //Only show active and inactive records
												  if($row['record_status'] == 1 || $row['record_status'] == 2)
												  {
                                                  echo '<tr>';

                                                  echo '<td>'.$row['role'].'</td>';
                                                  echo '<td>'.$row['description'].'</td>';
                                                  echo '<td style="color:'.$row['color'].'">'.$row['color'].'</td>';
                                                  
												  if($row['record_status']==1)
													   echo '<td style="color:#428bca;">'.'Active'.'</td>';
												   
                                                  if($row['record_status']==2)
													   echo '<td style="color:#A9A9A9;">'.'InActive'.'</td>';
                                                 

												 
                                                  echo '<td>
                                                    <a href="'.site_url("admin").'/roles/update/'.$row['role_id'].'" style="color:#428bca;"><span class="glyphicon glyphicon-edit"></span></a>  
                                                  </td>';
                                                  
												
												   
												    
												   if($row['role_id'] != 1) { 
												    echo '<td>';
													
                                                   echo '<a href="'.site_url("admin").'/roles/delete/'.$row['role_id'].'" class="delete"  style="color:#428bca;"><span class="glyphicon glyphicon-minus-sign"></span></a>';
												   
												   echo '</td>';
                                                   };
													
												  
                                                  echo '</tr>';
                                                                  $num++;
												  }
                                                }
                                                ?> 
                                            </tbody>
                                        </table>
                                    </div>
  				</div>
  			</div>

		  </div>
		</div>
    </div>