<?php namespace Rido\MDR;

use Rido\MDR\Models\Whois;

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

    public function whois(array $attributes = [])
    {
        return new Whois($this->connection, $attributes);
    }
}