<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:12
 */

namespace Model\DataAccess\Repository;

use Model\DataAccess\Mapper\MovieMapper;
use Model\Domain\Entity\Entity;
use Model\Domain\Entity\Movie;

class MovieRepository extends EntityRepository
{

    public function __construct(\PDO $connection, GenreRepository $genreRepository)
    {
        $this->tableName = 'movie';
        parent::__construct($connection);
        $this->entityMapper = new MovieMapper($genreRepository);
    }

    public function insert(Entity $entity): void
    {
        parent::insert($entity);
        $this->attachGenres($entity);
    }

    public function insertHardCodedId(Entity $entity): void
    {
        parent::insertHardCodedId($entity);
        $this->attachGenres($entity);
    }

    private function attachGenres(Entity $entity)
    {
        $genreCollection = $entity->getGenres();
        $queryString     = "INSERT INTO movie_to_genre (movie_id, genre_id) VALUES (:movie, :genre)";
        $statement       = $this->connection->prepare($queryString);
        $movieId         = $entity->getId();
        $statement->bindValue("movie", $movieId, \PDO::PARAM_INT);
        foreach ($genreCollection as $genre) {
            $statement->bindValue("genre", $genre->getId(), \PDO::PARAM_INT);
            $statement->execute();
        }
    }
}