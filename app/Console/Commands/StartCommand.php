<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class StartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'First command to run when the app starts.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting the app...');
        $this->runMigrations();
        $this->addDefaultAdmin();
        $this->addSiteSettings();
        $this->info('Project successfully established.');
    }

    /**
     * Run the migrations using a shell command.
     */
    private function runMigrations()
    {
        $process = new Process(['php', 'artisan', 'migrate', '--force']);
        $process->setTimeout(3600); // Optional: set a timeout for the process

        try {
            $process->mustRun();

            $this->info($process->getOutput());
        } catch (ProcessFailedException $exception) {
            $this->error('The migration command failed.');
            $this->error($exception->getMessage());
        }
    }

    /**
     * Add default admin user.
     */
    private function addDefaultAdmin()
    {
        $this->info('Adding default admin user...');

        $process = new Process(['php', 'artisan', 'db:seed', '--class=AdminSeeder']);
        $process->setTimeout(3600); // Optional: set a timeout for the process

        try {
            $process->mustRun();

            $this->info($process->getOutput());
        } catch (ProcessFailedException $exception) {
            $this->error('The seeder command failed.');
            $this->error($exception->getMessage());
        }
    }

    /**
     * Add site settings.
     */
    private function addSiteSettings()
    {
        $this->info('Adding site settings...');

        $process = new Process(['php', 'artisan', 'db:seed', '--class=SiteSettingsSeeder']);
        $process->setTimeout(3600); // Optional: set a timeout for the process

        try {
            $process->mustRun();

            $this->info($process->getOutput());
        } catch (ProcessFailedException $exception) {
            $this->error('The seeder command failed.');
            $this->error($exception->getMessage());
        }

        $this->info('Site settings seeded.');
    }
}
