<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->foreign('photo_id')->references('id')->on('photo')->onDelete('cascade');
        });

        Schema::table('posts', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }
}
