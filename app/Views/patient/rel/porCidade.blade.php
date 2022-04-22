<?php
//print_r($filtros);exit;
?>
<script>

</script>
<div class="right_col" role="main">
    <div class="x_panel">
        <div class="x_title">
            <h2>Relatorio:<small>Paciente por Cidade</small></h2>
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
            <form name="form1" method="post" action="{{ route('pac.paccidade') }}" class="form-horizontal form-label"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="" name="acao" id="acao" />

                <div class="form-group row">
                    <div class='control-label col-md-4 col-sm-4 col-xs-12' style="margin-top: 0px; padding-top: 0px;">
                        <label for="ds_cidade">Cidade:</label>
                        <select class="form-control" name="ds_cidade" id="ds_cidade">
                            <option></option>
                            @foreach ($cidade as $i)
                                <option {{ $filtros->ds_cidade == 'S' ? 'selected' : null }}
                                    value="{{ $i->cidade_uf }}">{{ $i->cidade_uf }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='control-label col-md-3 col-sm-3 col-xs-12' style="margin-top: 0px; padding-top: 0px;">
                        <label for="ds_ordem">Cidade:</label>
                        <select class="form-control" name="ds_ordem" id="ds_ordem">
                                <option {{ $filtros->ds_ordem == 'p.name' ? 'selected' : null }}value="p.name">Nome Paciente</option>
                                <option {{ $filtros->ds_ordem == 'p.created_at' ? 'selected' : null }}value="p.created_at">Data de Criação</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class='control-label col-md-2 col-sm-2 col-xs-12' style="margin-top: 0px; padding-top: 0px;">
                        <label for="dt_periodo01">Cadastrado de:</label>
                        <input value="{{ $filtros->dt_periodo01 }}" type='date' class="form-control"
                            id='dt_periodo01' name='dt_periodo01' title="  " />
                    </div>
                    <div class='control-label col-md-2 col-sm-2 col-xs-12' style="margin-top: 0px; padding-top: 0px;">
                        <label for="dt_periodo02">até:</label>
                        <input value="{{ $filtros->dt_periodo02 }}" type='date' class="form-control"
                            id='dt_periodo02' name='dt_periodo02' title="  " />
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
