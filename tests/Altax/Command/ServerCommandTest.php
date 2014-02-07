<?php
namespace Test\Altax\Command;

use Symfony\Component\Console\Tester\CommandTester;
use Altax\Console\Application;
use Altax\Foundation\Container;
use Altax\Module\Task\Resource\DefinedTask;
use Altax\Command\ServerCommand;

class ServerCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testDefault()
    {
        $container = new Container();
        $task = new DefinedTask();
        $task->setName("test001");

        $application = new Application($container);
        $application->setAutoExit(false);
        $application->add(new ServerCommand($task));
        $command = $application->find("test");

        $commandTester = new CommandTester($command);
        $commandTester->execute(
            array("command" => $command->getName())
            );

//        echo $commandTester->getDisplay();
    }
}
