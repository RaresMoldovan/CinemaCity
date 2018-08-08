<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:12
 */

namespace Model\DataAccess\Repository;


use Model\DataAccess\Mapper\ReservationMapper;

class ReservationRepository extends EntityRepository
{
    public function __construct(\PDO $connection)
    {
        $this->tableName = 'reservation';
        parent::__construct($connection);
        $this->entityMapper = new ReservationMapper();
    }
}