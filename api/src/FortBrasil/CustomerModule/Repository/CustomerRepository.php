<?php

namespace FortBrasil\CustomerModule\Repository;

use FortBrasil\BaseModule\Repository\BaseRepository;

class CustomerRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('FortBrasil\CustomerModule\Entity', '\Customer');
    }

    public function findAll()
    {
        return parent::findAll();
    }

    public function findById($id)
    {
        return parent::findById($id);
    }

    public function insert($obj)
    {
        parent::insert($obj);
    }

    public function update($obj)
    {
        parent::update($obj);
    }

    public function delete($obj)
    {
        parent::delete($obj);
    }

}