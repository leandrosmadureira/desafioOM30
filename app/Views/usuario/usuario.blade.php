<?php
//print_r($filtros);exit;
?>
<script>
    function limpa_cep() {
        //Limpa valores do formulário de cep.
        document.getElementById('logradouro').value = ("");
        document.getElementById('bairro').value = ("");
        document.getElementById('cidade').value = ("");
        document.getElementById('uf').value = ("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('logradouro').value = (conteudo.logradouro);
            document.getElementById('bairro').value = (conteudo.bairro);
            document.getElementById('cidade').value = (conteudo.localidade);
            document.getElementById('uf').value = (conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_cep();
            alert("CEP não encontrado.");
        }
    }

    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('logradouro').value = "...";
                document.getElementById('bairro').value = "...";
                document.getElementById('cidade').value = "...";
                document.getElementById('uf').value = "...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_cep();
        }
    };

    function validaCns(cns) {
        $.post("{{ route('validacns') }}", {
            cns: cns
        }).done(function(resultado) {
            alert(resultado);
            $("#pmother").val(resultado);

        });
    }

    function consultaPaciente() {
        var ds_view = 'paciente.modelPaciente';
        document.getElementById("RETORNO_MODAL").innerHTML =
            "<div style='text-align: center;'><br><br><br><img height='90' src='img/gif/icons8-spinner.gif'> <br><br><FONT face=verdana color=#94d6ef size=2><B>CARREGANDO...<BR/><BR/><BR/></B></FONT></div>";
        $.post("{{route('user.modal')}}", {ds_view: ds_view,'_token': '{{ csrf_token() }}'},
            function(pegar_dados) {
                complete: $("#RETORNO_MODAL").empty().html(pegar_dados);
            }
        );
    }
    $(function() {
        $('#photo').change(function(){
            const file = $(this)[0].files[0]
            const fileReader = new FileReader()
            fileReader.onloadend = function() {
                $('#image').attr('src',fileReader.result)
            }
            fileReader.readAsDataURL(file)
        })
    })
</script>
<div class="right_col" role="main">
    <div class="x_panel">
        <div class="x_title">
            <h2>Cadastro:<small>Usuário</small></h2>
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
            <div class="modal fade" id="pesquisaUser" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document"
                    style="max-width: 100%;min-width: 50%; width: auto; display: table;">
                    <div class="modal-content" style=" border: 1px #0fa6f1 solid;">
                        <div id="RETORNO_MODAL">
                        </div>
                    </div>
                </div>
            </div>
            
            <form action="{{route('user.index')}}" method="POST" id="formPesq" class="form-horizontal form-label" >
                @csrf
                <input name="user_id" id="user_id2" value="" type="hidden"/>
                <input name="acao" id="acaoPesq" value="pesquisar" type="hidden"/>
            </form>
            <form name="form1" method="post" action="{{ route('user.index') }}" class="form-horizontal form-label" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="" name="acao" id="acao" />
                <div class="form-group row">
                    <div class="col col-lg-10">
                        <div class="form-group row">
                            <div class='control-label col-md-6 col-sm-6 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="name">Nome*:</label>
                                <div class="input-group mb-3">
                                <input type="text" value="{{ $user->name }}" id="name" class="form-control"
                                    name="name" title="" {{((isset($user->id))?"readonly":null)}}/>
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-toggle="modal" data-target="#pesquisaUser" onclick="consultaPaciente();" title=""><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                            <div class='control-label col-md-6 col-sm-6 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="email">E-mail:</label>
                                <input type="email" value="{{ $user->email }}" id="email"
                                    class="form-control" name="email" title=""/>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class='control-label col-md-2 col-sm-2 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="sn_active">Ativo:</label>
                                <select class="form-control" name="sn_active" id="sn_active">
                                    <option {{ $user->sn_active == 'S' ? 'selected' : null }} value="S">SIM</option>
                                    <option {{ $user->sn_active == 'N' ? 'selected' : null }} value="N">NÃO</option>
                                </select>
                            </div>
                        
                            <div class='control-label col-md-2 col-sm-2 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="sn_reset">Reset:</label>
                                <select class="form-control" name="sn_reset" id="sn_reset">
                                    <option {{ $user->sn_reset == 'S' ? 'selected' : null }} value="S">SIM</option>
                                    <option {{ $user->sn_reset == 'N' ? 'selected' : null }} value="N">NÃO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-2 left">
                        <img id="image"
                            src="{{ isset($user->photo) ? $user->photo : 'img/ava_medico.jpg' }}"
                            alt="Picture" width="100%" class="img-thumbnail">
                            
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="photo" style="padding: 10px 10px;
                                        width: 100%;
                                        background-color: #333;
                                        color: #FFF;
                                        text-transform: uppercase;
                                        text-align: center;
                                        display: block;
                                        margin-top: 0px;
                                        cursor: pointer;" title="Selecionar foto que esteja no arquivo">Atualizar Foto</label>
                            <input value="" type='file' class="form-control" id='photo' name='photo' title="" style="display: none"/>

                            <input value="{{ $user->id }}" type='text' class="form-control" id='user_id' name='user_id' title="" readonly style="text-align: right"/>
                                
                        </div>
                    </div>
                </div>
                <div class="form-group row right" style="text-align: right">
                    <div class="col-md-12 offset-md-12">
                        <a href="{{route('user.index')}}" class="btn btn-success">Novo</a>
                        <input class="btn btn-success" type="submit" name="salvar" id="button" value="Salvar"
                            onclick="$('#acao').val('validar')" />
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>