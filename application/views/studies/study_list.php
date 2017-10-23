<!-- table -->
        <table class="table table-striped table-bordered" id="example" name="study">
                <thead>
                        <tr>
                                <th></th>
                                <th>Client</th>
                                <th>Product Name</th>
                                <th>Product Type</th>
                                <th>Study Number</th>
                                <th>Type</th>
                                <th>Status</th>

                                <th>Total</th>
                                <th>Conditions</th>
                                <th>Dates</th>
                                <th>Location</th>
                        </tr>
                </thead>

                <tbody>
                <?php 	foreach ($records as $row)
                                {



                    $start_date = date("l, F jS, Y", strtotime($row['start_date'])); 
                    $end_date = date("l, F jS, Y", strtotime($row['end_date'])); 




                                        echo '<tr>';
                                        echo '<td><input type="checkbox" name="studies_id[]" class="study_ids"  id="studies_id"  value="'.$row['study_id'].'" ></td>';
                                        echo '<td>'.$row['client_name'].'</td>';
                                        echo '<td>'.$row['product_name'].'</td>';
                                        echo '<td>'.$row['product_type'].'</td>';                                                                    
                                        echo '<td><a href="'.site_url().'studies/study/'.$row['study_id'].'" target="blank" >'.$row['study_number'].'</a></td>'; 
                                        echo '<td>'.$row['study_type'].'</td>';
                                        echo '<td>'.$row['status_name'].'</td>';

                                        echo '<td>'.$this->Studies_model->get_total_participant($row['study_id']).'</td>';
                                        echo '<td>'.$this->Studies_model->get_medical_condition($row['study_id']).'</td>';
                                        echo '<td>'.$start_date.' - '.$end_date.'</td>';
                                        echo '<td>'.$this->Studies_model->get_study_location($row['study_id']).'</td>';

                                        echo '</tr>';
                                }
                ?>
                </tbody>
           </table>
                                    
 
				
  		
   