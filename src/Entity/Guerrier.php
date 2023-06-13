<?php

namespace App\Entity;

use Exception;

class Guerrier extends Personnage
{
    /**
     * @throws Exception
     */
    public static function initialize(string $name): Guerrier
    {
        return (new Guerrier())
            ->setForce(random_int(10, 40))
            ->setDefense(random_int(10, 19))
            ->setPv(100)
            ->setName($name);
    }
}
