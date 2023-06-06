<?php

include './models/Travel.php';

require './core.php';

include 'src/userConfig.php';

$userConfig = new Userconfiguration();

$travel = new Travel();

if (isset($_POST["log_out"])) {
    $userConfig->endSession(true, "./login.php");
}

// if (isset($_POST["change"])) {
//     $user->changeUserInfo();
// }

session_start();

if (!isset($_SESSION["flag"])) {
    header("Location: ./login.php");
}

$userinfo = $_SESSION['userinfo'];

$userName = $userConfig->showUserName($userinfo);

$userId = $userinfo["id"];

$userTravelLog = $travel->select(array("user_id" => $userId));

$userTableData = "";

foreach($userTravelLog as $value) {
    $timestamp = strtotime($value[2]);
    $date = date("H:i d/m/Y", $timestamp);
    $userTableData .= "<tr> <td class='user-data-cell'>" . $value[1] . "</td> <td class='user-data-cell'>" . $date ." </td> </tr>";
}

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
        <h1> Hello! Welcome, <?php echo $userName; ?> </h1>

            <h3><?php echo $userinfo["email"]; ?></h3>

            <button class="configButton" onclick="OpenAndCloseDivs( 'configButton', 'configuration', 'open')" id="configButton">Configuração</button>

            <div class="config" id="configuration">
                <button class="exit" onclick="OpenAndCloseDivs('configButton', 'configuration', 'close')">X</button>
                <div id="config-button-area">
                    <button class="optionButton">Modificar Senha</button>
                    <form action="./index.php" method="post">
                        <input type="submit" class="optionButton" value="Sair" name="log_out">
                    </form>
                    <button class="optionButton">Excluir conta</button>
                </div>
            </div>
            <div>
            <table class="user-data-table">
                <thead id="user-travel-data-table-head">
                    <tr>
                        <td class="user-data-cell">Nome da viagem</td>
                        <td class="user-data-cell">Data da compra</td>
                    </tr>
                </thead>
                <tbody id="user-travel-data-table-body">
                        <?php echo $userTableData?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</body>
<script src='script.js'>

</script>

</html>