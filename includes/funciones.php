<?php

require 'app.php';

function incluirTemplate(string $nombre) {
    include TEMPLATES_PATH . "/{$nombre}.php";
}

function estaAutenticado() : bool {
    session_start();
    $auth = $_SESSION['login'];
    if($auth) {
        return true;
    }
    return false;
}