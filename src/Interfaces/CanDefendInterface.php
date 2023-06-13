<?php

namespace App\Interfaces;

interface CanDefendInterface
{
    public function defendFrom(object $object): int;
}
