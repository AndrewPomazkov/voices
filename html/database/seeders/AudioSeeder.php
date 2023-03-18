<?php

namespace Database\Seeders;

use App\Models\Audio;
use App\Models\User;
use Illuminate\Database\Seeder;

class AudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Получаем всех пользователей
        $users = User::all();

        // Для каждого пользователя создаем от 5 до 20 аудиозаписей
        $users->each(function ($user) {
            $audioCount = rand(5, 20);

            for ($i = 0; $i < $audioCount; $i++) {
                Audio::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        });
    }
}
