<?php
namespace Fminor\Repertoire\Generator;

use Fminor\Core\Generator\GeneratorAbstract;
use Fminor\Repertoire\Request\TemplateRequest;
use Fminor\Core\Config\ParametersManager;

class TemplatingGenerator extends GeneratorAbstract
{
    /* (non-PHPdoc)
     * @see \Fminor\Core\Generator\GeneratorAbstract::generate()
     */
    public function generate(array $requests, ParametersManager $parManager)
    {
        foreach ($requests as $request) {
            if ($request instanceof TemplateRequest) {
                $this->create(
                        'src/Resources/views/'.$request->getPath(),
                        $request->getFilename().'.php',
                        $request->getContent()
                );
            }
        }
    }
}
