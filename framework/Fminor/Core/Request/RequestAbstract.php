<?php
namespace Fminor\Core\Request;

abstract class RequestAbstract
{
    static function filter($requests)
    {
        return array_filter($requests, function ($request) {
            $class = get_class();
            return ($request instanceof $class);
        });
    }
}
