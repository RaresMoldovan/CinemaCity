<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 18:49
 */

namespace Model\DataAccess\Mapper;

use Model\Domain\Entity\Entity;
use Model\Domain\Entity\Hall;

class HallMapper extends EntityMapper
{
    const FIELD_NR_PLACES = 'nr_of_places';

    public function map(array $associative): Entity
    {
        $id = $associative[parent::FIELD_ID];
        $name =  $associative[parent::FIELD_NAME];
        $nrOfPlaces = $associative[self::FIELD_NR_PLACES];
        return new Hall($id, $name, $nrOfPlaces);
    }

}