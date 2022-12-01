<?php

namespace Database\Seeders;

use App\Models\Motivation;
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
        User::create([
            'name'      =>  'test',
            'job'       =>  'test',
            'email'     =>  'test@test.test',
            'role_id'   =>  '2',
            'password'  =>  bcrypt('test')
        ]);
        User::create([
            'name'      =>  'example',
            'job'       =>  'example',
            'email'     =>  'example@example.example',
            'role_id'   =>  '2',
            'password'  =>  bcrypt('example')
        ]);
        Motivation::create([
            'motivation'      =>  'test motivation',
            'user_id'       =>  '1',

        ]);
        Motivation::create([
            'motivation'      =>  'example motivation',
            'user_id'       =>  '2',

        ]);

    }
}
