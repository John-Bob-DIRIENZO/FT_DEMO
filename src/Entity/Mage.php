<?php

namespace App\Entity;

use DateTime;
use Exception;

class Mage extends Personnage
{
    const NO_MANA = 5;

    private ?DateTime $lastSpell = null;

    /**
     * @throws Exception
     */
    public static function initialize(string $name): Mage
    {
        return (new Mage())
            ->setForce(random_int(10, 19))
            ->setDefense(0)
            ->setPv(100)
            ->setName($name);
    }

    public function launchSpell(Personnage $personnage): int
    {
        if ($this->isAsleep()) {
            return self::IS_SLEEPING;
        }

        if ($this->id === $personnage->getId()) {
            return self::SELF_ATTACK;
        }

        if (!$this->canLaunchSpell()) {
            return self::NO_MANA;
        }

        $personnage->setLastAsleep((new DateTime())->format("Y-m-d H:i:s"));
        $this->setLastSpell((new DateTime())->format("Y-m-d H:i:s"));

        return self::IS_OK;
    }

    public function canLaunchSpell(): bool
    {
        return !($this->lastAsleep && (new DateTime('-2 minute') < $this->lastAsleep));
    }

    /**
     * @return DateTime|null
     */
    public function getLastSpell(): ?DateTime
    {
        return $this->lastSpell;
    }

    /**
     * @param string|null $lastSpell
     * @return Mage
     * @throws Exception
     */
    public function setLastSpell(?string $lastSpell): Mage
    {
        if ($lastSpell === null) {
            $this->lastSpell = null;
            return $this;
        }

        $this->lastSpell = new DateTime($lastSpell);
        return $this;
    }
}
