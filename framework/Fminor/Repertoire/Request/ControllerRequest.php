<?php
namespace Fminor\Repertoire\Request;

use Fminor\Core\Request\RequestAbstract;

class ControllerRequest extends RequestAbstract
{
    private $controller;
    private $action;
    private $code;
    public function getController()
    {
        return $this->controller;
    }
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }
    public function getAction()
    {
        return $this->action;
    }
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }
    public function getCode()
    {
        return $this->code;
    }
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}
