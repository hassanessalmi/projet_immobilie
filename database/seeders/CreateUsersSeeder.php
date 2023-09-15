<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'firstName' => 'Admin',
                'lastName' => 'Admin',
                'email' => 'admin@admin.com',
                'is_admin' => '1',
                'password' => bcrypt('1111'),
            ],
            [
                'firstName' => 'User',
                'lastName' => 'User',
                'email' => 'normal@user.com',
                'is_admin' => '0',
                'password' => bcrypt('1111'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}