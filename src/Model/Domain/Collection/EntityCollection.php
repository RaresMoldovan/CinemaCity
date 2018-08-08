<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 17:31
 */

namespace Model\Domain\Collection;

use Model\Domain\Entity\Entity;

class EntityCollection implements \Iterator, \Countable
{
    protected $items = [];
    protected $itemIds = [];

    protected $position;

    /**
     * QuizCollection constructor.
     */
    public function __construct()
    {
        $this->position = 0;
    }

    public function addItem(Entity $item): void
    {
        $id               = $item->getId();
        $this->itemIds[]  = $id;
        $this->items[$id] = $item;
    }

    public function getItem(string $id): Entity
    {
        return isset($this->items[$id]) ? $this->items[$id] : null;
    }

    public function current()
    {
        $index = $this->itemIds[$this->position];
        return $this->items[$index];
    }

    public function next()
    {
        $this->position++;
    }

    public function key()
    {
        return $this->position;
    }

    public function valid()
    {
        return (isset($this->itemIds[$this->position]));
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function count()
    {
        return count($this->items);
    }


}