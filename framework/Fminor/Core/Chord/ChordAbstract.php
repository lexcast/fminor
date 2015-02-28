<?php
namespace Fminor\Core\Chord;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Fminor\Core\Config\ParametersManager;

abstract class ChordAbstract
{
    /**
     * Returns the configuration node of the chord.
     *
     * @return ArrayNodeDefinition|NodeDefinition chord's configuration
     */
    abstract public function getConfigNode();
    /**
     * Will process the parameters and returns all write requests needed.
     *
     * @return array write requests
     */
    abstract public function generateRequests(ParametersManager $parManager);
    /**
     * Return the chord's name.
     *
     * @return string chord's name
     */
    abstract public function getName();
    /**
     * @return array
     */
    abstract public function getSupportedFeatures();
    /**
     * @return ArrayNodeDefinition|NodeDefinition
     */
    protected function getChordNode()
    {
        $builder = new TreeBuilder();

        return $builder->root($this->getName(), 'array');
    }
}
