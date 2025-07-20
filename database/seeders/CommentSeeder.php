<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Comment;
use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::factory(50)->recycle([
            Facility::all(),
            User::all(),
        ])->create();
    }
}
