<?php namespace Rido\MDR\Models;

class Whois extends Model
{
    /**
     * Advanced domain whois
     *
     * @param $domain
     * @return string
     */
    public function advanced($domain)
    {
        $result = $this->connection->get('whois', [
            'type'   => 'uitgebreid',
            'domein' => $domain
        ]);

        return $this->formatAdvancedWhoisResult($result['result']);
    }

    /**
     * Check for available domains
     *
     * @param array $domains
     * @return array
     */
    public function bulk(array $domains)
    {
        return $this->connection->get('whois', [
            'type'     => 'bulk',
            'domeinen' => implode(';', $domains)
        ]);
    }

    /**
     * Retrieve information from internal registered domain
     *
     * @param $domain
     * @return array
     */
    public function internal($domain)
    {
        return $this->connection->get('whois', [
            'type'   => 'intern',
            'domein' => $domain
        ]);
    }

    /**
     * @param $result
     * @return string
     */
    private function formatAdvancedWhoisResult($result)
    {
        return urldecode($result);
    }
}