<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 17:44
 */

namespace Model\Domain\Entity;


class Seat implements Entity
{
    private $id;
    private $hall;
    private $code;

    /**
     * Seat constructor.
     * @param $id
     * @param $hall
     * @param $code
     */
    public function __construct(int $id, Hall $hall, string $code)
    {
        $this->id   = $id;
        $this->hall = $hall;
        $this->code = $code;
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
     * @return Hall
     */
    public function getHall(): Hall
    {
        return $this->hall;
    }

    /**
     * @param Hall $hall
     */
    public function setHall(Hall $hall): void
    {
        $this->hall = $hall;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }


}