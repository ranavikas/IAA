<style>
    .multiselect{
        width: 245px !important;
        
    }
    
    .select-top {  
        margin-top: -15px;
    }
    
    .hideen {
        display: none;
      }
    </style>


<div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<?php $this->load->view('includes/leftbar'); ?>
		  </div>
		  <div class="col-md-10">

  			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
                            <div class="panel-heading"><h3>Studies</h3></div>
				<nav class="navbar navbar-dark stylish-color">
					<ol class="breadcrumb">
						
					</ol>
				</nav>
				

				<!-- Add Button -->
                                <a  href="<?php echo site_url("studies/add"); ?>"  class="btn btn-primary btn-sm" style="margin-left:15px;">Add Study</a>
                                <a  href="#"  class="btn btn-primary btn-sm copy_study " id="copy_study"  style=" float: right; margin-right:15px;" disabled>Copy Study</a>
				
				
				<!-- START Main Content -->
  				<div class="panel-body">
				
					<!-- Flash Message -->
                    <legend>
						<?php if($this->session->flashdata('success') === TRUE) { ?>
						<div class="alert alert-success"><a class="close" data-dismiss="alert">x</a><?php echo $this->session->flashdata('msg');?></div>
						<?php } ?>
										
						<?php if($this->session->flashdata('success') === FALSE) { ?>
						<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><?php echo $this->session->flashdata('msg');?></div>
						<?php } ?>
                    </legend>

                        <!--Search Section-->
                    <?php //echo form_open('admin/orders/search', ' method="GET"'); 
                        //echo form_open('studies', ' method="GET"'); 
                    ?>
                        <div class="panel panel-default" id="forms">
                                <div class="panel-heading">Search
                                </div>
                                <div class="panel-body">
                                          <fieldset>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="ethnicity" class="col-sm-1 control-label">Filter By : </label>
                                                        <div class="col-sm-2"> 
                                                            <select id="filter_by" class="form-control">
                                                                <option value="1">Year</option>
                                                                <option value="2">Client</option>
                                                                <option value="3">Product</option>
                                                                <option value="4">Product Type</option>
                                                                <option value="5">Study Status</option>
                                                                <option value="6">Location</option>

                                                             </select>
                                                        </div>
                                                    </div> 
                                                    
                                                    <div class="form-group">
                                                       <!--<label for="status">Year:   </label>-->
                                                       <div class="col-sm-2 select-top  filterSelect" >
                                                            
                                                       </div>
                                                       
                                                    
                                                       
                                                       <span class="col-sm-2 select-top" style="margin-left: 60px;" >
                                                            <button type="submit" class="btn btn-primary " id="savebtnfilter" name="search" value="Apply Filters">Search</button>
                                                            <button type="reset" class="btn btn-primary" onclick="location.href='<?php echo site_url("studies/"); ?>'">Clear</button>
                                                       </span>
                                                     </div> 
                                                    
                                                  
                                          </fieldset>
                                </div>
                        </div>
                    <?php //echo form_close(); ?>
                    <!--ENd Search Section-->
                       
                    <div class="filter-list-area">   
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
									
                                                    /*$st_date = new DateTime($row['start_date']);
                                                    $start_date =  $st_date->format('F j, Y');
                                                    
                                                    $en_date = new DateTime($row['end_date']);
                                                    $end_date =  $en_date->format('F j, Y');*/
                                                    
                                                    
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
                    </div>                
  				</div>
				
  			</div>

		  </div>
		</div>
    </div>

   