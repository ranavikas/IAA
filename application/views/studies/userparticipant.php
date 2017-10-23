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
<!--<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">-->
<div class="page-content">
    <div class="row">
        <div class="col-md-12">
              <!-- table -->
          <?php
            //form data
            $attributes = array('class' => 'form-horizontal','name' => 'questionanswer', 'id' => 'questionanswer' , 'enctype' => 'multipart/form-data');

            //form validation
            echo validation_errors();

            echo form_open('studies/usergroup_participant', $attributes);
            ?>
          <div class="search-table-outter wrapper">   
          <table  class="table table-striped table-bordered  sorted_table search-table inner" name="medical_conditions_list">
              <?php 
              //echo '<pre>';
             // print_r($adit_column);
               $gender = '';
               $age = '';
               $ethinicity = '';
               $occupation = '';
              
              for($i = 0 ; $i<count($adit_column) ; $i++){
                  
                 if($adit_column[$i]['column_name'] == 'age')
                     $age = $adit_column[$i]['column_value'];
                
                 if($adit_column[$i]['column_name'] == 'gender')
                     $gender = $adit_column[$i]['column_value'];
                 
                 if($adit_column[$i]['column_name'] == 'ethnicity')
                     $ethinicity = $adit_column[$i]['column_value'];
                 
                 if($adit_column[$i]['column_name'] == 'occupation')
                     $occupation = $adit_column[$i]['column_value'];
                  
                  
              }
              ?>
                                      <thead class="sorted_head">
                                                
                                          
                                              <tr >
                                                  <th class="width-20"></th>
                                                      <th class="width-120">Status</th>
                                                      <th class="width-50">First Name</th>
                                                      <th class="width-30">MI</th>
                                                      <th class="width-70">Last Name</th>
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
                                          <tr>
                                                      <td class="width-20"></td>
                                                      <td class="width-120"></td>
                                                      <td class="width-50"></td>
                                                      <td class="width-30"></td>
                                                      <td class="width-70"></td>
                                                      <td class="width-50"><input type="text" name="columnnn-gender-<?php echo $usergroup_id; ?>" value="<?php echo $gender; ?>" style="width: 70px;"></td>
                                                      <td class="width-50"><input type="text" name="columnnn-age-<?php echo $usergroup_id; ?>" value="<?php echo $age; ?>" style="width: 70px;"></td>
                                                      <td class="width-70"><input type="text" name="columnnn-ethnicity-<?php echo $usergroup_id; ?>" value="<?php echo $ethinicity; ?>" style="width: 70px;"></td>
                                                      <td class="width-70"><input type="text" name="columnnn-occupation-<?php echo $usergroup_id; ?>" value="<?php echo $occupation; ?>" style="width: 70px;"></td>
                                                        <?php 
                                                        if (!empty($usergroup_question)) {
                                                            foreach ($usergroup_question as $qrow)
                                                            {
                                                               echo '<td class="width-100">'.''.'</td>';
                                                            }
                                                        }
                                                        ?>
                                                </tr>
                                          
                                          
                                      <?php 	foreach ($records as $row)
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
                                                                 echo '</select></td>';
                                                              
                                                               
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
                                                                       echo '<td>'.$this->Studies_model->get_question_option($qrow['id'] , $qrow['question_type'] ,$row['participant_id'] , $usergroup_id ).'</td>';
                                                                       //echo '<td>'.$qrow['id'].'-'.$qrow['question_type'].'-'.$row['participant_id'].'-'.$usergroup_id.'</td>';
                                                                    }
                                                                }
                                                              echo '</tr>';
                                                      }
                                      ?>
                                           
               </tbody>
          </table>  
              
          </div> <!--wrapper-->    
              
          <?php echo form_close(); ?>        
        </div>
    </div>

   
</div>

<script src="https://code.jquery.com/jquery.js"></script>


 <script src="<?php echo ASSET_PATH;?>js/jquery-sortable.js"></script>
 
 <script src="<?php echo ASSET_PATH;?>bootstrap/js/bootstrap.min.js"></script>
 <script src="<?php echo ASSET_PATH;?>bootstrap/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
    
   $(function () {
            setInterval(function () {
                $.post("<?php echo site_url('studies/usergroup_participant'); ?>", $("#questionanswer").serialize());
            }, 10000);
        }); 
     
     	
     	$('.participnats').click(function() {
    
     		var checked = []
     		$("input[name='participant_idss[]']:checked").each(function ()
     		{
     			checked.push(parseInt($(this).val()));
     		});
     		
     		
     		if (checked != '') {
            //alert('select one');    
            
            $('#updateGroup').removeAttr('disabled');
            $('#moveSchedule').removeAttr('disabled');
        } else {
            //  alert('not select any one');  
           
            $('#updateGroup').attr('disabled', 'disabled');
            $('#moveSchedule').attr('disabled', 'disabled');
        }
        
        
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
        
        
        $(document).ready(function() {
            var rowCount = $("#userscheduled > tbody").children().length;
            //alert(rowCount);
            $(".screen").html(rowCount);
            
                $('.potential-select').multiselect({
                    enableFiltering: true,
                    includeSelectAllOption: true,
                    maxHeight: 400,
                    dropUp: false
                });
                
                
                $(".btn-group").click(function(){
                  
                    $(this).toggleClass("open");
                });

         }); 
            
        
</script>
