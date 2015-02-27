<?php
namespace Fminor\Repertoire\Chord;

use Fminor\Core\Chord\ChordAbstract;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\ScalarNode;

class WebpageChord extends ChordAbstract
{
	
	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordInterface::getConfigNode()
	 */
	public function getConfigNode() {
		$node = $this->getChordNode();
		$node
			->prototype('array')
				->children()
					->scalarNode('route')->end()
					->arrayNode('parts')->end()
				->end()
			->end();
		return $node;
	}

	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordInterface::generateWriteRequests()
	 */
	public function generateRequests(array $parameters) { }
	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordInterface::getName()
	 */
	public function getName() {
		return 'webpage';
	}
	
	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordAbstract::getSupportedFeatures()
	 */
	public function getSupportedFeatures() {
		return array(
			'linkeable'
		);
	}
}