<?php

namespace Database\Seeders;

use App\Models\users_roles;
use Illuminate\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        users_roles::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
