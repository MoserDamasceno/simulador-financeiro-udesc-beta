<!--Page Container Start Here-->
<section class="login-container">
	<div class="container">
		<div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
			<div class="login-form-container">
				<form action="<?php echo base_url('auth/login') ?>" method="POST" class="j-forms" id="forms-login" novalidate>
					<div class="login-form-header">
						<!-- <div class="logo">
							<img src="<?php echo assets_url() ?>images/ebgesc-logo-azul.png" alt="logo">
						</div> -->
					</div>
					<?php if (isset($error)): ?>

						<div class="alert alert-danger" role="alert">
							<?php echo $error ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

					<?php elseif (isset($success)): ?>

						<div class="alert alert-success" role="alert">
							<?php echo $success ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

					<?php endif; ?>
					<div class="login-form-content">
						<!-- start email -->
						<div class="unit">
							<div class="input login-input">
								<label class="icon-left" for="email">
									<i class="zmdi zmdi-account"></i>
								</label>
								<input class="form-control login-frm-input"  type="text" id="email" name="email" placeholder="Email">
							</div>
						</div>
						<!-- end login -->

						<!-- start password -->
						<div class="unit">
							<div class="input login-input">
								<label class="icon-left" for="password">
									<i class="zmdi zmdi-key"></i>
								</label>
								<input class="form-control login-frm-input"  type="password" id="password" name="password" placeholder="Senha">
								<span class="hint" style="margin-top: 20px">
									<a href="/auth/register" class="link">Não tem uma conta? Registre-se agora!</a>
								</span>
							</div>
						</div>

		</div>
						<!-- end password -->

						<!-- start response from server -->
						<div class="response"></div>
						<!-- end response from server -->
					</div>
					<div class="login-form-footer">
						<button type="submit" class="btn-block btn btn-primary">Entrar</button>
						<!-- <a href="<?php echo base_url('user') ?>" class="btn-block btn btn-primary">Entrar</a> -->
					</div>

				</form>
			</div>
		</div>
	</div>
