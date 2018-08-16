<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:12
 */

namespace Model\DataAccess\Repository;

use Model\DataAccess\Mapper\ShowMapper;
use Model\Domain\Entity\Hall;
use Model\Domain\Collection\EntityCollection;

class ShowRepository extends EntityRepository
{
    /**
     * ShowRepository constructor.
     * @param \PDO $connection
     * @param MovieRepository $movieRepository
     * @param HallRepository $hallRepository
     */
    public function __construct(\PDO $connection, MovieRepository $movieRepository, HallRepository $hallRepository)
    {
        $this->tableName = '`show`';
        parent::__construct($connection);
        $this->entityMapper = new ShowMapper($movieRepository, $hallRepository);
    }

    /**
     * @param int $movieId
     * @return EntityCollection
     */
    public function getAllUpcomingShowsForMovie(int $movieId): EntityCollection
    {
        $queryString = "SELECT * FROM " . $this->tableName . " WHERE movie_id=:movie AND time>NOW()";
        $statement   = $this->connection->prepare($queryString);
        $statement->bindValue("movie", $movieId, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        return $this->entityMapper->mapAll($result);
    }
}