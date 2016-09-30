<?php namespace Rido\MDR\Models;

use Rido\MDR\Connection;

abstract class Model
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var array
     */
    private $attributes;

    public function __construct(Connection $connection, array $attributes = [])
    {
        $this->connection = $connection;
        $this->attributes = $attributes;
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}