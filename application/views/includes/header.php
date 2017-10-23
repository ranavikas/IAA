<!DOCTYPE html>
<html>
  <head>
    <title><?php echo PROJECT_NAME;?> - System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <!--<link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">-->

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-select.min.css" rel="stylesheet">
    <!--<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-select.css" rel="stylesheet">-->
    
    <!-- styles -->
    <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/vendors/bootstrap-wysihtml5/lib/font-awesome/css/font-awesome.min.css">

   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              
	              <div class="logo">
	                  <h1><a href="<?php echo WEBSITE_URL;?>"><?php echo PROJECT_NAME;?></a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                 <!-- <div class="input-group form">
	                       <input type="text" class="form-control" placeholder="Search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
	                  </div> -->
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
                          <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <!--<li><a href="profile.html">Profile</a></li>-->
	                          <li><a href="<?php echo WEBSITE_URL;?>/login/logout">Logout   <span class="glyphicon glyphicon-lock"></span></a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
                         
	              </div>
	           </div>
	        </div>
	     </div>
	</div>       