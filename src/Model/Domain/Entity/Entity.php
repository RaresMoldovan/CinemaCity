<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 17:14
 */

namespace Model\Domain\Entity;

interface Entity
{
    /**
     * An entity is unique, therefore it is identified by an id.
     * @return int
     */
    public function getId() : int;
}