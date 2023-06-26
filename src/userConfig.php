<?php

class Userconfiguration
{
    function endSession($redirect = false, $fileToRedirect = null)
    {
        setcookie(session_name(), "", time() - 3600);
        session_unset();
        session_destroy();
        if ($redirect === true) {
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
}
