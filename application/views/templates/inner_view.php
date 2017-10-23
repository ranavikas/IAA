<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('includes/inner_header');   // loading header file.?>
<div class="page-content">
	<div class="row">
		<?php $this->load->view('includes/inner_sidebar');   // loading sidebar file.?>
		<?php echo $the_view_content;    // loading main content file.?>
	</div>
</div>
<?php $this->load->view('includes/inner_footer'); // loading footer file.?>