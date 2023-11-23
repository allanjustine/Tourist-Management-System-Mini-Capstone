<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermission = Permission::create(['name' => 'manage-all']);

        $adminCreate = Permission::create(['name' => 'admin-create']);
        $adminEdit = Permission::create(['name' => 'admin-edit']);
        $adminView = Permission::create(['name' => 'admin-view']);
        $adminDelete = Permission::create(['name' => 'admin-delete']);
        $adminIndex = Permission::create(['name' => 'admin-index']);

        $adminPermission->givePermissionTo(
            [
                $adminCreate, $adminEdit, $adminView, $adminDelete, $adminIndex
            ]
        );

        $userPermission = Permission::create(['name' => 'manage-posts']);

        $userCreate = Permission::create(['name' => 'post-create']);
        $userEdit = Permission::create(['name' => 'post-edit']);
        $userView = Permission::create(['name' => 'post-view']);
        $userDelete = Permission::create(['name' => 'post-delete']);
        $userIndex = Permission::create(['name' => 'post-index']);

        $userPermission->givePermissionTo(
            [
                $userCreate, $userEdit, $userView, $userDelete, $userIndex
            ]
        );

    }
}
