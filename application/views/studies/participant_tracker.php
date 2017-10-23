<div class="page-content">
    <div class="row">
        <div class="col-md-12">

          <table class="table table-striped table-bordered " id="" name="">
              
                                      <thead>
                                              <tr>
                                                      <th>User Groups</th>
                                                      <th>Need</th>
                                                      <th>Have</th>
                                                      <th>Still Need</th>
                                                      <th>Payment</th>
                                                      <th>Total</th>
                                                      
                                              </tr>
                                      </thead>
                                      
                                      <tbody>
                                      <?php 	
                                            $total_need = 0;
                                            $total_have = 0;
                                            $total_still_need = 0;
                                            $total_payment = 0;
                                            foreach ($participant_tracker as $row)
                                              {

                                                    $have = $this->Studies_model->participant_have_count(6 ,$row['study_group_id']);
                                                    $still_need = $row['number_of_participants'] - $have;
                                                    
                                                    
                                                    $total_need += $row['number_of_participants'];
                                                    $total_have += $have;
                                                    $total_still_need += $still_need;
                                                    $total_payment += $row['total_payment'];
                                                    

                                                    echo '<tr>'; 
                                                      echo '<td>'.$row['group_name'].'</td>';
                                                      echo '<td>'.$row['number_of_participants'].'</td>';
                                                      echo '<td>'.$have.'</td>';
                                                      echo '<td>'.$still_need.'</td>';
                                                      echo '<td>'.'$'.number_format($row['payment_amount'], 1, ".", ",").'</td>';
                                                      echo '<td>'.'$'.number_format($row['total_payment'], 1, ".", ",").'</td>';
                                                    echo '</tr>';
                                              }
                                                    echo '<tr>'; 
                                                      echo '<td>'.''.'</td>';
                                                      echo '<td>'.$total_need.'</td>';
                                                      echo '<td>'.$total_have.'</td>';
                                                      echo '<td>'.$total_still_need.'</td>';
                                                      echo '<td>'.''.'</td>';
                                                      echo '<td>'.'$'.number_format($total_payment, 1, ".", ",").'</td>';
                                                    echo '</tr>';
                                      ?>
               </tbody>
          </table>  
   
        </div>
    </div>
</div>