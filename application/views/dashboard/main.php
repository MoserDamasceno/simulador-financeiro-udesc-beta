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
					<h3>Ações</h3>
				</div>
				<div class="widget-container">
					<div class="widget-content">
						<table class="table table-striped data-tbl">
							<thead>
								<tr>
									<th data-field="ticker">Ticker</th>
									<th data-field="company">Empresa</th>
									<th data-field="price">Preço (R$)</th>
									<th data-field="updated">Última atualização</th>
									<th data-field="price"></th>
									<th data-field="price"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($cotations as $c) : ?>
									<tr>
										<td><?php echo $c->ticker ?></td>
										<td><?php echo $c->company ?></td>
										<td><?php echo number_format($c->value, 2, ',', '.') ?></td>
										<td><?php echo date('H:i d/m/Y', strtotime($c->date_time)) ?></td>
										<td><a target="_blank" href="https://br.tradingview.com/chart/?symbol=BMFBOVESPA%3A<?php echo $c->ticker ?>" class="button">Análise técnica</a></td>
										<td><a href="/stock/buy/<?php echo $c->ticker ?>" class="button">Comprar</a></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>