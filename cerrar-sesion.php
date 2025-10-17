<?php 
    session_start();
    $_SESSION = []; // reescribir el array de sesion
    header('Location: /');
?>