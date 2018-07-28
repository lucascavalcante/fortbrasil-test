<?php

namespace FortBrasil\BaseModule\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use FortBrasil\ConfigModule\Resource\Database;

abstract class BaseRepository
{
    protected $path;
    protected $entityManager;
    protected $entityPath;

    public function __construct($path, $entity)
    {
        $this->path = $path;
        $this->entityPath = $path . $entity;
        $this->entityManager = $this->createEntityManager();
    }

    public function createEntityManager()
    {
        $path = [$this->path];
        $isDevMode = true;
        $config = Setup::createAnnotationMetadataConfiguration($path, $isDevMode, null, null, false);

        $conn = new Database();
        return EntityManager::create($conn->getCredentials(), $config);
    }

    public function findAll()
    {
        $collection = $this->entityManager->getRepository($this->entityPath)->findAll();
        $data = [];

        foreach ($collection as $obj) {
            $data[] = $obj;
        }
        return $data;
    }

    public function findById($id)
    {
        return $this->entityManager->find($this->entityPath, $id);
    }

    public function insert($obj)
    {
        $this->entityManager->persist($obj);
        $this->entityManager->flush();
        return $obj;
    }
    public function update($obj)
    {
        $this->entityManager->merge($obj);
        $this->entityManager->flush();
        return $obj;
    }
    public function delete($obj)
    {
        $this->entityManager->remove($obj);
        $this->entityManager->flush();
        return 'Removed successfully';
    }
}