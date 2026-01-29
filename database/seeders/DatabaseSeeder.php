<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Editor User
        $editor = User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('password'),
            'role' => 'editor',
        ]);

        // Create Regular User
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create sample blogs
        Blog::create([
            'title' => 'Welcome to Our Blog',
            'content' => 'This is the first blog post created by the admin. Laravel makes it easy to build powerful web applications with elegant syntax.',
            'user_id' => $admin->id,
        ]);

        Blog::create([
            'title' => 'Getting Started with Laravel',
            'content' => 'Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling.',
            'user_id' => $admin->id,
        ]);

        Blog::create([
            'title' => 'Understanding Eloquent ORM',
            'content' => 'Eloquent ORM included with Laravel provides a beautiful, simple ActiveRecord implementation for working with your database. Each database table has a corresponding Model.',
            'user_id' => $editor->id,
        ]);

        Blog::create([
            'title' => 'Role-Based Access Control',
            'content' => 'Implementing role-based access control in Laravel is straightforward. You can use middleware, gates, or policies to manage user permissions effectively.',
            'user_id' => $editor->id,
        ]);

        Blog::create([
            'title' => 'Building RESTful APIs',
            'content' => 'Laravel provides excellent tools for building RESTful APIs. With resource controllers and API resources, you can quickly build robust APIs.',
            'user_id' => $admin->id,
        ]);
    }
}
