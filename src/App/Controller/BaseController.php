<?php
namespace App\Controller;

use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\Helper\SlotsHelper;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController
{
	protected function render($name, array $args = array(), $status='200')
	{
		$loader = new FilesystemLoader(__DIR__.'/../../views/%name%');

		$templating = new PhpEngine(new TemplateNameParser(), $loader);
		$templating->set(new SlotsHelper());

		return new Response($templating->render($name, $args), $status);
	}
}
