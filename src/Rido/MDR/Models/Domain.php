<?php namespace Rido\MDR\Models;

class Domain extends Model
{
    public function get()
    {
        if ($result = $this->connection->get('domain_list')) {
            return $result['items'];
        }

        return false;
    }
}