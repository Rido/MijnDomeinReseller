# MijnDomeinReseller (MDR)

[![Build Status](https://travis-ci.org/Rido/MijnDomeinReseller.svg?branch=develop)](https://travis-ci.org/Rido/MijnDomeinReseller)
[![StyleCI](https://styleci.io/repos/50727782/shield?branch=develop)](https://styleci.io/repos/50727782)
[![License](https://poser.pugx.org/rido/mijndomeinreseller/license)](https://packagist.org/packages/rido/mijndomeinreseller)

PHP Client for the MDR API.

This develop branch is the new modern PHP client for the MDR API. I'm currently working on this version.
I will merge it into the master branch when it's finished.

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

## More information
https://www.mijndomeinreseller.nl/api/

## License
MIT License

Copyright (c) 2016 Rick Doorakkers

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.