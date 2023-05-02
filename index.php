<?php
session_start();

echo print_r($_SESSION);

$name = $_SESSION['name'];

$hellophrase = "<h1> Hello! Welcome, $name </h1>";

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
        * {
            background-color: #24221f;
            position: relative;
            justify-content: center;
        }
    </style>


</head>
<body>
        <?php echo $hellophrase; ?> 
</body>
<script src='script.js'></script>
</html>