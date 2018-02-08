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
        'template_connections',
    ];

    /**
     * @return bool
     */
    public function get()
    {
        if ($result = $this->connection->get('dns_get_templates')) {
            return $result['items'];
        }

        return false;
    }
}
