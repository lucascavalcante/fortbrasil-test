<?php

namespace FortBrasil\ConfigModule\Resource;

class Database {

    private $credentials;

    public function __construct()
    {
        $this->credentials = [
            'dbname' => 'fortbrasil-db',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
    }

    public function getCredentials() : array
    {
        return $this->credentials;
    }

}