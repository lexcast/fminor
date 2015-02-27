<?php
namespace Fminor\Core\Chord;

use Symfony\Component\Config\Definition\NodeInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
abstract class ChordAbstract
{
	/**
	 * Returns the configuration node of the chord
	 * 
	 * @return NodeInterface chord's configuration
	 */
	abstract function getConfigNode();
	/**
	 * Will process the parameters and returns all write requests needed
	 * 
	 * @return array write requests
	 */
	abstract function generateRequests(array $parameters);
	/**
	 * Return the chord's name
	 * 
	 * @return string chord's name
	 */
	abstract function getName();
	/**
	 * @return array
	 */
	abstract function getSupportedFeatures();
	/**
	 * 
	 * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition|\Symfony\Component\Config\Definition\Builder\NodeDefinition
	 */
	protected function getChordNode()
	{
		$builder = new TreeBuilder();
		return $builder->root($this->getName(), 'array');
	}
}