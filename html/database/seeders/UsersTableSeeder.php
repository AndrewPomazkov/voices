<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use SebastianBergmann\CodeCoverage\Report\PHP;

class UsersTableSeeder extends Seeder
{

    public function __construct(private readonly bool $main_admin)
    {
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) { // 50 random users
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Set a default password for all generated users
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => $faker->randomElement(['user', 'admin']), // Randomly assign 'user' or 'admin' role
                'avatar' => $faker->imageUrl(100, 100, 'people'), // Generate random 100x100 avatars
            ]);
        }
        // Restore admin
        echo 'Do we need admin account?'.PHP_EOL;
        if($this->main_admin === true) {
            echo 'Yes we do!'.PHP_EOL;
            DB::table('users')->insert([
                'name' => 'censore',
                'email' => 'pomazkova@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('xlsqbq'), // Set a default password for all generated users
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => $faker->randomElement(['admin']), // Randomly assign 'user' or 'admin' role
                'avatar' => $faker->imageUrl(100, 100, 'people'), // Generate random 100x100 avatars
            ]);
        }else{
            echo 'No, seriously?'.PHP_EOL;
        }

    }
}
