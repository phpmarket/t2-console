<?php

namespace T2\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use App\App;
use Throwable;

class Stop extends Command
{
    /**
     * @var string
     */
    protected static string $defaultName = 'stop';

    /**
     * @var string
     */
    protected static string $defaultDescription = 'Stop worker. Use mode -g to stop gracefully.';

    protected function configure(): void
    {
        $this->addOption('graceful', 'g', InputOption::VALUE_NONE, 'graceful stop');
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
        App::run();
        return self::SUCCESS;
    }
}