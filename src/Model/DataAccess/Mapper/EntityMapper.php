<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 18:57
 */

namespace Model\DataAccess\Mapper;

use Model\Domain\Collection\EntityCollection;
use Model\Domain\Entity\Entity;

abstract class EntityMapper
{
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';

    /**
     * @param array $associative
     * @return Entity
     */
    public abstract function map(array $associative): Entity;

    /**
     * Maps more rows of data into an entity collection.
     * @param array $associative
     * @return EntityCollection
     */
    public function mapAll(array $associative): EntityCollection
    {
        $collection = new EntityCollection();
        foreach ($associative as $row) {
            $collection->addItem($this->map($row));
        }
        return $collection;
    }
}