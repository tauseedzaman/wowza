<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\users_roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         // users with admin role
        //  $user2 = User::create([
        //     'name' => "admin",
        //     'email' => 'admin@gmail.com',
        //     'username' => 'admin',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);
        // $userrole = users_roles::create([
        //     'user_id' => $user2->id,
        //     'role_id' => 2,
        // ]);


        $this->call(roleSeeder::class);
        // // users with manager role
        // $user2 = User::create([
        //     'name' => "manager",
        //     'email' => 'manager@gmail.com',
        //     'username' => 'manager',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);
        // $userrole = users_roles::create([
        //     'user_id' => $user2->id,
        //     'role_id' => 3,
        // ]);

        // // users with user role
        // $user3 = User::create([
        //     'name' => "user",
        //     'email' => 'user@gmail.com',
        //     'username' => 'user',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);
        // $userrole = users_roles::create([
        //     'user_id' => $user3->id,
        //     'role_id' => 4,
        // ]);



        User::create([
            'name' => "tauseed zaman",
            'email' => 'tauseedzaman@gmail.com',
            'username' => 'tauseedzaman',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        // \App\Models\User::factory(50)->create();
        $this->call(UsersRolesSeeder::class);
    }
}
