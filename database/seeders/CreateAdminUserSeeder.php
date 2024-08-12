<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Mochamad Tirta Bening',
            'password' => bcrypt('123456'),
            'code' => 'AD-1',
            'phone' => '089776',
            'Address' => 'Padalarang'
        ]);

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        $permissionsAdmin = Permission::all();

        $adminRole->syncPermissions($permissionsAdmin);

        $user->assignRole($adminRole);

        $user1 = User::firstOrCreate([
            'email' => 'user1@gmail.com'
        ], [
            'name' => 'Mochamad Tirta Bening',
            'password' => bcrypt('113333555555'),
            'code' => 'K001',
            'phone' => '089776',
            'Address' => 'Padalarang'
        ]);

        // Buat role anggota
        $anggotaRole  = Role::firstOrCreate(['name' => 'Anggota']);

        $permissionsAnggota = [
            'mandatorySavings-list',
            'mandatorySavings-create',
            'mandatorySavings-edit',
            'mandatorySavings-delete',
            'loan-list',
            'loan-create',
            'loan-edit',
            'loan-delete'
        ];

        $anggotaRole->syncPermissions($permissionsAnggota);

        $user1->assignRole($anggotaRole);

    }
}
