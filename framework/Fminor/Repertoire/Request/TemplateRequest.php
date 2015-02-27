<?php
namespace Fminor\Repertoire\Request;

use Fminor\Core\Request\RequestInterface;

class TemplateRequest implements RequestInterface
{
	private $content;
	private $path;
	private $filename;
	public function getContent() {
		return $this->content;
	}
	public function setContent($content) {
		$this->content = $content;
		return $this;
	}
	public function getPath() {
		return $this->path;
	}
	public function setPath($path) {
		$this->path = $path;
		return $this;
	}
	public function getFilename() {
		return $this->filename;
	}
	public function setFilename($filename) {
		$this->filename = $filename;
		return $this;
	}

}
