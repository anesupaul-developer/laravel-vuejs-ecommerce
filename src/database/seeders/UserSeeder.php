<?php

namespace Database\Seeders;

use App\Definitions\BaseDefinition;
use App\Definitions\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User as Model;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@filament-ecommerce.test',
                'role' => UserType::SUPER_ADMIN->value
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@filament-ecommerce.test',
                'role' => UserType::MANAGER->value
            ],
            [
                'name' => 'Adam Griffins',
                'email' => 'adam@filament-ecommerce.test',
                'role' => UserType::GENERAL_USER->value
            ]

        ];

        foreach($users as $user) {
            if (!DB::table('users')->where('email', $user['email'])->exists()) {
                 $customer = Model::factory()->create([
                     'name' => $user['name'],
                     'email' => $user['email'],
                     'is_admin_panel_user' => BaseDefinition::IS_ADMIN
                 ]);

                 $customer->assignRole(Role::create(['name' => $user['role']]));
            }
        }
    }
}
