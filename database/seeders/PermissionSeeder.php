<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    private array $permissions = [
        'view-contact-requests',
        'done-contact-requests',
        'delete-contact-requests',
    ];

    public function run()
    {
        foreach ($this->permissions as $permission) {
            if (Permission::where('name', $permission)->first()) {
                continue;
            }
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
