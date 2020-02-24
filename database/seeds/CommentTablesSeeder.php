<?php

use Illuminate\Database\Seeder;

class CommentTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Comment::class, 1000000)->create();
    }
}
