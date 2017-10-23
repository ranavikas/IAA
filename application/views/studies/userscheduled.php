<style type="text/css">
    /*scrolling*/
    .search-table, td, th{border-collapse:collapse; border:1px solid #777;}
    th{padding:20px 7px; font-size:15px; color:#444; background:#66C2E0;}
    td{padding:5px 10px; height:35px;}

    .search-table-outter { overflow-x: scroll; overflow-y: scroll; max-height: 680px;}
    .width-20 { min-width: 20px; } 
    .width-50 { min-width: 50px; }        
    .width-70 { min-width: 70px; }
    .width-100 { min-width: 100px; }
    .width-120 { min-width: 120px; }
</style>
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
              
        <div class="search-table-outter wrapper"> 
          <table class="table table-striped table-bordered sorted_table search-table inner" id="userscheduled" name="medical_conditions_list">
              
              <thead class="sorted_head">
                                              <tr>
                                                      <th class="width-20"></th>
                                                      <th class="width-120">Status</th>
                                                       <th class="width-50">Photolog Notes</th>
                                                      <th class="width-50">First Name</th>
                                                      <th class="width-30">MI</th>
                                                      <th class="width-50">Last Name</th>
                                                      <th class="width-50">Gender</th>
                                                      <th class="width-50">Age</th>
                                                      <th class="width-70">Ethnicity</th>
                                                      <th class="width-70">Occupation</th>
                                                        <?php 
                                                         //echo '<pre>';
                                                         //print_r($usergroup_question);
                                                        if (!empty($usergroup_question)) {
                                                            foreach ($usergroup_question as $qrow)
                                                            {
                                                               echo '<th class="width-100">'.$qrow['question'].'</th>';
                                                            }
                                                        }
                                                        ?>
                                              </tr>
                                      </thead>

                                      <tbody>
                                      <?php 	foreach ($records as $row)
                                                      {
                                                              echo '<tr class="scheduledUser">';
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
                                                              
                                                              echo '<td>Noteeeee</td>'; 
                                                              echo '<td>'.$row['firstname'].'</td>';
                                                              echo '<td>'.$row['middlename'].'</td>';
                                                              echo '<td>'.$row['lastname'].'</td>';
                                                              echo '<td>'.$row['gender'].'</td>';
                                                              echo '<td>'.$row['age'].'</td>';
                                                              echo '<td>'.$row['ethnicity'].'</td>';
                                                              echo '<td>'.$row['occupation'].'</td>';
                                                                if (!empty($usergroup_question)) {
                                                                    foreach ($usergroup_question as $qrow)
                                                                    {
                                                                       echo '<td>'.$this->Studies_model->get_scheduled_question_option($qrow['id'] , $qrow['question_type'] ,$row['participant_id'] , $usergroup_id ).'</td>';
                                                                      
                                                                    }
                                                                }
                                                              echo '</tr>';
                                                      }
                                      ?>
               </tbody>
          </table>  
        </div>   
    <!--for export table-->      
          <?php echo form_close(); ?> 
    <!--for export table-->  
    <div  id="exportprintDiv" style="display: none;">   
          <table class="table table-striped table-bordered">
              
                                      <thead>
                                              <tr>
                                                      <th> Participant ID</th>
                                                      <th>Status</th>
                                                       <th>Photolog Notes</th>
                                                      <th>First Name</th>
                                                      <th>MI</th>
                                                      <th>Last Name</th>
                                                      <th>Gender</th>
                                                      <th>Age</th>
                                                      <th>Ethnicity</th>
                                                      <th>Occupation</th>
                                                        <?php 
                                                         //echo '<pre>';
                                                         //print_r($usergroup_question);
                                                        if (!empty($usergroup_question)) {
                                                            foreach ($usergroup_question as $qrow)
                                                            {
                                                               echo '<th>'.$qrow['question'].'</th>';
                                                            }
                                                        }
                                                        ?>
                                              </tr>
                                      </thead>

                                      <tbody>
                                      <?php 	foreach ($records as $row)
                                                      {
                                                              echo '<tr>';
                                                              echo '<td>'.$row['participant_id'].'</td>';
                                                            
                                                              echo '<td>'.$this->Studies_model->study_participant_status_byid($row['study_participant_status']).'</td>';
                                                              
                                                              echo '<td>Noteeeee</td>'; 
                                                              echo '<td>'.$row['firstname'].'</td>';
                                                              echo '<td>'.$row['middlename'].'</td>';
                                                              echo '<td>'.$row['lastname'].'</td>';
                                                              echo '<td>'.$row['gender'].'</td>';
                                                              echo '<td>'.$row['age'].'</td>';
                                                              echo '<td>'.$row['ethnicity'].'</td>';
                                                              echo '<td>'.$row['occupation'].'</td>';
                                                                if (!empty($usergroup_question)) {
                                                                    foreach ($usergroup_question as $qrow)
                                                                    {
                                                                       echo '<td>'.$this->Studies_model->export_scheduled_question_option($qrow['id'] , $qrow['question_type'] ,$row['participant_id'] , $usergroup_id ).'</td>';
                                                                      
                                                                    }
                                                                }
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
     <!-- jQuery UI -->
  <script src="<?php echo ASSET_PATH;?>js/jquery-sortable.js"></script>
<script type="text/javascript">
    
   /*$(function () {
            setInterval(function () {
                $.post("<?php echo site_url('studies/usergroup_participant'); ?>", $("#questionanswer").serialize());
            }, 10000);
        });*/
        
        $(document).ready(function() {
            var rowCount = $("#userscheduled > tbody").children().length;
            //alert(rowCount);
            $(".screen").html(rowCount);

         });
     
     
   // Sortable rows
        $('.sorted_table').sortable({
          containerSelector: 'table',
          itemPath: '> tbody',
          itemSelector: 'tr',
          placeholder: '<tr class="placeholder"/>'
        });

        // Sortable column heads
        var oldIndex;
        $('.sorted_head tr').sortable({
          containerSelector: 'tr',
          itemSelector: 'th',
          placeholder: '<th class="placeholder"/>',
          vertical: false,
          onDragStart: function ($item, container, _super) {
            oldIndex = $item.index();
            $item.appendTo($item.parent());
            _super($item, container);
          },
          onDrop: function  ($item, container, _super) {
            var field,
                newIndex = $item.index();

            if(newIndex != oldIndex) {
              $item.closest('table').find('tbody tr').each(function (i, row) {
                row = $(row);
                if(newIndex < oldIndex) {
                  row.children().eq(newIndex).before(row.children()[oldIndex]);
                } else if (newIndex > oldIndex) {
                  row.children().eq(newIndex).after(row.children()[oldIndex]);
                }
              });
            }

            _super($item, container);
          }
        });     
        
        
</script>