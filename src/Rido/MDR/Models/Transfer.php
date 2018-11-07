<?php

namespace Rido\MDR\Models;

class Transfer extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'transfer_id',
        'domein',
        'status',
        'tld',
        'status_melding',
        'datum_invoer',
        'datum_update',

        'status_melding_count',
        'status_datum',
    ];

    /**
     * @return bool
     */
    public function get(array $attributes = [])
    {
        $this->fill($attributes);

        $result = $this->connection->get('transfer_list', [
            'status' => $this->status,
            'domein' => $this->domein,
            'tld'    => $this->tld,
        ]);

        return $result['items'];
    }

    /**
     * @param $tld
     *
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->connection->get('transfer_details', [
            'transfer_id' => $id,
        ]);

        return $result['items'];
    }
}
