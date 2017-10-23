<div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                            <div class="panel-heading"><h3>Screener Questions</h3></div>
				<nav class="navbar navbar-dark stylish-color">
					<ol class="breadcrumb">
						<!--<li class="breadcrumb-item">
                                                        <?php echo ucfirst($this->uri->segment(1));?>
                        </li>
						<li class="breadcrumb-item active"><?php echo ucfirst($this->uri->segment(2));?></li>-->
					</ol>
				</nav>
				

				<!-- Add Button -->
				<a  href="<?php echo site_url("questions"); ?>/add" class="btn btn-primary btn-sm" style="margin-left:15px;">Add Questions</a>
				
				
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
                    <table class="table table-striped table-bordered" id="example" name="questioneer">
						<thead>
							<tr>
								<th>Question</th>
                                                                <th>Question Type</th>
                                                                <th>Last Modified</th>
                                                                <th>Edit</th>
								<th>Delete</th>
                                                        </tr>
                                                </thead>
                        
						<tbody>
						<?php 	foreach ($records as $row)
								{
								$last_date = new DateTime($row['last_modified']);
                                                                $mod_date =  $last_date->format('F j, Y');
                                                                
                                                                if($row['question_type'] == 1)
                                                                    $ques_type = 'Single Choice';
                                                                
                                                                if($row['question_type'] == 2)
                                                                    $ques_type = 'Multiple Choice';
                                                                
                                                                if($row['question_type'] == 3)
                                                                    $ques_type = 'Free Text';
                                                                
                                                                    echo '<tr>';
									echo '<td>'.$row['question'].'</td>';
                                                                        echo '<td>'.$ques_type.'</td>';
                                                                        echo '<td>'.$mod_date.'</td>';
									echo '<td><a href="'.site_url("questions").'/update/'.$row['id'].'" style="color:#428bca;"><span class="glyphicon glyphicon-edit"></span></a></td>';  
									echo '<td><a href="'.site_url("questions").'/delete/'.$row['id'].'" class="delete" style="color:#428bca;"><span class="glyphicon glyphicon-minus-sign"></span></a></td>';  
									
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