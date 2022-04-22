
<script>
    function consultaPaciente() {
        var ds_view = 'paciente.modalPaciente';
        var pesID = $('#pesID').val()
        var pesName = $('#pesName').val()
        var pesEmail = $('#pesEmail').val()
       
        $.post("{{route('user.getuser')}}", {user_id:pesID, name:pesName, email:pesEmail, ds_view: ds_view,'_token': '{{ csrf_token() }}'},
            function(pegar_dados) {
                complete: $("#tab").empty().html(pegar_dados);
            }
        );
        
    }
</script>
<div class="modal-header">
    <h4 class="modal-title count blue" id="exampleModalLabel" style="text-align: center;"><b>Consulta de Usuário</b></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    
</div>
<div style=" padding: 10px 10px 10px 10px ">
    <form id="ajax_form">
        <table class="table table-striped" style="margin-top: 0px;">
            
                <tr>
                    <td colspan="3" style=" text-align: center;"><strong>### LISTA ###</strong></td>
                    <td colspan="1" style=" text-align: center;"> <button class="btn btn-outline-secondary" type="button" title="" onclick="consultaPaciente()"><span class="glyphicon glyphicon-search"></span></button></td>
                </tr>
                <tr>
                    <th style=" text-align: center; width: 10%;">#</th>
                    <th style=" text-align: left; width: 40%;">Nome</th>
                    <th style=" text-align: left; width: 40%;">E-mail</th>
                    <th style=" text-align: center; width: 10%;">Ativo</th>
                </tr>
                <tr>
                    <th style=" text-align: center;"><input type="text" value="" id="pesID" class="form-control" name="pesID" title=""/></th>
                    <th style=" text-align: left;"><input type="text" value="" id="pesName" class="form-control" name="pesName" title=""/></th>
                    <th style=" text-align: center;"><input type="text" value="" id="pesEmail" class="form-control" name="pesEmail"/></th>
                    <th style=" text-align: center;"></th>
                </tr>
            
                <tbody id="tab">
                @foreach ($user as $i)
                <tr onclick="$('#user_id2').val('{{$i->id}}');document.getElementById('formPesq').submit()" style="cursor: pointer">
                    <td style=" text-align: right;">{{$i->id}}</td>
                    <td>{{$i->name}}</td>
                    <td style=" text-align: left;">{{$i->email}}</td>
                    <td style=" text-align: center;">{{(($i->sn_active=='S')?"SIM":"NÃO")}}</td>
                </tr>
                @endforeach
                <td colspan="4" style=" text-align: center;">
                    <button type="button" data-dismiss="modal" class="btn btn-success col-md-12" >Fechar</button>
                </td>
            </tbody>
        </table>
</div>
<div id="ret" name="ret"></div>