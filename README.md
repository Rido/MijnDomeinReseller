# MijnDomeinReseller (MDR)

[![Build Status](https://travis-ci.org/bedrijfsportaal/MijnDomeinReseller.svg)](https://travis-ci.org/bedrijfsportaal/MijnDomeinReseller)
[![StyleCI](https://styleci.io/repos/106532343/shield)](https://styleci.io/repos/106532343)
[![Github all releases](https://img.shields.io/github/downloads/Bedrijfsportaal/MijnDomeinReseller/total.svg)](https://github.com/bedrijfsportaal/MijnDomeinReseller/releases/)
[![License](https://poser.pugx.org/rido/mijndomeinreseller/license)](https://packagist.org/packages/rido/mijndomeinreseller)

PHP Client for the MDR API.

This develop branch is the new modern PHP client for the MDR API. I'm currently working on this version.

## Contributors
[![Rido](https://avatars0.githubusercontent.com/u/1889864?s=60&v=4)](https://github.com/Rido)
[![Bedrijfsportaal](https://avatars3.githubusercontent.com/u/32488174?s=60&v=4)](https://github.com/Bedrijfsportaal)

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
- [x] DnsSec
- [x] DnsSecRecord
- [x] DnsTemplates
- [x] Domain
- [x] Nameserver
- [ ] NameserverGlue
- [ ] NewGtld
- [x] Tld
- [x] Transfer
- [x] Whois

## More information
https://www.mijndomeinreseller.nl/api/

## License
The MijnDomeinReseller PHP Client is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
