<!--Page Container Start Here-->
<section class="main-container main-area">
    <div class="page-header single-line">
        <div class="row">
            <div class="col-md-6">
                <h2>Planos</h2>
            </div>
            <div class="col-md-6">
                <ul class="list-page-breadcrumb">
                    <li><a href="#">Home <i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li><a href="#">Planos <i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li class="active-page"> Criar</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="widget-wrap">
                    <div class="widget-header block-header margin-bottom-0 clearfix">
                        <div class="pull-left">
                            <h3>Editar plano</h3>
                            <p>Preencha os campos abaixo para editar o plano</p>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo base_url('plan') ?>" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                    <div class="widget-container">
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-8">
                                    <form class="form-horizontal" method="POST" action="<?php echo base_url('plan/save' .'/'. $plan->id_plan) ?>">
                                        <input type="hidden" name="id_plan" value="<?php echo $plan->id_plan ?>">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Nome</label>
                                            <div class=" col-md-8">
                                                <input type="text" value="<?php echo $plan->plan ?>" name="plan" class="form-control" placeholder="Insira o nome do plano aqui">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Valor</label>
                                            <div class=" col-md-8">
                                                <input type="text" value="<?php echo $plan->value ?>" name="value" class="form-control" placeholder="Insira o valor do plano aqui">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Parcelas máximas</label>
                                            <div class=" col-md-8">
                                                <input type="text" value="<?php echo $plan->installments ?>" name="installments" class="form-control" placeholder="Insira o máximo de parcelas pro plano (entre 1 e 18)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Duração do plano (em meses)</label>
                                            <div class=" col-md-8">
                                                <input type="text" value="<?php echo $plan->duration ?>" name="duration" class="form-control" placeholder="Insira a duração do plano em meses">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Serviços</label>
                                            <div class="col-md-8">
                                                <?php foreach ($services as $service): ?>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="services[]" value="<?php echo $service->id_service ?>" <?php echo (in_array($service->id_service, $plan_services)) ? 'checked':'' ; ?>> <?php echo $service->service ?>
                                                        </label>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">&nbsp;</label>
                                            <div class="col-md-8">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                    <a href="<?php echo base_url('plan') ?>" class="btn btn-default">Cancelar</a>
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
