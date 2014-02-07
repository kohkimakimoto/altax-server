<?php
namespace Altax\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ServerCommand extends \Altax\Command\Command
{
    protected function configure()
    {
        $config = $this->getTaskConfig();

        $host = isset($config["host"]) ? $config["host"] : '0.0.0.0';
        $port = isset($config["port"]) ? $config["port"] : 3000;
        $script = isset($config["script"]) ? $config["script"] : "";

        $this
            ->setDescription("Runs php builtin server.")
            ->addOption(
                'host',
                null,
                InputOption::VALUE_OPTIONAL, 
                'The host address to serve the application on.', 
                $host
                )
            ->addOption(
                'port',
                null,
                InputOption::VALUE_OPTIONAL, 
                'The port to serve the application on.', 
                $port
                )
            ->addArgument(
                'script',
                InputArgument::OPTIONAL,
                'Router script of the server.',
                $script
            )
            ;
    }

    protected function fire($task)
    {
        if (version_compare(PHP_VERSION, '5.4.0', '<'))
        {
            throw new \Exception('This PHP binary is not version 5.4 or greater.');
        }

        $input = $task->getInput();
        $output = $task->getOutput();

        $host = $input->getOption('host');
        $port = $input->getOption('port');
        $script = $input->getArgument('script');

        $input->info("Altax web server started on http://{$host}:{$port}");
        
        passthru('"'.PHP_BINARY.'"'." -S {$host}:{$port} {$script}");
    }
}
