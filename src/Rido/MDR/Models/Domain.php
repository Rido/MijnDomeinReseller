<?php

namespace Rido\MDR\Models;

use InvalidArgumentException;

class Domain extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'domains',
        'registrant_id',
        'registrant_bedrijfsnaam',
        'registrant_rechtsvorm',
        'registrant_regnummer',
        'registrant_voorletter',
        'registrant_tussenvoegsel',
        'registrant_achternaam',
        'registrant_straat',
        'registrant_huisnr',
        'registrant_huisnrtoev',
        'registrant_postcode',
        'registrant_plaats',
        'registrant_land',
        'registrant_tel',
        'registrant_email',
        'admin_id',
        'admin_bedrijfsnaam',
        'admin_rechtsvorm',
        'admin_regnummer',
        'admin_voorletter',
        'admin_tussenvoegsel',
        'admin_achternaam',
        'admin_straat',
        'admin_huisnr',
        'admin_huisnrtoev',
        'admin_postcode',
        'admin_plaats',
        'admin_land',
        'admin_tel',
        'admin_email',
        'tech_id',
        'tech_bedrijfsnaam',
        'tech_rechtsvorm',
        'tech_regnummer',
        'tech_voorletter',
        'tech_tussenvoegsel',
        'tech_achternaam',
        'tech_straat',
        'tech_huisnr',
        'tech_huisnrtoev',
        'tech_postcode',
        'tech_plaats',
        'tech_land',
        'tech_tel',
        'tech_email',
        'tld_es_admin_type_id',
        'tld_es_admin_idnum',
        'tld_es_tech_type_id',
        'tld_es_tech_idnum',
        'tld_es_bill_type_id',
        'tld_es_bill_idnum',
        'bill_id',
        'autorenew',
        'lock',
        'ns_id',
        'ns1',
        'ns2',
        'ns3',
        'ns4',
        'ns5',
        'ns6',
        'ns7',
        'gebruik_dns',
        'dns_template',
        'authkey',
        'verloopdatum',
        'inaccountdatum',
        'status',
        'duur',
    ];

    /**
     * @return mixed
     */
    public function get()
    {
        $result = $this->connection->get('domain_list');

        if (isset($result['items'])) {
            $result = $this->processDomains($result);

            return $result['items'];
        }

        return [];
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        $result = $this->connection->get('domain_list_delete');

        if (isset($result['items'])) {
            $result = $this->processDomains($result);

            return $result['items'];
        }

        return [];
    }

    /**
     * @param $domain
     * @param $tld
     *
     * @return mixed
     */
    public function find($domain, $tld)
    {
        $result = $this->connection->get('domain_get_details', [
            'domein' => $domain,
            'tld'    => $tld,
        ]);

        return $this->createObjectFromResponse($result);
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function register(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld) {
            $result = $this->connection->put('domain_register', $this->attributes);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function transfer(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld) {
            $result = $this->connection->put('domain_transfer', $this->attributes);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function delete(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld) {
            $result = $this->connection->put('domain_delete', [
                'domein' => $this->domein,
                'tld'    => $this->tld,
            ]);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function authInfo(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld) {
            $result = $this->connection->get('domain_auth_info', [
                'domein' => $this->domein,
                'tld'    => $this->tld,
            ]);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function updateContacts(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld) {
            $result = $this->connection->get('domain_modify_contacts', $this->attributes);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function trade(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld) {
            $result = $this->connection->get('domain_trade', $this->attributes);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function updateNameservers(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld) {
            $result = $this->connection->get('domain_modify_ns', $this->attributes);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function pushRequest(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld && $this->authkey) {
            $result = $this->connection->get('domain_push_request', [
                'domein'  => $this->domein,
                'tld'     => $this->tld,
                'authkey' => $this->authkey,
            ]);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function renew(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld && $this->duur) {
            $result = $this->connection->get('domain_renew', [
                'domein' => $this->domein,
                'tld'    => $this->tld,
                'duur'   => $this->duur,
            ]);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function restore(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld) {
            $result = $this->connection->get('domain_restore', [
                'domein' => $this->domein,
                'tld'    => $this->tld,
            ]);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function setAutoRenew(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld && $this->autorenew) {
            $result = $this->connection->get('domain_set_autorenew', [
                'domein'             => $this->domein,
                'tld'                => $this->tld,
                'autorenew'          => $this->autorenew,
                'registrant_approve' => $this->registrant_approve,
            ]);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
    public function setLock(array $attributes = [])
    {
        $this->fill($attributes);

        if ($this->domein && $this->tld && $this->set_lock) {
            $result = $this->connection->get('domain_set_lock', [
                'domein'   => $this->domein,
                'tld'      => $this->tld,
                'set_lock' => $this->set_lock,
            ]);

            return $result;
        }

        throw new InvalidArgumentException();
    }

    /**
     * @param $result
     *
     * @return mixed
     */
    protected function processDomains($result)
    {
        if (isset($result['items']) && count($result['items'])) {
            foreach ($result['items'] as $id => $item) {
                $result['items'][$id] = new Domain($this->connection, $item);
            }
        }

        return $result;
    }
}
