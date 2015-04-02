<?php
session_start();

require_once 'autoload.php';

$router = new \Controller\Router();
$router->routeRequest();