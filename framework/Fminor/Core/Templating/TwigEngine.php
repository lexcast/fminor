<?php
namespace Fminor\Core\Templating;


class TwigEngine
{
    /**
     * @var \Twig_Environment
     */
    private $templating;
    public function __construct($dir)
    {
        $loader = new \Twig_Loader_Filesystem($dir.'/../Resources/views/');
        $this->templating = new \Twig_Environment($loader, array(
            'debug' => true,
            'cache' => false,
            'strict_variables' => true,
            'autoescape' => false,
        ));
    }
    public function render($filename, $parameters)
    {
        return $this->templating->render($filename, $parameters);
    }
}
