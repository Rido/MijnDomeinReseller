<?php namespace Rido\MDR;

/**
 * Class MijnDomeinReseller
 *
 * @package Rido\MDR
 */
class MijnDomeinReseller
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * MijnDomeinReseller constructor.
     *
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}