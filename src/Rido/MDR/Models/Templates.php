<?php

namespace Rido\MDR\Models;

class Templates extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'template_id',
        'template_name',
    ];

    /**
     * @return bool
     */
    public function get()
    {
        if ($result = $this->connection->get('dns_template_list')) {
            return $result['items'];
        }

        return false;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->connection->get('dns_template_get_details', [
            'template_id' => $id,
        ]);

        return $result;
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function create(array $attributes = [])
    {
        $this->fill($attributes);

        $result = $this->connection->put('dns_template_record_add', $this->attributes);

        return $result;
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function remove(array $attributes = [])
    {
        $this->fill($attributes);

        $result = $this->connection->put('dns_template_record_del', $this->attributes);

        return $result;
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function ttl(array $attributes = [])
    {
        $this->fill($attributes);

        $result = $this->connection->put('dns_template_ttl_modify', $this->attributes);

        return $result;
    }
}
