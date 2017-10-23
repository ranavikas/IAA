<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">    
<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">   

    <?php if($filter_id == '1'){?>
    
        <select class="form-control" name="study_year" id="study_year" style="width: 245px !important;">
            <?php  

             $selected='' ;
            $starting_year  =date('Y', strtotime('-15 year'));
            $ending_year = date('Y', strtotime('+1 year'));
            $study_year  =date('Y',  strtotime($study_year));

            for($starting_year; $starting_year <= $ending_year; $starting_year++) {

             
                    if(date('Y')==$starting_year) { //is the loop currently processing this year?
                      $selected='selected'; //if so, save the word "selected" into a variable
                   } else { 

                       $selected='' ; //otherwise, ensure the variable is empty
                   }
               //then include the variable inside the option element
               echo '<option '.$selected.'    value="'.$starting_year.'">'.$starting_year.'</option>';
            } ?>
        </select>

    <?php } if($filter_id == '2'){?>
    
         <select class="form-control" name="client_id[]" id="client-select" multiple="multiple">                                                           
          <?php         
              for( $i=0; $i<sizeof($clients_rec); $i++) {
             ?>
             <option value="<?php echo $clients_rec[$i]['client_id']; ?>"  ><?php echo $clients_rec[$i]['client_name']; ?></option>
          <?php }  ?>   
         </select>

    <?php } if($filter_id == '3'){?>
    
            <select class="form-control" name="product_id[]" id="product-select" multiple="multiple">

                <?php         
                    for( $i=0; $i<sizeof($products_rec); $i++) {
                   ?>
                <option value="<?php echo $products_rec[$i]['product_id']; ?>"  <?php if (!empty($product_ids)) { if(in_array($products_rec[$i]['product_id'] , $product_ids)){?> selected="selected"<?php }} ?> ><?php echo $products_rec[$i]['product_name']; ?></option>
                <?php }  ?>   
            </select>

    <?php } if($filter_id == '4'){?>
            <select class="form-control" name="product_type[]" id="product-type" multiple="multiple">
                <?php         
                    for( $i=0; $i<sizeof($products_type_rec); $i++) {
                   ?>
                <option value="<?php echo $products_type_rec[$i]['id']; ?>" <?php if (!empty($product_type)) { if(in_array($products_type_rec[$i]['id'] , $product_type)){?> selected="selected"<?php }} ?> ><?php echo $products_type_rec[$i]['product_type']; ?></option>
                <?php }  ?>   
            </select>

    <?php } if($filter_id == '5'){?>
                <select class="form-control" name="study_status[]" id="study_status" multiple="multiple">
                    <?php         
                        for( $i=0; $i<sizeof($study_status_rec); $i++) {
                       ?>
                    <option value="<?php echo $study_status_rec[$i]['id']; ?>" <?php if (!empty($study_status)) { if(in_array($study_status_rec[$i]['id'] , $study_status)){?> selected="selected"<?php }} ?> ><?php echo $study_status_rec[$i]['status_name']; ?></option>
                    <?php }  ?>   
                </select>

    <?php }if($filter_id == '6'){?>
        <select class="form-control" name="study_location[]" id="study_location" multiple="multiple">
                                                             
            <?php         
                for( $i=0; $i<sizeof($location_rec); $i++) {
               ?>
            <option value="<?php echo $location_rec[$i]['location_id']; ?>" <?php if (!empty($study_location)) { if(in_array($location_rec[$i]['location_id'] , $study_location)){?> selected="selected"<?php }} ?> ><?php echo $location_rec[$i]['location_name']; ?></option>
            <?php }  ?>   
        </select>

    <?php }?>
<script type="text/javascript">
      $(document).ready(function() {
     	$('#client-select').multiselect({
     		enableFiltering: true,
     		includeSelectAllOption: true,
     		maxHeight: 400,
     		dropUp: false
     	});
     	
     	$('#product-select').multiselect({
     		enableFiltering: true,
     		includeSelectAllOption: true,
     		maxHeight: 400,
     		dropUp: false
     	});
     	$('#product-type').multiselect({
     		enableFiltering: true,
     		includeSelectAllOption: true,
     		maxHeight: 400,
     		dropUp: false
     	});
     	$('#study_status').multiselect({
     		enableFiltering: true,
     		includeSelectAllOption: true,
     		maxHeight: 400,
     		dropUp: false
     	});
     	$('#study_location').multiselect({
     		enableFiltering: true,
     		includeSelectAllOption: true,
     		maxHeight: 400,
     		dropUp: false
     	});

             

     }); //end fo document.ready function   

</script>
    