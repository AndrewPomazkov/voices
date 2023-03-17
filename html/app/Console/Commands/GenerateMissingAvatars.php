<?php
declare(strict_types=1);
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;

class GenerateMissingAvatars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'avatars:generate-missing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update empty avatars for users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        $users = User::where('avatar', '')->get();
        foreach ($users as $user) {
            $avatar = new Avatar();
            $timestamp = md5(time() . Str::random());
            $avatarPath = "avatars/{$timestamp}.png";
            $avatarImage = $avatar->create($timestamp)->save(public_path($avatarPath));


            Storage::put($avatarPath, (string) $avatarImage);

            $user->avatar = $avatarPath;
            $user->save();
        }

        $this->info("Updated avatars for " . count($users) . " users.");
    }
}
