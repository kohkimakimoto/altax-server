<?php
namespace Altax\Contrib\Server\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ServerCommand extends \Altax\Command\Command
{
    protected function configure()
    {
        $config = $this->getTaskConfig();

        $host = isset($config["host"]) ? $config["host"] : '0.0.0.0';
        $port = isset($config["port"]) ? $config["port"] : 3000;
        $script = isset($config["script"]) ? $config["script"] : null;
        $docroot = isset($config["docroot"]) ? $config["docroot"] : null;

        $this
            ->setDescription("Runs php builtin server.")
            ->addOption(
                'host',
                'H',
                InputOption::VALUE_REQUIRED, 
                'The host address of the server.', 
                $host
                )
            ->addOption(
                'port',
                'p',
                InputOption::VALUE_REQUIRED, 
                'The port of the server.', 
                $port
                )
            ->addOption(
                'docroot',
                't',
                InputOption::VALUE_REQUIRED, 
                'The document root of the server.',
                $docroot
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
        $docroot = $input->getOption('docroot');
        $script = $input->getArgument('script');

        $output->writeln("<info>Altax web server started on </info><comment>http://{$host}:{$port}</comment>");
        if ($docroot) {
            $output->writeln("<info>Document root: </info><comment>{$docroot}</comment>");
        }
        if ($script) {
            $output->writeln("<info>Router script: </info><comment>{$script}</comment>");
        }
        
        if ($docroot) {
            passthru('"'.PHP_BINARY.'"'." -S {$host}:{$port} -t{$docroot} {$script}");
        } else {
            passthru('"'.PHP_BINARY.'"'." -S {$host}:{$port} {$script}");
        }
    }
}
