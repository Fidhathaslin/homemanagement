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
            'email'     => 'admin@home.com',
            'password'  => Hash::make('P@$$word#2025')
        ]);

        $superAdmin->assignRole('super-admin');
  }
}
