<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use FortBrasil\ConfigModule\Resource\Database;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/FortBrasil/CustomerModule/Entity"), $isDevMode, null, null, false);

// database configuration parameters
$conn = new Database();

// obtaining the entity manager
$entityManager = EntityManager::create($conn->getCredentials(), $config);