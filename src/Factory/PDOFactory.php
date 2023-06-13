<?php

namespace App\Factory;

use App\Interfaces\PdoFactoryInterface;

class PDOFactory implements PdoFactoryInterface
{
    private string $hostname;
    private int $port;
    private string $database;
    private string $username;
    private string $password;

    public function __construct(string $hostname = "localhost",
                                int    $port = 8889,
                                string $database = "ft_perso",
                                string $username = "root",
                                string $password = "root")
    {
        $this->hostname = $hostname;
        $this->port = $port;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    public function getPdo(): \PDO
    {
        return new \PDO(
            "mysql:host={$this->hostname}:{$this->port};dbname={$this->database}",
            $this->username,
            $this->password
        );
    }
}
