<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        Role::create(
            [
                "role" => "superuser"
            ],
        );
        Role::create(
            [
                "role" => "employee"
            ],
        );
        // User::create([
        //     'name'      =>  'coba',
        //     'job'       =>  'coba',
        //     'email'     =>  'coba@coba.coba',
        //     'password'  =>  bcrypt('coba')
        // ]);
    }
}
