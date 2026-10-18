<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrNew([
            'email' => 'admin@example.com',
        ]);

        if (! $admin->exists) {
            $admin->name = 'Administrator';
            $admin->password = 'AdminBelajar123!';
            $admin->role = 'admin';
            $admin->save();
        }
    }
}