<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
	$this->load->view('includes/outer_header');    // header
?>
<?php
	echo $the_view_content;     // main content 
?>
<?php
	$this->load->view('includes/outer_footer');    // footer
?>