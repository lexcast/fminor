<?php
namespace Fminor\Repertoire\Request;

use Fminor\Core\Request\RequestAbstract;

class RoutingRequest extends RequestAbstract
{
    private $path;
    private $methods;
    private $controller;
    private $action;
    public function getPath()
    {
        return $this->path;
    }
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
    public function getMethods()
    {
        return $this->methods;
    }
    public function setMethods(array $methods)
    {
        $this->methods = $methods;

        return $this;
    }
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
}
