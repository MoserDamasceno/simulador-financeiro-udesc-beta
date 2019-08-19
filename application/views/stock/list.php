<!--Page Container Start Here-->
<section class="main-container main-area">
	<div class="page-header single-line">
		<div class="row">
			<div class="col-md-6">
				<h2>Seja bem vindo <?php echo $user->name ?></h2>
			</div>
			<div class="col-md-6">
				
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="widget-wrap">
				<div class="widget-header block-header margin-bottom-0 clearfix">
					<h3>Stocks</h3>
					<p>Preço de ações</p>
				</div>
				<div class="widget-container">
					<div class="widget-content">
						<table class="table table-striped">
							<thead>
								<tr>
									<th data-field="ticker">Ticker</th>
									<th data-field="company">Company</th>
									<th data-field="price">Price</th>
									<th data-field="updated">Last update</th>
									<th data-field="price">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($cotations as $c): ?>
									<tr>
										<td><?php echo $c->ticker ?></td>
										<td><?php echo $c->company ?></td>
										<td><?php echo money_format('%i', $c->value)  ?></td>
										<td><?php echo date('H:i d/m/Y', strtotime($c->date_time)) ?></td>
										<td><a href="#" class="button">Buy</a></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="widget-wrap">
				<div class="widget-header block-header margin-bottom-0 clearfix">
					<h3>Wallet</h3>
					<p>Ativos em sua carteira</p>
				</div>
				<div class="widget-container">
					
					<div class="widget-content">
						<table class="table table-striped">

							<thead>
								<tr>
									<th data-field="id">Ticker</th>
									<th data-field="company">Company</th>
									<th data-field="amount">Amount</th>
									<th data-field="name">Price</th>
									<th data-field="price">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $total = 0 ?>
								<?php foreach ($wallet as $w): ?>
									<?php $total += round($w->value, 2) * $w->quantity?>
									<tr>
										<td><?php echo $w->ticker ?></td>
										<td><?php echo $w->company ?></td>
										<td><?php echo $w->quantity ?></td>
										<td><?php echo money_format('%i', round($w->value, 2))  ?></td>
										<td><a href="#" class="button">Sell</a></td>
									</tr>
								<?php endforeach ?>

							</tbody>
							<tfooter>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>Total</td>
									<td><?php echo money_format('%i', $total)  ?></td>
								</tr>
							</tfooter>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
