<!--Page Container Start Here-->
<section class="main-container main-area">
	<div class="row">
		<div class="col-md-6">
			<div class="widget-wrap">
				<div class="widget-header block-header margin-bottom-0 clearfix">
					<h3>Stocks</h3>
					<p>Comprar ação da empresa <?php echo $stock->company ?></p>
				</div>
				<div class="widget-container">
					<div class="widget-content">
						<p>Seu saldo em carteira é de <span style="font-size: 16px"><?php echo money_format('%i', round($user->saldo, 2))?></span></p>
						<form class="form-horizontal" method="POST" action="<?php echo base_url('stock/save_buy') ?>">
							<input type="hidden" name="id_stock" value="<?php echo $stock->id_stock ?>">
							<input type="hidden" name="id_cotation" value="<?php echo $stock->id_cotation ?>">
							<div class="form-group">
								<label class="col-md-4 control-label">Quantidade</label>
								<div class=" col-md-8">
									<input type="number" name="quantidade" class="form-control" placeholder="Digite a quantidade de ações que deseja comprar.">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 control-label">&nbsp;</label>
								<div class="col-md-8">
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Salvar</button>
										<a href="<?php echo base_url('dashboard') ?>" class="btn btn-default">Cancelar</a>
									</div>
								</div>
							</div>
						</form>
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="widget-wrap">
				<div class="widget-header block-header margin-bottom-0 clearfix">
					<h3>BBAS3</h3>
					<p>Informações do ativo</p>
				</div>
				<div class="widget-container">
					
					<div class="widget-content">
						<p>
							<b>Empresa:</b> <?php echo $stock->company ?> <br/>
							<b>Ticker:</b> <?php echo $stock->ticker ?> <br/>
							<b>Cotação:</b> <?php echo money_format('%i', $stock->value) ?><br/>
							<b>Ultima atualização:</b> <?php echo date('H:i d/m/Y', strtotime($stock->date_time)) ?> <br/>
						</p>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
