<?php

namespace T2\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\App;
use T2\Console\Application;
use Throwable;
use function class_exists;

class Status extends Command
{
    /**
     * @var string
     */
    protected static string $defaultName = 'status';

    /**
     * @var string
     */
    protected static string $defaultDescription = 'Get worker status. Use mode -d to show live status.';

    protected function configure(): void
    {
        $this->addOption('live', 'd', InputOption::VALUE_NONE, 'show live status');
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