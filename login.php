<?php
session_start();

function main()
{
    if(!file_exists("usersRegister.json")) {
       echo "<p>Essa conta ainda não existe</p>";
       echo "<a href='register.php'>Link Link</a>";
    }

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $useremail = $_POST["email"];
        $userpassword = $_POST["password"];

        if (!validateMail($useremail)) {
            //echo "Email inválido";
            return false;
        }

        if (!validatePassword($userpassword)) {
            //echo "Senha inválida";
            return false;
        }

        if (!thisUserExist($useremail, $userpassword)) {
            //echo "Email ou Senha não foram encontrados";
            return false;
        }

        $_SESSION["flag"] = true;

        header("Location: ./index.php");
    }
}

function validateMail($email)
{
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

function validatePassword($password)
{
    if (empty($password) || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
        return false;
    }
    return true;
}

function thisUserExist($email, $password)
{
    $jsonbody = file_get_contents("usersRegister.json");
    $filedecoded = json_decode($jsonbody);


    foreach ($filedecoded as $users) {
        $userEmailListed = $users->usermail;
        $userPassListed = $users->userpassword;
        if ($userEmailListed == $email && $userPassListed == $password) {
            $userObject = [
                "username" => $users->name,
                "email" => $email
            ];
            $_SESSION["userinfo"] = $userObject;

            return true;
        }
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

                    <form class="box2" action="./login.php" method="post">
                        <h3 style="margin-bottom: 0;">E-mail</h3>
                        <input type="name" class="textBox" id="email" placeholder="Digite seu email" name="email">
                        <h3 style="margin-bottom: 0;">Senha</h3>
                        <input type="password" class="textBox" id="password" name="password" placeholder="Digite sua senha">
                        <button class="eyeButton" type="button" onclick="showPass('password', 'eyeButton1', 'eye1')" id="eyeButton1">
                            <img src="./assets/eye.svg" class="eye" id="eye1">
                        </button>
                        <div class="errorBox" id="error"></div>
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