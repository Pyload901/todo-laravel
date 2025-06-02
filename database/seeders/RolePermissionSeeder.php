<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view todos',
            'create todos',
            'edit todos',
            'delete todos',
            'manage users',
            'view all todos',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Admin gets all permissions
        $adminRole->givePermissionTo(Permission::all());

        // User gets basic todo permissions (for their own todos)
        $userRole->givePermissionTo([
            'view todos',
            'create todos',
            'edit todos',
            'delete todos'
        ]);

        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => \Hash::make('password'),
        ]);
        $adminUser->assignRole('admin');

        // Create regular user
        $regularUser = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => \Hash::make('password'),
        ]);
        $regularUser->assignRole('user');

        // Assign user role to existing test user if it exists
        $testUser = User::where('email', 'test@example.com')->first();
        if ($testUser) {
            $testUser->assignRole('user');
        }
    }
}
