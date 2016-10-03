<?php

class ConnectionTest extends PHPUnit_Framework_TestCase
{
    public function testConnectionWithInvalidCredentials()
    {
        $this->expectException(\Rido\MDR\Exceptions\ApiException::class);

        $connection = new \Rido\MDR\Connection();
        $connection->setUsername('test');
        $connection->setPassword('test');

        $connection->get('domain_list');
    }
}
