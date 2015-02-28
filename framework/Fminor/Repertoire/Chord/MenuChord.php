<?php
namespace Fminor\Repertoire\Chord;

use Fminor\Core\Chord\ChordAbstract;
use Fminor\Core\Config\ParametersManager;

class MenuChord extends ChordAbstract
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
	public function generateRequests(ParametersManager $parManager) { }
	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordInterface::getName()
	 */
	public function getName() {
		return 'menu';
	}

	/* (non-PHPdoc)
	 * @see \Fminor\Core\Chord\ChordAbstract::getSupportedFeatures()
	 */
	public function getSupportedFeatures() {
		return array(
			'embeddedable'
		);
	}
}
