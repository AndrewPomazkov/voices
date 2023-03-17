<?php
declare(strict_types=1);

namespace App\Console\Commands;

use Database\Seeders\UsersTableSeeder;
use Illuminate\Console\Command;

class SeedUsersCommand extends Command
{
    protected $signature = 'seed:users {main_admin?}';
    protected $description = 'Seed users with custom parameters (seed:users 1|true - recreates admin)';

    public function handle()
    {
        $main_admin = $this->argument('main_admin') === 'true' || $this->argument('main_admin') === '1';

        $seeder = app()->make(UsersTableSeeder::class, ['main_admin' => $main_admin]);
        $seeder->run();

        $this->info('Users seeded with custom parameters.');
    }
}
