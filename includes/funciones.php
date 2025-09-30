<?php

require 'app.php';

function incluirTemplate(string $nombre) {
    include TEMPLATES_PATH . "/{$nombre}.php";
}