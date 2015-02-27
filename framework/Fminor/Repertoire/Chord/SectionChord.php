<?php
namespace Fminor\Repertoire\Chord;

use Fminor\Core\Chord\ChordAbstract;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Fminor\Repertoire\Request\TemplateRequest;
use Fminor\Core\Templating\TwigEngine;

class SectionChord extends ChordAbstract
{

	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordInterface::getConfigNode()
	 */
	public function getConfigNode() {
		$node = $this->getChordNode();
		$node->prototype('scalar')->end();
		return $node;
	}

	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordInterface::generateWriteRequests()
	 */
	public function generateRequests(array $parameters)
	{
		$sections = $parameters['fminor']['section'];
		$twig = new TwigEngine(__DIR__);
		$requests = array();
		for($i=0; $i<count($sections)-1;$i++) {
			$section = $sections[$i];
			$request = new TemplateRequest();
			$request->setFilename($section);
			$request->setPath('fminor/section');
			$request->setContent($twig->render('section.php.twig', array('name' => $section)));
			$requests[] = $request;
		}
		return $requests;
	}
	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordInterface::getName()
	 */
	public function getName() {
		return 'section';
	}

	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordAbstract::getSupportedFeatures()
	 */
	public function getSupportedFeatures() {
		return array(
			'embeddedable',
			'linkeable'
		);
	}
}
