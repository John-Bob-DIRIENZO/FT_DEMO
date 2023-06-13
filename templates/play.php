

<?php

echo "<ul>";

foreach ($enemies as $personnage) :
    ?>

    <li>
        <?= $personnage->getName(); ?> (pv: <?= $personnage->getPv(); ?>)
        <a href=<?= sprintf("/handlers/handle-attack.php?attacker=%s&defender=%s", $me->getId(), $personnage->getId()); ?>>Attack</a>
    </li>

<?php

endforeach;

?>
