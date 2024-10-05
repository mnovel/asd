<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Dashboard',
            'Participant',
            'TPS',
            'Candidate',
            'Voting Session',
            'Precence',
            'Voting',
            'Barcode',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'Admin' => [
                'Dashboard',
                'Participant',
                'TPS',
                'Candidate',
                'Voting Session',
                'Precence',
            ],
            'Tps' => [
                'Dashboard',
                'Voting',
            ],
            'Participant' => [
                'Dashboard',
                'Barcode'
            ]
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($rolePermissions);
        }
    }
}
