<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user or promote an existing one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        if ($email) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->role = 'admin';
                $user->save();
                $this->info("User {$email} has been promoted to Admin.");
                return;
            }
            $this->error("User not found. Creating new admin...");
        } else {
            $email = 'admin@cahaya.com';
        }

        // Create default admin
        $password = 'password';
        
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin User',
                'password' => Hash::make($password),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->info("Admin created successfully!");
        $this->table(['Name', 'Email', 'Password', 'Role'], [[$user->name, $user->email, $password, $user->role]]);
    }
}
