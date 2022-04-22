<?php
//echo $msg;exit;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--<link rel="icon" href="img/favicon.ico">-->
    <link rel="icon" href="img/icons/ambulancia.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Cadastro de Paciente</title>
    <!-- Bootstrap -->
    <link href="/../../vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min2.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center login-img3-body">

    <main class="form-signin">
        <form class="login-form" method="post" action="<?= base_url('loginctrl/signIn') ?>">
            <?= csrf_field() ?>
            <div class="login-wrap">
                <img class="mb-4" src="img/logo_pac.png" alt="" width="60%"><br>
                <!--<h1 class="h3 mb-3 fw-normal" style="color: #1f13c5;">TESTE DO PEZINHO</h1>-->
                <strong>CADASTRO DE PACIENTE</strong><br><br>

                <div class="form-floating">
                    <input type="email" name="email" class="form-control" placeholder="E-mail"
                        required="" style="text-transform: lowercase;">
                    <label for="floatingInput">E-mail</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" placeholder="Senha" required="">
                    <label for="floatingPassword">Senha</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <!--<input type="checkbox" value="remember-me"> Remember me-->
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
            </div>
            <?php
            $msg = session()->getFlashData('msg');
            if (!empty($msg)){
            ?>
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <?=esc($msg)?>
            </div>
            <?php } ?>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–<?= date('Y')?></p>
        </form>
    </main>
</body>

</html>
