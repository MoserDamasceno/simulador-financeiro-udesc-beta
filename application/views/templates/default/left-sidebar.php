<!--Leftbar Start Here-->
<aside class="leftbar material-leftbar">
	<div class="left-aside-container">
		<div class="user-profile-container">
			<div class="user-profile clearfix">
				<?php /*
					<div class="admin-user-thumb">
											<img src="<?php echo assets_url() ?>images/moser.jpg" alt="admin">
										</div>
					*/ ?>
				<div class="admin-user-info">
					<ul>
						<li><?php echo $this->session->userdata('user')->name ?></li>
						<li><?php echo $this->session->userdata('user')->email ?></li>
					</ul>
				</div>
			</div>
			<div class="admin-bar">
				<ul>
					<li>
						<a href="<?php echo base_url('/auth/logout') ?>">
							<i class="zmdi zmdi-power"></i>
						</a>
					</li>

				</ul>
			</div>
		</div>
		<ul class="list-accordion">
			<li class="list-title">Menu</li>
			<li>
				<a href="<?php echo base_url('dashboard') ?>"><i class="zmdi zmdi-search"></i><span class="list-label">Ações</span></a>
			</li>
			<li>
				<a href="<?php echo base_url('wallet') ?>"><i class="zmdi zmdi-store"></i><span class="list-label">Carteira</span></a>
			</li>
			<li>
				<a href="<?php echo base_url('transaction') ?>"><i class="zmdi zmdi-group-work"></i><span class="list-label">Transações</span></a>
			</li>
			<li>
				<a href="<?php echo base_url('wallet/ranking') ?>"><i class="zmdi zmdi-ticket-star"></i><span class="list-label">Ranking</span></a>
			</li>
			<?php if ($this->session->userdata('user')->role_id == 1) : ?>
				<li>
					<a href="<?php echo base_url('cotation') ?>"><i class="zmdi zmdi-group-work"></i><span class="list-label">Atualizar cotações</span></a>
				</li>
				<li>
					<a href="<?php echo base_url('turma') ?>"><i class="zmdi zmdi-accounts-alt"></i><span class="list-label">Turmas</span></a>
				</li>
				<li>
					<a href="<?php echo base_url('user') ?>"><i class="zmdi zmdi-account"></i><span class="list-label">Alunos</span></a>
				</li>
			<?php endif ?>

		</ul>
	</div>
</aside>
<!--Leftbar End Here-->
