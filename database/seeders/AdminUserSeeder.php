<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'abd',
            'email' => 'abd@gmail.com',
            'phonenumber' => '0935545289',
            'password' => Hash::make('00000000'),
            'role' => 'admin',
        ]);
    }
}
