<div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                            <div class="panel-heading"><h3>Participants</h3></div>
				<nav class="navbar navbar-dark stylish-color">
					<ol class="breadcrumb">
						
						
					</ol>
				</nav>
				

				<!-- Add Button -->
				<a  href="<?php echo site_url().$this->uri->segment(1); ?>/add" class="btn btn-primary  btn-sm" style="margin-left:15px;">Add Participant</a>
				<a  href="<?php echo site_url().$this->uri->segment(1); ?>/search" class="btn btn-primary  btn-sm" style="margin-left:15px;">Participant Search</a>
				
                                <a class="btn btn-primary btn-sm " style="margin-right:15px; float:right;" onclick="exportParticipantTableToCSV('participant.csv')">Export Participant</a>
                                <a href="#myModal" data-toggle="modal" data-target="#myModal" id="selected_study"  class="btn btn-primary btn-sm modalLinkStudy" style="margin-right:15px; float:right;" disabled>Add Selected to Study</a>
				
				
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
                    <table class="table table-striped table-bordered table-compact table-hover table-order-column " id="example1" name="medical_conditions_list">
						<thead>
							<tr>
                                                                <th class="participnats">  <input type="checkbox" id="checkAll">  </th>
								<th>First Name</th>
                                                                <th>MI</th>
                                                                <th>Last Name</th>
                                                                <th>Gender</th>
                                                                <th>Age</th>
                                                                <th>Education</th>
                                                                <th>Occupation</th>
                                                                <th>Company</th>
                                                                <th>IAA Classification</th>
                                                                <th>Phone number 1</th>
                                                                <th>Phone number 2</th>
                                                                <th>City/State</th>
                                                                <th>Notes</th>
                                                                <th>Edit</th>
								
                                                        </tr>
                                                </thead>
                        
						<tbody>
						<?php 	foreach ($records as $row)
								{
									echo '<tr>';
                                                                        echo '<td><input type="checkbox" name="participnat_ids[]" class="participnats" id="participnat_id"  value="'.$row['participant_id'].'" ></td>';
									echo '<td>'.$row['firstname'].'</td>';
                                                                        echo '<td>'.$row['middlename'].'</td>';
                                                                        echo '<td>'.$row['lastname'].'</td>';
                                                                        echo '<td>'.$row['gender'].'</td>';
                                                                        echo '<td>'.$row['age'].'</td>';
                                                                        echo '<td>'.$row['education_level'].'</td>';
                                                                        echo '<td>'.$row['occupation'].'</td>';
                                                                        echo '<td>'.$row['employer'].'</td>';
                                                                        echo '<td>'.$row['classification'].'</td>';
                                                                        echo '<td>'.$row['phone'].'</td>';
                                                                        echo '<td>'.$row['alternate_phone'].'</td>';
                                                                        $citystate = '';
                                                                        if($row['city'] != '')
                                                                        {
                                                                            $citystate = $row['city'];
                                                                             
                                                                            if($row['state'] != '')
                                                                            $citystate .= '/'.$row['state'];
                                                                        }
                                                                        else{
                                                                             if($row['state'] != '')
                                                                            $citystate .= $row['state'];   
                                                                        }
                                                                        echo '<td>'.$citystate.'</td>';
                                                                        
                                                                        $nootes = '';
                                                                        
                                                                        if($row['do_not_call'] != '')
                                                                        {
                                                                            $nootes = 'Do not call';
                                                                             
                                                                            if($row['do_not_email'] != '')
                                                                            $nootes .= '/'.'Do not email';
                                                                            
                                                                            if($row['decreased'] != '')
                                                                            $nootes .= '/'.'Deceased';
                                                                            
                                                                        }
                                                                        
                                                                        if($row['do_not_email'] != '' && $row['do_not_call'] == '')
                                                                        {
                                                                            $nootes = 'Do not email';
                                                                            
                                                                            if($row['decreased'] != '')
                                                                            $nootes .= '/'.'Deceased';
                                                                        }
                                                                        
                                                                        if($row['decreased'] != '' && $row['do_not_call'] == '' && $row['do_not_email'] == '')
                                                                        {
                                                                            $nootes = 'deceased';
                                                                        }
                                                                        
                                                                        
                                                                        echo '<td>'.$nootes.'</td>';
                                                                        
                                                                        
									echo '<td><a href="'.site_url().'participants/update/'.$row['participant_id'].'" style="color:#428bca;"><span class="glyphicon glyphicon-edit"></span></a></td>';  
									
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



   <table class="table table-striped table-bordered" id="participantcsvDiv" style="display:none;">
    <thead>
            <tr>
                   
                    <th>DOB</th>
                    <th>Ethnicity</th>
                    <th>Employer</th>
                    <th>User Groups</th>
                    <th>Email</th>
                    <th>Email2</th>
                    <th>Zip</th>
                    <th>Transportation</th>
                    <th>ESL</th>
                    <th>Needs Wheelchair Access</th>
                    <th>Do Not Call</th>
                    <th>Do not email</th>
                    <th>Deceased</th>
                    <th>Photolog Notes</th>

            </tr>
    </thead>

    <tbody>
    <?php 	foreach ($csv_records as $row)
                    {
                           
                            echo '<tr>';
                            echo '<td>'.$row['dob'].'</td>';
                            echo '<td>'.$row['ethnicity'].'</td>';
                            echo '<td>'.$row['employer'].'</td>';
                            
                            $all_group = '';
                            
                            $medical_condition = $this->Participants_model->get_participant_medical_name($row['participant_id']);
                             if (!empty($medical_condition)) {
                                $all_group =  implode(' | ', $medical_condition);
                            }
                            $user_grouppp = $this->Participants_model->get_participant_usergroup_name($row['participant_id']);
                            if (!empty($user_grouppp)) {
                                $all_group .= ' | ';
                                $all_group .=  implode(' | ', $user_grouppp);
                            }
                             
                            $occuppp = $this->Participants_model->get_participant_occupation_name($row['participant_id']);
                            
                            if (!empty($occuppp)) {
                                $all_group .= ' | ';
                                $all_group .=  implode(' | ', $occuppp);
                             }
                            
                            //echo '<pre>';
                            //print_r($occuppp);
                            
                            echo '<td>'.$all_group.'</td>';
                            echo '<td>'.$row['email'].'</td>';
                            echo '<td>'.$row['alternate_email'].'</td>';
                            echo '<td>'.$row['zip'].'</td>';
                            
                            $transport = '';
                            if($row['transportation'] == '1'){ $transport = 'Own Car';}
                            if($row['transportation'] == '2'){ $transport = 'Public Transport';}
                            if($row['transportation'] == '3'){ $transport = 'Family Member/Friend';}
                            if($row['transportation'] == '4'){ $transport = 'Outreach';}
                            if($row['transportation'] == '5'){ $transport = 'No Transportation';}
                            if($row['transportation'] == '6'){ $transport = 'Car Service';}
                            
                            echo '<td>'.$transport.'</td>';
                            
                            $esl = '';
                            if($row['esl'] == '1'){ $esl = 'No';}else{ $esl = 'Yes'; }
                            echo '<td>'.$esl.'</td>';
                            
                            
                            $wheelchair = '';
                            if($row['need_wheelchair'] == '1'){ $wheelchair = 'No';}else{ $wheelchair = 'Yes'; }
                            echo '<td>'.$wheelchair.'</td>';
                            
                            
                            $do_not_call = '';
                            if($row['do_not_call'] == '1'){ $do_not_call = 'Yes';}
                            echo '<td>'.$do_not_call.'</td>';
                            
                            $do_not_email = '';
                            if($row['do_not_email'] == '1'){ $do_not_email = 'Yes';}
                            echo '<td>'.$do_not_email.'</td>';
                            
                            $decreased = '';
                            if($row['decreased'] == '1'){ $decreased = 'Yes';}
                            echo '<td>'.$decreased.'</td>';
                            
                            $photoloog = '';
                            
                            
                            if($row['photo_src'] != '' && $row['classification'] == ''){
                               $photoloog  = $row['photo_src'];
                            }
                            
                            if($row['classification'] != '' && $row['photo_src'] == ''){
                               $photoloog  = $row['classification'];
                            }
                            
                            if($row['classification'] != '' && $row['photo_src'] != ''){
                               $photoloog  = $row['classification'].' | '. $row['photo_src'];
                            }
                            
                            
                            echo '<td>'.$photoloog.'</td>';
                           
                            
                            echo '</tr>';
                    }
    ?>
         </tbody>
    </table>




<!-- model -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content-study modal-lg">
        </div>
    </div>
</div>
<style>
@media (min-width: 768px) {
  .modal-dialog {
    width: 1080px !important;
    margin: 30px auto;
  }
  .modal-content {
    -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
  }
  .modal-sm {
    width: 300px;
  }
}

button.close {
    margin-top: 20px;
    margin-right: 20px;
}

</style>

 <script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript">

 
 $(document).ready(function() {
          $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
            });
    });
 
 </script>