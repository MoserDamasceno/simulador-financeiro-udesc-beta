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
					<h3>Carteira</h3>
					<p>Seu saldo é: <?php echo money_format('%i', round($user->saldo, 2))?></p>
				</div>
				<div class="widget-container">
					
					<div class="widget-content">
						<table class="table table-striped data-tbl">

							<thead>
								<tr>
									<th data-field="id">Ticker</th>
									<th data-field="company">Empresa</th>
									<th data-field="amount">Quantidade</th>
									<th data-field="valor_medio">Valor médio</th>
									<th data-field="valor_atual">Valor atual</th>
									<th data-field="ultima_atualizacao">Última atualização</th>
									<th data-field="price"></th>
								</tr>
							</thead>
							<tbody>
								<?php $total = 0 ?>
								<?php if ($wallet): ?>

									<?php foreach ($wallet as $w): ?>
										<?php $total += round($w->value, 2) * $w->quantity?>
										<tr>
											<td><?php echo $w->ticker ?></td>
											<td><?php echo $w->company ?></td>
											<td><?php echo $w->quantity ?></td>
											<td><?php echo money_format('%i', round($w->average_price, 2))  ?></td>
											<td><?php echo money_format('%i', round($w->value, 2))  ?></td>
											<td><?php echo $w->date_time  ?></td>
											<td><a href="/stock/sell/<?php echo $w->ticker ?>" class="button">Vender</a></td>
										</tr>
									<?php endforeach ?>
								<?php endif ?>

							</tbody>
							<tfooter>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>Total</td>
									<td><?php echo money_format('%i', $total)  ?></td>
									<td></td>
									<td></td>
								</tr>
							</tfooter>
						</table>
					</div>

				</div>
			</div>
		</div>
		<?php /*
		<div class="col-md-4">
					<div class="widget-wrap">
						<div class="widget-header block-header margin-bottom-0 clearfix">
							<h3>Performance</h3>
							<p> &nbsp;</p>
						</div>
						<div class="widget-container">
							
							<div class="widget-content">
								<p>
									<?php 
										$valor_inicial = 1000000; 
										$valor_total =  $total + $user->saldo;
										$variacao = round((($valor_total / $valor_inicial) - 1 ) * 100, 2) ;
										?>
									<b>Saldo inicial:</b> <?php echo money_format('%i', $valor_inicial)  ?> <br>
									<b>Saldo atual:</b> <?php echo money_format('%i', $user->saldo)  ?> <br>
									<b>Valor em ativos:</b> <?php echo money_format('%i', $total)  ?> <br>
									<b>Valor total:</b> <?php echo money_format('%i', $valor_total)  ?> <br>
									<b>Variação total:</b> <?php echo $variacao . '%' ?>
								</p>
		
							</div>
		
						</div>
					</div>
				</div>
		*/ ?>
	</div>
</section>
