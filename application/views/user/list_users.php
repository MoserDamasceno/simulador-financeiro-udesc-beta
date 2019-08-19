<!--Page Container Start Here-->
<section class="main-container main-area">
    <div class="page-header single-line">
        <div class="row">
            <div class="col-md-6">
                <h2>Usuários</h2>
            </div>
            <div class="col-md-6">
                <ul class="list-page-breadcrumb">
                    <li><a href="#">Home <i class="zmdi zmdi-chevron-right"></i></a></li>
                    <li><a href="#">Usuários <i class="zmdi zmdi-chevron-right"></i></a></li>
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
                                        <h3>Lista de usuários</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="widget-header text-right">
                                        <a class="btn btn-primary" href="<?php echo base_url('user/create') ?>">Adicionar usuário</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <table class="table table-striped data-tbl">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Permissão</th>
                                <th class="td-center">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?php echo $user->id_user ?></td>
                                        <td><?php echo $user->name ?></td>
                                        <td><?php echo $user->email ?></td>
                                        <td><?php echo $user->phone ?></td>
                                        <td><?php echo $user->role ?></td>
                                        <td class="td-center">
                                            <div class="btn-toolbar" role="toolbar">
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo base_url('user/edit/' . $user->id_user) ?>" class="btn btn-default btn-sm m-user-edit"><i class="zmdi zmdi-edit"></i></a>
                                                    <a href="#" data-id="<?php echo $user->id_user ?>" class="btn btn-default btn-sm m-user-delete user-delete"><i class="zmdi zmdi-close"></i></a>
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

