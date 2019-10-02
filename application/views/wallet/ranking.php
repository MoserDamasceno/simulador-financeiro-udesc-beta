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
					<h3>Ranking</h3>
					<p></p>
				</div>
				<div class="widget-container">
					
					<div class="widget-content">
						<table class="table table-striped data-tbl">

							<thead>
								<tr>
									<th data-field="nome">Nome</th>
									<th data-field="disciplina">Disciplina</th>
									<th data-field="saldo_atual">Saldo atual (R$)</th>
									<th data-field="amount">Valor em ativos (R$)</th>
									<th data-field="valot_total">Valor total (R$)</th>
									<th data-field="variacao">Variação total (%)</th>
								</tr>
							</thead>
							<tbody>
								<?php $total = 0 ?>
								<?php if ($users): ?>

									<?php foreach ($users as $u): ?>
										<tr>
											<td><?php echo $u->name ?></td>
											<td><?php echo $u->class ?></td>
											<td><?php echo number_format($u->values['valor_atual'], 2, ',', '.' ) ?></td>
											<td><?php echo number_format($u->values['valor_ativos'], 2, ',', '.' ) ?></td>
											<td><?php echo number_format($u->values['valor_total'], 2, ',', '.' ) ?></td>
											<td><?php echo $u->values['variacao'] ?></td>
										</tr>
									<?php endforeach ?>
								<?php endif ?>

							</tbody>
							<tfooter>
								<tr>
									<td></td>
									<td></td>
									<td>Total</td>
									<td><?php echo converterMoeda($total)  ?></td>
									<td></td>
									<td></td>
								</tr>
							</tfooter>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
