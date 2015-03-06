<?php
namespace Fminor\Repertoire\Generator;

use Fminor\Core\Generator\GeneratorAbstract;
use Fminor\Core\Config\ParametersManager;
use Fminor\Repertoire\Request\RoutingRequest;
use Fminor\Core\Templating\TwigEngine;

class RoutingGenerator extends GeneratorAbstract
{
    /* (non-PHPdoc)
     * @see \Fminor\Core\Generator\GeneratorAbstract::generate()
     */
    public function generate(array $requests, ParametersManager $parManager)
    {
        $twig = new TwigEngine(__DIR__);
        $param = array('routes' => RoutingRequest::filter($requests));
        $this->create('src/Config', 'routes.php', $twig->render('routes.php.twig', $param ));
    }
}
