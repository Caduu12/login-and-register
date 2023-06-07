<?php
include '../models/Travel.php';

require '../core.php';
    
include '../src/userConfig.php';
    
$userConfig = new Userconfiguration();
    
$travel = new Travel();

if (isset($_POST["log_out"])) {
    $userConfig->endSession(true, "./../register.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>administration</title>
    <link rel='stylesheet' href='./../style.css'>
</head>

<body>
    <div class="fullcontent">
        <img src="./../assets/logo.svg" class="logo">
        <form action="./admin-main.php" method="post">
            <input type="submit" class="optionButton" value="Sair" name="log_out">
        </form>

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
</body>
<script src='script.js'>

</script>

</html>