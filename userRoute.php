<?php

if(!function_exists('redirectByPermission')) {
    function redirectByPermission() {
        if ($_SESSION["admin_user"] === false) {
            header("Location: ./index.php");
        }

        if ($_SESSION["admin_user"]) {
            header("Location: ./administration-pages/admin-main.php");
        }
    }
    
}


if (!function_exists('isPermissionCorrect')) {
    function isRouteCorrect($userLocation)
    {
        $commonUserRoute = ["index.php"];

        $adminUserRoute = ["admin-pages.php"];

        if ($_SESSION["admin_user"] === true) {
            $routeToUse = $adminUserRoute;
            $pathToRedirect = "./administration-pages/admin-main.php";

        }

        if ($_SESSION["admin_user"] === false) {
            $routeToUse = $commonUserRoute;
            $pathToRedirect = "../index.php";
        }

        foreach ($routeToUse as $value) {
            if ($userLocation == $value) {
                return true;
            }
        }

        header("Location : " . $pathToRedirect);
    }
}
