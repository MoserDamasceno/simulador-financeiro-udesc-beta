<!--Page Container Start Here-->
<section class="main-container main-area">
    <div class="page-header single-line">
        <div class="row">
            <div class="col-md-6">
                <h2>Campos personalizados</h2>
            </div>
            <div class="col-md-6">
                <ul class="list-page-breadcrumb">
                    <li><a href="#">Home <i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li><a href="#">Campos personalizados <i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li class="active-page"> Lista</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="widget-wrap  material-table-widget">
                <div class="widget-container margin-top-0">
                    <div class="widget-content">
                        <div class="data-action-bar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="widget-header text-left">
                                        <h3>Lista de campos personalizados</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget-header text-right">
                                        <a class="btn btn-primary" href="<?php echo base_url('field/create') ?>">Adicionar campo personalizado</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <table class="table table-striped data-tbl">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Campo personalizado</th>
                                <th class="td-center">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fields as $field): ?>
                                    <tr>
                                        <td><?php echo $field->id_field ?></td>
                                        <td><?php echo $field->field ?></td>
                                        <td class="td-center">
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo base_url('field/edit/' . $field->id_field) ?>" class="btn btn-default btn-sm m-field-edit"><i class="zmdi zmdi-edit"></i></a>
                                                    <a href="#" data-id="<?php echo $field->id_field ?>" class="btn btn-default btn-sm m-field-delete field-delete"><i class="zmdi zmdi-close"></i></a>
                                                </div>
                                            </div>
                                        </td>
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
<!--Page Container End Here-->

