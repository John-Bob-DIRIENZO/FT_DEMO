<?php

require_once './../vendor/autoload.php';

$repo = new \App\Repository\PersonnageRepository(
    new \App\Factory\PDOFactory()
);

$attacker = $repo->getById(intval($_GET['attacker']));
$defender = $repo->getById(intval($_GET['defender']));

switch ($attacker->attack($defender)) {
    case \App\Entity\Personnage::IS_OK:
        $repo->update($defender);
        $error = "ok";
        break;
    case \App\Entity\Personnage::IS_DEAD:
        $repo->deleteById($defender->getId());
        $error = "ok";
        break;
    case \App\Entity\Personnage::SELF_ATTACK:
        $error = "self_attack";
        break;
    case \App\Entity\Personnage::IS_SLEEPING:
        $error = "sleeping";
        break;
    default:
        $error = "unknown_action";
        break;
}

header("Location: /play.php?status={$error}&id={$attacker->getId()}");
