<!--Page Container Start Here-->
<section class="main-container main-area">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="widget-wrap">
					<div class="widget-header block-header margin-bottom-0 clearfix">
						<div class="pull-left">
							<h3>Criar usuário</h3>
							<p>Preencha os campos abaixo para adicionar um usuário</p>
						</div>
						<div class="pull-right">
							<a href="<?php echo base_url('user') ?>" class="btn btn-default">Voltar</a>
						</div>
					</div>
					<div class="widget-container">
						<div class="widget-content">
							<div class="row">
								<div class="col-md-8">
									<form class="form-horizontal" method="POST" action="<?php echo base_url('user/save') ?>">
										<div class="form-group">
											<label class="col-md-4 control-label">Nome</label>
											<div class=" col-md-8">
												<input type="text" name="name" class="form-control" placeholder="Insira o nome aqui">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">E-mail</label>
											<div class=" col-md-8">
												<input type="email" name="email" class="form-control" placeholder="Insira o e-mail aqui">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Telefone</label>
											<div class=" col-md-8">
												<input type="text" name="phone" class="form-control phone-mask" placeholder="Insira o telefone aqui">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Tipo de usuário</label>
											<div class="col-md-8">
												<select class="form-control" name="role_id">
													<option value>Selecione a permissão</option>
													<?php foreach ($type_user as $tp) : ?>
														<option value="<?php echo $tp->id ?>"><?php echo $tp->role ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Turma</label>
											<div class="col-md-8">
												<select class="form-control" name="class">
													<option value>Selecione a turma</option>
													<?php foreach ($classes as $class) : ?>
														<option value="<?php echo $class->id_class ?>"><?php echo $class->class ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">Senha</label>
											<div class="col-md-8">
												<input type="password" name="password" class="form-control" placeholder="Insira a senha aqui">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label">&nbsp;</label>
											<div class="col-md-8">
												<div class="form-actions">
													<button type="submit" class="btn btn-primary">Salvar</button>
													<a href="<?php echo base_url('user') ?>" class="btn btn-default">Cancelar</a>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
