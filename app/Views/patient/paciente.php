<?php
//print_r($uf);exit;

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
        $.post("<?= route_to('validacns') ?>", {
            cns: cns
        }).done(function(resultado) {
            alert(resultado);
            $("#pcns").val(resultado);

        });
    }

    function consultaPaciente() {
        var ds_view = 'paciente.modalPaciente';
        document.getElementById("RETORNO_MODAL").innerHTML =
            "<div style='text-align: center;'><br><br><br><img height='90' src='img/gif/icons8-spinner.gif'> <br><br><FONT face=verdana color=#94d6ef size=2><B>CARREGANDO...<BR/><BR/><BR/></B></FONT></div>";
        $.post("<?=route_to('pac.modal')?>", {ds_view: ds_view,'_token': '<?= csrf_token() ?>'},
            function(pegar_dados) {
                complete: $("#RETORNO_MODAL").empty().html(pegar_dados);
            }
        );
    }
    $(function() {
        $('#pphoto').change(function(){
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
            <h2>Cadastro:<small>Paciente</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li>
                    <a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if ($msg_erro){?>
                <div class="alert alert-danger alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                    <?= $msg_erro ?>
                </div>
            <?php }
            if ($msg){ ?>
                <div class="alert alert-success  alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span>
                    </button>
                    <?= $msg ?>
                </div>
            <?php } ?>
            <div class="modal fade" id="pesquisaPaciente" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document"
                    style="max-width: 100%;min-width: 50%; width: auto; display: table;">
                    <div class="modal-content" style=" border: 1px #0fa6f1 solid;">
                        <div id="RETORNO_MODAL">
                        </div>
                    </div>
                </div>
            </div>
            
            <form action="<?=route_to('pac.index')?>" method="POST" id="formPesq" class="form-horizontal form-label" > 
                <?= csrf_field() ?>
                <input name="patient_id" id="patient_id2" value="" type="hidden"/>
                <input name="acao" id="acaoPesq" value="pesquisar" type="hidden"/>
            </form>
            <form name="form1" method="post" action="<?= route_to('pac.index') ?>" class="form-horizontal form-label" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" value="" name="acao" id="acao" />
                <div class="form-group row">
                    <div class="col col-lg-10">
                        <div class="form-group row">
                            <div class='control-label col-md-6 col-sm-6 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pname">Nome*:</label>
                                <div class="input-group mb-3">
                                <input type="text" value="<?= $patient->pname ?>" id="pname" class="form-control"
                                    name="pname" title="Nome do Paciente"/>
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-toggle="modal" data-target="#pesquisaPaciente" onclick="consultaPaciente();" title="Clique para consultar pacientes já cadastrados"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                            <div class='control-label col-md-6 col-sm-6 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pnamesocial">Nome Social:</label>
                                <input type="text" value="<?= $patient->pnamesocial ?>" id="pnamesocial"
                                    class="form-control" name="pnamesocial" title="Nome pelo qual o paciente prefere ser chamado."/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class='control-label col-md-6 col-sm-6 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pmother">Mãe*:</label>
                                <input type="text" value="<?= $patient->pmother ?>" id="pmother" class="form-control"
                                    name="pmother" title="Nome da mãe do paciente"/>
                            </div>
                            <div class='control-label col-md-6 col-sm-6 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pfather">Pai:</label>
                                <input type="text" value="<?= $patient->pfather ?>" id="pfather" class="form-control"
                                    name="pfather" title="Nome do pai do paciente"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class='control-label col-md-3 col-sm-3 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pbirth">Nascimento*:</label>
                                <input value="<?= $patient->pbirth ?>" type='date' class="form-control" id='pbirth'
                                    name='pbirth' title="Data de Nascimento do paciente."/>
                            </div>
                            <div class='control-label col-md-3 col-sm-3 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pcpf">CPF*:</label>
                                <input value="<?= $patient->pcpf ?>" type='text' class="form-control" id='pcpf' title="CPF do paciente." name='pcpf' onkeypress="return mask(event,this,'###.###.###-##');"/>
                            </div>
                            <div class='control-label col-md-3 col-sm-3 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pcns">CNS*:</label>
                                <input value="<?= $patient->pcns ?>" type='text' class="form-control" id='pcns'
                                    name='pcns' onkeypress="validaCns(this.value)" title="Cartão Nacional SUS do paciente"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class='control-label col-md-3 col-sm-3 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pphone">Telefone:</label>
                                <input value="<?= $patient->pphone ?>" type='text' class="form-control" id='pphone' name='pphone' onkeypress="return mask(event,this,'(##) #####-####')" title="Telefone de contato"/>
                                
                            </div>
                            <div class='control-label col-md-5 col-sm-5 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pcpf">E-mail:</label>
                                <input value="<?= $patient->pemail ?>" type='email' class="form-control" id='pemail' name='pemail' title="E-mail para contato" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class='control-label col-md-2 col-sm-2 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;" >
                                <label for="cep">CEP*:</label>
                                <input value="<?= $adress->cep ?>" type='text' class="form-control" id='cep'
                                    name='cep' onkeypress="return mask(event,this,'##.###-###')"
                                    onblur="pesquisacep(this.value);" title="Para consulta automática do CEP digite o número e depois clicando em outro campo."/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class='control-label col-md-7 col-sm-7 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="logradouro">Endereço*:</label>
                                <input value="<?= $adress->logradouro ?>" type='text' class="form-control"
                                    id='logradouro' name='logradouro' title="" />
                            </div>
                            <div class='control-label col-md-1 col-sm-1 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pnr_adress">Endereço*:</label>
                                <input value="<?= $patient->pnr_adress ?>" type='text' class="form-control"
                                    id='pnr_adress' name='pnr_adress' title="" />
                            </div>
                            <div class='control-label col-md-3 col-sm-3 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pcomplement">Complemento:</label>
                                <input value="<?= $patient->pcomplement ?>" type='text' class="form-control"
                                    id='pcomplement' name='pcomplement' title="" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class='control-label col-md-4 col-sm-4 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="bairro">Bairro*:</label>
                                <input value="<?= $adress->bairro ?>" type='text' class="form-control" id='bairro'
                                    name='bairro' title="" />
                            </div>
                            <div class='control-label col-md-4 col-sm-4 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="cidade">Cidade*:</label>
                                <input value="<?= $adress->cidade ?>" type='text' class="form-control" id='cidade'
                                    name='cidade' title="" />
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class='control-label col-md-4 col-sm-4 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="uf">Estado*:</label>
                                <select class="form-control" name="uf" id="uf">
                                    <option></option>
                                    <?php foreach ($uf as $i){ ?>
                                        <option <?= $adress->uf == $i['short_name'] ? 'selected' : null ?>
                                            value="<?= $i['short_name'] ?>"><?= $i['long_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class='control-label col-md-12 col-sm-12 col-xs-12'
                                style="margin-top: 0px; padding-top: 0px;">
                                <label for="pobs">Observação:</label>
                                <textarea class="form-control" placeholder="" id="pobs" name="pobs"
                                    style="height: 100px"><?= $patient->pobs ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-2 left">
                        <img id="image"
                            src="<?= isset($patient->pphoto) ? $patient->pphoto : 'img/ava_patient.jpg' ?>"
                            alt="Picture" width="100%" class="img-thumbnail">
                            
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label for="pphoto" style="padding: 10px 10px;
                                        width: 100%;
                                        background-color: #333;
                                        color: #FFF;
                                        text-transform: uppercase;
                                        text-align: center;
                                        display: block;
                                        margin-top: 0px;
                                        cursor: pointer;" title="Selecionar foto que esteja no arquivo">Atualizar Foto</label>
                            <input value="" type='file' class="form-control" id='pphoto' name='pphoto' title="" style="display: none"/>

                            <input value="<?= $patient->id ?>" type='text' class="form-control" id='patient_id' name='patient_id' title="" readonly style="text-align: right"/>

                            <input value="<?= $adress->id ?>" type='hidden' class="form-control" id='adress_id'
                                name='adress_id' title="" />
                                
                        </div>
                    </div>
                </div>
                <div class="form-group row right" style="text-align: right">
                    <div class="col-md-12 offset-md-12">
                        <a href="<?=route_to('pac.index')?>" class="btn btn-success">Novo</a>
                        <input class="btn btn-success" type="submit" name="salvar" id="button" value="Salvar"
                            onclick="$('#acao').val('validar')" />
                        <input class="btn btn-danger" type="submit" name="excluir" id="button" value="Excluir"  onclick="$('#acao').val('excluir')"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>