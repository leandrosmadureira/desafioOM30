<?php
date_default_timezone_set('America/Sao_Paulo');
$cd_usuario = session('cd_usuario');
$nm_usuario = session('nm_usuario');
$email = session('email');
$photo = session('pphoto');
$sessionId = session('sessionId');
$ultimo_acesso = session('ultimo_acesso');
//print_r("Nome: $nm_usuario <br> Usuario: $cd_usuario <br> Fisio: $cd_fisio <br> Nivel: $tp_privilegio <br> Sessão: $sessionId <br>");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/icons/ambulancia.png">
    <title>Cadastro de Paciente|</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="http://localhost/dijs/style/js/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        function session() {
            let data = new Date();
            sessionStorage.setItem('ultimo_acesso', ((data.getFullYear())) + "-" + ((data.getMonth() + 1)) + "-" + data
                .getDate() + " " + data.getHours() + ":" + data.getMinutes() + ":" + data.getSeconds());
            //alert(sessionStorage.getItem('ultimo_acesso'))
            //alert(((data.getFullYear())) + "-" + ((data.getMonth() + 1)) + "-" + data.getDate()  + " "+ data.getHours()+":"+data.getMinutes())
        }

        function mask(e, id, mask) {
            var tecla = (window.event) ? event.keyCode : e.which;
            if ((tecla > 47 && tecla < 58)) {
                mascara(id, mask);
                return true;
            } else {
                if (tecla == 8 || tecla == 0) {
                    mascara(id, mask);
                    return true;
                } else return false;
            }
        }

        function mascara(id, mask) {
            var i = id.value.length;
            var carac = mask.substring(i, i + 1);
            var prox_char = mask.substring(i + 1, i + 2);
            if (i == 0 && carac != '#') {
                insereCaracter(id, carac);
                if (prox_char != '#') insereCaracter(id, prox_char);
            } else if (carac != '#') {
                insereCaracter(id, carac);
                if (prox_char != '#') insereCaracter(id, prox_char);
            }

            function insereCaracter(id, char) {
                id.value += char;
            }
        }
    </script>
</head>

<body class="nav-md" id="body" onmousemove="session()">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?= route_to('Home') ?>" class="site_title"><i class="fa fa-ambulance"></i>
                            <span>Cad. Paciente</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="<?= isset($photo) ? $photo : 'img/ava_medico.jpg' ?>" alt="..."
                                class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Bem Vindo,</span>
                            <h2><?= explode(' ', $nm_usuario)[0] ?></h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3></h3>
                            <ul class="nav side-menu">
                                <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?= route_to('Home') ?>">Home</a></li>

                                    </ul>
                                </li>

                                <li><a><i class="fa fa-edit"></i>Cadastro <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('pac.index') }}">Paciente</a></li>
                                        <li><a href="{{route('user.index')}}">Usuário</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-desktop"></i> Consulta <span
                                            class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{route('pac.paccidade')}}">Pacientes por Cidade</a></li>
                                        <li><a href="{{route('pac.contatopac')}}">Contato Paciente</a></li>
                                        <li><a href="{{route('pac.audit')}}">Auditoria</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!--
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('login.destroy') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
          -->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <!--<img src="img/ava_santa.png" alt="">--><?= explode(' ', $nm_usuario)[0] ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right"
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('login.show') }}"> Alterar Senha</a>
                                    <a class="dropdown-item" href="<?= route_to('signout') ?>"><i
                                            class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>

                            
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->