<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function dd($data, $clean = true) 
{
    echo '<pre>';
    $clean ? var_export($data) : var_dump($data);
    echo '</pre>';
}