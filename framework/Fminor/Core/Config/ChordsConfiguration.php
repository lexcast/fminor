<?php
namespace Fminor\Core\Config;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class ChordsConfiguration implements ConfigurationInterface
{
    /**
     * @var array
     */
    private $repertoires;

    /**
     * (non-PHPdoc).
     *
     * @see \Symfony\Component\Config\Definition\ConfigurationInterface::getConfigTreeBuilder()
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('framework');
        $rootNode
            ->children()
                ->arrayNode('language')
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ;
        $this->appendChordsNodes($rootNode);

        return $treeBuilder;
    }
    /**
     * @param ArrayNodeDefinition $rootNode
     */
    private function appendChordsNodes(ArrayNodeDefinition $rootNode)
    {
        foreach ($this->repertoires as $repertoire) {
            $builder = new TreeBuilder();
            $repNode = $builder->root($repertoire->getName());
            $chords = $repertoire->getChords();
            foreach ($chords as $chord) {
                $repNode->append($chord->getConfigNode());
            }
            $rootNode->append($repNode);
        }
    }
    /**
     * @param array $repertoires
     */
    public function setRepertoires(array $repertoires)
    {
        $this->repertoires = $repertoires;
    }
}
