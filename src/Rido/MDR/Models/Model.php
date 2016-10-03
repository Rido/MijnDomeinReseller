<?php

namespace Rido\MDR\Models;

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
    protected $attributes = [];

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * Model constructor.
     *
     * @param Connection $connection
     * @param array      $attributes
     */
    public function __construct(Connection $connection, array $attributes = [])
    {
        $this->connection = $connection;
        $this->fill($attributes);
    }

    /**
     * @param array $attributes
     */
    protected function fill(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if ($this->isFillable($key)) {
                $this->attributes[$key] = $value;
            }
        }
    }

    /**
     * @param $key
     *
     * @return bool
     */
    protected function isFillable($key)
    {
        return in_array($key, $this->fillable);
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

    /**
     * @param $result
     *
     * @return mixed
     */
    public function createObjectFromResponse($result)
    {
        $modelName = get_class($this);

        $model = new $modelName($this->connection, $result);

        return $model;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        if ($this->isFillable($key)) {
            $this->attributes[$key] = $value;
        }
    }
}
