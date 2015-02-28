<?php
namespace Fminor\Core\Config;

use Symfony\Component\Config\Definition\Processor;
use Fminor\Core\Config\ChordsConfiguration;

class ParametersManager
{
  private $parameters;
  function __construct($chordsYml, $repertoires)
  {
    $configuration = new ChordsConfiguration();
		$configuration->setRepertoires($repertoires);

		$processor = new Processor();
		$this->parameters = $processor->processConfiguration(
				$configuration,
				array($chordsYml)
		);

		foreach ($repertoires as $repertoire) {
			foreach ($repertoire->getChords() as $chord) {
				if (isset($this->parameters[$repertoire->getName()][$chord->getName()]))
					$this->parameters[$repertoire->getName()][$chord->getName()]['features']=
						$chord->getSupportedFeatures();
			}
		}
  }
  function getChordParameters($repertoire, $chord)
  {
    if(isset($this->parameters[$repertoire][$chord])) {
      $parameter =  $this->parameters[$repertoire][$chord];
      unset($parameter['features']);
      return $parameter;
    }

    return null;
  }
  function getChordFeatures($repertoire, $chord)
  {
    if(isset($this->parameters[$repertoire][$chord])) {
      $parameter =  $this->parameters[$repertoire][$chord];
      return $parameter['features'];
    }

    return null;
  }
  function hasFeature($repertoire, $chord, $feature)
  {
    $features = $this->getChordFeatures($repertoire, $chord);
    return ($features !== null && in_array($feature, $features));
  }
  function getParameters()
  {
    return $this->parameters;
  }
  function getBaseParameter($parameter)
  {
    return $this->parameters[$parameter];
  }
}
