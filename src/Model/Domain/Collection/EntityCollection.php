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

    /**
     * @param Entity $item
     */
    public function addItem(Entity $item): void
    {
        $id               = $item->getId();
        $this->itemIds[]  = $id;
        $this->items[$id] = $item;
    }

    /**
     * @param string $id
     * @return Entity
     */
    public function getItem(string $id): Entity
    {
        return isset($this->items[$id]) ? $this->items[$id] : null;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        $index = $this->itemIds[$this->position];
        return $this->items[$index];
    }

    /**
     * @return void
     */
    public function next(): void
    {
        $this->position++;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return (isset($this->itemIds[$this->position]));
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }


}