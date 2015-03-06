<?php
namespace Fminor\Repertoire\Request;

use Fminor\Core\Request\RequestAbstract;

class TemplateRequest extends RequestAbstract
{
    const INLINE =  'inline';
    const INCLUDED = 'included';
    //this will be added
    //const CONTROLLER = 'controller';
    private $content;
    private $type;
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        if($type !== self::INLINE && $type !== self::INCLUDED) {
            throw new \InvalidArgumentException(
                'type should be '.self::INLINE.' or '.self::INCLUDED
            );
        }
        $this->type = $type;

        return $this;
    }
}
