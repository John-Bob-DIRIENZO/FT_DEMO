<?php

namespace App\Interfaces;

interface PdoFactoryInterface
{
    public function getPdo(): \PDO;
}
