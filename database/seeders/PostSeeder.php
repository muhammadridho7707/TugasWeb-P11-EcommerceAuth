<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $authors = User::whereIn('role', [User::ROLE_ADMIN, User::ROLE_EDITOR])->get();

        foreach ($authors as $author) {
            Post::factory(3)->create(['user_id' => $author->id]);
        }
    }
}