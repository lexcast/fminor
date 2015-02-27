<?php
namespace Fminor\Core\Generator;

abstract class GeneratorAbstract
{
	abstract function generate(array $requests, array $parameters);
	protected function create($path, $filename, $content)
	{
		$path = __DIR__.'/../../../../'.$path.'/';
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		if (file_exists($path.$filename)) {
			unlink($path.$filename);
		}
		file_put_contents($path.$filename, $content);
	}
}
