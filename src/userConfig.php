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

    function changeUserInfo() {
        
    }
}
