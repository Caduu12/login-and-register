<?php

include './models/Travel.php';

require './core.php';

require './userRoute.php';

include 'src/userConfig.php';

$userConfig = new Userconfiguration();

$travel = new Travel();

if (isset($_POST["log_out"])) {
    $userConfig->endSession(true, "./login.php");
}

session_start();

isRouteCorrect(basename(__FILE__));

if (!isset($_SESSION["flag"])) {
    header("Location: ./login.php");
}

$userinfo = $_SESSION['userinfo'];

$userName = $userConfig->showUserName($userinfo);

$userId = $userinfo["id"];

$userTravelLog = $travel->select(array("user_id" => $userId));

$userTableData = "";

foreach ($userTravelLog as $value) {
    $timestamp = strtotime($value[2]);
    $date = date("H:i d/m/Y", $timestamp);
    $userTableData .= "<tr> <td class='user-data-cell'>" . $value[1] . "</td> <td class='user-data-cell'>" . $date . " </td> </tr>";
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
</head>

<body>
    <div class="fullcontent">
        <a href="./index.php"><img src="./assets/logo.svg" class="logo"></a>
        <div class="config modal-close" id="configuration">
            <button class="exit" onclick="modal('configuration')">X</button>
            <div id="config-button-area">
                <button class="optionButton">Modificar Senha</button>
                <form action="./index.php" method="post">
                    <input type="submit" class="optionButton" value="Sair" name="log_out">
                </form>
                <button class="optionButton">Excluir conta</button>
            </div>
        </div>
        <div class="main">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h1> Hello! Welcome, <?php echo $userName; ?> </h1>

                <button class="configButton" onclick="modal('configuration')" id="configButton">Configuração</button>

            </div>

            <h3><?php echo $userinfo["email"]; ?></h3>

            <div>
                <table class="user-data-table">
                    <thead id="user-travel-data-table-head">
                        <tr>
                            <td class="user-data-cell">Nome da viagem</td>
                            <td class="user-data-cell">Data da compra</td>
                        </tr>
                    </thead>
                    <tbody id="user-travel-data-table-body">
                        <?php echo $userTableData ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src='script.js'>

</script>

</html>