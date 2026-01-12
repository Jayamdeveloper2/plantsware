<?php

namespace Database\Seeders;

use App\Models\AdminUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Insert data using the AdminUser model
        // Check if admin already exists
        $admin = AdminUser::where('username', 'admin')->first();
        
        if (!$admin) {
            AdminUser::create([
                'name' => 'admin',
                'username' => 'admin',
                'password' => '123456', // Will be automatically hashed by setPasswordAttribute
                'remember_token' => null,
            ]);
        } else {
            // Update existing admin password if needed
            $admin->password = '123456'; // Will be auto-hashed
            $admin->save();
        }
    }
}
