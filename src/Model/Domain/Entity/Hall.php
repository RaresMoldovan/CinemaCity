<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 17:40
 */

namespace Model\Domain\Entity;


use Model\Domain\Collection\EntityCollection;

class Hall implements Entity
{
    private $id;
    private $name;
    private $nrOfPlaces;

    /**
     * Hall constructor.
     * @param $id
     * @param $name
     * @param $nrOfPlaces
     */
    public function __construct(int $id, string $name, int $nrOfPlaces)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->nrOfPlaces = $nrOfPlaces;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getNrOfPlaces(): int
    {
        return $this->nrOfPlaces;
    }

    /**
     * @param int $nrOfPlaces
     */
    public function setNrOfPlaces(int $nrOfPlaces): void
    {
        $this->nrOfPlaces = $nrOfPlaces;
    }

}