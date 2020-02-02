<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        /*
        *   Seeds
        */

        $this->call(RolesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);


        /*
        *   Factories
        */

        factory(App\User::class, 10)->create()->each(function($user){
            $user->posts()->save(factory(App\Post::class)->make());
        });

        factory(App\Comment::class,10)->create()->each(function($comment){
            $comment->replies()->save(factory(App\CommentReply::class)->make());
        });


        Schema::enableForeignKeyConstraints();
    }
}
