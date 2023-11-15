<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gig;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();

        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@gmail.com'
        ]);

        Gig::factory(6)->create([
            'user_id' => $user->getKey()
        ]);
        
    }
}
