<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'  => 'John Doe',
                'email' => 'john@example.com',
            ],
            [
                'name'  => 'Jane Smith',
                'email' => 'jane@example.com',
            ],
            [
                'name'  => 'Mike Johnson',
                'email' => 'mike@example.com',
            ],
            [
                'name'  => 'Sarah Wilson',
                'email' => 'sarah@example.com',
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name'     => $userData['name'],
                    'password' => Hash::make('password'),
                ]
            );
        }

        echo "✅ Users created successfully\n";
    }
}
