<?php

namespace FortBrasil\CustomerModule\Service;

use FortBrasil\BaseModule\Util\Util;
use FortBrasil\CustomerModule\Entity\Customer;
use FortBrasil\CustomerModule\Repository\CustomerRepository;

class CustomerService
{
    private $repository;
     public function __construct()
     {
         $this->repository = new CustomerRepository();
     }

    public function getAllCustomers() {
         $customers = $this->repository->findAll();
        return Util::return(200, $customers);
    }

    public function getCustomer($id) {
         $customer = $this->repository->findById($id);
         if($customer !== null)
             return Util::return(200, $customer);

        return Util::return(404, 'Customer not found');
    }

    public function addCustomer($request, $app) {
        $customer = new Customer();
        $customer->setFirstName($request->request->get('firstName'));
        $customer->setLastName($request->request->get('lastName'));
        $customer->setCpf($request->request->get('cpf'));

        $birthday = $request->request->get('birthday', null);
        if($birthday != 'null')
            $birthday = new \DateTime($birthday, new \DateTimeZone('America/Fortaleza'));
        else
            $birthday = null;

        $customer->setBirthday($birthday);
        $customer->setGenre($request->request->get('genre'));

        $validate = $this->validate($customer, $app);
        if($validate)
            return Util::return(400, $validate);

        $registry = $this->repository->insert($customer);
        return Util::return(201, $registry);
    }

    public function editCustomer($request, $app) {
        $customer = $this->repository->findById($request->attributes->get('id'));
        if($customer === null) {
            return Util::return(404, 'Customer not found');
        }

        $customer->setFirstName($request->request->get('firstName'));
        $customer->setLastName($request->request->get('lastName'));
        $customer->setCpf($request->request->get('cpf'));

        $birthday = $request->request->get('birthday', null);
        if($birthday != 'null')
            $birthday = new \DateTime($birthday, new \DateTimeZone('America/Fortaleza'));
        else
            $birthday = null;


        $customer->setBirthday($birthday);
        $customer->setGenre($request->request->get('genre', null));

        $validate = $this->validate($customer, $app);
        if($validate)
            return Util::return(400, $validate);

        $registry = $this->repository->insert($customer);
        return Util::return(200, $registry);
    }

    public function deleteCustomer($request) {
        $customer = $this->repository->findById($request->attributes->get('id'));
        if($customer !== null) {
            return Util::return (200, $this->repository->delete($customer));
        }

        return Util::return(404, 'Customer not found');
    }

    public function validate($customer, $app) {
        $errors = $app['validator']->validate($customer);
        $returnErrors = [];

        if($this->repository->findByCpf($customer->getCpf()) !== null) {
            if($this->repository->findByIdAndCpf($customer->getId(), $customer->getCpf()) === null)
                $returnErrors['cpf'] = 'CPF already registered';
        }

        if (count($errors) > 0 || count($returnErrors) > 0) {
            foreach ($errors as $error) {
                $returnErrors[$error->getPropertyPath()] = $error->getMessage();
            }

            return $returnErrors;
        }

        return null;
    }
}