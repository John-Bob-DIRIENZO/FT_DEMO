<?php

require_once 'vendor/autoload.php';

$repo = new \App\Repository\PersonnageRepository(
    new \App\Factory\PDOFactory()
);

$allPerso = $repo->getAll();

$me = array_filter($allPerso, function ($personnage) {
    return $personnage->getId() == $_GET['id'];
});


if (count($me) < 1) {
    throw new Exception("Not found");
}

$me = array_pop($me);

$enemies = array_filter($allPerso, function ($personnage) {
    return $personnage->getId() != $_GET['id'];
});

if (isset($_GET['status'])) {
    echo "<div>{$_GET['status']}</div>";

}


echo "<ul>";

foreach ($enemies as $personnage) :
    ?>

    <li>
        <?= $personnage->getName(); ?> (pv: <?= $personnage->getPv(); ?>)
        <a href=<?= sprintf("/handlers/handle-attack.php?attacker=%s&defender=%s", $me->getId(), $personnage->getId()); ?>>Attack</a>
    </li>

<?php

endforeach;

