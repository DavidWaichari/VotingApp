<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'dwaichari@gmail.com')->first();
        //create david
        if (!$user) {
            User::create([
                'name'=> 'David Waichari',
                'email'=> 'dwaichari@gmail.com',
                'id_number'=> '29237891',
                'phone_number' => '0708473015',
                'is_admin' => 'Yes',
                'can_vote' => 'Yes',
                'member_number' => '123456',
            ]);
        }
    }
}
