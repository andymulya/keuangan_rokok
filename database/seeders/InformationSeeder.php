<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $info = [
            [
                'name' => 'Tempat Lahir',
                'type' => 'text',
                'role_name' => [Role::ADMIN, Role::GUEST]
            ],
            [
                'name' => 'Tanggal Lahir',
                'type' => 'date',
                'role_name' => [Role::ADMIN, Role::GUEST]
            ],
            [
                'name' => 'Nomor Telepon',
                'type' => 'phone',
                'role_name' => [Role::ADMIN, Role::GUEST]
            ],
        ];

        foreach ($info as $value) {
            $role = Role::whereIn('name', $value['role_name'])->pluck('id');
            Information::create([
                'name' => $value['name'],
                'type' => $value['type'],
            ])->role()->sync($role);
        }
    }
}
