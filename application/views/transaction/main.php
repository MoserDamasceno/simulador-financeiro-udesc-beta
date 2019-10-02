<!--Page Container Start Here-->
<section class="main-container main-area">
	<div class="page-header single-line">
		<div class="row">
			<div class="col-md-6">
				<h2>Seja bem vindo, <?php echo $user->name ?></h2>
			</div>
			<div class="col-md-6">
				
			</div>
		</div>
	</div>

	<div class="row">
				<div class="col-md-12">
			<div class="widget-wrap">
				<div class="widget-header block-header margin-bottom-0 clearfix">
					<h3>Histórico de transações</h3>
					<p></p>
				</div>
				<div class="widget-container">
					
					<div class="widget-content">
						<table class="table table-striped data-tbl">

							<thead>
								<tr>
									<th data-field="id">Ticker</th>
									<th data-field="company">Empresa</th>
									<th data-field="operation">Operação</th>
									<th data-field="amount">Quantidade</th>
									<th data-field="name">Valor unitário (R$)</th>
									<th data-field="valor_operacao">Valor da operação (R$)</th>
									<th data-field="data">Data/hora</th>

								</tr>
							</thead>
							<tbody>
								<?php $total = $compras = $vendas = 0 ?>
								<?php foreach ($transaction as $w): ?>
									<?php 
									if ($w->type == 'buy') {
										$compras += round($w->value, 2) * $w->quantity;
									} else {
										$vendas += round($w->value, 2) * $w->quantity;
									}
									?>
									<tr>
										<td><?php echo $w->ticker ?></td>
										<td><?php echo $w->company ?></td>
										<td><?php echo ($w->type == 'buy') ? 'Compra' : 'Venda' ?></td>
										<td><?php echo $w->quantity ?></td>
										<td><?php echo number_format(round($w->value, 2), 2, ',', '.')  ?></td>
										<td><?php echo number_format(round($w->value, 2) * $w->quantity, 2, ',', '.')  ?></td>
										<td><?php echo date('d/m/Y H:i', strtotime($w->date_time)) ?></td>
									</tr>
								<?php endforeach ?>

							</tbody>
							<tfooter>
								<tr>
									<td></td>
									<td></td>
									<td><b>Compras:</b></td>
									<td><?php echo converterMoeda($compras)  ?></td>
									<td></td>
									<td><b>Vendas:</b></td>
									<td><?php echo converterMoeda($vendas)  ?></td>
									<?php /*
									<td><b>Resultado:</b></td>
																		<td><?php echo converterMoeda($vendas - $compras)  ?></td>
									*/ ?>
								</tr>
							</tfooter>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
