<div class="page-content">
	<div class="row">
		<div class="col-md-2">
			<?php $this->load->view('includes/leftbar'); ?>
		</div>
		<div class="col-md-10">

			<!--<div class="content-box-large">-->
			<div class="panel panel-default" id="headings">
				<div class="panel-heading"><h3>Locations</h3></div>
				<nav class="navbar navbar-dark stylish-color">
					<ol class="breadcrumb">
						
						
					</ol>
				</nav>
				

				<!-- Add Button -->
				<a  href="<?php echo site_url('data/').$this->uri->segment(2); ?>/update" class="btn btn-primary btn-sm" style="margin-left:15px;">Add Locations</a>
				<a class="btn btn-primary btn-sm " style="margin-right:15px; float:right;" onclick="exportLocationTableToCSV('location.csv')">Export Locations</a>
                              
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
					<table class="table table-striped table-bordered" id="locationtable" name="medical_conditions_list">
						<thead>
							<tr>
								<th></th>
								<th>Location Name</th>
								<th>Address1</th>
								<th>Address2</th>
								<th>City</th>
								<th>State</th>
								<th>Zip</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Location Type</th>
								<th>Edit</th>
								
							</tr>
						</thead>

						<tbody>
							<?php 	foreach ($records as $row)
							{
								echo '<tr>';
								echo '<td><input type="checkbox" name="location_ids[]" class="locations" id="participnat_id"  value="'.$row['location_id'].'" ></td>';
								echo '<td>'.$row['location_name'].'</td>';
								echo '<td>'.$row['address1'].'</td>';
								echo '<td>'.$row['address2'].'</td>';
								echo '<td>'.$row['city'].'</td>';
								echo '<td>'.$row['state'].'</td>';
								echo '<td>'.$row['zip'].'</td>';
								echo '<td>'.$row['email'].'</td>';
								echo '<td>'.$row['phone'].'</td>';
								echo '<td>'.$row['location_type'].'</td>';
								echo '<td><a href="'.site_url('data/').'locations/update/'.$row['location_id'].'" style="color:#428bca;"><span class="glyphicon glyphicon-edit"></span></a>
								&nbsp;
								<a class="delete_class" href="javascript:void(0);" data-id="'.$row['location_id'].'" style="color:#428bca; float:right;"><span class="fa fa-remove"></span></a>
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

		$.post(url+'locations/delete', {id:id}, function(){ 

			location.replace(url+'locations');
		});
	}

});

</script>