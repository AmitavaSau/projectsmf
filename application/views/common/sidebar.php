<div id="sidebar" class="sidebar pb-3">
	<div class="text-gray-500 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">
		<div id="clockdate">
			<div class="clockdate-wrapper">
				<div id="clock"></div>
				<div id="date"></div>
			</div>
		</div>
	</div>
	
	<ul class="sidebar-menu list-unstyled">
		<li class="sidebar-list-item">
			<a href="<?php echo $this->config->base_url();?>dashboard" class="sidebar-link text-muted <?php echo ($active_link == 'dashboard' ? 'active' : '');?>">
				<i class="fas fa-tv mr-3 text-gray"></i><span>Dashboard</span>
			</a>
		</li>
		
		<li class="sidebar-list-item">
			<a href="#" data-toggle="collapse" data-target="#reports" aria-expanded="<?php echo ($active_link == 'reports' ? 'true' : 'false');?>" aria-controls="reports" class="sidebar-link text-muted <?php echo ($active_link == 'reports' ? 'active' : '');?>">
				<i class="fas fa-chart-line mr-3 text-gray"></i>
				<span>Reports</span>
			</a>
			<div id="reports" class="collapse <?php echo ($active_link == 'reports' ? 'show' : '');?>">
				<ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
					<li class="sidebar-list-item"><a href="<?php echo $this->config->base_url();?>reports/basicverify" class="sidebar-link text-muted pl-lg-5">Basic Info Verified</a></li>
					<li class="sidebar-list-item"><a href="<?php echo $this->config->base_url();?>reports/academicverify" class="sidebar-link text-muted pl-lg-5">Academic Verified</a></li>
				</ul>
			</div>
		</li>
		
		<li class="sidebar-list-item">
			<a href="#" data-toggle="collapse" data-target="#configs" aria-expanded="<?php echo ($active_link == 'configs' ? 'true' : 'false');?>" aria-controls="configs" class="sidebar-link text-muted <?php echo ($active_link == 'configs' ? 'active' : '');?>">
				<i class="fas fa-cogs mr-3 text-gray"></i>
				<span>Configs</span>
			</a>
			<div id="configs" class="collapse <?php echo ($active_link == 'configs' ? 'show' : '');?>">
				<ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
					<li class="sidebar-list-item"><a href="<?php echo $this->config->base_url();?>users" class="sidebar-link text-muted pl-lg-5">Users</a></li>
					<li class="sidebar-list-item"><a href="<?php echo $this->config->base_url();?>roles" class="sidebar-link text-muted pl-lg-5">Roles</a></li>
				</ul>
			</div>
		</li>
		
		<li class="sidebar-list-item">
			<a href="<?php echo $this->config->base_url();?>logout" class="sidebar-link text-muted">
				<i class="fas fa-sign-out-alt mr-3 text-gray"></i>
				<span>Logout</span>
			</a>
		</li>
	</ul>
	
</div>