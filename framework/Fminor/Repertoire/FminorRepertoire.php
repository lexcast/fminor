<?php
namespace Fminor\Repertoire;

use Fminor\Core\RepertoireInterface;

class FminorRepertoire implements RepertoireInterface
{
	/* (non-PHPdoc)
	 * @see \Fminor\Core\RepertoireInterface::getChords()
	 */
	public function getChords() {
		return array(
				new Chord\SectionChord()
		);
	}
	/* (non-PHPdoc)
	 * @see \Fminor\Core\RepertoireInterface::getCommands()
	 */
	public function getCommands() {
		return array();
	}
	/* (non-PHPdoc)
	 * @see \Fminor\Core\RepertoireInterface::getGenerators()
	 */
	public function getGenerators() {
		return array(
				new Generator\TemplatingGenerator()
		);
	}
	/* (non-PHPdoc)
	 * @see \Fminor\Core\RepertoireInterface::getName()
	 */
	public function getName() {
		return 'fminor';
	}
}
