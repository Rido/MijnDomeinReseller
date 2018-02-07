<?php

namespace Rido\MDR\Models;

class Contact extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'contact_id',
        'contact_bedrijfsnaam',
        'contact_rechtsvorm',
        'contact_regnummer',
        'contact_voornaam',
        'contact_voorletter',
        'contact_tussenvoegsel',
        'contact_achternaam',
        'contact_straat',
        'contact_huisnr',
        'contact_huisnrtoev',
        'contact_postcode',
        'contact_plaats',
        'contact_land',
        'contact_email',
        'contact_tel',
        'contact_tel_land',
        'contact_rechtsvorm',
        'contact_kvknr',

        'bedrijfsnaam',
        'rechtsvorm',
        'regnummer',
        'btwnummer',
        'voorletter',
        'tussenvoegsel',
        'achternaam',
        'straat',
        'huisnr',
        'huisnrtoev',
        'postcode',
        'plaats',
        'land',
        'tel_land',
        'tel',
        'email'
    ];

    /**
     * @return bool
     */
    public function get()
    {
        if ($result = $this->connection->get('contact_list')) {
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
        $result = $this->connection->get('contact_get_details', [
            'contact_id' => $id,
        ]);

        if (!isset($result['contact_id'])) {
            $result['contact_id'] = $id;
        }

        return $this->createObjectFromResponse($result);
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function create(array $attributes)
    {
        $this->fill($attributes);

        $result = $this->connection->put('contact_add', $this->attributes);

        if (isset($result['contact_id'])) {
            $this->contact_id = $result['contact_id'];
        }

        return $result;
    }
}
