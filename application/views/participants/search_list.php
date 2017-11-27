<div class="panel-body">	
 <table class="table table-striped table-bordered" id="example" name="study">
    <thead>
            <tr>
                    
                    <th>First Name</th>
                    <th>MI</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <!--<th>Education</th>
                    <th>Occupation</th>
                    <th>Company</th>
                    <th>IAA Classification</th>
                    <th>Phone number 1</th>
                    <th>Phone number 2</th>
                    <th>City/State</th>
                    <th>Notes</th>
                    <th>Edit</th>-->

            </tr>
    </thead>

    <tbody>
    <?php 	foreach ($records as $row)
                    {
                            echo '<tr>';
                            echo '<td>'.$row['firstname'].'</td>';
                            echo '<td>'.$row['middlename'].'</td>';
                            echo '<td>'.$row['lastname'].'</td>';
                            echo '<td>'.$row['gender'].'</td>';
                            echo '<td>'.$row['age'].'</td>';
                            /*echo '<td>'.$row['education_level'].'</td>';
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
                            */
                            echo '</tr>';
                    }
    ?>
             </tbody>
        </table>
</div>

 <script src="https://code.jquery.com/jquery.js"></script>
 <script src="<?php echo ASSET_PATH;?>vendors/datatables/js/jquery.dataTables.min.js"></script>
 <script src="<?php echo ASSET_PATH;?>vendors/datatables/dataTables.bootstrap.js"></script>
 <script src="<?php echo ASSET_PATH;?>js/tables.js"></script>