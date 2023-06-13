<?php

namespace App\Entity;

use App\Helper\CaseHelper;
use App\Interfaces\CanDefendInterface;
use DateTime;
use Exception;

abstract class Personnage implements CanDefendInterface
{
    const IS_SLEEPING = 1;
    const SELF_ATTACK = 2;
    const IS_DEAD = 3;
    const IS_OK = 4;

    protected ?int $id = null;
    protected ?string $name = null;
    protected ?int $pv = null;
    protected ?int $force = null;
    protected ?int $defense = null;
    protected ?DateTime $lastAsleep = null;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $method = "set" . CaseHelper::snakeToPascalCase($key);
            if (is_callable([$this, $method])) {
                [$this, $method]($value);
            }
        }
    }

    abstract public static function initialize(string $name): Personnage;

    public function attack(CanDefendInterface $personnage): int
    {
        if ($this->isAsleep()) {
            return self::IS_SLEEPING;
        }

        if ($this->id === $personnage->getId()) {
            return self::SELF_ATTACK;
        }

        return $personnage->defendFrom($this);
    }

    public function getType(): string
    {
        $reflection = new \ReflectionClass($this);
        return $reflection->getName();
    }

    public function defendFrom(object $personnage): int
    {
        $damages = $personnage->getForce() - $this->getDefense();
        if ($damages < 0) $damages = 0;
        $this->setPv($this->getPv() - $damages);

        if ($this->pv <= 0) {
            return self::IS_DEAD;
        }

        return self::IS_OK;
    }

    public function isAsleep(): bool
    {
        return $this->lastAsleep && (new DateTime('-1 minute') < $this->lastAsleep);
    }

    /**
     * @return DateTime|null
     */
    public function getLastAsleep(): ?DateTime
    {
        return $this->lastAsleep;
    }

    /**
     * @param string|null $lastAsleep
     * @return Personnage
     * @throws Exception
     */
    public function setLastAsleep(?string $lastAsleep): Personnage
    {
        if ($lastAsleep === null) {
            $this->lastAsleep = null;
            return $this;
        }

        $this->lastAsleep = new DateTime($lastAsleep);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Personnage
     */
    public function setId(?int $id): Personnage
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Personnage
     */
    public function setName(?string $name): Personnage
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPv(): ?int
    {
        return $this->pv;
    }

    /**
     * @param int|null $pv
     * @return Personnage
     */
    public function setPv(?int $pv): Personnage
    {
        $this->pv = $pv;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getForce(): ?int
    {
        return $this->force;
    }

    /**
     * @param int|null $force
     * @return Personnage
     */
    public function setForce(?int $force): Personnage
    {
        $this->force = $force;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getDefense(): ?int
    {
        return $this->defense;
    }

    /**
     * @param int|null $defense
     * @return Personnage
     */
    public function setDefense(?int $defense): Personnage
    {
        $this->defense = $defense;
        return $this;
    }

}
