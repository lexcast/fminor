<?php
namespace Fminor\Core\Config;

use Symfony\Component\Config\Definition\Processor;

class ParametersManager
{
  private $parameters;
    public function __construct($chordsYml, $repertoires)
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
                if (isset($this->parameters[$repertoire->getName()][$chord->getName()])) {
                    $this->parameters[$repertoire->getName()][$chord->getName()]['features'] =
                        $chord->getSupportedFeatures();
                }
            }
        }
    }
    public function getChordParameters($repertoire, $chord)
    {
        if (isset($this->parameters[$repertoire][$chord])) {
            $parameter =  $this->parameters[$repertoire][$chord];
            unset($parameter['features']);

            return $parameter;
        }

        return;
    }
    public function getChordFeatures($repertoire, $chord)
    {
        if (isset($this->parameters[$repertoire][$chord])) {
            $parameter =  $this->parameters[$repertoire][$chord];

            return $parameter['features'];
        }

        return;
    }
    public function hasFeature($repertoire, $chord, $feature)
    {
        $features = $this->getChordFeatures($repertoire, $chord);

        return ($features !== null && in_array($feature, $features));
    }
    public function getParameters()
    {
        return $this->parameters;
    }
    public function getBaseParameter($parameter)
    {
        return $this->parameters[$parameter];
    }
}
