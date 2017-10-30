# MijnDomeinReseller (MDR)

[![Build Status](https://travis-ci.org/Rido/MijnDomeinReseller.svg)](https://travis-ci.org/Rido/MijnDomeinReseller)
[![StyleCI](https://styleci.io/repos/50727782/shield)](https://styleci.io/repos/50727782)
[![License](https://poser.pugx.org/rido/mijndomeinreseller/license)](https://packagist.org/packages/rido/mijndomeinreseller)

PHP Client for the MDR API.

This develop branch is the new modern PHP client for the MDR API. I'm currently working on this version.

## Usage
```php
<?php

require __DIR__.'/../vendor/autoload.php';

$username = '';
$password = '';

$connection = new \Rido\MDR\Connection();
$connection->setUsername($username);
$connection->setPassword($password);

$mdr = new \Rido\MDR\MijnDomeinReseller($connection);

$domain = $mdr->domain();

$domains = $domain->get();

// Array with all the registered domains
var_dump($domains); 
```

## Todo
- [ ] Billing
- [x] Contact
- [x] Dns
- [x] DnsRecord
      - Find records
      - Modify TTL
- [ ] DnsSec
- [ ] DnsSecRecord
- [x] Domain
- [x] Nameserver
- [ ] NameserverGlue
- [ ] NewGtld
- [x] Tld
- [ ] Transfer
- [x] Whois

## More information
https://www.mijndomeinreseller.nl/api/

## License
The MijnDomeinReseller PHP Client is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
