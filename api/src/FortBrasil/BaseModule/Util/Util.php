<?php

namespace FortBrasil\BaseModule\Util;

class Util
{
    public static function return($code, $message) {
        return ['code ' => $code, 'message' => $message];
    }
}