<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:12
 */

namespace Model\DataAccess\Repository;

use Model\DataAccess\Mapper\ShowMapper;

class ShowRepository extends EntityRepository
{
    public function __construct(\PDO $connection)
    {
        $this->tableName = 'show';
        parent::__construct($connection);
        $this->entityMapper = new ShowMapper();
    }
}