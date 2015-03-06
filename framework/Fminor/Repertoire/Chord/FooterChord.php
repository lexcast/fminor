<?php
namespace Fminor\Repertoire\Chord;

use Fminor\Core\Chord\ChordAbstract;
use Fminor\Repertoire\Request\TemplateRequest;
use Fminor\Core\Templating\TwigEngine;
use Fminor\Core\Config\ParametersManager;

class FooterChord extends ChordAbstract
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
      $footers = $parManager->getChordParameters('fminor','footer');
      $twig = new TwigEngine(__DIR__);
      $requests = array();
      for ($i = 0; $i<count($footers);$i++) {
          $footer = $footers[$i];
          $companyName = 'your_company';
          $year= '2015';
          $request = new TemplateRequest();
          $request->setId('fminor.footer.'.$footer);
          $request->setType(TemplateRequest::INLINE);
          $request->setContent($twig->render('footer.php.twig', array('name' => $footer, 'company_name' => $companyName, 'year' => $year)));
          $requests[] = $request;
      }

      return $requests;
    }
    /* (non-PHPdoc)
     * @see \Fminor\Core\Chord\ChordInterface::getName()
     */
    public function getName()
    {
        return 'footer';
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
