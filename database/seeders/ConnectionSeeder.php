<?php

namespace Database\Seeders;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ConnectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Create connections between users
        foreach ($users as $user) {
            // Get random users to connect with (excluding self)
            $connectWithUsers = User::where('id', '!=', $user->id)
                ->inRandomOrder()
                ->take(rand(1, 5)) // Random number of connections (1-5)
                ->get();

            foreach ($connectWithUsers as $connectUser) {
                Connection::create([
                    'sender_id' => $user->id,
                    'receiver_id' => $connectUser->id,
                    'status' => 'declined', // You can use: pending, accepted, rejected
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
