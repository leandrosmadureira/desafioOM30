<?php 
    $c = 0;
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Paciente por Cidade</title>
    <script language="JavaScript" src="lib/scripts.js"></script>
    <script language="JavaScript" src="lib/scripts.css"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <style type="text/css">
        .style1 {
            font-size: 10px;
            font-weight: bold;
        }

        .style2 {
            font-size: 9px
        }

    </style>
</head>
<style type="text/css">
    body {
        font-size: 12px;
        font-family: Verdana, Arial, Helvetica, sans-serif;
    }

    #conteudo {
        background: #FFFFFF;
        border: #666666 solid 0px;
        margin: auto;
        width: 100%;
        padding-left: 0px;
        padding-right: 0px;
    }

</style>

<body style="border: #666666 solid 2px;">
    <div id="conteudo">
        <table width="100%" align="center">
            <tr>
                <td width="98%" align="center">
                    <img src="" width="100%">
                </td>
            </tr>
        </table>
        
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr bgcolor="#F2F2F2">
                    <th  colspan="9">
                        <p align="center"><strong>CONTATOS DE PACIENTES</strong></p>
                    </th>    
                </tr>

                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                </tr>
            </thead>
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
        </table>    
  <p>&nbsp;</p>
      <div style="position:absolute;bottom:0;width:100%;">
        <p class="style2" align="right">&nbsp;
            Impresso por {{session('nm_usuario')}} em {{date('d/m/Y')}}
        </p>
    </div>
</div>
</body>
</html>
