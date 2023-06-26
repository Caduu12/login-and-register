<?php
include '../models/Travel.php';

include '../src/userConfig.php';

require '../core.php';

require '../userRoute.php';

$userConfig = new Userconfiguration();

$travel = new Travel();

if (isset($_POST["log-out"])) {
    $userConfig->endSession(true, "/../login.php");
    exit();
}

session_start();

isRouteCorrect(basename(__FILE__));

$usersTravelHistory = $travel->selectJoin("INNER JOIN", "users", array("`users`" => "`id`", "`travels`" => "`user_id`"), "`users`.`name`, `users`.`email`, `travels`.`travel_name`, `travels`.`travel_purchase_date`");

$tudo = "";

$buttonDesign = "<button onclick=modal('class aqui') class='info-button'>i</button";

foreach ($usersTravelHistory as $arrays => $key) {
    $timestamp = strtotime($key[2]);
    $date = date("H:i d/m/Y", $timestamp);
    $tudo .=  "<tr> <td class='user-data-cell'>" . $key[0] . "</td> <td class='user-data-cell'>" . $key[1] . "</td> <td class='user-data-cell'>" . $key[2] . "</td> <td class='user-data-cell'>" . $key[3] . "</td> <td class='user-data-cell'>" . $buttonDesign . " </td> </tr>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>
    <link rel='stylesheet' href='./../style.css'>
</head>

<body>
    <div class="fullcontent">
        <img src="./../assets/logo.svg" class="logo">
        <form action="./admin-main.php" method="post">
            <input type="submit" class="optionButton" value="Sair" name="log-out">
        </form>

        <div>
            <table class="user-data-table">
                <thead id="user-travel-data-table-head">
                    <tr>
                        <td class="user-data-cell">Nome do usuário</td>
                        <td class="user-data-cell">Email do usuário</td>
                        <td class="user-data-cell">Nome da viagem</td>
                        <td class="user-data-cell">Data da compra</td>
                        <td class="user-data-cell">Mais Informações</td>
                    </tr>
                </thead>
                <tbody id="user-travel-data-table-body">
                    <?php echo $tudo; ?>
                </tbody>
            </table>
            <?php echo print_r($_SESSION["userinfo"]["email"])?>
        </div>
    </div>
    <div class="info modal-close"></div>
</body>
<script src='./../script.js'>

</script>

</html>