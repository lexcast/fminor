<?php
namespace Fminor\Repertoire\Generator;

use Fminor\Core\Generator\GeneratorAbstract;
use Fminor\Repertoire\Request\TemplateRequest;

class TemplatingGenerator extends GeneratorAbstract
{

	/* (non-PHPdoc)
	 * @see \Fminor\Core\Generator\GeneratorInterface::generate()
	 */
	public function generate(array $requests, array $parameters)
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
