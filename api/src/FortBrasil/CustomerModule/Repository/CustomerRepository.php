<?php

namespace FortBrasil\CustomerModule\Repository;

use FortBrasil\BaseModule\Repository\BaseRepository;

class CustomerRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('FortBrasil\CustomerModule\Entity', '\Customer');
    }

    public function findByCpf($cpf) {
        return $this->entityManager->getRepository($this->entityPath)->findOneBy(['cpf' => $cpf]);
    }

    public function findByIdAndCpf($id, $cpf) {
        return $this->entityManager->getRepository($this->entityPath)->findOneBy(['id' => $id, 'cpf' => $cpf]);
    }

}