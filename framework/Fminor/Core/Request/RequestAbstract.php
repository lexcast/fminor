<?php
namespace Fminor\Core\Request;

abstract class RequestAbstract
{
    private $id;
    static function filter($requests)
    {
        return array_filter($requests, function ($request) {
            $class = get_class();
            return ($request instanceof $class);
        });
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
