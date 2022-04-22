<?php
//print_r($filtros);exit;
?>
<script>

</script>
<div class="right_col" role="main">
    <div class="x_panel">
        <div class="x_title">
            <h2>Relatorio:<small>Auditoria Cadastro de Paciente</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li>
                    <a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @if ($msg_erro)
                <div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                    <?= $msg_erro ?>
                </div>
            @endif
            @if ($msg)
                <div class="alert alert-success  alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                    <?= $msg ?>
                </div>
            @endif
            <form name="form1" method="post" action="{{ route('pac.audit') }}" class="form-horizontal form-label"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="" name="acao" id="acao" />
                <div class="form-group row">
                    <div class='control-label col-md-2 col-sm-2 col-xs-12' style="margin-top: 0px; padding-top: 0px;">
                        <label for="dt_periodo01">Código de Paciente:</label>
                        <input value="{{ $filtros->patient_id }}" type='number' class="form-control"
                            id='patient_id' name='patient_id' title="  " />
                    </div>
                </div>
                <div class="form-group row right" style="text-align: right">
                    <div class="col-md-12 offset-md-12">
                        <input class="btn btn-primary" type="submit" name="salvar" id="button" value="Processar"
                            onclick="$('#acao').val('validar')" />

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
