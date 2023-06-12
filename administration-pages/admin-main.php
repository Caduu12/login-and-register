<?php
include '../models/Travel.php';
    
include '../src/userConfig.php';
    
require '../core.php';

require '../userRoute.php';

$userConfig = new Userconfiguration();
    
$travel = new Travel();

if (isset($_POST["log_out"])) {
    $userConfig->endSession(true, "./../login.php");
}

session_start();

isRouteCorrect(basename(__FILE__));

$usersTravelHistory = $travel->select();

echo dd($usersTravelHistory);

die();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrção</title>
    <link rel='stylesheet' href='./../style.css'>
</head>

<body>
    <div class="fullcontent">
        <img src="./../assets/logo.svg" class="logo">
        <form action="./admin-main.php" method="post">
            <input type="submit" class="optionButton" value="Sair" name="log_out">
        </form>

        <div>
            
        </div>
    </div>
</body>
<script src='script.js'>

</script>

</html>