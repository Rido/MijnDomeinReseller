<?php

namespace Rido\MDR;

use Rido\MDR\Models\Contact;
use Rido\MDR\Models\Dns;
use Rido\MDR\Models\DnsRecord;
use Rido\MDR\Models\DnsSec;
use Rido\MDR\Models\DnsSecRecord;
use Rido\MDR\Models\Domain;
use Rido\MDR\Models\Nameserver;
use Rido\MDR\Models\Templates;
use Rido\MDR\Models\Tld;
use Rido\MDR\Models\Transfer;
use Rido\MDR\Models\Whois;

/**
 * Class MijnDomeinReseller.
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
     *
     * @return Contact
     */
    public function contact(array $attributes = [])
    {
        return new Contact($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return Dns
     */
    public function dns(array $attributes = [])
    {
        return new Dns($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return DnsRecord
     */
    public function dnsRecord(array $attributes = [])
    {
        return new DnsRecord($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return DnsSec
     */
    public function dnsSec(array $attributes = [])
    {
        return new DnsSec($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return DnsSecRecord
     */
    public function dnsSecRecord(array $attributes = [])
    {
        return new DnsSecRecord($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return Domain
     */
    public function domain(array $attributes = [])
    {
        return new Domain($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return Nameserver
     */
    public function nameserver(array $attributes = [])
    {
        return new Nameserver($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return Tld
     */
    public function templates(array $attributes = [])
    {
        return new Templates($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return Tld
     */
    public function tld(array $attributes = [])
    {
        return new Tld($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return Tld
     */
    public function transfer(array $attributes = [])
    {
        return new Transfer($this->connection, $attributes);
    }

    /**
     * @param array $attributes
     *
     * @return Whois
     */
    public function whois(array $attributes = [])
    {
        return new Whois($this->connection, $attributes);
    }
}
