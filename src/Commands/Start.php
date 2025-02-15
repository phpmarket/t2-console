<?php

namespace T2\Console\Commands;

use App\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use T2\Console\Application;
use Throwable;
use function class_exists;

class Start extends Command
{
    /**
     * @var string
     */
    protected static string $defaultName = 'start';

    /**
     * @var string
     */
    protected static string $defaultDescription = 'Start worker in DEBUG mode. Use mode -d to start in DAEMON mode.';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addOption('daemon', 'd', InputOption::VALUE_NONE, 'DAEMON mode');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws Throwable
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (class_exists(App::class)) {
            App::run();
            return self::SUCCESS;
        }
        Application::run();
        return self::SUCCESS;
    }
}