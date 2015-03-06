<?php
namespace Fminor\Repertoire\Generator;

use Fminor\Core\Generator\GeneratorAbstract;
use Fminor\Core\Config\ParametersManager;
use Fminor\Repertoire\Request\ControllerRequest;
use Fminor\Core\Templating\TwigEngine;

class ControllerGenerator extends GeneratorAbstract
{
    /* (non-PHPdoc)
     * @see \Fminor\Core\Generator\GeneratorAbstract::generate()
     */
    public function generate(array $requests, ParametersManager $parManager)
    {
        $controllers = array();
        foreach (ControllerRequest::filter($requests) as $request) {
            if(! isset($controllers[$request->getController()])) {
                $controllers[$request->getController()] = array(
                    'name' => $request->getController(),
                    'actions' => array()
                );
            }
            $controllers[$request->getController()]['actions'][] = array(
                'name' => $request->getAction(),
                'code' => $request->getCode()
            );
        }
        $twig = new TwigEngine(__DIR__);
        foreach($controllers as $controller) {
            $this->create(
                'src/App/Controller',
                $controller['name'].'Controller.php',
                $twig->render('controller.php.twig', array('controller' => $controller))
            );
        }
    }
}
