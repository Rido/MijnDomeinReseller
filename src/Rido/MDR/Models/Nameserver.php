<?php namespace Rido\MDR\Models;

class Nameserver extends Model
{
    protected $fillable = [
        'ns_id',
        'auto',
        'ns1',
        'ns1_ip',
        'ns2',
        'ns2_ip',
        'ns3',
        'ns3_ip',
        'ns4',
        'ns4_ip',
        'ns5',
        'ns5_ip',
        'ns6',
        'ns6_ip',
        'ns7',
        'ns7_ip',
    ];

    /**
     * @return bool
     */
    public function get()
    {
        if ($result = $this->connection->get('nameserver_list')) {
            return $result['items'];
        }

        return false;
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function create(array $attributes)
    {
        $this->fill($attributes);

        $result = $this->connection->put('nameserver_add', $this->attributes);

        if (isset($result['ns_id'])) {
            $this->ns_id = $result['ns_id'];
        }

        return $result;
    }
}