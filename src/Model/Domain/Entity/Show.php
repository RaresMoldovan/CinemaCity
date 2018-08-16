<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 17:44
 */

namespace Model\Domain\Entity;


class Show implements Entity
{
    private $id;
    private $movie;
    private $hall;
    private $time;

    /**
     * Show constructor.
     * @param $id
     * @param $movie
     * @param $hall
     * @param $date
     */
    public function __construct(int $id, Movie $movie, Hall $hall, string $time)
    {
        $this->id    = $id;
        $this->movie = $movie;
        $this->hall  = $hall;
        $this->time  = $time;
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
     * @return Movie
     */
    public function getMovie(): Movie
    {
        return $this->movie;
    }

    /**
     * @param Movie $movie
     */
    public function setMovie(Movie $movie): void
    {
        $this->movie = $movie;
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
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }


}