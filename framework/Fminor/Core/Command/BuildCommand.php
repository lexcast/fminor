<?php
namespace Fminor\Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Fminor\Core\Config\ChordsConfiguration;
use Fminor\Core\Generator\RoutingGenerator;
use Fminor\Core\Generator\TemplatingGenerator;
use Fminor\Core\Generator\ControllerGenerator;

class BuildCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('build')
            ->setDescription('Build a webpage based on a yml file')
            ->addOption(
               'force',
               null,
               InputOption::VALUE_NONE,
               'If set, the command won\'t ask for confirmation'
            )
            ->setHelp(<<<EOT
The <info>build</info> command will create a total working site based on an yml file.
By default, the command will load the chords.yml file in root of the project and generate the site on src/ folder.
Remember that this command will delete files in src/ folder to can generate the new ones, so use it wisely.
The command will ask if you want to continue, but if you want to run the command without any confirmation add the --force option.
<info>php tuner build --force</info>
Note that this command is just for build a new project.
EOT
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$bar = $this->getProgressBar($output);
    	$bar->setMessage('processing configuration...');
    	$bar->start();
    	$chordsYml = Yaml::parse(file_get_contents(__DIR__.'/../../../../chords.yml'));
		if($chordsYml === false || !is_array($chordsYml)) {
			$bar->clear();
			$output->writeln('<error>There was an error while trying to open chords.yml file</error>');
			return;
		}
		$repertoires = require_once __DIR__.'/../../../../src/Config/repertoires.php';
		$configuration = new ChordsConfiguration();
		$configuration->setRepertoires($repertoires);
		$processor = new Processor();
		$processedConfiguration = $processor->processConfiguration(
				$configuration,
				array($chordsYml)
		);

		foreach ($repertoires as $repertoire) {
			foreach ($repertoire->getChords() as $chord) {
				if (isset($processedConfiguration[$repertoire->getName()][$chord->getName()]))
					$processedConfiguration[$repertoire->getName()][$chord->getName()]['properties']=
						$chord->getSupportedFeatures();
			}
		}

		$bar->advance();


        $force = $input->getOption('force');
        if($force === false) {
        	$output->writeln('<comment>this command will delete all configuration, resources, controller and model files on src/ folder</comment>');

        	$helper = $this->getHelper('question');
        	$question = new ConfirmationQuestion('Do you want to continue with this action?[N/y]', false);

	        if (!$helper->ask($input, $output, $question)) {
	    		return;
			}
        }
        $requests = array();
        foreach ($repertoires as $repertoire) {
        	foreach ($repertoire->getChords() as $chord) {
        		$requests = array_merge($requests, $chord->generateRequests($processedConfiguration));
        	}
        }
        $this->generate($repertoires, $requests, $processedConfiguration);
		$bar->finish();
    }
    /**
     *
     * @param OutputInterface $output
     * @return \Symfony\Component\Console\Helper\ProgressBar
     */
    private function getProgressBar(OutputInterface $output)
    {
    	$bar = new ProgressBar($output);
    	$bar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %memory:6s%');
    	$bar->setBarCharacter('<comment>=</comment>');
    	$bar->setEmptyBarCharacter(' ');
    	$bar->setProgressCharacter('|');
    	$bar->setBarWidth(50);

    	return $bar;
    }
    private function generate(array $repertoires, array $requests, array $parameters)
    {
      foreach ($repertoires as $repertoire) {
        foreach ($repertoire->getGenerators() as $generator) {
          $generator->generate($requests, $parameters);
        }
      }
    }
}
