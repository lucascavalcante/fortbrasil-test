<?php

namespace FortBrasil\BaseModule\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface BaseInterface
{
    public static function managingRoutes(Request $request);
}