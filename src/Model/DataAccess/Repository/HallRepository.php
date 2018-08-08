<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:11
 */

namespace Model\DataAccess\Repository;


use Model\DataAccess\Mapper\HallMapper;

class HallRepository extends EntityRepository
{
    public function __construct(\PDO $connection)
    {
        $this->tableName = 'hall';
        parent::__construct($connection);
        $this->entityMapper = new HallMapper();
    }
}