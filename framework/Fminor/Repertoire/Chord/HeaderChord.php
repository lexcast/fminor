<?php
namespace Fminor\Repertoire\Chord;

use Fminor\Core\Chord\ChordAbstract;
use Fminor\Repertoire\Request\TemplateRequest;
use Fminor\Core\Templating\TwigEngine;
use Fminor\Core\Config\ParametersManager;

class HeaderChord extends ChordAbstract
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
      $headers = $parManager->getChordParameters('fminor','header');
      $twig = new TwigEngine(_DIR_);
      $requests = array();
      for ($i = 0; $i<count($headers);$i++) {
          $header = $headers[$i];
          $request = new TemplateRequest();
          $request->setId('fminor.header.'.$header);
          $request->setType(TemplateRequest::INLINE);
          $request->setContent($twig->render('header.php.twig', array('name' => $header)));
          $requests[] = $request;
      }

      return $requests;
    }
    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordInterface::getName()
     */
    public function getName()
    {
        return 'header';
    }

    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordAbstract::getSupportedFeatures()
     */
    public function getSupportedFeatures()
    {
        return array(
            'embeddedable',
        );
    }
}
