<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'mandatorySavings-list',
            'mandatorySavings-create',
            'mandatorySavings-edit',
            'mandatorySavings-delete',
            'loan-list',
            'loan-create',
            'loan-edit',
            'loan-delete',
            'installment-list',
            'installment-create',
            'installment-edit',
            'installment-delete',
            'principalSavings-list',
            'principalSavings-create',
            'principalSavings-edit',
            'principalSavings-delete',
        ];

        foreach ($permissions as $permission) {
            // Cek apakah izin sudah ada sebelum membuatnya
            if (Permission::where('name', $permission)->doesntExist()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
