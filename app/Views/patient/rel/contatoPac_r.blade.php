<?php
//print_r($filtros);exit;
?>
<script>

</script>
<div class="right_col" role="main">
    <div class="x_panel">
        <div class="x_title">
            <h2>Relatorio:<small>Contato de Paciente</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <form id="back" method="POST" action="{{ route('pac.contatopac') }}">
                        @csrf
                        <input type="hidden" name="dt_periodo01" id="" value="{{$filtros->dt_periodo01}}">
                        <input type="hidden" name="dt_periodo02" id="" value="{{$filtros->dt_periodo02}}">
                        <input type="hidden" name="ds_ordem" id="" value="{{$filtros->ds_ordem}}">
                        <input type="hidden" name="ds_cidade" id="" value="{{$filtros->ds_cidade}}">
                    </form>
                    <a class="collapse-link" onclick="document.getElementById('back').submit()"><i class="fa fa-mail-reply" title="Voltar a tela de consulta"></i></a>
                </li>
                <li>
                    <a href="{{route('pac.contatopac',['ds_ordem' => $filtros->ds_ordem,'dt_periodo01' => $filtros->dt_periodo01,'dt_periodo02' => $filtros->dt_periodo02,'ds_cidade' => $filtros->ds_cidade,'print'=>'print', 'acao' => 'validar'])}}" target="_blank"><i class="fa fa-print" title="Imprimir consulta informada na tela"></i></a>
                </li>
                <li><a class="collapse-link" onclick="location.reload()"><i class="fa fa-refresh"></i></a>
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

            <div class=" row">
                <div class="x_content">
                    <div class="card-box table-responsive">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th>Cidade</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($lista as $i)
                                <tr>
                                    <td>{{$i->pacient_id}}</td>
                                    <td>{{(($i->pnamesocial)?$i->pnamesocial:$i->pname)}}</td>
                                    <td>{{$i->pcpf}}</td>
                                    <td>{{$i->pemail}}</td>
                                    <td>{{$i->pphone}}</td>
                                    <td style="text-align: right">{{$i->cidade ." - ". $i->uf}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
