<?php
namespace Fminor\Repertoire\Chord;

use Fminor\Core\Chord\ChordAbstract;
use Fminor\Repertoire\Request\TemplateRequest;
use Fminor\Core\Templating\TwigEngine;
use Fminor\Core\Config\ParametersManager;

class SectionChord extends ChordAbstract
{
    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordInterface::getConfigNode()
     */
    public function getConfigNode()
    {
        $node = $this->getChordNode();
        $node->prototype('scalar')->end();

        return $node;
    }

    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordInterface::generateWriteRequests()
     */
    public function generateRequests(ParametersManager $parManager)
    {
        $sections = $parManager->getChordParameters('fminor', 'section');
        $twig = new TwigEngine(__DIR__);
        $requests = array();
        for ($i = 0; $i<count($sections);$i++) {
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
    public function getName()
    {
        return 'section';
    }

    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordAbstract::getSupportedFeatures()
     */
    public function getSupportedFeatures()
    {
        return array(
            'embeddedable',
            'linkeable',
        );
    }
}
