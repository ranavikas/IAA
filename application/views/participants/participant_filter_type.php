<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">    
<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">   

<?php 
$filter_field = explode(',', $filter_id);
?>


    <?php if(in_array(1, $filter_field)) {
        ?>
    
         <div class="form-group">
                <div class="col-sm-1">
                 <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                    <input type="text" class="form-control" value="Ethnicity" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                    <select name="ethnicity" id="ethnicity" class="form-control">
                        <option value="" >Select Ethnicity</option>
                        <?php         
                            foreach($ethnicity_rec as $row) {
                                 if ($row['ethnicity_id'] == $ethnicity)
                                     $sel = 'selected';
                                 else
                                     $sel = '';
                        ?>
                        <option value="<?php echo $row['ethnicity_id']; ?>" <?php echo $sel;?> ><?php echo $row['ethnicity']; ?></option>
                        <?php }  ?>   
                    </select>
               </div>
                <div class="clear-dev"></div>
            </div>

            

    <?php } if(in_array(2, $filter_field)){?>
    
         <div class="form-group">
                <div class="col-sm-1">
                <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="Employer" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                    <input type="text" class="form-control" list="elist" id="employer" name="employer" value="" >
                        <datalist id="elist">
                        <?php    

                         foreach($parti_employer_rec as $row) {
                        ?>

                            <option value="<?php echo $row['parti_employer']; ?>" ><?php echo $row['parti_employer']; ?></option>

                        <?php }  ?> 
                        </datalist>
               </div>
                  <div class="clear-dev"></div>
            </div>

    <?php } if(in_array(3, $filter_field)){?>
    
        <div class="form-group">
            <div class="col-sm-1">
            <a class="deleter" href="javascript:void(0);">x</a>                                                             
             </div>
            <div class="col-sm-5">
            <input type="text" class="form-control" value="City" readonly>                                                                
            </div>
           <div class="col-sm-6"> 
                  <input type="text" class="form-control" id="city" name="city" value="" > 
           </div>
              <div class="clear-dev"></div>
        </div>

    <?php } if(in_array(4, $filter_field)){?>
           <div class="form-group">
                <div class="col-sm-1">
                <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="Zip" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                      <input type="text" class="form-control" id="zip" name="zip" value="" > 
               </div>
                  <div class="clear-dev"></div>
            </div>

    <?php } if(in_array(5, $filter_field)){?>
            <div class="form-group">
                <div class="col-sm-1">
                <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="Transportation" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                    <select name="transport" id="transport" class="form-control">
                      <option value="" >Select Transportation</option>
                        <option value="1">Own Car</option>
                            <option value="2">Public Transport</option>
                              <option value="3">Family Member/Friend</option>
                                <option value="4" >Outreach</option>
                                  <option value="5">No Transportation</option>
                                    <option value="6" >Car Service</option>
                    </select>    
               </div>
                  <div class="clear-dev"></div>
            </div>

    <?php } if(in_array(6, $filter_field)) {?>
            <div class="form-group">
                <div class="col-sm-1">
                <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="ESL" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                    <select name="esl" id="esl" class="form-control">
                        <option value="" >Select ESL</option>
                        <option value="1">No</option>  
                        <option value="2" >Yes</option>

                      </select>     
               </div>
                  <div class="clear-dev"></div>
            </div>
  <?php } if(in_array(7, $filter_field)) {?>
            <div class="form-group">
                <div class="col-sm-1">
                <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="Need Wheelchair" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                    <select name="need_wheelchair" id="need_wheelchair" class="form-control">
                        <option value="" >Select wheelchair access</option>
                        <option value="1" >No</option>
                        <option value="2">Yes</option>

                    </select>    
               </div>
                  <div class="clear-dev"></div>
            </div>
  <?php } if(in_array(8, $filter_field)) {?>
            <div class="form-group">
                <div class="col-sm-1">
                <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="Deceased" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                   <input type="checkbox" name="deceased" id="deceased" value="1" class="">
               </div>
                  <div class="clear-dev"></div>
            </div>
  <?php } if(in_array(9, $filter_field)) {?>
            <div class="form-group">
                <div class="col-sm-1">
                <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="Do Not Call" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                   <input type="checkbox" name="do_not_call" id="do_not_call" value="1" class="">   
               </div>
                  <div class="clear-dev"></div>
            </div>
  <?php } if(in_array(10, $filter_field)) {?>
            <div class="form-group">
                <div class="col-sm-1">
                <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="Do Not Email" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                   <input type="checkbox" name="do_not_email" id="do_not_email" value="1" class="">     
               </div>
                  <div class="clear-dev"></div>
            </div>
  <?php } if(in_array(11, $filter_field)) {?>
            <div class="form-group">
                <div class="col-sm-1">
                <a class="deleter" href="javascript:void(0);">x</a>                                                             
                 </div>
                <div class="col-sm-5">
                <input type="text" class="form-control" value="IAA Classification" readonly>                                                                
                </div>
               <div class="col-sm-6"> 
                    <select name="participant_classfication" id="participant_classfication" class="form-control">
                        <option value="">Select Classification</option>    
                       <?php         
                                foreach($classification_rec as $row) {
                                     if ($row['classification_id'] == $classification)
                                         $sel = 'selected';
                                     else
                                         $sel = '';
                            ?>
                            <option value="<?php echo $row['classification_id']; ?>" <?php echo $sel;?> ><?php echo $row['classification']; ?></option>
                            <?php }  ?>   
                   </select>    
               </div>
                  <div class="clear-dev"></div>
            </div>
         
    <?php }?>
<script src="https://code.jquery.com/jquery.js"></script>
<script type="text/javascript">
    
      $(document).ready(function() {
          
          $('.deleter').on('click', function(){
            $(this).closest('div.form-group').remove();
          });
     }); //end fo document.ready function   

</script>
    