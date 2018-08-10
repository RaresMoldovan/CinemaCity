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

class ShowRepository extends EntityRepository
{
    public function __construct(\PDO $connection, MovieRepository $movieRepository, HallRepository $hallRepository)
    {
        $this->tableName = '`show`';
        parent::__construct($connection);
        $this->entityMapper = new ShowMapper($movieRepository, $hallRepository);
    }
}