<script src="https://code.jquery.com/jquery.js"></script>
<style>
    .input-sm{
        width: 84px;
    }
    .select-box-width{
        width: 150px;
    }
    </style>
 <?php
    //form data
    $attributes = array('class' => 'form-horizontal','name' => 'iaa_schedule', 'id' => 'iaa_schedule' , 'enctype' => 'multipart/form-data');

    //form validation
    echo validation_errors();

    echo form_open('studies/iaa_schedules', $attributes);
    ?>
     <input type="hidden" name="study_id" value="<?php echo $study_id;?>">
<div class="page-content">
    <div class="row" >
        <div class="col-md-12">
            <?php 
              $n = 1;
            for($i=0; $i<count($record); $i++)
            {   
                
                
            $day = 86400; // Day in seconds  
            $format = 'Y-m-d'; // Output format (see PHP date funciton)  
            $sTime = strtotime($record[$i]['start_date']); // Start as time  
            $eTime = strtotime($record[$i]['end_date']); // End as time  
            $numDays = round(($eTime - $sTime) / $day) + 1;  
            $total_days = array();  

            for ($d = 0; $d < $numDays; $d++) {  
                $total_days[] = date($format, ($sTime + ($d * $day)));  
            }  
          
                foreach ($total_days as $day)
                {
                    
                  
                    
                 
                    
                ?>
            <div class="row col-sm-6 " ><?php 
            
                $originalDate = "2010-03-21";
                $newDate = date("l, F jS, Y", strtotime($day));                    
            echo $newDate;
            ?>  <input type="hidden" name="lists[<?php echo $n;?>]" value="<?php echo $day;?>"> </div>
            <div class="row col-sm-6 " style="float: right; text-align: right;" ><a  onclick="exportScheduleTableToCSVOnly<?php echo $n;?>('scheduleonly.csv')" ><div class="csvIcon"></div></a> Location:<?php echo $record[$i]['location_name']; ?></div>
                <table class="table table-striped table-bordered " id="" name="">
                             <thead>
                                            <tr>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Name</th>
                                                <th>User Type</th>
                                                <th>Training Condition</th>
                                                <th>Status</th>
                                                <th>P#</th>
                                                      
                                            </tr>
                                      </thead>
                                        <?php 
                                        
                                         $schedule = $this->Studies_model->get_saved_schedule($study_id , $day);
                                            //echo '<pre>';
                                           //print_r($schedule); 
                                        for($w = 0 ; $w<6 ; $w++)
                                        {
                                          if(count($schedule) > 0)
                                          {
                                           $start_time        =  $schedule[$w]['start_time'];
                                           $end_time          =  $schedule[$w]['end_time'];
                                           $participant       =  $schedule[$w]['participant'];
                                           $user_group        =  $schedule[$w]['user_group'];
                                           $group_name        =  $schedule[$w]['group_name'];
                                           $training_condition = $schedule[$w]['training_condition'];
                                           $participant_statuss = $schedule[$w]['participant_status'];
                                           $participant_order  = $schedule[$w]['participant_order'];

                                          }else{
                                              $start_time        =  '';
                                              $end_time          =  '';
                                              $participant       =  '';
                                              $user_group        =  '';
                                              $group_name        =  '';
                                              $training_condition = '';
                                              $participant_statuss = '';
                                              $participant_order  = '';
                                          }     

                                        ?>      
                                      <tbody>
                                            <tr>
                                               
                                                <td><input class="form-control input-sm"  type="text" name="list[<?php echo $n;?>][<?php echo $w;?>][]" placeholder="hh:mm:ss" value="<?php echo $start_time;?>"></td>
                                                <td><input class="form-control input-sm" type="text" name="list[<?php echo $n;?>][<?php echo $w;?>][]" placeholder="hh:mm:ss" value="<?php echo $end_time; ?>"></td>
                                                <td>
                                                       <select name="list[<?php echo $n;?>][<?php echo $w;?>][]" class="form-control select-box-width study_participant">
                                                        <?php 
 
                                                           for($j=0; $j<count($study_participant); $j++)
                                                            { 
                                                               $participant_user_type = $study_participant[$j]['participant_id'].'-'.$study_participant[$j]['user_group'];  
                                                               $put = $participant.'-'.$user_group;
                                                               if ($participant_user_type == $put)
                                                                     $sel = 'selected';
                                                                 else
                                                                     $sel = ''; 

                                                        ?>
                                                        <option value="<?php echo $participant_user_type; ?>"  <?php echo $sel;?> data-id="<?php echo $study_participant[$j]['group_name'];?>"><?php echo $study_participant[$j]['firstname'].' '.$study_participant[$j]['lastname']; ?></option>
                                                        <?php  }  ?>   
                                                       </select>
                                                    
                                                </td>
                                                <td><input type="text" class="form-control input-sm twoo"  value="<?php echo $group_name;?>" readonly="readonly"></td>
                                                <td>
                                                    <select name="list[<?php echo $n;?>][<?php echo $w;?>][]" id="status" class="form-control select-box-width">
                                                        <option value="1" <?php  if($training_condition == '1'){?> selected<?php } ?>>Training</option>
                                                         <option value="2" <?php  if($training_condition == '2'){?> selected<?php } ?> >Untrained</option>
                                                    </select> 
                                                </td>
                                                <td>
                                                   <select name="list[<?php echo $n;?>][<?php echo $w;?>][]" id="participant_status" class="form-control select-box-width">
                                                        <?php 
                                                        
                                                           for($k=0; $k<count($participant_status); $k++)
                                                            { 
                                                                 if ($participant_status[$k]['id'] == $participant_statuss)
                                                                     $sel = 'selected';
                                                                 else
                                                                     $sel = ''; 

                                                        ?>
                                                        <option value="<?php echo $participant_status[$k]['id']; ?>" <?php echo $sel;?>><?php echo $participant_status[$k]['status']; ?></option>
                                                        <?php  }  ?>   
                                                       </select>
                                                
                                                
                                                </td>
                                                <td><input class="form-control input-sm" min="1" type="number" name="list[<?php echo $n;?>][<?php echo $w;?>][]" value="<?php echo $participant_order;?>"></td>
                                            </tr>
                                           
                                    </tbody>
                                <?php }?>
                                                
                </table>  
                <?php
                    
                $n++;
                }
            }        
                ?> 
        </div>
    </div>

    <!--for printing purpose-->
    <div class="row schedule-export "  id="scheduleexportprintDiv" style="display:none;">
        <div class="col-md-12">
            <?php 
              $n = 1;
            for($i=0; $i<count($record); $i++)
            {   
                
                
            $day = 86400; // Day in seconds  
            $format = 'Y-m-d'; // Output format (see PHP date funciton)  
            $sTime = strtotime($record[$i]['start_date']); // Start as time  
            $eTime = strtotime($record[$i]['end_date']); // End as time  
            $numDays = round(($eTime - $sTime) / $day) + 1;  
            $total_days = array();  

            for ($d = 0; $d < $numDays; $d++) {  
                $total_days[] = date($format, ($sTime + ($d * $day)));  
            }  
          
                foreach ($total_days as $day)
                {
               
                
                $newDate = date("l, F jS, Y", strtotime($day));                    
            //echo $newDate;
            ?> 
            
                <table class="table table-striped table-bordered "   id="csvOnly<?php echo $n;?>" name="">
                             <thead>
                                             <tr>
                                                 <th><?php echo $day; ?></th>
                                                 <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                 <th>Location:<?php echo $record[$i]['location_name']; ?></th>
                                               
                                            </tr>
                                                <tr>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Name</th>
                                                <th>User Type</th>
                                                <th>Training Condition</th>
                                                <th>Status</th>
                                                <th>P#</th>
                                                      
                                            </tr>
                                      </thead>
                                        <?php 
                                        
                                         $schedule = $this->Studies_model->get_saved_schedule($study_id , $day);
                                            //echo '<pre>';
                                           //print_r($schedule); 
                                        for($w = 0 ; $w<6 ; $w++)
                                        {
                                          if(count($schedule) > 0)
                                          {
                                           $start_time        =  $schedule[$w]['start_time'];
                                           $end_time          =  $schedule[$w]['end_time'];
                                           $participant       =  $schedule[$w]['participant'];
                                           $user_group        =  $schedule[$w]['user_group'];
                                           $group_name        =  $schedule[$w]['group_name'];
                                           $training_condition = $schedule[$w]['training_condition'];
                                           $participant_statuss = $schedule[$w]['participant_status'];
                                           $participant_order  = $schedule[$w]['participant_order'];

                                          }else{
                                              $start_time        =  '';
                                              $end_time          =  '';
                                              $participant       =  '';
                                              $user_group        =  '';
                                              $group_name        =  '';
                                              $training_condition = '';
                                              $participant_statuss = '';
                                              $participant_order  = '';
                                          }     

                                        ?>      
                                      <tbody>
                                            <tr>
                                               
                                                <td><?php echo $start_time;?></td>
                                                <td><?php echo $end_time; ?></td>
                                                <td>
                                                    <?php echo $this->Studies_model->get_participant_name($participant); ?>
                                                </td>
                                                <td><?php echo $group_name;?></td>
                                                <td>
                                                     
                                                    <?php  
                                                    if($training_condition == '1'){
                                                        echo 'Training';
                                                     } 
                                                     
                                                    if($training_condition == '2'){
                                                        echo 'Untrained';
                                                     } 
                                                     ?>

                                                </td>
                                                <td>
                                                <?php   echo $this->Studies_model->get_participant_status_name($participant_statuss);  ?>
                                                </td>
                                                <td><?php echo $participant_order;?> </td>
                                            </tr>
                                           
                                    </tbody>
                                <?php }?>
                                                
                </table>
                <script type="text/javascript">      
                      function exportScheduleTableToCSVOnly<?php echo $n;?>(filename) {
                          $(".schedule-export").css("display" , "block");
                          // $(".particpnatt").css("display" , "block");

                          var csv = [];
                          var rows = document.getElementById("csvOnly<?php echo $n;?>").querySelectorAll("table tr");

                          for (var i = 0; i < rows.length; i++) {
                              var row = [], cols = rows[i].querySelectorAll("td, th");

                              for (var j = 0; j < cols.length; j++) 
                                  row.push(cols[j].innerText);

                              csv.push(row.join(","));        
                          }
                         // $(".statuss").css("display" , "none");
                         // $(".particpnatt").css("display" , "none");
                          $(".schedule-export").css("display" , "none");
                          // Download CSV file
                          downloadCSV(csv.join("\n"), filename);
                      }   
              </script>            
            
            
                <?php
                    
                $n++;
                }
            }        
                ?> 
        </div>
    </div>
    <!--for printing-->
    
</div>
<?php echo form_close(); ?>   
    

<script type="text/javascript">
    
   $(function () {
            setInterval(function () {
                $.post("<?php echo site_url('studies/iaa_schedules'); ?>", $("#iaa_schedule").serialize());
            }, 10000);
        });
        
    $('.study_participant').on('change', function(e) {
        e.preventDefault();
        //alert( this.value );
        var cur_val =  $(this).find(':selected').attr('data-id');
        //var items = cur_val.split('-');
        
       $(this).closest('tr').find('.twoo').val(cur_val);
      
      });
      
      
        $(document).ready(function() { 
          
                $('.study_participant').each(function() {
                    
                    
                   //var cur_val = $('.study_participant :selected').val();
                    //alert(cur_val);
                   //var items = cur_val.split('-');
                  
                   var cur_val = $('.study_participant :selected').attr('data-id');
                  
                   if($(this).closest('tr').find('.twoo').val() == '')
                   {    
                        $(this).closest('tr').find('.twoo').val(cur_val);
                   } 
        
        });
           
        });
        
  </script>      
    