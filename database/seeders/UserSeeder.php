<?php

namespace Database\Seeders;
 
use App\Models\User;
use Illuminate\Database\Seeder;
 
class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name'     => 'John Doe',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
    }
}
