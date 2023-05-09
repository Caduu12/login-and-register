<?php

if (isset($_POST["logOut"])) {
    setcookie(session_name(), "", time() - 3600);
    session_unset();
    header("Location: ./login.php");
}

session_start();

if (!isset($_SESSION["flag"])) {
    header("Location: ./login.php");
}

$userinfo = $_SESSION['userinfo'];

$name = $userinfo["username"];

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
        <div class="main" onclick="sessionEdit()">
            <?php echo $hellophrase; ?>

            <form action="index.php" method="post">
                <input type="submit" name="logOut" value="Fazer LogOut" id="logout">
            </form>
        </div>
    </div>
</body>
<script src='script.js'>
    
</script>

</html>