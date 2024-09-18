<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'name'      => 'super-admin',
            'email'     => 'admin@codenex.com',
            'password'  => Hash::make('P@$$word#2024')
        ]);

        $superAdmin->assignRole('super-admin');
  }
}
