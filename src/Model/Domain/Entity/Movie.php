<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 17:17
 */

namespace Model\Domain\Entity;

use Model\Domain\Collection\EntityCollection;

class Movie implements Entity
{
    private $id;
    private $name;
    private $description;
    private $year;
    private $image;
    /**
     * @var EntityCollection
     */
    private $genres;

    /**
     * Movie constructor.
     * @param $id int
     * @param $name string
     * @param $description string
     * @param $year int
     * @param $image string
     */
    public function __construct(int $id, string $name, string $description, int $year, string $image)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->year        = $year;
        $this->image       = $image;
        $this->genres      = new EntityCollection();
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
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return EntityCollection
     */
    public function getGenres(): EntityCollection
    {
        return $this->genres;
    }

    /**
     * @param Genre $genre
     */
    public function addGenre(Genre $genre): void
    {
        $this->genres->addItem($genre);
    }

    /**
     * @param EntityCollection $genres
     */
    public function addGenres(EntityCollection $genres): void
    {
        foreach ($genres as $genre) {
            $this->addGenre($genre);
        }
    }

}