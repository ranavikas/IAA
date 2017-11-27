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
						<li class="breadcrumb-item">
                                                        <?php echo ucfirst($this->uri->segment(1));?>
                        </li>
						<li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segment(2));?></li>
					</ol>
				</nav>
				

				<!-- Add Button -->
				<a  href="<?php echo site_url("data").'/'.$this->uri->segment(2); ?>/add" class="btn btn-primary btn-sm" style="margin-left:15px;">Add Contacts</a>
				<a class="btn btn-primary btn-sm " style="margin-right:15px; float:right;" onclick="exportContactsTableToCSV('contacts.csv')">Export Contacts</a>
                              
				
				<!-- START Main Content -->
  				<div class="panel-body">
				
					<!-- Flash Message -->
                    <legend>
						<?php if($this->session->flashdata('success') === TRUE) { ?>
						<div class="alert alert-success"><a class="close" data-dismiss="alert">x</a><?php echo $this->session->flashdata('msg');?></div>
						<?php } ?>
										
						<?php if($this->session->flashdata('success') === FALSE) { ?>
						<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><?php echo $this->session->flashdata('msg');?></div>
						<?php } ?>
                    </legend>

                       
					
					<!-- table -->
                    <table class="table table-striped table-bordered" id="contactstable" name="">
						<thead>
							<tr>
								<th>First Name</th>
                                                                <th>Last Name</th>
                                                                <th>Title</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th class="editclas">Edit</th>
                                                                <th class="delclas">Delete</th>
                                                        </tr>
                                                </thead>
                        
						<tbody>
						<?php 	foreach ($records as $row)
								{
									echo '<tr>';
									echo '<td>'.$row['firstname'].'</td>';
                                                                        echo '<td>'.$row['lastname'].'</td>';
                                                                        echo '<td>'.$row['title'].'</td>';
                                                                        echo '<td>'.$row['email'].'</td>';
                                                                        echo '<td>'.$row['phone'].'</td>';
									echo '<td><a href="'.site_url("data").'/contacts/update/'.$row['contact_id'].'" style="color:#428bca;"><span class="glyphicon glyphicon-edit"></span></a></td>';  
									echo '<td><a href="'.site_url("data").'/contacts/delete/'.$row['contact_id'].'" class="delete" style="color:#428bca;"><span class="glyphicon glyphicon-minus-sign"></span></a></td>';  
									
									echo '</tr>';
								}
						?>
                         </tbody>
                    </table>
                                    
  				</div>
				
  			</div>

		  </div>
		</div>
    </div>