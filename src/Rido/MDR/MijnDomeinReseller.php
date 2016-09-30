<?php namespace Rido\MDR;

use Rido\MDR\Models\Domain;
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

    /**
     * @param array $attributes
     * @return Domain
     */
    public function domain(array $attributes = [])
    {
        return new Domain($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     * @return Whois
     */
    public function whois(array $attributes = [])
    {
        return new Whois($this->connection, $attributes);
    }
}