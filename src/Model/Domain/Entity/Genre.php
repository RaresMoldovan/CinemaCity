<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 17:23
 */

namespace Model\Domain\Entity;


class Genre implements Entity
{
    private $id;
    private $name;

    /**
     * Genre constructor.
     * @param $id
     * @param $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


}