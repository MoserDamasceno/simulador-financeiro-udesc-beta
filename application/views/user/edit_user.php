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
                            <h3>Editar usuário</h3>
                            <p>Preencha os campos abaixo para editar o usuário</p>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo base_url('user') ?>" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                    <div class="widget-container">
                        <div class="widget-content">
                            <div class="row">
                                <div class="col-md-8">
                                    <form class="form-horizontal" method="POST" action="<?php echo base_url('user/save' .'/'. $user->id_user) ?>">
                                        <input type="hidden" name="id_user" value="<?php echo $user->id_user ?>">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Nome</label>
                                            <div class=" col-md-8">
                                                <input type="text" value="<?php echo $user->name ?>" name="name" class="form-control" placeholder="Insira o nome aqui">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">E-mail</label>
                                            <div class=" col-md-8">
                                                <input type="email" value="<?php echo $user->email ?>" name="email" class="form-control" placeholder="Insira o e-mail aqui">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Telefone</label>
                                            <div class=" col-md-8">
                                                <input type="text" value="<?php echo $user->phone ?>" name="phone" class="form-control phone-mask" placeholder="Insira o telefone aqui">
                                            </div>
                                        </div>
                                        <?php if ($this->session->userdata('user')->role_id == 1): ?>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Tipo de usuário</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" name="role_id">
                                                        <option value>Selecione a permissão</option>
                                                        <?php foreach ($type_user as $tp): ?>
                                                            <option value="<?php echo $tp->id ?>" <?php echo ($tp->id == $user->role_id)? 'selected' :'' ; ?>><?php echo $tp->role ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Senha</label>
                                            <div class="col-md-8">
                                                <input type="password" name="password" class="form-control" placeholder="Deixe em branco para não alterar a senha">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">&nbsp;</label>
                                            <div class="col-md-8">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">Salvar</button>
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