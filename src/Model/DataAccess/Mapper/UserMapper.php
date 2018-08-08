<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 18:50
 */

namespace Model\DataAccess\Mapper;

use Model\Domain\Entity\Entity;
use Model\Domain\Entity\User;

class UserMapper extends EntityMapper
{
    const FIELD_EMAIL = 'email';
    const FIELD_PASSWORD = 'password';

    public function map(array $associative): Entity
    {
        $id = $associative[parent::FIELD_ID];
        $email =  $associative[self::FIELD_EMAIL];
        $password = $associative[self::FIELD_PASSWORD];
        return new User($id, $email, $password);
    }
}