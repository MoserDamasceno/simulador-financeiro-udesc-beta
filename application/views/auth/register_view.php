<!--Page Container Start Here-->
<section class="login-container">
	<div class="container">
		<div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
			<div class="login-form-container">
				<form action="<?php echo base_url('auth/register') ?>" method="POST" class="j-forms" id="forms-login" novalidate>
					<div class="login-form-header">
						<!-- <div class="logo">
							<img src="<?php echo assets_url() ?>images/ebgesc-logo-azul.png" alt="logo">
						</div> -->
					</div>
					<?php if (isset($error)) : ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $error ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif; ?>
					<div class="login-form-content">
						<!-- start email -->

						<div class="unit">
							<div class="input login-input">
								<input class="form-control login-frm-input" type="text" id="name" name="name" placeholder="Nome">
							</div>
						</div>

						<div class="unit">
							<div class="input login-input">
								<input class="form-control login-frm-input" type="text" id="email" name="email" placeholder="Email">
							</div>
						</div>

						<div class="unit">
							<div class="input login-input">
								<select class="form-control login-frm-input" name="class" id="class">
									<option value>Disciplina</option>
									<option value="3">ESFI 2020/1</option>
									<option value="4">MEFCA 2020/1</option>
									<option value="5">MECA Prof. Tomasi 2020/1</option>
								</select>
							</div>
						</div>
						<!-- end login -->

						<!-- start password -->
						<div class="unit">
							<div class="input login-input">
								<input class="form-control login-frm-input" type="password" id="password" name="password" placeholder="Senha">
							</div>
						</div>


						<div class="unit">
							<span class="hint" style="margin-top: 20px">
								<a href="/auth" class="link">Já tem uma conta? Faça o Login!</a>
							</span>
						</div>

					</div>
					<!-- end password -->

					<!-- start response from server -->
					<div class="response"></div>
					<!-- end response from server -->
			</div>
			<div class="login-form-footer">
				<button type="submit" class="btn-block btn btn-primary">Registrar</button>
			</div>

			</form>
		</div>
	</div>
	</div>
