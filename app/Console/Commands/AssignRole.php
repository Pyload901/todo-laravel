<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:assign-role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to a user by email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $roleName = $this->argument('role');

        // Find user
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1;
        }

        // Check if role exists
        if (!Role::where('name', $roleName)->exists()) {
            $this->error("Role '{$roleName}' does not exist.");
            $this->info("Available roles: " . Role::pluck('name')->implode(', '));
            return 1;
        }

        // Assign role
        $user->syncRoles([$roleName]);
        
        $this->info("Successfully assigned '{$roleName}' role to {$user->name} ({$email})");
        return 0;
    }
}
