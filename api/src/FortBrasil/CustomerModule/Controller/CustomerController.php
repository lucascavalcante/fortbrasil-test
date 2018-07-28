<?php

namespace FortBrasil\CustomerModule\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FortBrasil\BaseModule\Interfaces\BaseInterface;
use FortBrasil\CustomerModule\Service\CustomerService;

class CustomerController implements BaseInterface
{
    public static function managingRoutes(Request $request)
    {
        $service = new CustomerService();
        $response = null;

        switch ($request->server->get('REQUEST_METHOD')) {
            case 'GET':
                $id = $request->attributes->get('id', false);
                $response = $id ? $service->getCustomer($id) : $service->getAllCustomers();
                break;
            case 'POST':
                $response = $service->addCustomer($request);
                break;
            case 'PUT':
                $response = $service->editCustomer($request);
                break;
            case 'DELETE':
                $response = $service->deleteCustomer($request);
                break;
        }
        return new JsonResponse($response);
    }
}