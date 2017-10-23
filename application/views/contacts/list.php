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
				<a  href="<?php echo site_url().$this->uri->segment(1); ?>/update" class="btn btn-primary btn-sm" style="margin-left:15px;">Add Contacts</a>
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
								<th>First Name</th>
								<th>Last Name</th>
								<th>Title</th>
								<th>Email</th>
								<th>Email 2</th>
								<th>Phone</th>
								<th>Phone Ext</th>
								<th>Phone 2</th>
								<th>Phone 2 Ext</th>
								<th>Organization</th>
								<th>Edit</th>
								
							</tr>
						</thead>

						<tbody>
							<?php 	foreach ($records as $row)
							{
								echo '<tr>';
								echo '<td><input type="checkbox" name="location_ids[]" class="locations" id="contact_id"  value="'.$row['contact_id'].'" ></td>';
								echo '<td>'.$row['firstname'].'</td>';
								echo '<td>'.$row['lastname'].'</td>';
								echo '<td>'.$row['title'].'</td>';
								echo '<td>'.$row['email'].'</td>';
								echo '<td>'.$row['email2'].'</td>';
								echo '<td>'.$row['phone'].'</td>';
								echo '<td>'.$row['phone_ext'].'</td>';
								echo '<td>'.$row['phone2'].'</td>';
								echo '<td>'.$row['phone2_ext'].'</td>';
								echo '<td>'.$row['organization'].'</td>';
								echo '<td><a href="'.site_url().'contacts/update/'.$row['contact_id'].'" style="color:#428bca;"><span class="glyphicon glyphicon-edit"></span></a>
								<a class="delete_class" href="javascript:void(0);" data-id="'.$row['contact_id'].'" style="color:#428bca; float:right;"><span class="fa fa-remove"></span></a>
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

var url  = "<?php echo site_url(); ?>";

$(".delete_class").on("click", function(){ 

	var id = $(this).attr('data-id');
	var sure = confirm("Are you sure to Delete?");

	if ( sure ) {

		$.post(url+'contacts/delete', {id:id}, function(){ 

			location.replace(url+'contacts');
		});
	}

});

</script>