<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Role;

class AssignDefaultRoles extends Command
{
    protected $signature = 'assign:default-roles';
    protected $description = 'Assign default roles to users who lack them';

    public function handle()
    {
        $defaultRole = Role::where('name', 'user')->first(); // เปลี่ยน 'user' ตาม role ที่เหมาะสม
        if (!$defaultRole) {
            $this->error('Default role not found!');
            return 1;
        }

        $usersWithoutRoles = User::doesntHave('roles')->get();
        foreach ($usersWithoutRoles as $user) {
            $user->roles()->attach($defaultRole->id);
            $this->info("Assigned role 'user' to user ID: {$user->id}");
        }

        $this->info('Default roles assigned successfully!');
        return 0;
    }
}

