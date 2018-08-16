<?php
/**
 * Created by PhpStorm.
 * User: raresmoldovan
 * Date: 07.08.2018
 * Time: 11:21
 */

namespace Model\DataAccess\Connection;


class DatabaseConnection
{
    /**
     * @var DatabaseConfiguration
     */
    private $configuration;
    private $pdo;

    /**
     * @param DatabaseConfiguration $config
     */
    public function __construct(DatabaseConfiguration $config)
    {
        $this->configuration = $config;
        $this->constructPDO();
    }

    /**
     * @return \PDO
     */
    public function getPDO(): \PDO
    {
        return $this->pdo;
    }

    /**
     * Constructs the PDO object, called in the class constructor.
     */
    private function constructPDO(): void
    {
        $this->pdo = null;
        try {
            $dsn       = $this->configuration->getHost() . ':dbname=' . $this->configuration->getDatabaseName();
            $this->pdo = new \PDO($dsn, $this->configuration->getUsername(), $this->configuration->getPassword());
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}