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
                <li>
                    <form id="back" method="POST" action="{{ route('pac.audit') }}">
                        @csrf
                        <input type="hidden" name="patient_id" id="" value="{{$filtros->patient_id}}">
                    </form>
                    <a class="collapse-link" onclick="document.getElementById('back').submit()"><i class="fa fa-mail-reply" title="Voltar a tela de consulta"></i></a>
                </li>
                <li>
                    <a href="{{route('pac.audit',['patient_id' => $filtros->patient_id,'print'=>'print', 'acao' => 'validar'])}}" target="_blank"><i class="fa fa-print" title="Imprimir consulta informada na tela"></i></a>
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
                                    <th>Campo</th>
                                    <th>Antes</th>
                                    <th>Depois</th>
                                    <th>Data</th>
                                    <th>Usuário</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($lista as $i)
                                <tr>
                                    <td>{{$i->id}}</td>
                                    <td>{{$i->campo}}</td>
                                    <td>{{$i->antes}}</td>
                                    <td>{{$i->depois}}</td>
                                    <td>{{$i->dt_alteracao}}</td>
                                    <td>{{$i->name}}</td>
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
