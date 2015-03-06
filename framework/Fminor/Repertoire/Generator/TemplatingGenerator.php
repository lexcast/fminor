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
        $temReqs = TemplateRequest::filter($requests);
        foreach ( $temReqs as $request) {
            $request->setContent($this->processTemplate($request->getContent(), $requests));
            if($request->getType() === TemplateRequest::INCLUDED) {
                $this->create('src/Resources/views', $request->getId().'.php', $request->getContent());
            }
        }
    }
    private function processTemplate($content, array $requests)
    {
        $embeddedMatches = array();
        preg_match_all('/@(.*?)@/', $content, $embeddedMatches, PREG_SET_ORDER);
        foreach ($embeddedMatches as $match) {
            $request = $this->getRequestById($requests, $match[1]);
            if($request instanceof TemplateRequest) {
                $request->setContent(
                    $this->processTemplate($request->getContent(), $requests)
                );
                $type = $request->getType();
                if($type === TemplateRequest::INLINE) {
                    $content = preg_replace('/@(.*?)@/', $request->getContent(), $content, 1);
                }
                elseif($type === TemplateRequest::INCLUDED) {
                    $content = preg_replace(
                        '/@(.*?)@/', "<?php $view->render('".$match[1].".php'); ?>", $content, 1
                    );
                }
            }
        }
        $linkMatches = array();
        preg_match_all('/%(.*?)%/', $content, $linkMatches, PREG_SET_ORDER);
        foreach ($linkMatches as $match) {
            $request = $this->getRequestById($requests, $match[1]);
            if($request instanceof TemplateRequest) {
                $anchor = substr($match[1], strrpos($match[1], '.'));
                $content = preg_replace('/%(.*?)%/', '#'.$anchor, $content, 1);
            }
            elseif($request instanceof RoutingRequest) {
                $content = preg_replace('/%(.*?)%/', $request->getPath(), $content, 1);
            }
        }
        return $content;
    }
}
