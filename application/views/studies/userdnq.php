<div class="page-content">
    <div class="row">
        <div class="col-md-12">
              <!-- table -->
          <?php
            //form data
            $attributes = array('class' => 'form-horizontal','name' => 'schedualquestionanswer', 'id' => 'questionanswer' , 'enctype' => 'multipart/form-data');

            //form validation
            echo validation_errors();

            echo form_open('studies/usergroup_participant', $attributes);
            ?>
              
        
          <table class="table table-striped table-bordered sorted_table" id="" name="medical_conditions_list">
              
                                      <thead>
                                              <tr>
                                                      <th></th>
                                                      <th>Status</th>
                                                      <th>First Name</th>
                                                      <th>MI</th>
                                                      <th>Last Name</th>
                                                      <th>Gender</th>
                                                      <th>Age</th>
                                                      <th>Ethnicity</th>
                                                      <th>Occupation</th>
                                                       <th>DNQ Studies</th>  
                                              </tr>
                                      </thead>

                                      <tbody>
                                      <?php 	foreach ($dnq_records as $row)
                                                      {
                                                              echo '<tr>';
                                                              echo '<td><input type="checkbox" name="participant_idss[]" class="participnats" id="participant_id"  value="'.$row['participant_id'].'" ></td>';
                                                            
                                                              echo '<td><select name="statuus-'.$row['participant_id'].'-'.$usergroup_id.'"  id="client_id" class="form-control">';
                                                              
                                                                          
                                                                      foreach($study_participant_status as $srow) {

                                                                           if ($row['study_participant_status'] == $srow['id'])
                                                                               $sel = 'selected';
                                                                           else
                                                                               $sel = '';
                                                                 
                                                                        echo '<option value="'.$srow['id'].'" '.$sel.'>'.$srow['status'].'</option>';
                                                                    }  
                                                                 echo '</td>';
                                                              
                                                              echo '<td>'.$row['firstname'].'</td>';
                                                              echo '<td>'.$row['middlename'].'</td>';
                                                              echo '<td>'.$row['lastname'].'</td>';
                                                              echo '<td>'.$row['gender'].'</td>';
                                                              echo '<td>'.$row['age'].'</td>';
                                                              echo '<td>'.$row['ethnicity'].'</td>';
                                                              echo '<td>'.$row['occupation'].'</td>';
                                                               echo '<td>'.$this->Studies_model->get_dnq_studies($row['study_id']).'</td>';  
                                                              echo '</tr>';
                                                      }
                                      ?>
               </tbody>
          </table>  
           
    <!--for export table-->      
          <?php echo form_close(); ?> 
    <!--for export table-->  
    <div  id="exportprintDnq" style="display: none;">   
          <table class="table table-striped table-bordered">
              
                                      <thead>
                                              <tr>
                                                      <th> Participant ID</th>
                                                      <th>Status</th>
                                                      
                                                      <th>First Name</th>
                                                      <th>MI</th>
                                                      <th>Last Name</th>
                                                      <th>Gender</th>
                                                      <th>Age</th>
                                                      <th>Ethnicity</th>
                                                      <th>Occupation</th>
                                                      <th>DNQ Studies</th>  
                                              </tr>
                                      </thead>

                                      <tbody>
                                      <?php 	foreach ($dnq_records as $row)
                                                      {
                                                              echo '<tr>';
                                                              echo '<td>'.$row['participant_id'].'</td>';
                                                            
                                                              echo '<td>'.$this->Studies_model->study_participant_status_byid($row['study_participant_status']).'</td>';
                                                            
                                                              echo '<td>'.$row['firstname'].'</td>';
                                                              echo '<td>'.$row['middlename'].'</td>';
                                                              echo '<td>'.$row['lastname'].'</td>';
                                                              echo '<td>'.$row['gender'].'</td>';
                                                              echo '<td>'.$row['age'].'</td>';
                                                              echo '<td>'.$row['ethnicity'].'</td>';
                                                              echo '<td>'.$row['occupation'].'</td>';
                                                              echo '<td>'.$row['study_id'].'</td>';
                                                              echo '</tr>';
                                                      }
                                      ?>
               </tbody>
          </table>   
        </div> 
    <!--end export table-->  
    
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
    
   /*$(function () {
            setInterval(function () {
                $.post("<?php echo site_url('studies/usergroup_participant'); ?>", $("#questionanswer").serialize());
            }, 10000);
        });*/
        
</script>