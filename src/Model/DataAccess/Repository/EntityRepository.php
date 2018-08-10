<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 06.08.2018
 * Time: 18:41
 */

namespace Model\DataAccess\Repository;

use Model\DataAccess\Mapper\EntityMapper;
use Model\DataAccess\Util\StringUtil;
use Model\Domain\Collection\EntityCollection;
use Model\Domain\Entity\Entity;

abstract class EntityRepository
{
    /**
     * @var \PDO
     */
    protected $connection;
    /**
     * @var string
     */
    protected $tableName;
    /**
     * @var EntityMapper
     */
    protected $entityMapper;
    /**
     * @var array
     */
    protected $columnNames;

    /**
     * EntityRepository constructor.
     * @param $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
        $this->generateColumnNames();
    }

    private function generateColumnNames()
    {
        //TODO Database name from config.
        $columnQuery = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'cinema' AND TABLE_NAME = '" . trim($this->tableName, '`') . "'";
        $result = $this->connection->query($columnQuery);
        $associative = $result->fetchAll();
        foreach($associative as $columnArray) {
                if($columnArray[0]!=='id') {
                    $this->columnNames[] = $columnArray[0];
                }
        }

    }
    /**
     * @return EntityCollection
     */
    public function getAll(): EntityCollection
    {
        $queryString = "SELECT * FROM " . $this->tableName;
        $statement   = $this->connection->query($queryString);
        $result      = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $this->entityMapper->mapAll($result);
    }

    /**
     * @param int $id
     * @return Entity
     */
    public function getById(int $id): Entity
    {
        $queryString = "SELECT * FROM " . $this->tableName . " WHERE id=:id";
        $statement   = $this->connection->prepare($queryString);
        $statement->bindValue("id", $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch();
        return $this->entityMapper->map($result);
    }

    /**
     * @param string $columnName
     * @param string $value
     * @return EntityCollection
     */
    public function findByColumn(string $columnName, string $value)
    {
        $queryString = "SELECT * FROM " . $this->tableName . " WHERE " . $columnName . "=:val";
        $statement   = $this->connection->prepare($queryString);
        $statement->bindValue("val", $value);
        $statement->execute();
        $result      = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($result)===0) {
            return null;
        }
        return $this->entityMapper->mapAll($result);
    }

    /**
     * @param Entity $entity
     */
    public function insert(Entity $entity): void
    {
        $columns     = implode(',', $this->columnNames);
        $queryString = "INSERT INTO " . $this->tableName . " (" . $columns . ")" . " VALUES ";
        $queryString .= "(" . $this->createValuesString($entity) .")";
        //Execute the insert query
        var_dump($queryString);
        $this->connection->exec($queryString);
    }

    /**
     * @param Entity $entity
     */
    public function insertHardCodedId(Entity $entity) : void
    {
        $columns     = implode(',', $this->columnNames);
        $queryString = "INSERT INTO " . $this->tableName . " (id," . $columns . ")" . " VALUES ";
        $queryString .= "({$entity->getId()}," . $this->createValuesString($entity) .")";
        $queryString .= " ON DUPLICATE KEY UPDATE " . $this->createValuesString($entity, true);
        //Execute the insert query
        $this->connection->exec($queryString);
    }

    /**
     * @param Entity $entity
     */
    public function update(Entity $entity): void
    {
        $queryString = "UPDATE " . $this->tableName . " SET ";
        $queryString .=  $this->createValuesString($entity, true) . " ";
        $queryString .= " WHERE id=" . $entity->getId();
        $this->connection->exec($queryString);

    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        $deleteString = "DELETE FROM " . $this->tableName . " WHERE id=" . $id;
        $this->connection->exec($deleteString);

    }

    /**
     * @param Entity $entity
     * @param bool $withColumnNames
     * @return string
     */
    protected function createValuesString(Entity $entity, bool $withColumnNames = false): string
    {
        $valuesArray = [];
        foreach ($this->columnNames as $column) {

            $withoutId  = StringUtil::removeIdExtension($column);
            $camelCased = StringUtil::snakeCaseToCamelcase($withoutId);
            if ($column !== $withoutId) {
                $valueToBeInserted = $entity->{'get' . $camelCased}()->getId();
            } else {
                $valueToBeInserted = $entity->{'get' . $camelCased}();
            }
            $valuesArray[] =  ($withColumnNames ? $column . "=" : '') . (is_string($valueToBeInserted) ? $this->connection->quote($valueToBeInserted) : $valueToBeInserted);
        }
        $valuesString = implode(', ', $valuesArray);
        return $valuesString;
    }

}