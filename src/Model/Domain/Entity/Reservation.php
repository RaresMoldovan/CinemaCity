<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 17:46
 */

namespace Model\Domain\Entity;


class Reservation implements Entity
{
    private $id;
    private $user;
    private $show;
    private $seat;

    /**
     * Reservation constructor.
     * @param $id int
     * @param $user User
     * @param $show Show
     * @param $seat Seat
     */
    public function __construct(int $id, User $user, Show $show, Seat $seat)
    {
        $this->id   = $id;
        $this->user = $user;
        $this->show = $show;
        $this->seat = $seat;
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Show
     */
    public function getShow(): Show
    {
        return $this->show;
    }

    /**
     * @param Show $show
     */
    public function setShow(Show $show): void
    {
        $this->show = $show;
    }

    /**
     * @return Seat
     */
    public function getSeat(): Seat
    {
        return $this->seat;
    }

    /**
     * @param Seat $seat
     */
    public function setSeat(Seat $seat): void
    {
        $this->seat = $seat;
    }


}