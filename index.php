<?php

session_start();

spl_autoload_register(function($class){
    include 'classes/' . $class . '.php';
});

include 'app/Router.php';

$router = new Router();
try {

    $router->requeteUrl();
}catch (Exception $e){
    var_dump($e->getMessage());
}