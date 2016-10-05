<?php

namespace Rido\MDR\Models;

class Dns extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'domein',
        'tld',
        'dns_records',
    ];

    /**
     * @param $domain
     * @param $tld
     * @return mixed
     */
    public function find($domain, $tld)
    {
        $result = $this->connection->get('dns_get_details', [
            'domein' => $domain,
            'tld'    => $tld,
        ]);

        $result = $this->processDnsRecords($result);

        return $this->createObjectFromResponse($result);
    }

    /**
     * @param $domain
     * @param $tld
     * @param $ttl
     * @return array
     */
    public function updateTtl($domain, $tld, $ttl)
    {
        $result = $this->connection->get('dns_ttl_modify', [
            'domein' => $domain,
            'tld'    => $tld,
            'ttl'    => $ttl,
        ]);

        return $result;
    }

    /**
     * @param $result
     * @return mixed
     */
    protected function processDnsRecords($result)
    {
        if (isset($result['items']) && count($result['items'])) {
            $result['dns_records'] = [];

            foreach ($result['items'] as $item) {
                $result['dns_records'][] = new DnsRecord($this->connection, $item);
            }
        }

        return $result;
    }
}