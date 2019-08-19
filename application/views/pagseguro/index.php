<!--Page Container Start Here-->
<section class="main-container main-area">
    <div class="page-header single-line">
        <div class="row">
            <div class="col-md-6">
                <h2>Assinatura</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="widget-wrap  material-table-widget">
                <div class="widget-container margin-top-0">
                    <div class="widget-content">
                        <div class="data-action-bar">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="widget-header text-left">
										<h3>Planos</h3>
										<br>
                                    </div>
                                </div>
							</div>
							<div class="row">
								<div class="col-md-12">
                                    <form id="pagseguro-form" class="form-horizontal" method="POST" action="/pagseguro/create">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                            	<label>Planos</label>
                                                <select class="form-control" name="plan" required>
                                                    <option value>Selecione o plano</option>
                                                    <?php foreach ($plans as $plan): ?>
                                                        <option value="<?php echo $plan->id_plan ?>"><?php echo $plan->plan ?></option>
													<?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                      
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <div class="form-actions">
													<button style="border:none;background:none;" type="submit">
														<img src="https://stc.pagseguro.uol.com.br/public/img/botoes/assinaturas/209x48-assinar-assina.gif" alt="Pague com PagSeguro - É rápido, grátis e seguro!" width="209" height="48" />
													</button>
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
