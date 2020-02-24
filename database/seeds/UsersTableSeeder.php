<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 1000000)->create()->each(function ($user) {
            $user->comments()->createMany(factory(App\Models\Comment::class, 2)->make()->toArray());
        });
    }
}
