<style>
   .fcurrent{ color: #428bca !important;}
</style>

<div class="sidebar content-box" style="display: block;">
	<ul class="nav">

		<!-- Main menu -->
		<!--<li><a href="index.html"><i class="glyphicon glyphicon-home"></i></a></li> -->

                <li><a href="<?php echo site_url().'contacts'; ?>" <?php if($this->uri->segment(1) == 'contacts'){?> class="fcurrent"<?php } ?>><i class="glyphicon glyphicon-folder-close"></i>Contacts</a></li>
		<li><a href="<?php echo site_url().'participants'; ?>" <?php if($this->uri->segment(1) == 'participants'){?> class="fcurrent"<?php } ?>><i class="glyphicon glyphicon-user"></i>Participants</a></li>
		<li><a href="<?php echo site_url().'studies'; ?>" <?php if($this->uri->segment(1) == 'studies'){?> class="fcurrent"<?php } ?>><i class="glyphicon glyphicon-folder-close"></i>Studies</a></li>

		<li class="submenu">
			<a href="#" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) != ''){?> class="fcurrent"<?php } ?>>
				<i class="glyphicon glyphicon-list-alt"></i> Data
				<span class="caret pull-right"></span>
			</a>
			<!-- Sub menu -->
			<ul>
				<li><a href="<?php echo site_url("data").'/clients'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'clients'){?> class="fcurrent"<?php } ?>>Clients</a></li>
				<li><a href="<?php echo site_url("data").'/Contacts'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'Contacts'){?> class="fcurrent"<?php } ?>>Contacts</a></li>
				<li><a href="<?php echo site_url("data").'/ethnicities'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'ethnicities'){?> class="fcurrent"<?php } ?>>Ethnicities</a></li>
				<li><a href="<?php echo site_url("data").'/genders'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'genders'){?> class="fcurrent"<?php } ?>>Genders</a></li>
				<li><a href="<?php echo site_url("data").'/locations'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'locations'){?> class="fcurrent"<?php } ?>>Locations</a></li>
				<li><a href="<?php echo site_url("data").'/conditions'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'conditions'){?> class="fcurrent"<?php } ?>>Medical Conditions</a></li>
				<li><a href="<?php echo site_url("data").'/occupations'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'occupations'){?> class="fcurrent"<?php } ?>>Occupations</a></li>
				<li><a href="<?php echo site_url("data").'/classifications'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'classifications'){?> class="fcurrent"<?php } ?>>Particiant Classifications</a></li>
				<li><a href="<?php echo site_url("data").'/Productypes'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'Productypes'){?> class="fcurrent"<?php } ?>>Product Types </a></li>
				<li><a href="<?php echo site_url("questions").'/'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'questions'){?> class="fcurrent"<?php } ?>>Screener Questions  </a></li>
				<li><a href="<?php echo site_url("data").'/Studytypes'; ?>" <?php if($this->uri->segment(1) == 'data' && $this->uri->segment(2) == 'Studytypes'){?> class="fcurrent"<?php } ?>>Study Types </a></li>
				
			</ul>
		</li>




		<li class="submenu">
			<a href="#" <?php if($this->uri->segment(1) == 'admin' && $this->uri->segment(2) != ''){?> class="fcurrent"<?php } ?>>
				<i class="glyphicon glyphicon-lock"></i> Admin
				<span class="caret pull-right"></span>
			</a>
			<!-- Sub menu -->
			<ul>
				<li><a href="<?php echo site_url("admin").'/users'; ?>" <?php if($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'users'){?> class="fcurrent"<?php } ?>>Users</a></li>
				<li><a href="<?php echo site_url("admin").'/roles'; ?>" <?php if($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'roles'){?> class="fcurrent"<?php } ?>>User Roles</a></li>

			</ul>
		</li>	

	</ul>
</div>