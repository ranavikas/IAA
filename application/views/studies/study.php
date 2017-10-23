<style>
    .border-clas{
       border:  1px solid #eee; 
       margin: auto; 
    } 
    .heading-txt{
        font-size: 1.5em;
        margin-top: 15px;
        margin-bottom: 10px;
    }
    .usergroup-btn{
           margin-left: 5px;
           margin-right: 5px;
            width: 150px;
            margin-top: 10px;
            margin-bottom: 10px;
            white-space: initial;
    }
    
    .potential-inner-btn{
        margin-left: 15px;
        margin-right: 10px;
        width: 170px;
        margin-top: 10px;
        margin-bottom: 10px;
        white-space: initial;
    }
    
   
     .nav-tabs {
        margin-top: 10px;
        margin-left: 15px;
        margin-right: 15px;
    }
    
    .page-content > .row {
        margin-top: 10px;
    }
    
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
        color: #fff;
        cursor: default;
        background-color: #428bca;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
    
    
    
 /*left tabsss*/   
    
   /*!
 * bootstrap-vertical-tabs - v1.1.0
 * https://dbtek.github.io/bootstrap-vertical-tabs
 * 2014-06-06
 * Copyright (c) 2014 Ä°smail Demirbilek
 * License: MIT
 */
.tabs-left, .tabs-right {
  border-bottom: none;
  padding-top: 2px;
}
.tabs-left {
  border-right: 1px solid #ddd;
}
.tabs-right {
  border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
  float: none;
  margin-bottom: 2px;
}
.tabs-left>li {
  margin-right: -1px;
}
.tabs-right>li {
  margin-left: -1px;
}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
}

.tabs-right>li.active>a,
.tabs-right>li.active>a:hover,
.tabs-right>li.active>a:focus {
  border-bottom: 1px solid #ddd;
  border-left-color: transparent;
}
.tabs-left>li>a {
  border-radius: 4px 0 0 4px;
  margin-right: 0;
  display:block;
}
.tabs-right>li>a {
  border-radius: 0 4px 4px 0;
  margin-right: 0;
}
.vertical-text {
  margin-top:50px;
  border: none;
  position: relative;
}
.vertical-text>li {
  height: 20px;
  width: 120px;
  margin-bottom: 100px;
}
.vertical-text>li>a {
  border-bottom: 1px solid #ddd;
  border-right-color: transparent;
  text-align: center;
  border-radius: 4px 4px 0px 0px;
}
.vertical-text>li.active>a,
.vertical-text>li.active>a:hover,
.vertical-text>li.active>a:focus {
  border-bottom-color: transparent;
  border-right-color: #ddd;
  border-left-color: #ddd;
}
.vertical-text.tabs-left {
  left: -50px;
}
.vertical-text.tabs-right {
  right: -50px;
}
.vertical-text.tabs-right>li {
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
.vertical-text.tabs-left>li {
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  transform: rotate(-90deg);
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
                                <div class="panel-heading">
                                    <h4>  
                                        <a  href="<?php echo site_url("studies/add"); ?>"  class="btn btn-primary"  style="margin-left:15px;">New Study</a>
                                        <span style="margin-left:15px;"><?php  echo $records[0]['study_number'].':'.$records[0]['client_name'].' '.$records[0]['product_name'].' '.$records[0]['study_type']; ?></span>
                                    </h4>
                                </div>
			
                             
                                 <ul class="nav nav-tabs" id="myTab">
                                        <li class="active"><a href="#tab1<?php echo $study_id;?>" data-toggle="tab">Details</a></li>
                                        <li><a href="#tab2<?php echo $study_id;?>" data-toggle="tab">Potentials</a></li>
                                        <li><a href="#tab3<?php echo $study_id;?>" data-toggle="tab">Scheduled</a></li>
                                        <li><a href="#tab4<?php echo $study_id;?>" data-toggle="tab">Schedule</a></li>
                                        <li><a href="#tab5<?php echo $study_id;?>" data-toggle="tab">Demographics</a></li>
                                        <li><a href="#tab6<?php echo $study_id;?>" data-toggle="tab">Tracker</a></li>
                                        <li><a href="#tab7<?php echo $study_id;?>" data-toggle="tab">DNQ List</a></li>
                                </ul>
				 <div class="tab-content">
                                      <div class="tab-pane active " id="tab1<?php echo $study_id;?>"> 
                                       <?php $this->load->view('studies/detail'); ?>
                                      </div> 
                                     <div class="tab-pane " id="tab2<?php echo $study_id;?>"> 
                                        <?php $this->load->view('studies/potential'); ?>
                                      </div> 
                                     <div class="tab-pane " id="tab3<?php echo $study_id;?>"> 
                                         <?php $this->load->view('studies/scheduled'); ?>
                                      </div> 
                                      <div class="tab-pane " id="tab4<?php echo $study_id;?>"> 
                                         <?php $this->load->view('studies/schedulee'); ?>
                                      </div>
                                     <div class="tab-pane " id="tab7<?php echo $study_id;?>"> 
                                         
                                         <?php $this->load->view('studies/dnq'); ?>
                                      </div> 
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
    width: 1180px !important;
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