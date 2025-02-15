<?php

namespace T2\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Version extends Command
{
    /**
     * @var string
     */
    protected static string $defaultName = 'version';

    /**
     * @var string
     */
    protected static string $defaultDescription = 'Show T2Engine version';

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $installed_file = base_path() . '/vendor/composer/installed.php';
        if (is_file($installed_file)) {
            $version_info = include $installed_file;
        }
        $version = $version_info['versions']['phpmarket/t2-console']['pretty_version'] ?? '';
        $output->writeln("T2Engine $version");
        return self::SUCCESS;
    }
}