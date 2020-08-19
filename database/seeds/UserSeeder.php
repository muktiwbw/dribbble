<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Redaco',
            'email' => 'redaco@example.com',
            'password' => bcrypt('password123')
        ]);
    }
}
