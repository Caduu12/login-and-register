<?php

include './models/user.php';

include './src/validation.php';

require './core.php';

session_start();

function main()
{
    $validation = new Validation();

    $user = new User();

    if (isset($_POST["email"]) && isset($_POST["password"])) {

        $username = $_POST["username"];
        $useremail = strtolower($_POST["email"]);
        $userpassword = $_POST["password"];
        $userConfirmedPassword = $_POST["confirmPassword"];

        if ($validation->registerValidationTrigger($username, $useremail, $userpassword, $userConfirmedPassword)) {
            $user->insert(array('name' => $username, 'email' => $useremail, 'password' => $userpassword, 'is_admin' => false));
            session_unset();
            header('location: login.php');
        }
    }
}

main();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel='stylesheet' href="./style.css">
    <link rel="icon" href="assets/logo.svg" type="image/icon type">
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Roboto&display=swap' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    </style>

</head>

<body>
    <div class="content">
        <a href="./index.php"><img src="./assets/logo.svg" class="logo"></a>
        <div class="input">
            <div class="main" id="main">
                <div id="inputBody">
                    <div class="box1">
                        <h1 class="title"><img src="./assets/log-in.png" class="" style="margin-bottom: -4px; margin-right: 5px;">Crie sua conta</h1>
                        <p class="topText" style="font-family: 'Roboto';">Entre com suas informações para cadastro.</p>
                    </div>

                    <?php
                    if ($errorMessage = getSessionFlashError()) {
                        echo '<div class="errorBox" id="error">' . $errorMessage . '</div>';
                    }
                    ?>
                    <form class="box2" style="margin-top: -7px;" action="./register.php" method="post">
                        <h3 style="margin-bottom: 0;">Nome</h3>
                        <input type="text" class="textBox" id="name" placeholder="Digite seu nome" name="username">

                        <h3 style="margin-bottom: 0; margin-top: -1px;">E-mail</h3>
                        <input type="email" class="textBox" id="email" placeholder="Digite seu email" name="email">

                        <h3 style="margin-bottom: 0; margin-top: -1px;">Senha</h3>
                        <input type="password" class="textBox" id="password" placeholder="Crie sua senha" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" name="password"> 
                        <button class="eyeButton" id="eyeButton1" type="button" onclick="showPass('password', 'eyeButton1', 'eye1')">
                            <img src="./assets/eye.svg" class="eye" id="eye1">
                        </button>

                        <h3 style="margin-bottom: 0; margin-top: -23px;">Confirme a senha</h3>
                        <input type="password" class="textBox" id="password2" placeholder="Confirme sua senha" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"  name="confirmPassword">
                        <button class="eyeButton" id="eyeButton2" type="button" onclick="showPass('password2', 'eyeButton2', 'eye2')">
                            <img src="./assets/eye.svg" class="eye" id="eye2">
                        </button>
                </div>
                <div class="buttonBox">
                    <input type="submit" value="CADASTRAR" class="submitButton2" onclick="submitForm()">
                    <a href="./login.php" class="link">Já tem uma conta? Faça o login</a>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="photo"></div>
</body>
<script src="./script.js"></script>

</html>