<?php

if (isset($data['status']))

    echo "<div>{$data['status']}</div>"

?>



<ul>

<?php

foreach ($allPerso as $personnage) :
    ?>

    <li>
        <?= $personnage->getName(); ?> (pv: <?= $personnage->getPv(); ?>)
        <a href="/?p=play&id=<?= $personnage->getId(); ?>">Vers la bagarre</a>
    </li>

<?php

endforeach;
