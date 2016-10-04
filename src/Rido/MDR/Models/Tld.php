<?php namespace Rido\MDR\Models;

class Tld extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'tld',
        'prijs_registratie',
        'prijs_registratie_munt',
        'prijs_verhuizing',
        'prijs_verhuizing_munt',
        'prijs_verlenging',
        'prijs_verlenging_munt',
        'munt_wisselkoers',
        'lengte_min',
        'lengte_max',
        'jaar_min',
        'jaar_max',
        'registreren',
        'verhuizen',
    ];

    /**
     * @return bool
     */
    public function get()
    {
        if ($result = $this->connection->get('tld_list')) {
            return $result['items'];
        }

        return false;
    }

    /**
     * @param $tld
     * @return mixed
     */
    public function find($tld)
    {
        $result = $this->connection->get('tld_get_details', [
            'tld' => $tld
        ]);

        if (!isset($result['tld'])) {
            $result['tld'] = $tld;
        }

        return $this->createObjectFromResponse($result);
    }
}