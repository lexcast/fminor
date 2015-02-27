<?php
namespace Fminor\Repertoire\Request;

use Fminor\Core\Request\RequestInterface;

class RoutingRequest implements RequestInterface
{
	private $path;
	private $methods;
	public function getPath() {
		return $this->path;
	}
	public function setPath($path) {
		$this->path = $path;
		return $this;
	}
	public function getMethods() {
		return $this->methods;
	}
	public function setMethods(array $methods) {
		$this->methods = $methods;
		return $this;
	}
}
