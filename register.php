<?php
session_start();

function main()
{
    if (isset($_POST["email"]) && isset($_POST["password"])) {

        $username = $_POST["username"];
        $useremail = $_POST["email"];
        $userpassword = $_POST["password"];
    
        if (file_exists("usersRegister.json")) {
    
            if (!validateName($username)) {
                $_SESSION['status'] = "error";
                $_SESSION['mensagem'] = "Nome invalido";
    
                header("Location: login.php");
                return false;
            }
    
            if (!validateMail($useremail)) {
                $_SESSION['status'] = "error";
                $_SESSION['mensagem'] = "E-mail invalido";
                
                header("Location: login.php");
                return false;
            }
    
            if (!validatePassword($userpassword)) {
                $_SESSION['status'] = "error";
                $_SESSION['mensagem'] = "E-mail invalido";
    
                header("Location: login.php");
                return false;
            }
    
            $isRegister = createUserInFile($username, $useremail, $userpassword);
    
            if (validateMail($useremail) && validateMail($useremail) && validatePassword($userpassword)) {
                session_unset();
                header("Location: index.php");
            }
        }
    
        if (!file_exists("usersRegister.json")) {
            createUserFile($username, $useremail, $userpassword);
        }
    }
}



function createUserInFile($username, $useremail, $userpassword)
{
    $baseJsonFile = file_get_contents("usersRegister.json");

    $decodedObject = json_decode($baseJsonFile);


    // TODO: Descobrir o tipo de dado que retorno $decordedObject

    // TODO: Se for um array, iterar neste array buscar objeto users e comparar cada item, com o $useremail, $userpassword

    // TODO: Dentro do loop identificar se o usuario e senha ja existem, caso existir $_SESSION['status'], $_SESSION['mensagem']
    // return "erro, usuario ja existente e redirecionar para a tela de cadastro";

    $newUserObject = [
        "name" => $username,
        "usermail" => $useremail,
        "userpassword" => $userpassword
    ];

    array_push($decodedObject, $newUserObject);

    $encodeToJson = json_encode($decodedObject);

    $editingFile = fopen("usersRegister.json", "w");
    echo "Foi escrito";
    fwrite($editingFile, $encodeToJson);

    fclose($editingFile);
}

function createUserFile($username, $useremail, $userpassword)
{
    $creatingFile = fopen("usersRegister.json", "w");

    $jsonBasicFormat = [
        [
            "name" => $username,
            "usermail" => $useremail,
            "userpassword" => $userpassword
        ]
    ];

    $jsonbody = json_encode($jsonBasicFormat);

    fwrite($creatingFile, $jsonbody);

    fclose($creatingFile);
}

function validateName($name)
{
    if (empty($name) || !preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/", $name)) {
        return false;
    }
    return true;
}

function validateMail($email)
{
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !thisEmailExist($email)) {
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


function thisEmailExist($email)
{
    $userFile = file_get_contents("usersRegister.json");
    $fileContentDecoded = json_decode($userFile);

    foreach ($fileContentDecoded as $user) {
        $otherEmailUsers = $user->usermail;
        if ($otherEmailUsers == $email) {
            return false;
        }
    }
    return true;
}

main();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href="./style.css">
    <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Roboto&display=swap' rel='stylesheet'>
    <title>Teste</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    </style>

</head>

<body>
    <div class="content">
        <a href="./index.php"><img src="./assets/logo.svg" class="logo"></a>
        <div class="input">
            <div class="main2" id="main">
                <div id="inputBody">
                    <div class="box1">
                        <?php
                        if (isset($_SESSION['status']) && $_SESSION['status'] == "error") {
                            echo '<h1>' . $_SESSION['mensagem'] . '</h1>';
                        }
                        ?>
                        <h1 class="title"><img src="./assets/log-in.png" class="" style="margin-bottom: -4px; margin-right: 5px;">Crie sua conta</h1>
                        <p class="topText" style="font-family: 'Roboto';">Entre com suas informações para cadastro.</p>
                    </div>

                    <form class="box2" style="margin-top: -7px;" action="./register.php" method="post">
                        <h3 style="margin-bottom: 0;">Nome</h3>
                        <input type="text" class="textBox" id="name" placeholder="Digite seu nome" name="username">

                        <h3 style="margin-bottom: 0; margin-top: -1px;">E-mail</h3>
                        <input type="text" class="textBox" id="email" placeholder="Digite seu email" name="email">

                        <h3 style="margin-bottom: 0; margin-top: -1px;">Senha</h3>
                        <input type="password" class="textBox" id="password" placeholder="Crie sua senha" name="password">
                        <button class="eyeButton" id="eyeButton1" type="button" onclick="showPass('password', 'eyeButton1', 'eye1')">
                            <img src="./assets/eye.svg" class="eye" id="eye1">
                        </button>

                        <h3 style="margin-bottom: 0; margin-top: -23px;">Confirme a senha</h3>
                        <input type="password" class="textBox" id="password2" placeholder="Confirme sua senha" pattern="^(?=.*[0-9].*)(?=.*[a-zA-Z])(?!.*\s)[0-9a-zA-Z*$-+?_&=!%{}/'.]*$" name="confirmPassword">
                        <button class="eyeButton" id="eyeButton2" type="button" onclick="showPass('password2', 'eyeButton2', 'eye2')">
                            <img src="./assets/eye.svg" class="eye" id="eye2">
                        </button>

                        <div class="errorBox" id="error"></div>

                        <div class="buttonBox">
                            <input type="submit" value="ENTRAR" class="submitButton2" action="something here!!!">
                            <a href="./login.html" class="link">Não tem conta conosco? Cadastre-se</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="photo"></div>
</body>
<script src="script.js"></script>
<!-- pattern="^(?=.*[0-9].*)(?=.*[a-zA-Z])(?!.*\s)[0-9a-zA-Z*$-+?_&=!%{}/'.]*$" -->

</html>