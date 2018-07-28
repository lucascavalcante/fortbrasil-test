<?php

namespace FortBrasil\BaseModule\Controller;

use FortBrasil\BaseModule\Interfaces\BaseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BaseController implements BaseInterface
{
    public static function managingRoutes(Request $request, $array = null)
    {
        return new JsonResponse($array);
    }

}