<?php namespace Rido\MDR\Models;

class Domain extends Model
{
    protected $fillable = [
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
        'authkey',
        'verloopdatum',
        'inaccountdatum',
        'status',
    ];

    public function get()
    {
        if ($result = $this->connection->get('domain_list')) {
            return $result['items'];
        }

        return false;
    }

    public function find($domain)
    {
        $exp = explode('.', $domain, 2);

        if (count($exp) == 2) {
            $result = $this->connection->get('domain_get_details', [
                'domein' => $exp[0],
                'tld'    => $exp[1]
            ]);

            return $this->createObjectFromResponse($result);
        }

        throw new \InvalidArgumentException();
    }
}