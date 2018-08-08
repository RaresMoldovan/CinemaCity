<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:12
 */

namespace Model\DataAccess\Repository;

use Model\DataAccess\Mapper\SeatMapper;

class SeatRepository extends EntityRepository
{
    public function __construct(\PDO $connection)
    {
        $this->tableName = 'seat';
        parent::__construct($connection);
        $this->entityMapper = new SeatMapper();
    }
}