<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 18:49
 */

namespace Model\DataAccess\Mapper;

use Model\Domain\Entity\Entity;
use Model\Domain\Entity\Genre;

class GenreMapper extends EntityMapper
{
    public function map(array $associative): Entity
    {
        $id = $associative[parent::FIELD_ID];
        $name = $associative[parent::FIELD_NAME];
        return new Genre($id, $name);
    }

}