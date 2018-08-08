<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:11
 */

namespace Model\DataAccess\Repository;


use Model\DataAccess\Connection\DatabaseConnection;
use Model\DataAccess\Mapper\GenreMapper;
use Model\Domain\Collection\EntityCollection;

class GenreRepository extends EntityRepository
{

    public function __construct(\PDO $connection)
    {
        $this->tableName = 'genre';
        parent::__construct($connection);
        $this->entityMapper = new GenreMapper();
    }

    public function getGenresForMovie(int $movieId) : EntityCollection
    {
        //Execute the select query
        $queryString = "SELECT genre_id FROM movie_to_genre WHERE movie_id=:movie";
        $statement = $this->connection->prepare($queryString);
        $statement->bindValue('movie', $movieId, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        //Retrieve the genres
        $genreCollection = new EntityCollection();
        foreach($result as $row) {
            $genreCollection->addItem($this->getById($row[0]));
        }
        return $genreCollection;
    }

}