<?php

include './models/user.php';

include './src/validation.php';

include 'src/userConfig.php';

require './core.php';

session_start();

function main()
{
    $validation = new Validation();

    $userConfig = new Userconfiguration();

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $useremail = strtolower($_POST["email"]);
        $validation->logInValidationTrigger($useremail, $_POST["password"]);
    }

    $userConfig->defineUserRole();

    if ($_SESSION["flag"] == true && $_SESSION["admin_user"] == true) {
        header("Location: ./administration-pages/admin-main.php");
    }

    if ($_SESSION["flag"] == true  && $_SESSION["admin_user"] == false) {
        header("Location: ./index.php");
    }

}

main()

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Roboto&display=swap' rel='stylesheet'>
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    </style>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="content">
        <a href="./index.php"><img src="./assets/logo.svg" class="logo"></a>
        <div class="input">
            <div class="main" id="main">
                <div id="inputBody">
                    <div class="box1">
                        <h1 class="title"><img src="./assets/log-in.png" class="" style="margin-bottom: -4px; margin-right: 5px;">Faça seu login</h1>
                        <p class="topText">Entre com suas informações de cadastro.</p>
                    </div>
                    <?php
                    if ($errorMessage = getSessionFlashError()) {
                        echo '<div class="errorBox" id="error">' . $errorMessage . '</div>';
                    }
                    ?>
                    <form class="box2" action="./login.php" method="post">
                        <h3 style="margin-bottom: 0;">E-mail</h3>
                        <input type="name" class="textBox" id="email" placeholder="Digite seu email" name="email">
                        <h3 style="margin-bottom: 0;">Senha</h3>
                        <input type="password" class="textBox" id="password" name="password" placeholder="Digite sua senha">
                        <button class="eyeButton" type="button" onclick="showPass('password', 'eyeButton1', 'eye1')" id="eyeButton1">
                            <img src="./assets/eye.svg" class="eye" id="eye1">
                        </button>
                        <div class="buttonBox">
                            <input type="submit" value="ENTRAR" class="submitButton" onclick="submitForm()">
                            <a href="./register.php" class="link">Não tem conta conosco? Cadastre-se</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="photo"></div>
</body>
<script src="./script.js"></script>
<!-- pattern="^(?=.*[0-9].*)(?=.*[a-zA-Z])(?!.*\s)[0-9a-zA-Z*$-+?_&=!%{}/'.]*$" -->

</html>