<?php
namespace Fminor\Repertoire\Chord;

use Fminor\Core\Chord\ChordAbstract;
use Fminor\Core\Config\ParametersManager;
use Fminor\Core\Templating\TwigEngine;
use Fminor\Repertoire\Request\RoutingRequest;
use Fminor\Repertoire\Request\TemplateRequest;
use Fminor\Repertoire\Request\ControllerRequest;

class WebpageChord extends ChordAbstract
{
    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordInterface::getConfigNode()
     */
    public function getConfigNode()
    {
        $node = $this->getChordNode();
        $node
            ->prototype('array')
                ->children()
                    ->scalarNode('path')->end()
                    ->arrayNode('parts')
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end();

        return $node;
    }

    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordInterface::generateWriteRequests()
     */
    public function generateRequests(ParametersManager $parManager)
    {
        $webpages = $parManager->getChordParameters('fminor', 'webpage');
        $requests = array();
        foreach($webpages as $key => $webpage) {
            foreach ($webpage['parts'] as $part) {
                if (!$parManager->hasFeatureById($part, 'embeddedable')) {
                    throw new \InvalidArgumentException(
                        'parts should support be embeddedable'
                    );
                }
            }
            $requests[] = $this->createRoute($key, $webpage);
            $requests[] = $this->createController($key, $webpage);
            $requests[] = $this->createTemplate($key, $webpage);
        }

        return $requests;
    }
    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordInterface::getName()
     */
    public function getName()
    {
        return 'webpage';
    }

    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordAbstract::getSupportedFeatures()
     */
    public function getSupportedFeatures()
    {
        return array(
            'linkeable',
        );
    }
    private function createRoute($key, $webpage)
    {
        $route = new RoutingRequest();
        $route->setId('fminor.webpage.'.$key);
        $route->setPath($webpage['path']);
        $route->setMethods(array('GET'));
        $route->setController('Default');
        $route->setAction($key);
        return $route;
    }
    private function createController($key, $webpage)
    {
        $controller = new ControllerRequest();
        $controller->setId('fminor.webpage.'.$key.'.controller');
        $controller->setController('Default');
        $controller->setAction($key);
        $controller->setCode(
            'return $this->render(\'fminor.webpage.'.$key.'.template.php\');'
        );
        return $controller;
    }
    private function createTemplate($key, $webpage)
    {
        $twig = new TwigEngine(__DIR__);
        $template = new TemplateRequest();
        $template->setId('fminor.webpage.'.$key.'.template');
        $template->setType(TemplateRequest::INCLUDED);
        $template->setContent(
            $twig->render(
                'webpage.php.twig',
                array('name' => $key, 'parts' => $webpage['parts'])
            )
        );

        return $template;
    }
}
