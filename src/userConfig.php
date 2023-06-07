<?php

class Userconfiguration
{
    function endSession($redirect = false, $fileToRedirect = null)
    {
        setcookie(session_name(), "", time() - 3600);
        session_unset();
        if ($redirect == true) {
            $redirection = "Location: " . $fileToRedirect;
            header($redirection);
        }
    }

    function showUserName($userinfo)
    {
        $name = $userinfo["name"];

        $nameSeparate = explode(" ", $name);

        $firstName = $nameSeparate[0];

        return $firstName;
    }

    function defineUserRole()
    {
        $userAtributtion = $_SESSION["userinfo"]["is_admin"];

        if ( $userAtributtion == true)  {
            $_SESSION["admin_user"] = true;
        }

        if ( $userAtributtion == false) {
            $_SESISON["admin_user"] = false;
        }
    }
}
