<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:12
 */

namespace Model\DataAccess\Repository;

use Model\DataAccess\Mapper\SeatMapper;
use Model\Domain\Collection\EntityCollection;
use Model\Domain\Entity\Show;

class SeatRepository extends EntityRepository
{
    /**
     * SeatRepository constructor.
     * @param \PDO $connection
     * @param HallRepository $hallRepository
     */
    public function __construct(\PDO $connection, HallRepository $hallRepository)
    {
        $this->tableName = 'seat';
        parent::__construct($connection);
        $this->entityMapper = new SeatMapper($hallRepository);
    }

    /**
     * @param int $hallId
     */
    public function deleteSeatsOfHall(int $hallId): void
    {
        $deleteString = 'DELETE FROM `seat` WHERE hall_id=:hall';
        $statement    = $this->connection->prepare($deleteString);
        $statement->bindValue("hall", $hallId, \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * @param Show $show
     * @return EntityCollection
     */
    public function getRemainingSeatsForShow(Show $show): EntityCollection
    {
        $seatQuery = "SELECT * FROM seat WHERE hall_id=:hallId AND id NOT IN (SELECT seat_id FROM reservation WHERE show_id=:showId)";
        $statement = $this->connection->prepare($seatQuery);
        $statement->bindValue("hallId", $show->getHall()->getId(), \PDO::PARAM_INT);
        $statement->bindValue("showId", $show->getId(), \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        return $this->entityMapper->mapAll($result);
    }
}