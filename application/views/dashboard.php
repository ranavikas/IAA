<div class="page-content">
	<div class="row">
		<div class="col-md-2">
			<?php $this->load->view('admin/includes/leftbar'); ?>
		</div>

		<div class="col-md-10">
		
			<?php 
				if($this->session->flashdata('flash_success')){
					echo SUCCESS_MSG_START.$this->session->flashdata('flash_success').MSG_END;
				}
				if($this->session->flashdata('flash_error')){
					echo ERROR_MSG_START.$this->session->flashdata('flash_error').MSG_END;
				}
			?>		
			

			<h1>Welcome to <?php echo PROJECT_NAME;?></h1>
			<br/><br/>
			
			<div class="content-box-large">
			<div class="panel panel-default" id="headings">
				<div class="panel-heading"><h3>Welcome back, <?php echo $user_fullname; ?>!</h3></div>
				<br/><br/> 
					
					<h4>Latest Activity</h4>
					<div id="menu">
						<div class="panel list-group">
						
						<a href="#" class="list-group-item" data-toggle="collapse" data-target="#clients" data-parent="#menu">NEW CLIENTS <span class="badge"><?php echo $new_clients_count;?></span></a>
						<div id="clients" class="sublinks collapse">
						<?php foreach($new_clients as $row) { ?>
						
							<a class="list-group-item small" href="admin/clients/view/<?php echo $row['client_id'];?>" target="_blank"><span class="glyphicon glyphicon-chevron-right"><?php echo $row['firstname'].' '.$row['lastname']; ?></span></a>
						<?php } ?>
						</div>
						
						<a href="#" class="list-group-item" data-toggle="collapse" data-target="#orders" data-parent="#menu">NEW ORDERS <span class="badge"><?php echo $new_orders_count;?></span></a>
						<div id="orders" class="sublinks collapse">
						<?php foreach($new_orders as $row) { ?>
						
							<a class="list-group-item small" href="admin/orders/view/<?php echo $row['id'];?>" target="_blank"><span class="glyphicon glyphicon-chevron-right"><?php echo $row['status_name'].' '.$row['job_id']; ?>
							<?php echo "- <strong>Client:</strong> ".$row['client_name']; ?>
							<?php echo "- <strong>Scope:</strong> ".$row['estimate_scope']; ?>
							</span></a>
						<?php } ?>
						</div>						
						
						</div>
						 
					</div>				

				
			</div>
			</div>
			
		</div>
	</div>
</div>



