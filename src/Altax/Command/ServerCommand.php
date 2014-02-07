<?php
namespace Altax\Command;

use Symfony\Component\Console\Input\InputOption;

class ServerCommand extends \Altax\Command\Command
{
    protected function configure()
    {
        $this
            ->setDescription("Runs php builtin server.")
            ->addOption(
                'host',
                null,
                InputOption::VALUE_OPTIONAL, 
                'The host address to serve the application on.', 
                '0.0.0.0'
                )
            ->addOption(
                'port',
                null,
                InputOption::VALUE_OPTIONAL, 
                'The port to serve the application on.', 
                3000
                )
            ;
    }

    protected function fire($task)
    {
        if (version_compare(PHP_VERSION, '5.4.0', '<'))
        {
            throw new \Exception('This PHP binary is not version 5.4 or greater.');
        }

        $task->getOutput()->writeln("Run");
        
        //passthru('"'.PHP_BINARY.'"'." -S {$host}:{$port} -t \"{$public}\" server.php");
    }
}