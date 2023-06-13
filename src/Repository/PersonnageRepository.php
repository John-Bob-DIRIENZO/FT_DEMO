<?php

namespace App\Repository;

use App\Entity\Guerrier;
use App\Entity\Mage;
use App\Entity\Personnage;
use App\Interfaces\PdoFactoryInterface;
use Exception;

class PersonnageRepository
{
    private \PDO $pdo;

    public function __construct(PdoFactoryInterface $pdo)
    {
        $this->pdo = $pdo->getPdo();
    }

    /**
     * @throws Exception
     */
    private function buildPerso(array $perso): Personnage
    {
        $ref = new \ReflectionClass($perso['type']);
        return $ref->newInstance($perso);
    }

    /**
     * @return Personnage[]
     * @throws Exception
     */
    public function getAll(): array
    {
        $persos = [];

        $query = $this->pdo->query("SELECT * FROM `Personnage`");
        while ($perso = $query->fetch(\PDO::FETCH_ASSOC)) {
            $persos[] = $this->buildPerso($perso);
        }

        return $persos;
    }

    public function getById(int $id): Personnage
    {
        $query = $this->pdo->prepare("SELECT * FROM `Personnage` WHERE id = :id");
        $query->bindValue("id", $id, \PDO::PARAM_INT);
        $query->execute();
        $perso = $query->fetch(\PDO::FETCH_ASSOC);

        return $this->buildPerso($perso);
    }

    public function create(Personnage $personnage): Personnage
    {
        $stmt = $this->pdo->prepare("INSERT INTO `Personnage` (`name`, `force`, `defense`, `pv`, `type`) VALUES (:name, :force, :defense, :pv, :type)");
        $stmt->bindValue('name', $personnage->getName(), \PDO::PARAM_STR);
        $stmt->bindValue('force', $personnage->getForce(), \PDO::PARAM_INT);
        $stmt->bindValue('defense', $personnage->getDefense(), \PDO::PARAM_INT);
        $stmt->bindValue('pv', $personnage->getPv(), \PDO::PARAM_INT);
        $stmt->bindValue('type', $personnage->getType(), \PDO::PARAM_STR);

        $stmt->execute();
        return $personnage->setId($this->pdo->lastInsertId());
    }

    public function update(Personnage $personnage): bool
    {
        $stmt = $this->pdo->prepare("UPDATE `Personnage` SET `pv` = :pv, `last_spell` = :lastSpell, `last_asleep` = :lastAsleep WHERE id = :id");
        $stmt->bindValue('pv', $personnage->getPv(), \PDO::PARAM_INT);

        if (is_callable([$personnage, "getLastSpell"])) {
            $lastSpell = [$personnage, "getLastSpell"]();
        } else {
            $lastSpell = null;
        }

        $asleep = $personnage->getLastAsleep() ? $personnage->getLastAsleep()->format("Y-m-d H:i:s") : null;

        $stmt->bindValue('lastSpell', $lastSpell);
        $stmt->bindValue('lastAsleep', $asleep);
        $stmt->bindValue('id', $personnage->getId(), \PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deleteById(int $id): bool
    {
        $stmt = $this->pdo->prepare("DElETE FROM `Personnage` WHERE id = :id");
        $stmt->bindValue('id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }
}
