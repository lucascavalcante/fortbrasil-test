<?php

namespace FortBrasil\CustomerModule\Service;

use FortBrasil\BaseModule\Util\Util;
use FortBrasil\CustomerModule\Repository\CustomerRepository;

class CustomerService
{
    private $repository;
     public function __construct()
     {
         $this->repository = new CustomerRepository();
     }

    public function getAllCustomers() {
        return $this->repository->findAll();
    }

    public function getCustomer($id) {
         $customer = $this->repository->findById($id);
         if($customer !== null)
             return Util::return(200, (array) $customer);

        return Util::return(404, 'Customer not found');
    }

    public function addCustomer($request) {
        return 'add';
    }

    public function editCustomer($request) {
        return 'edit';
    }

    public function deleteCustomer($id) {
        return 'delete';
    }
}