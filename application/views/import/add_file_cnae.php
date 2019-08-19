<!--Page Container Start Here-->
<section class="main-container main-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="widget-wrap">
                    <div class="widget-header block-header margin-bottom-0 clearfix">
                        <div class="pull-left">
                            <h3>Adicionar arquivo</h3>
                            <p>Selecione o arquivo desejado para importar</p>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo base_url('import') ?>" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                    <div class="widget-container">
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-8">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="<?php echo base_url('import/save_cnae') ?>">
                                        
                                        <input type="hidden" name="teste" value="dsds">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Arquivo:</label>
                                            <div class="col-md-8">
                                                <input type="file" name="arquivo" class="filestyle bootstrap-file" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control " disabled=""> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" class="btn btn-default "><i class="fa fa-folder-open"></i> Escolha um arquivo</label></span></div>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">&nbsp;</label>
                                            <div class="col-md-8">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Importar</button>
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