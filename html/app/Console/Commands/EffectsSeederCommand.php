<?php

namespace App\Console\Commands;

use Database\Seeders\EffectsSeeder;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class EffectsSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:effects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the effects table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        $seeder = app()->make(EffectsSeeder::class);
        $seeder->run();

        $this->info('Effects table populated successfully');
        return CommandAlias::SUCCESS;
    }
}
