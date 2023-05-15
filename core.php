<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (!function_exists('dd')) {
    function dd($data, $clean = true)
    {
        echo '<pre>';
        $clean ? var_export($data) : var_dump($data);
        echo '</pre>';
    }
}

if (!function_exists('setSessionFlashError')) {
    function setSessionFlashError($errorMessage)
    {
        $_SESSION['_error_to_display'] = $errorMessage;
    }
}

if (!function_exists('getSessionFlashError')) {
    function getSessionFlashError()
    {
        if (!isset($_SESSION['_error_to_display'])) {
            return null;
        } 

        $errorMensage = $_SESSION['_error_to_display'];

        unset($_SESSION['_error_to_display']);

        return $errorMensage;
    }
}
