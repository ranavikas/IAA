<style>
    .usergroup-btn.active{
               background-color: #5cb85c;
                border-color: #4cae4c;
    }
    </style>
        <!-- START Main Content -->
        <div class="panel-body">

              <div class="row col-sm-12 border-clas">
                    <div class="heading-txt col-sm-2">
                        <span id="groupname">RA Patients</span>
                        <span id="groupid" style="display:none;"></span>
                        <span id="studyid" style="display:none;"><?php echo $study_id;?></span>

                    </div>

                   <div class="heading-txt col-sm-2">
                       Need : <span id="groupparti">15</span>
                    </div>
                  <div class="heading-txt col-sm-2">
                        Screened :  <span class="screen">0</span>
                    </div>

                </div> 
                <div class="row col-sm-2 border-clas" >
                    <?php  foreach($usergroup as $row) { ?>
                     <a   data-id="<?php echo $row['id']; ?>" data-group="<?php echo $row['group_name']; ?>" data-screen="<?php echo $this->Studies_model->get_screen_count(3,$row['id']); ?>"  data-participant="<?php echo $row['number_of_participants']; ?>" class="btn btn-primary usergroup-btn usergroup" style="margin-left:15px;"><?php echo $row['group_name'] . '  ' .'('.$this->Studies_model->get_screen_count(3,$row['id']).'/'.$row['number_of_participants'].')'; ?></a>
                   <?php  }  ?>
                </div>
                <div class="row col-sm-10 border-clas"  >
                    <a href="#myModal" data-toggle="modal" data-target="#myModal" id="add_screen_question"  class="btn btn-primary potential-inner-btn" >Add Screener Questions</a>
                    <a href="#myModal" data-toggle="modal" data-target="#myModal" id="remove_screen_question"  class="btn btn-primary potential-inner-btn" >Remove Screener Questions</a>
                    <a href="#myModal" data-toggle="modal" data-target="#myModal" id="create_screen_question"  class="btn btn-primary potential-inner-btn" >Create New Screener Questions</a>
                    <a href="#myModal" data-toggle="modal" data-target="#myModal" id="new_participant"  class="btn btn-primary potential-inner-btn" >New Participant</a>
                    <a  class="btn btn-primary potential-inner-btn move_scheduled" id="moveSchedule" disabled>Move to Scheduled</a>
                    <a  href="#myModal" data-toggle="modal" data-target="#myModal" id="updateGroup"  class="btn btn-primary potential-inner-btn updateGroup" disabled>Update Usergroup</a>
                    <a  class="btn btn-primary potential-inner-btn remove_selected_screener" >Remove Selected from Screener</a>

                    <div  id="usergroup_participants_table" >

                    </div>
                </div>                       
        </div>	
