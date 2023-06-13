<?php

require_once 'vendor/autoload.php';

$router = new \App\Fram\Router();

$router->getRoutesJson(dirname(__FILE__) . "/Autre/routes.json");

//$path = $_GET['p'] ?? "/";
//switch ($path) {
//    case "show-perso":
//        (new \App\Controller\PersonnageController())->getAllPersonnages();
//        break;
//    case "play":
//        (new \App\Controller\PersonnageController())->faireBagarre($_GET['id']);
//        break;
//    default:
//        echo "404 NOT FOUND";
//        break;
//}

exit;
