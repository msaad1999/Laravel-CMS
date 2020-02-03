<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $output = new Symfony\Component\Console\Output\ConsoleOutput();

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
        $output->writeln("<comment>Running Factories</comment>");
        $factoryTime = Carbon::now();

        factory(App\User::class, 20)->create()->each(function($user){
            $user->posts()->save(factory(App\Post::class)->make());
        });

        factory(App\Comment::class,20)->create()->each(function($comment){
            $comment->replies()->save(factory(App\CommentReply::class)->make());
        });

        $diff = Carbon::now()->diffInSeconds($factoryTime);
        $output->writeln("<info>Factory Production Complete</info> ($diff seconds)\n");


        Schema::enableForeignKeyConstraints();
    }
}
