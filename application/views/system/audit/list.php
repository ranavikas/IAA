<div class="page-content">
	<div class="row">
	
	<div class="col-md-2">
	<?php $this->load->view('admin/includes/leftbar'); ?>
	</div>

<div class="col-md-10">
			<div class="row">  
			  <div class="col-md-12">     
				  <ol class="breadcrumb">
					<li>
						<?php echo anchor(site_url('dashboard'), 'Home') ?>
					</li>
				    <li>Audit logs</li> 
				  </ol>
			  </div>
			</div>
  			<div class="content-box-large">
			<a  href="<?php echo site_url("clear-audit-logs"); ?>" class="btn btn-success btn-sm" style="margin-left:15px;">Clear Audit Log</a>
  				
				<legend>
				<?php
				//flash messages
				if($this->session->flashdata('mail_log_msg') != '')
				{
					if($this->session->flashdata('mail_log_msg') == TRUE)
					{
						echo '<div class="alert alert-success">';
						echo '<a class="close" data-dismiss="alert">×</a>';
						echo '<strong>'.$this->session->flashdata('mail_log_msg').'</strong>';
						echo '</div>';       
					}
					else
					{
						echo '<div class="alert alert-error">';
						echo '<a class="close" data-dismiss="alert">×</a>';
						echo '<strong>'.$this->session->flashdata('mail_log_msg').'</strong>';
						echo '</div>';          
					}
				}
				?>
				</legend>	
				
				<div class="panel-heading">
					
				</div>
  				<div class="panel-body">
  					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="audit_logs_table" name="audit_logs_table">
						<thead>
							<tr>
                                <th>Page</th>
                                <th>Action</th>
                                <th>Record</th>
                                <th>User</th>
                                <th>Timestamp</th>
                            </tr>                
						</thead>
						<tbody>
						<?php
							for($i=0; $i<sizeof($res); $i++)
							{
								echo '<tr>';
								echo '<td>'.$res[$i]['page_name'].'</td>';
								echo '<td>'.$res[$i]['action'].'</td>';
								echo '<td>'.$res[$i]['record_id'].'</td>';
								echo '<td>'.$res[$i]['username'].'</td>';
								echo '<td>'.reversedateformat($res[$i]['action_ts']).'</td>';
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

   