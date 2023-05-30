<?php

require './core.php';

include 'src/userConfig.php';

$userConfig = new Userconfiguration();

if (isset($_POST["logOut"])) {
    $userConfig->endSession(true, "./login.php");
}

if (isset($_POST["change"])) {
    $user->changeUserInfo();
}

session_start();

if (!isset($_SESSION["flag"])) {
    header("Location: ./login.php");
}

$userinfo = $_SESSION['userinfo'];

$name = $userinfo["name"];

$email = $userinfo["email"];

$nameSeparate = explode(" ", $name);

$firstName = $nameSeparate[0];

$hellophrase = "<h1> Hello! Welcome, $firstName </h1>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel='stylesheet' href='./style.css'>
    <style>
        .content {
            justify-content: center;
            position: relative;
        }

        #logout {
            background-color: #e53300;
            color: #ff9b7f;
        }
    </style>


</head>

<body>
    <div class="fullcontent">
        <a href="./index.php"><img src="./assets/logo.svg" class="logo"></a>
        <div class="main">
            <?php echo $hellophrase; ?>

            <h3><?php echo $email; ?></h3>

            <button class="configButton" onclick="OpenAndCloseDivs( 'configButton', 'configuration', 'open')" id="configButton">Configuração</button>

            <div class="config" id="configuration">
                <button class="exit" onclick="OpenAndCloseDivs('configButton', 'configuration', 'close')">X</button>
                <div id="config-button-area">
                    <button class="optionButton">Modificar Senha</button>
                    <button class="optionButton">Sair</button>
                    <button class="optionButton">Excluir conta</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src='script.js'>

</script>

</html>