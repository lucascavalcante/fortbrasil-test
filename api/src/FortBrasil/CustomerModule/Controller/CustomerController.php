<?php

namespace FortBrasil\CustomerModule\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use FortBrasil\BaseModule\Interfaces\BaseInterface;
use FortBrasil\CustomerModule\Service\CustomerService;

class CustomerController implements BaseInterface
{
    public static function managingRoutes(Request $request, $app = null)
    {
        $service = new CustomerService();
        $response = null;

        switch ($request->server->get('REQUEST_METHOD')) {
            case 'GET':
                $id = $request->attributes->get('id', false);
                $response = $id ? $service->getCustomer($id) : $service->getAllCustomers();
                break;
            case 'POST':
                $method = $request->request->get('_method');
                $response = $method === 'PUT' ? $service->editCustomer($request, $app) : $service->addCustomer($request, $app);
                break;
            case 'PUT':
                $response = $service->editCustomer($request, $app);
                break;
            case 'DELETE':
                $response = $service->deleteCustomer($request);
                break;
            case 'OPTIONS':
                $response = $service->addCustomer($request, $app);
                break;
        }

        return new JsonResponse($response);
    }
}