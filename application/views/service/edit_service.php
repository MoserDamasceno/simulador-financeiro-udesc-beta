<!--Page Container Start Here-->
<section class="main-container main-area">
    <div class="page-header single-line">
        <div class="row">
            <div class="col-md-6">
                <h2>Serviços</h2>
            </div>
            <div class="col-md-6">
                <ul class="list-page-breadcrumb">
                    <li><a href="#">Home <i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li><a href="#">Serviços <i class="zmdi zmdi-chevron-right"></i></a></li>
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
                            <h3>Editar serviço</h3>
                            <p>Preencha os campos abaixo para editar o serviço</p>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo base_url('service') ?>" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                    <div class="widget-container">
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-8">
                                    <form class="form-horizontal" method="POST" action="<?php echo base_url('service/save' .'/'. $service->id_service) ?>">
                                        <input type="hidden" name="id_service" value="<?php echo $service->id_service ?>">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Nome</label>
                                            <div class=" col-md-8">
                                                <input type="text" value="<?php echo $service->service ?>" name="service" class="form-control" placeholder="Insira o nome do serviço aqui">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">&nbsp;</label>
                                            <div class="col-md-8">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                                    <a href="<?php echo base_url('service') ?>" class="btn btn-default">Cancelar</a>
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