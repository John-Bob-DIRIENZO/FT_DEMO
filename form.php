<?php

$input = file_get_contents("php://input");
$_POST = json_decode($input, true);


setcookie("MON_AUTH", "token", 8709698758, "/", ".ipama.fr", false, true);

