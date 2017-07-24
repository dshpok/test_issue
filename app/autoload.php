<?php

function __autoload ($className){

    $filename = $className . '.php';
    require_once ($filename);
};

