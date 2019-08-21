<!--Topbar Start Here-->
<header class="topbar clearfix">
	<div class="topbar-left pull-left">
		<div class="clearfix">
			<ul class="left-branding clickablemenu ttmenu dark-style menu-color-gradient">
				<?php //if ($this->session->userdata('user')->role_id != 2): ?>
				<li><span class="left-toggle-switch"><i class="zmdi zmdi-menu"></i></span></li>
				<?php //endif; ?>
				<li>
					<div class="logo">
						<!-- <a href="<?php echo base_url() ?>" title="Admin Template"><img src="<?php echo assets_url() ?>images/ebgesc-logo.png" alt="logo"></a> -->
					</div>
				</li>
			</ul>
			
			<?php if ($this->session->userdata('user')->role_id != 2): ?>
				<ul class="branding-right pull-right">
					<li><a href="#" class="btn-mobile-search btn-top-search"><i class="zmdi zmdi-search"></i></a></li>
					<li><a href="#" class="btn-mobile-bar"><i class="zmdi zmdi-menu"></i></a></li>
				</ul>
			<?php endif; ?>
		</div>
	</div>
	
	<?php if ($this->session->userdata('user')->role_id == 2): ?>
<!-- 		<div class="topbar-right pull-right">

			<div class="clearfix">
				<ul class="pull-right top-right-icons">
					<li>
						<a href="<?php echo base_url('/auth/logout') ?>">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
 -->



		<!--Topbar Right End -->

	<?php endif; ?>
</header>
<!--Topbar End Here-->
