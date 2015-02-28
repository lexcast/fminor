<?php
namespace Fminor\Repertoire\Request;

use Fminor\Core\Request\RequestInterface;

class ControllerRequest implements RequestInterface
{
    private $controllerName;
    private $actionName;
    private $code;
    public function getControllerName()
    {
        return $this->controllerName;
    }
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;

        return $this;
    }
    public function getActionName()
    {
        return $this->actionName;
    }
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;

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
