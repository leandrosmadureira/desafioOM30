<?php

?>

<div class="right_col" role="main">
    <div class="x_panel">
        <div class="x_title">
            <h2>Editar:<small>Senha</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li>
                    <a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if ($msg_erro){ ?>
                <div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                    <?= $msg_erro ?>
                </div>
            <?php } 
            if ($msg){?>
                <div class="alert alert-success  alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                    <?= $msg ?>
                </div>
            <?php }?>
            <form id="editUser" method="post" action=""
                class="form-horizontal form-label-left">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">id <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="user_id" name="user_id" required="required" class="form-control" value="<?=$login['users_id']?>" readonly>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nome: <span
                            class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="nm_usuario" name="nm_usuario" required="required" class="form-control"
                            value="<?=$login['nm_user']?>" readonly>
                    </div>
                </div>
                <div class="item form-group">
                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Nova Senha*:</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input id="password01" class="form-control" type="password" name="password01"
                            value="<?=((isset($filtros->password01))?$filtros->password01:null)?>">
                    </div>
                </div>
                <div class="item form-group">
                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Confirme a
                        Senha*:</label>
                    <div class="col-md-6 col-sm-6 ">
                        <input id="password02" class="form-control" type="password" name="password02"
                            value="<?=((isset($filtros->password02))?$filtros->password02:null)?>">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button type="submit" class="btn btn-success" name="acao" value="salvar">Salvar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
