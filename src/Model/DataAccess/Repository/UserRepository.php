<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 18:12
 */

namespace Model\DataAccess\Repository;

use Model\DataAccess\Mapper\UserMapper;
use Model\Domain\Entity\User;

class UserRepository extends EntityRepository
{
    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->tableName = 'user';
        parent::__construct($connection);
        $this->entityMapper = new UserMapper();
    }

}