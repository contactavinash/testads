<style>
.error
{
	color:red;
}
</style>

<div class="animationload">
        <div class="loader">
        </div>
    </div>
    
<div id="header" class="navbar navbar-inverse navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="navbar-inner">
		<div class="container-fluid">
			<!-- BEGIN LOGO -->
			<?php
				echo anchor('adminsettings/index','<img src="'.base_url().'assets/img/logo.png">',array('class' => 'brand'));
			?>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="arrow"></span>
			</a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<div id="top_menu" class="nav notify-row">
				<!-- BEGIN NOTIFICATION -->
				<ul class="nav top-menu">
					<!-- BEGIN SETTINGS -->
					<li class="dropdown">
					<?php
						echo anchor('adminsettings/settings','<i class="icon-cog"></i>',array('class'=>'dropdown-toggle element','data-placement'=>'bottom','data-toggle'=>'tooltip','data-original-title'=>'Settings'));
					?>
					</li>
				</ul>
			</div>
				<!-- END  NOTIFICATION -->
			<div class="top-nav ">
				<ul class="nav pull-right top-menu" >

					<?php
					$admlogo = $this->admin_model->getadmindetails();
					if($admlogo){
						foreach($admlogo as $adm){
							$main_admin_logo = $adm->admin_logo;
						}
					}
					?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url(); ?>uploads/adminpro/<?php echo $main_admin_logo; ?>" alt="admin logo" width="30" height="50">
							<span class="username"><?php echo $this->session->userdata('admin_username'); ?></span>
						<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
                        <li><a href="<?php echo base_url();?>" target="_blank"><i class="icon-tasks"></i> Visit Site</a></li>
                       
							<!--<li><a href="#"><i class="icon-user"></i> My Profile</a></li>
							<li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>
							<li><a href="#"><i class="icon-calendar"></i> Calendar</a></li>
							<li class="divider"></li>-->
							<!--<li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>-->
							<li><?php echo anchor('adminsettings/settings','<i class="icon-cog"></i> Settings'); ?></li>
							<li><?php echo anchor('adminsettings/logout','<i class="icon-key"></i> Log Out'); ?></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU -->
			</div>
		</div>
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>