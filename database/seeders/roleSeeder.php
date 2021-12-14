<?php

namespace Database\Seeders;

use App\Models\role;
use Illuminate\Database\Seeder;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super Admin','Admin','Manager','User'];
        foreach($roles as $role){
            role::create([
                'name' => $role
            ]);
        }
    }
}
