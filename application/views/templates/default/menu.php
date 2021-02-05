<!--Topbar Start Here-->
<header class="topbar clearfix">
	<div class="topbar-left pull-left">
		<div class="clearfix">
			<ul class="left-branding clickablemenu ttmenu dark-style menu-color-gradient">
				<?php //if ($this->session->userdata('user')->role_id != 2): 
				?>
				<li><span class="left-toggle-switch"><i class="zmdi zmdi-menu"></i></span></li>
				<?php //endif; 
				?>
				<li>
					<div class="logo">
						<a href="<?php echo base_url() ?>"><img src="<?php echo assets_url() ?>images/logo-esag.png" alt="logo" style="width: 140px"></a>
					</div>
				</li>
			</ul>

			<?php if ($this->session->userdata('user')->role_id != 2) : ?>
				<ul class="branding-right pull-right">
					<li><a href="#" class="btn-mobile-search btn-top-search"><i class="zmdi zmdi-search"></i></a></li>
					<li><a href="#" class="btn-mobile-bar"><i class="zmdi zmdi-menu"></i></a></li>
				</ul>
			<?php endif; ?>
		</div>
	</div>


	<div class="topbar-right pull-right">
		<div class="clearfix">
			<ul class="pull-right top-right-icons">
				<?php if ($user): ?>
				<li style="padding: 18px 15px;">
					<b>Saldo monetário:</b> <?php echo converterMoeda(round($user->saldo, 2)) ?>
				</li>
				<li style="padding: 18px 15px;">
					<b>Saldo em ativos:</b> <?php echo converterMoeda(round($user->saldo_ativos, 2)) ?>
				</li>
				<?php endif; ?>	
			</ul>
		</div>
	</div>
	<!--Topbar Right End -->


</header>
<!--Topbar End Here-->
