<div class="page-content">
	<div class="row">
		<div class="col-md-2">
			<?php $this->load->view('includes/leftbar'); ?>
		</div>
		<div class="col-md-10">

			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
				<div class="panel-heading"><h3>Contacts</h3></div>
				<nav class="navbar navbar-dark stylish-color">
					<ol class="breadcrumb">
						
						
					</ol>
				</nav>
				

				<!-- Add Button -->
				<a  href="<?php echo site_url('data/').$this->uri->segment(2); ?>/update" class="btn btn-primary btn-sm" style="margin-left:15px;">Add Clients</a>
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


					
					<!-- table -->
					<table class="table table-striped table-bordered" id="example" name="medical_conditions_list">
						<thead>
							<tr>
								<th></th>
								<th>Client Name</th>
								<th>Default Location</th>
								<th>Default Contact</th>
								<th>Shipping Carrier</th>
								<th>Shipping Account</th>
								<th>Edit</th>
								
							</tr>
						</thead>

						<tbody>
							<?php 	foreach ($records as $row)
							{
								echo '<tr>';
								echo '<td><input type="checkbox" name="location_ids[]" class="clients" id="client_id"  value="'.$row['client_id'].'" ></td>';
								echo '<td>'.$row['client_name'].'</td>';
								echo '<td>'.$row['location_name'].'</td>';
								echo '<td>'.$row['firstname'].' '.$row['lastname'].'</td>';
								echo '<td>'.$row['shipping_carrier'].'</td>';
								echo '<td>'.$row['shipping_account'].'</td>';
								echo '<td><a href="'.site_url('data/').'clients/update/'.$row['client_id'].'" style="color:#428bca;"><span class="glyphicon glyphicon-edit"></span></a>
								<a class="delete_class" href="javascript:void(0);" data-id="'.$row['client_id'].'" style="color:#428bca; float:right;"><span class="fa fa-remove"></span></a>
								</td>';  

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

<!-- model -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content-study modal-lg">
		</div>
	</div>
</div>
<style>
@media (min-width: 768px) {
	.modal-dialog {
		width: 1080px !important;
		margin: 30px auto;
	}
	.modal-content {
		-webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
		box-shadow: 0 5px 15px rgba(0, 0, 0, .5);
	}
	.modal-sm {
		width: 300px;
	}
}

button.close {
	margin-top: 20px;
	margin-right: 20px;
}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script>

var url  = "<?php echo site_url('data/'); ?>";

$(".delete_class").on("click", function(){ 

	var id = $(this).attr('data-id');
	var sure = confirm("Are you sure to Delete?");

	if ( sure ) {

		$.post(url+'clients/delete', {id:id}, function(){ 

			location.replace(url+'clients');
		});
	}

});

</script>