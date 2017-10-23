   <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                            <div class="panel-heading"><h3>Users</h3></div>
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
				
               <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/add" class="btn btn-primary btn-sm" style="margin-left:15px;">Add User</a>

                <a  href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>/changepassword" class="btn btn-primary btn-sm" style="margin-left:15px; float: right; margin-right: 15px;">Change Password</a>
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

                                    
                                        <table class="table table-striped table-bordered" id="example">
                                            <thead>
                                              <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Change Password</th>
                                                <th>Delete</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              
                                              <?php
                                              
                                             // echo '<pre>';
                                             // print_r($users);
                                              
                                                $num = 1;
                                                foreach($users as $row)
                                                {
                                                    //Only show active and inactive records
                                                    if($row['active'] == 1 || $row['active'] == 2)
                                                    {
                                                      echo '<tr>';

                                                      echo '<td>'.$row['first_name'].'</td>';
                                                      echo '<td>'.$row['last_name'].'</td>';
                                                      echo '<td>'.$row['username'].'</td>';
                                                      echo '<td>'.$row['email'].'</td>';
                                                      echo '<td >'.$this->Users_model->get_assign_roles($row['user_id']).'</td>';
                                                     
                                                        if($row['active']==1)
                                                            echo '<td style="color:#428bca;">'.'Active'.'</td>';

                                                        if($row['active']==2)
                                                            echo '<td style="color:#A9A9A9;">'.'InActive'.'</td>';

														
                                                       
                                                        echo '<td>
                                                          <a href="'.site_url("admin").'/users/update/'.$row['user_id'].'" style="color:#428bca;"><span class="glyphicon glyphicon-edit"></span></a>  
                                                        </td>';
                                                      
                                                        
                                                       
                                                         echo '<td>';
                                                            if($row['user_id'] != 1 && $row['user_id'] <> $active_user_id) { 
                                                                echo '<a href="'.site_url("admin").'/users/changepassword/'.$row['user_id'].'"   style="color:#428bca;"><i class="fa fa-key"></i></a>';
                                                            };
                                                        echo '</td>';
                                                                          
														
                                                     
                                                         echo '<td>';
                                                            if($row['user_id'] != 1 && $row['user_id'] <> $active_user_id) { 
                                                                echo '<a href="'.site_url("admin").'/users/delete/'.$row['user_id'].'" class="delete"  style="color:#428bca;"><span class="glyphicon glyphicon-minus-sign"></span></a>';
                                                            };
                                                        echo '</td>';
                                                                              
														
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